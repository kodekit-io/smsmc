<?php

namespace App\Http\Controllers;

use App\Service\Smsmc;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $data['firstChart'] = $request->input('01');
        $data['secondChart'] = $request->input('04');
        $data['thirdChart'] = $request->input('05');
        $data['fourthChart'] = $request->input('06');
        // return view('tests.echarts-showimage', $data);

        $pdf = \PDF::loadView('tests.echarts-showimage', $data);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('report.pdf');

        // $pdf->save(public_path($pdfFileName));
        // return view('tests.echarts-showimage', $data);
    }

    public function googlechart()
    {
        return view('tests.googlechart');
    }

	public function summary()
    {
        $data['pageTitle'] = 'PDF Report';
        return view('tests.report-summary', $data);
    }

    public function reportPdf()
    {
        $pdf = \PDF::loadView('tests.googlechart');
        $pdf->setPaper('A4', 'landscape');
        $pdfFileName = 'report.pdf';
        $pdf->save(public_path($pdfFileName));
    }
    public function medialist()
    {
        $params = [
            'uid' => Auth::user()->id,
        ];
        $result = $this->smsmc->post('medialist', $params);
        return \GuzzleHttp\json_encode($result->result);
        // echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function forumlist()
    {
        $params = [
            'uid' => Auth::user()->id,
        ];
        $result = $this->smsmc->post('forumlist', $params);
        return \GuzzleHttp\json_encode($result->result);
        // echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }
    public function bloglist()
    {
        $params = [
            'uid' => Auth::user()->id,
        ];
        $result = $this->smsmc->post('bloglist', $params);
        return \GuzzleHttp\json_encode($result->result);
        // echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }

    public function engagementCalendar()
    {
        $params = [
            'uid' => Auth::user()->id
        ];
        $result = $this->smsmc->post('engagement/calendar', $params);
        return \GuzzleHttp\json_encode($result->result);
        // echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }

    public function engagementView()
    {
        $params = [
            'uid' => Auth::user()->id
        ];
        $result = $this->smsmc->post('engagement/view', $params);
        return \GuzzleHttp\json_encode($result->result);
        // echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    }

    public function uploadFile()
    {
        $response = $this->smsmc->postMultipart('http://103.16.199.58/sinarmas-plus/api/upload', [], false, false, true);
        dd($response);
    }

    public function tiketditel($ticketId)
    {
        $params = [
            'ticketId' => $ticketId,
            'uid' => \Auth::user()->id,
        ];

        $response = $this->smsmc->post('ticket/detail', $params);
        if ($response->status == '200') {
            // return $response->result;
            // return \GuzzleHttp\json_encode($response->result);
            return '<pre>'.json_encode($response->result, JSON_PRETTY_PRINT).'</pre>';
        }
    }
    public function tikettipe()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('ticket/tipe', $params);
        if ($response->status == '200') {
            // return $response->result;
            // return \GuzzleHttp\json_encode($response->result);
            return '<pre>'.json_encode($response->result, JSON_PRETTY_PRINT).'</pre>';
        }
    }
    public function tiketstatus()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('ticket/status', $params);
        if ($response->status == '200') {
            // return $response->result;
            // return \GuzzleHttp\json_encode($response->result);
            return '<pre>'.json_encode($response->result, JSON_PRETTY_PRINT).'</pre>';
        }
    }

    //
	// public function plist($page,$row)
	// {
	// 	$params = [
	// 		// 'pid' => $pid,
	// 		// 'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
	// 		// 'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
	// 		// 'sentiment' => '1,0,-1',
    //         'uid' => Auth::user()->id,
    //         // 'auth_token' => 'qcS97Knu',
	// 		'page' => $page,
	// 		'row' => $row,
    //         // 'totalPage' => 1
	// 	];
	// 	$result = $this->smsmc->post('project/list', $params);
	// 	// return \GuzzleHttp\json_encode($result->result);
	// 	echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
	// }
	// public function api0($x,$y,$a)
	// {
	// 	$params = [
	// 		'id_login' => $x,
	// 		'id_media' => $y,
	// 	];
	// 	$result = $this->smsmc->post($a, $params);
	// 	//return \GuzzleHttp\json_encode($result->result);
	// 	echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
	// }
    // public function api1($x,$a)
    // {
    //     $params = [
    //         'pid' => $x,
    //         'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
    //         'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
    //         'sentiment' => '1,0,-1',
    //     ];
    //     $result = $this->smsmc->post('project/'.$a, $params);
    //     //return \GuzzleHttp\json_encode($result->result);
    //     echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    // }
    // public function api2($x,$a,$b)
    // {
    //     $params = [
    //         'pid' => $x,
    //         'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
    //         'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
    //         'sentiment' => '1,0,-1',
    //     ];
    //     $result = $this->smsmc->post('project/'.$a.'/'.$b, $params);
    //     //return \GuzzleHttp\json_encode($result->result);
    //     echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    // }
    // public function api3($x,$a,$b,$c)
    // {
    //     $params = [
    //         'pid' => $x,
    //         'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
    //         'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
    //         'sentiment' => '1,0,-1',
    //     ];
    //     $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c, $params);
    //     //return \GuzzleHttp\json_encode($result->result);
    //     echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    // }
    // public function api4($x,$a,$b,$c,$d)
    // {
    //     $params = [
    //         'pid' => $x,
    //         'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
    //         'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
    //         'sentiment' => '1,0,-1',
    //     ];
    //     $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d, $params);
    //     //return \GuzzleHttp\json_encode($result->result);
    //     echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    // }
    // public function api5($x,$a,$b,$c,$d,$e)
    // {
    //     $params = [
    //         'pid' => $x,
    //         'StartDate' => Carbon::now('Asia/Jakarta')->subWeek()->format('Y-m-d\TH:i:s\Z'),
    //         'EndDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z'),
    //         'sentiment' => '1,0,-1',
    //     ];
    //     $result = $this->smsmc->post('project/'.$a.'/'.$b.'/'.$c.'/'.$d.'/'.$e, $params);
    //     //return \GuzzleHttp\json_encode($result->result);
    //     echo '<pre>'.json_encode($result->result, JSON_PRETTY_PRINT).'</pre>';
    // }
}
