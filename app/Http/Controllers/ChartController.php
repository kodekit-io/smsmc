<?php

namespace App\Http\Controllers;

use App\Service\ChartParameter;
use App\Service\Smsmc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * ChartController constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function brandEquity(Request $request)
    {
        $data = $this->plainProject('brandequity', $request);
        return $this->parseChartResult($data);
    }

    public function barSentiment(Request $request)
    {
        $data = $this->projectWithMedia('sentiment', $request);
        return $this->parseChartResult($data);
    }

    public function trendSentiment(Request $request)
    {
        $data = $this->projectWithMedia('sentimenttrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendPost(Request $request)
    {
        $data = $this->projectWithMedia('posttrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendBuzz(Request $request)
    {
        $data = $this->projectWithMedia('buzztrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendReach(Request $request)
    {
        $data = $this->projectWithMedia('reachtrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendInteraction(Request $request)
    {
        $data = $this->projectWithMedia('interactiontrend', $request);
        return $this->parseChartResult($data);
    }

    public function piePost(Request $request)
    {
        $data = $this->projectWithMedia('post', $request);
        return $this->parseChartResult($data);
    }

    public function pieBuzz(Request $request)
    {
        $data = $this->projectWithMedia('buzz', $request);
        return $this->parseChartResult($data);
    }

    public function pieInteraction(Request $request)
    {
        $data = $this->projectWithMedia('interaction', $request);
        return $this->parseChartResult($data);
    }

    public function pieUniqueUser(Request $request)
    {
        $data = $this->projectWithoutMedia('uniqueuser', $request);
        return $this->parseChartResult($data);
    }

    public function pieComment(Request $request)
    {
        $data = $this->projectWithMedia('comment', $request);
        return $this->parseChartResult($data);
    }

    public function pieLike(Request $request)
    {
        $data = $this->plainProject('1/like', $request);
        return $this->parseChartResult($data);
    }

    public function pieShare(Request $request)
    {
        $data = $this->plainProject('1/share', $request);
        return $this->parseChartResult($data);
    }

    public function barInteractionRate(Request $request)
    {
        $data = $this->projectWithMedia('interactionrate', $request);
        return $this->parseChartResult($data);
    }

    public function barMediaShare(Request $request)
    {
        $data = $this->plainProject('shareofmedia', $request);
        return $this->parseChartResult($data);
    }

    public function wordcloud(Request $request)
    {
        $data = $this->projectWithMedia('wordcloud', $request);
        return $this->parseChartResult($data);
    }

    public function convo(Request $request)
    {
        $data = $this->projectWithMedia('convo', $request);
        return $this->parseChartResult($data);
    }



    private function projectWithMedia($url, $request)
    {
        $chartParameter = new ChartParameter($request);
        $idMedia = $request->input('idMedia');
        $apiUrl = 'project/1';
        if ($idMedia != '') {
            $apiUrl .= '/' . $idMedia;
        }
        $apiUrl .= '/' . $url;

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function projectWithoutMedia($url, $request)
    {
        $chartParameter = new ChartParameter($request);
        // $idMedia = $request->input('idMedia');
        $apiUrl = 'project/1';
        // if ($idMedia != '') {
        //     $apiUrl .= '/' . $idMedia;
        // }
        $apiUrl .= '/' . $url;

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function plainProject($url, $request)
    {
        $apiUrl = 'project/' . $url;
        $chartParameter = new ChartParameter($request);
        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function chartApi($url, $chartParameter)
    {
        $params['pid'] = $chartParameter->projectId;
        $params['StartDate'] = $chartParameter->startDate;
        $params['EndDate'] = $chartParameter->endDate;
        $params['brandID'] = $chartParameter->keywords;
        $params['sentiment'] = $chartParameter->sentiments;
        $params['text'] = $chartParameter->text;

        return $this->smsmc->post($url, $params);
    }

    private function parseChartResult($data)
    {
        $result = [];
        if ($data->status == 200) {
            $result = $data->result;
        }

        return \GuzzleHttp\json_encode($result);
    }

}
