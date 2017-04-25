<?php

namespace App\Service;


class Notification
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Notification constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function getNotifications()
    {
        $params = [
            'uid' => \Auth::id()
        ];

        $response = $this->smsmc->post('/ticket/notif', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }
}