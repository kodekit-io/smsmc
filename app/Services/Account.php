<?php

namespace App\Service;


class Account
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Account constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function getSocialAccounts()
    {
        $params = [
            'id_login' => \Auth::id()
        ];

        $request = $this->smsmc->post('project/getprofile', $params);
        if ($request->status == '200') {
            return $request->result->sosmed;
        }

        return [];
    }

    public function updateSocialAccount($data)
    {
        $params = [
            'id_login' => \Auth::user()->id
        ];
        $facebooks = $data['field_facebook'];
        $twitters = $data['field_twitter'];
        $youtubes = $data['field_youtube'];
        $instagrams = $data['field_instagram'];
        $params = $this->parseSocmedAccountData($facebooks, 'fb', $params);
        $params = $this->parseSocmedAccountData($twitters, 'tw', $params);
        $params = $this->parseSocmedAccountData($youtubes, 'yt', $params);
        $params = $this->parseSocmedAccountData($instagrams, 'ig', $params);
        // dd($params);
        // \Log::info($params);
        $this->smsmc->post('project/editprofile', $params);
    }

    public function parseSocmedAccountData($data, $type, $params)
    {
        if (count($data) > 0) {
            //$x = 1;
            foreach ($data as $key => $account) {
                $params[$type . $key] = (is_null($account) ? '' : $account);
                //$x++;
            }
        }

        return $params;
    }
}
