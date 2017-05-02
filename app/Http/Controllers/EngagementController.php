<?php

namespace App\Http\Controllers;

use App\Service\Engagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EngagementController extends Controller
{
    /**
     * @var Engagement
     */
    private $engagement;

    /**
     * EngagementController constructor.
     */
    public function __construct(Engagement $engagement)
    {
        $this->engagement = $engagement;
    }

    public function accounts()
    {
        $socmedAttribute = session('socmedAttribute');
        $data['socmedAttribute'] = $socmedAttribute;
        $data['pageTitle'] = 'Engagement Accounts';
        return view('pages.engagement-accounts', $data);
    }

    public function login(Request $request, $idMedia)
    {
        $response = $this->engagement->login($request, $idMedia);
        if ($response->status == 200) {
            $this->saveSocmedToken($response->result, $idMedia);
        }
        return redirect('engagement-accounts');
    }

    public function logout(Request $request, $idMedia)
    {
        $response = $this->engagement->logout($request, $idMedia);
        if ($response->status == 200) {
            $this->removeSocmedToken($idMedia);
        }
        return redirect('engagement-accounts');
    }

    private function saveSocmedToken($result, $idMedia)
    {
        $socmedAttribute = [];
        if (session()->has('socmedAttribute')) {
            $socmedAttribute = session('socmedAttribute');
        }
        $socmedAttribute[$idMedia] = [
            'token' => $result->token,
            'id' => $result->user->id,
            'email' => $result->user->email,
            'userName' => $result->user->userName
        ];
        session(['socmedAttribute' => $socmedAttribute]);
    }

    private function removeSocmedToken($idMedia)
    {
        $socmedAttribute = session('socmedAttribute');
        array_pull($socmedAttribute, $idMedia);
        session()->forget('socmedAttribute');
        session(['socmedAttribute' => $socmedAttribute]);
    }
}
