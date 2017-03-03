<?php

namespace App\Http\Controllers;

use App\Service\Smsmc;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * TestController constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->smsmc = $smsmc;
    }

    public function api()
    {
        $result = $this->smsmc->post('project/list');
        //var_dump($result);
        return \GuzzleHttp\json_encode($result->result);
    }
}
