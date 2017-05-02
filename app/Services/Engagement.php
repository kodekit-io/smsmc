<?php

namespace App\Service;


class Engagement
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Engagement constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function login($request, $idMedia)
    {
        $params = [
            'uid' => \Auth::id(),
            'usernameSocmed' => $request->input('username'),
            'passwordSocmed' => $request->input('password'),
            'idMedia' => $idMedia,
            'appkey' => config('services.smsmc.key')
        ];

        return $this->smsmc->post('engagement/login', $params);
    }

    public function logout($request, $idMedia)
    {
        $socmedAttribute = session('socmedAttribute');
        $params = [
            'uid' => \Auth::id(),
            'idMedia' => $idMedia,
            'appkey' => config('services.smsmc.key'),
            'authTokenSocmed' => $socmedAttribute[$idMedia]['token'],
            'idSocmed' => $socmedAttribute[$idMedia]['id'],
        ];

        return $this->smsmc->post('engagement/logout', $params);
    }
}