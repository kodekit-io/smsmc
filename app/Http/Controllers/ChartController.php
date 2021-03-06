<?php

namespace App\Http\Controllers;

use App\Service\ChartParameter;
use App\Service\DatatableResult;
use App\Service\DatatableSorter;
use App\Service\Smsmc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    use DatatableSorter;

    /**
     * @var Smsmc
     */
    private $smsmc;
    /**
     * @var DatatableResult
     */
    private $datatableResult;

    /**
     * ChartController constructor.
     */
    public function __construct(Smsmc $smsmc, DatatableResult $datatableResult)
    {
        $this->smsmc = $smsmc;
        $this->datatableResult = $datatableResult;
    }

    public function brandEquity(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->plain('brandequity', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function barSentiment(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('sentiment', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function trendSentiment(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('sentimenttrend', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function trendPost(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('posttrend', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function trendBuzz(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('buzztrend', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function trendReach(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('reachtrend', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function trendInteraction(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('interactiontrend', $request, $cached);
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

    public function trendFans(Request $request)
    {
//        $data = $this->withoutMedia('lovetrend', $request);
//        return $this->parseChartResult($data);

        return [];
    }

    public function piePost(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('post', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function pieBuzz(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('buzz', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function pieInteraction(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('interaction', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function pieUniqueUser(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withoutMedia('uniqueuser', $request, $cached);
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

    public function barInteractionRate(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('interactionrate', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function barMediaShare(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->plain('shareofmedia', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function barTopicDistribution(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('topic', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function ontologi(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('ontologi', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function wordcloud(Request $request, $cached = 0)
    {
        $cached = ($cached == 0) ? false : true;
        $data = $this->withMedia('wordcloud', $request, $cached);
        return $this->parseChartResult($data);
    }

    public function convo(Request $request)
    {
        $data = $this->withMedia('convo', $request);
        return $this->parseChartResult($data);
    }

    public function pagingConvo(Request $request)
    {
        $arrSentimentByValue = [
            'negative' => '-1',
            'neutral' => '0',
            'positive' => '1'
        ];

        // Log::warning(\GuzzleHttp\json_encode($request->input('order')));

        $idMedia = $request->has('idMediaInAll') ? $request->input('idMediaInAll') : $request->input('idMedia');
        $reportType = $request->input('reportType');
        $draw = $request->input('draw');
        $length = $request->input('length');
        $start = $request->input('start');
        $page = $start/$length;

        $params['sentiment'] = $request->input('sentiments');

        // sentiment filter
        if (isset($request->input('columns')[5]['search']['value'])) {
            $sentimentValue = $request->input('columns')[5]['search']['value'];
            if ($sentimentValue != 'null') {
                $sentimentValue = \GuzzleHttp\json_decode($sentimentValue);
                $sentiment = $sentimentValue->sentiment;
                $idMedia = $sentimentValue->idMedia;
                if ($sentiment != '') {
                    $params['sentiment'] = $arrSentimentByValue[$sentiment];
                }
            }
        }
        if (isset($request->input('columns')[6]['search']['value'])) {
            $sentimentValue = $request->input('columns')[6]['search']['value'];
            if ($sentimentValue != 'null') {
                $sentimentValue = \GuzzleHttp\json_decode($sentimentValue);
                $sentiment = $sentimentValue->sentiment;
                $idMedia = $sentimentValue->idMedia;
                if ($sentiment != '') {
                    $params['sentiment'] = $arrSentimentByValue[$sentiment];
                }
            }
        }
        if (isset($request->input('columns')[7]['search']['value'])) {
            $sentimentValue = $request->input('columns')[7]['search']['value'];
            if ($sentimentValue != 'null') {
                $sentimentValue = \GuzzleHttp\json_decode($sentimentValue);
                $sentiment = $sentimentValue->sentiment;
                $idMedia = $sentimentValue->idMedia;
                if ($sentiment != '') {
                    $params['sentiment'] = $arrSentimentByValue[$sentiment];
                }
            }
        }
        if (isset($request->input('columns')[8]['search']['value'])) {
            $sentimentValue = $request->input('columns')[8]['search']['value'];
            if ($sentimentValue != 'null') {
                $sentimentValue = \GuzzleHttp\json_decode($sentimentValue);
                $sentiment = $sentimentValue->sentiment;
                $idMedia = $sentimentValue->idMedia;
                if ($sentiment != '') {
                    $params['sentiment'] = $arrSentimentByValue[$sentiment];
                }
            }
        }
        if (isset($request->input('columns')[9]['search']['value'])) {
            $sentimentValue = $request->input('columns')[9]['search']['value'];
            if ($sentimentValue != 'null') {
                $sentimentValue = \GuzzleHttp\json_decode($sentimentValue);
                $sentiment = $sentimentValue->sentiment;
                $idMedia = $sentimentValue->idMedia;
                if ($sentiment != '') {
                    $params['sentiment'] = $arrSentimentByValue[$sentiment];
                }
            }
        }

        // search text
        if ($request->has('search')) {
            $searchText = $request->input('search')['value'];
            $params['text'] = $searchText;
        }

        if ($request->has('text')) {
            $searchText = $request->input('text');
            $params['text'] = $searchText;
        }

        // other params
        if ($reportType == 1) {
            $params['pid'] = $request->projectId;
        }
        if ($reportType == 2) {
            $params['uid'] = \Auth::id();
        }

        // sorter
        $params = $this->datatableSorter($idMedia, $request->input('order'), $params);

        $params['StartDate'] = $request->startDate;
        $params['EndDate'] = $request->endDate;
        $params['brandID'] = $request->keywords;
        $params['row'] = $length;
        $params['page'] = $page;
        //$params['sort'] = 'author desc';

        $convoUrl = 'project/' . $reportType . '/' . $idMedia . '/convo';

        // Log::warning('convo paging request ==> ' . \GuzzleHttp\json_encode($request->all()));
        // Log::warning("convo paging url ==> " . $convoUrl);
        // Log::warning("convo paging param ==> " . \GuzzleHttp\json_encode($params));

        $data = $this->smsmc->post($convoUrl, $params);
        $dtResult = new DatatableResult();
        $dtResult->setDraw($draw);
        $dtResult->setData($data);
        // Log::warning(\GuzzleHttp\json_encode($dtResult));
        return \GuzzleHttp\json_encode($dtResult);
    }

    public function downloadConvo(Request $request)
    {
        $idMedia = $request->input('idMedia');
        $reportType = $request->input('reportType');
        if ($reportType == 1) {
            $params['pid'] = $request->input('projectId');
        }
        if ($reportType == 2) {
            $params['uid'] = \Auth::id();
        }

        $params['StartDate'] = $request->input('startDate');
        $params['EndDate'] = $request->input('endDate');
        $params['chartList'] = $reportType . $idMedia . '405';
        if ($request->has('keywords')) {
            $params['brandID'] = $request->input('keywords');
        }
        if ($request->has('sentiments')) {
            $params['sentiment'] = $request->input('sentiments');
        }

        $apiUrl = 'project/' . $reportType . '/' . $idMedia . '/convoexcel';
        $response = $this->smsmc->post($apiUrl, $params);
        if ($response->status == 200) {
            return $response->result->excel;
        }

        return '#';
    }
    public function downloadConvoAll(Request $request)
    {
        $params['pid'] = $request->input('projectId');
        $params['StartDate'] = $request->input('startDate');
        $params['EndDate'] = $request->input('endDate');
        $params['chartList'] = '18405';
        if ($request->has('keywords')) {
            $params['brandID'] = $request->input('keywords');
        }
        if ($request->has('sentiments')) {
            $params['sentiment'] = $request->input('sentiments');
        }

        $apiUrl = 'project/1/8/convoexcel';
        $response = $this->smsmc->post($apiUrl, $params);
        //Log::debug($apiUrl . " params ==> " . \GuzzleHttp\json_encode($params));
        if ($response->status == 200) {
            return $response->result->excel;
        }

        return '#';
    }

    public function influencer(Request $request)
    {
        $data = $this->withMedia('influencer', $request);
        return $this->parseChartResult($data);
    }

    public function changeSentiment(Request $request)
    {
        // Log::warning('change sentiment requests ==> ' . \GuzzleHttp\json_encode($request->all()));
        $reportType = $request->input('reportType');
        $idMedia = $request->input('idMedia');
        $postId = $request->input('id');
        $projectId = $request->input('projectId');
        $sentiment = $request->input('sentiment');
        //$date = Carbon::now()->format('Y-m-d\TH:i:s\Z');
        $date = $request->input('date');

        if ($reportType == 1) {
            $params = [
                'pid' => $projectId,
                'date' => $date,
                'postId' => $postId,
                'sentiment' => $sentiment
            ];
        }
        if ($reportType == 2) {
            $params = [
                'uid' => \Auth::id(),
                'date' => $date,
                'postId' => $postId,
                'sentiment' => $sentiment
            ];
        }
        $url = 'project/' . $reportType . '/' . $idMedia . '/sentiment/update';
        // Log::warning("change sentiment param ==> " . \GuzzleHttp\json_encode($params));
        // Log::warning("change sentiment url ==> " . $url);
        $response = $this->smsmc->post($url, $params);
        // Log::warning('change sentiment response ==> ' . \GuzzleHttp\json_encode($response));
        if ($response->status == '200') {
            // Log::warning('change sentiment response ==> ' . \GuzzleHttp\json_encode($response));
            return 1;
        }
        return 0;
    }


    private function withMedia($url, $request, $cached = false)
    {
        $chartParameter = new ChartParameter($request);

        $reportType = $request->input('reportType');
        $apiUrl = 'project/' . $reportType;

        $idMedia = $request->input('idMedia');
        if ($idMedia != '') {
            $apiUrl .= '/' . $idMedia;
        }

        $apiUrl .= '/' . $url;

        $minutes = config('misc.cache_lifetime');
        if ($cached) {
            return Cache::remember($apiUrl . '_' . $chartParameter->projectId, $minutes, function() use ($apiUrl, $chartParameter) {
                return $this->chartApi($apiUrl, $chartParameter);
            });
        }

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function withoutMedia($url, $request, $cached = false)
    {
        $chartParameter = new ChartParameter($request);

        $reportType = $request->input('reportType');
        $apiUrl = 'project/' . $reportType;

        $apiUrl .= '/' . $url;

        $minutes = config('misc.cache_lifetime');
        if ($cached) {
            return Cache::remember($apiUrl . '_' . $chartParameter->projectId, $minutes, function() use ($apiUrl, $chartParameter) {
                return $this->chartApi($apiUrl, $chartParameter);
            });
        }

        return $this->chartApi($apiUrl, $chartParameter);
    }

    private function plain($url, $request, $cached = false)
    {
        $apiUrl = 'project/' . $url;
        $chartParameter = new ChartParameter($request);
        $minutes = config('misc.cache_lifetime');
        if ($cached) {
            return Cache::remember($url . '_' . $chartParameter->projectId, $minutes, function() use ($apiUrl, $chartParameter) {
                return $this->chartApi($apiUrl, $chartParameter);
            });
        }
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
