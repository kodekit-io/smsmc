<?php

namespace App\Http\Controllers;

use App\Service\Smsmc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    protected $smsmc;

    /**
     * Create a new controller instance.
     *
     * @param Sikd $sikd
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->smsmc = $smsmc;
    }

    public function getLogin(Request $request
    )
    {
        Log::warning('Check on login ==> ' . \GuzzleHttp\json_encode(Auth::check()));
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
        $attributes = [
            'id'        => $apiLoginResult->result->user->userId,
            'password'  => $password,
            'email'     => $apiLoginResult->result->user->userName,
            'name'      => $apiLoginResult->result->user->userName,
            'remember_token' => ''
        ];

        session(['userAttributes' => $attributes]);

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
