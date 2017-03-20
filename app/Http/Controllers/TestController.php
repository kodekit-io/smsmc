<?php

namespace App\Http\Controllers;

use App\Service\Smsmc;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function echarts()
    {
        $data['pageTitle'] = 'Test Echarts';
        return view('tests.echarts-image', $data);
    }

    public function echartsPost(Request $request)
    {
        $data['pageTitle'] = 'Show Image';
        $data['base64Image'] = $request->input('chart1');
        return view('tests.echarts-showimage', $data);
    }

    public function googlechart()
    {
        return view('tests.googlechart');
    }

    public function reportPdf()
    {
        $pdf = \PDF::loadView('tests.googlechart');
        $pdf->setPaper('A4', 'landscape');
        $pdfFileName = 'report.pdf';
        $pdf->save(public_path($pdfFileName));
    }


    public function api1($x,$a)
    {
        $params = [
            'pid' => $x,
            'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
            'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api2($x,$a,$b)
    {
        $params = [
            'pid' => $x,
            'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
            'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api3($x,$a,$b,$c)
    {
        $params = [
            'pid' => $x,
            'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
            'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api4($x,$a,$b,$c,$d)
    {
        $params = [
            'pid' => $x,
            'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
            'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function api5($x,$a,$b,$c,$d,$e)
    {
        $params = [
            'pid' => $x,
            'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
            'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d.'/'.$e, $params);
        //return \GuzzleHttp\json_encode($result->result);
        echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
}
