<?php

namespace App\Service;


use Illuminate\Support\Facades\Auth;

class Project
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Project constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function projectList()
    {
        $params = [
            'uid' => Auth::user()->id,
        ];

        $projectList = $this->smsmc->post('project/list', $params);

        if ($projectList->status == 200) {
            return $projectList->result;
        }

        return [];
    }
}