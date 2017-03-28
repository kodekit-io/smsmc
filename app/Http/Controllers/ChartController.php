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
        $data = $this->plain('brandequity', $request);
        return $this->parseChartResult($data);
    }

    public function barSentiment(Request $request)
    {
        $data = $this->withMedia('sentiment', $request);
        return $this->parseChartResult($data);
    }

    public function trendSentiment(Request $request)
    {
        $data = $this->withMedia('sentimenttrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendPost(Request $request)
    {
        $data = $this->withMedia('posttrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendBuzz(Request $request)
    {
        $data = $this->withMedia('buzztrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendReach(Request $request)
    {
        $data = $this->withMedia('reachtrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendInteraction(Request $request)
    {
        $data = $this->withMedia('interactiontrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendUser(Request $request)
    {
        $data = $this->withoutMedia('usertrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendComment(Request $request)
    {
        $data = $this->withMedia('commenttrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendView(Request $request)
    {
        $data = $this->withoutMedia('viewtrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendPotentialReach(Request $request)
    {
        $data = $this->withoutMedia('potentialreachtrend', $request);
        return $this->parseChartResult($data);
    }

    public function trendLove(Request $request)
    {
        $data = $this->withoutMedia('lovetrend', $request);
        return $this->parseChartResult($data);
    }

    public function piePost(Request $request)
    {
        $data = $this->withMedia('post', $request);
        return $this->parseChartResult($data);
    }

    public function pieBuzz(Request $request)
    {
        $data = $this->withMedia('buzz', $request);
        return $this->parseChartResult($data);
    }

    public function pieInteraction(Request $request)
    {
        $data = $this->withMedia('interaction', $request);
        return $this->parseChartResult($data);
    }

    public function pieUniqueUser(Request $request)
    {
        $data = $this->withoutMedia('uniqueuser', $request);
        return $this->parseChartResult($data);
    }

    public function pieComment(Request $request)
    {
        $data = $this->withMedia('comment', $request);
        return $this->parseChartResult($data);
    }

    public function pieLike(Request $request)
    {
        $data = $this->withoutMedia('like', $request);
        return $this->parseChartResult($data);
    }

    public function pieShare(Request $request)
    {
        $data = $this->withoutMedia('share', $request);
        return $this->parseChartResult($data);
    }

    public function pieViralReach(Request $request)
    {
        $data = $this->withoutMedia('viralreach', $request);
        return $this->parseChartResult($data);
    }

    public function piePotentialReach(Request $request)
    {
        $data = $this->withMedia('potentialreach', $request);
        return $this->parseChartResult($data);
    }

    public function pieReach(Request $request)
    {
        $data = $this->withMedia('reach', $request);
        return $this->parseChartResult($data);
    }

    public function pieView(Request $request)
    {
        $data = $this->withoutMedia('viewcount', $request);
        return $this->parseChartResult($data);
    }

    public function pieRating(Request $request)
    {
        $data = $this->withoutMedia('rating', $request);
        return $this->parseChartResult($data);
    }

    public function pieLove(Request $request)
    {
        $data = $this->withoutMedia('love', $request);
        return $this->parseChartResult($data);
    }

    public function barInteractionRate(Request $request)
    {
        $data = $this->withMedia('interactionrate', $request);
        return $this->parseChartResult($data);
    }

    public function barMediaShare(Request $request)
    {
        $data = $this->plain('shareofmedia', $request);
        return $this->parseChartResult($data);
    }

    public function barTopicDistribution(Request $request)
    {
        $data = $this->withMedia('topic', $request);
        return $this->parseChartResult($data);
    }

    public function ontologi(Request $request)
    {
        $data = $this->withMedia('ontologi', $request);
        return $this->parseChartResult($data);
    }

    public function wordcloud(Request $request)
    {
        $data = $this->withMedia('wordcloud', $request);
        return $this->parseChartResult($data);
    }

    public function convo(Request $request)
    {
        $data = $this->withMedia('convo', $request);
        return $this->parseChartResult($data);
    }

    public function influencer(Request $request)
    {
        $data = $this->withMedia('influencer', $request);
        return $this->parseChartResult($data);
    }


    private function withMedia($url, $request)
    {
        $chartParameter = new ChartParameter($request);

        $reportType = $request->input('reportType');
        $apiUrl = 'project/' . $reportType;

        $idMedia = $request->input('idMedia');
        if ($idMedia != '') {
            $apiUrl .= '/' . $idMedia;
        }

        $apiUrl .= '/' . $url;

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function withoutMedia($url, $request)
    {
        $chartParameter = new ChartParameter($request);

        $reportType = $request->input('reportType');
        $apiUrl = 'project/' . $reportType;

        $apiUrl .= '/' . $url;

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function plain($url, $request)
    {
        $apiUrl = 'project/' . $url;
        $chartParameter = new ChartParameter($request);
        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function chartApi($url, $chartParameter)
    {
        if ($chartParameter->projectId != '') {
            $params['pid'] = $chartParameter->projectId;
        }
        if ($chartParameter->userId != '') {
            $params['uid'] = $chartParameter->userId;
        }
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
