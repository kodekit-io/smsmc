<?php

namespace App\Http\Controllers;

use App\Service\Role;
use App\Service\Smsmc;
use App\Service\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    protected $smsmc;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Role
     */
    private $role;

    /**
     * Create a new controller instance.
     *
     * @param Sikd $sikd
     */
    public function __construct(Smsmc $smsmc, User $user, Role $role)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->smsmc = $smsmc;
        $this->user = $user;
        $this->role = $role;
    }

    public function getLogin(Request $request)
    {
        $data['pageTitle'] = 'Login';
        return view('pages.login', $data);
    }

    public function postLogin(Request $request)
    {
        $apiLoginResult = $this->smsmc->getAccessToken($request->get('username'), $request->get('password'));

        if ($apiLoginResult->status == 200) {
            $this->signIn($apiLoginResult, $request->get('password'));

            return redirect('/home');
        } else {
            return redirect('/login')->withErrors(['error' => $apiLoginResult->result]);
        }

    }

    protected function signIn($apiLoginResult, $password)
    {
        $token = $apiLoginResult->result->token;
        $userId = $apiLoginResult->result->user->userId;
        $permissions = $apiLoginResult->result->user->permissions;

        $attributes = [
            'id'        => $userId,
            'password'  => $password,
            'email'     => $apiLoginResult->result->user->userName,
            'name'      => $apiLoginResult->result->user->userName,
            'remember_token' => '',
            'permissions' => $permissions
        ];

        session(['userAttributes' => $attributes]);

        $socmedAttribute = [];
        if (Storage::exists('socmed.json')) {
            $contents = Storage::get('socmed.json');
        }
        if ($contents) {
            $socmedAttribute = \GuzzleHttp\json_decode($contents);
        }
        session(['socmedAttribute' => $socmedAttribute]);

        Auth::loginUsingId($apiLoginResult->result->user->userName);

        $this->saveApiAuthToken($token);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function saveApiAuthToken($token)
    {
        session(['api_auth_token' => $token]);
    }
}
