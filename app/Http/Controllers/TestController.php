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

    public function api1($a)
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2017-02-01T00:00:00Z',
            'EndDate' => '2017-02-10T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api2($a,$b)
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2017-02-01T00:00:00Z',
            'EndDate' => '2017-02-10T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api3($a,$b,$c)
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2017-02-01T00:00:00Z',
            'EndDate' => '2017-02-10T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api4($a,$b,$c,$d)
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2017-02-01T00:00:00Z',
            'EndDate' => '2017-02-10T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api5($a,$b,$c,$d,$e)
    {
        $params = [
            'pid' => '2131142012017',
            'StartDate' => '2017-02-01T00:00:00Z',
            'EndDate' => '2017-02-10T00:00:00Z',
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d.'/'.$e, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
}
