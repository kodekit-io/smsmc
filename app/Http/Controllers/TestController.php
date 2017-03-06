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

    public function testBrandEquity()
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2016-11-13T00:00:00Z',
            'EndDate' => '2016-11-15T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/brandequity', $params);

        return \GuzzleHttp\json_encode($result);
    }
}
