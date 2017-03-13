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

    public function accountList()
    {

    }
}