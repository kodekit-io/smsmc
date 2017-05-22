<?php

namespace App\Service;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait ProjectRequestParser
{
    use LastSevenDays;

    function parseRequest(Request $request, $projectId)
    {
        // Log::warning(\GuzzleHttp\json_encode($request->all()));
        $last7DaysRange = $this->getLastSevenDaysRange();
        $startDate = $last7DaysRange['startDate'];
        $endDate = $last7DaysRange['endDate'];
        $searchText = '';
        $submittedKeywords = '';
        $submittedTopics = '';
        $submittedSentiments = '';

        //dd($request->all());
        if ($request->has('filter')) {
            $startDateRequest = $request->input('startDate');
            $endDateRequest = $request->input('endDate');

            // $startDate = ( $startDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $startDateRequest)->setTime(00, 00, 01)->format('Y-m-d\TH:i:s\Z') : $startDate;
            $startDate = ( $startDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $startDateRequest)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z') : $startDate;

            // $endDate = ( $endDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $endDateRequest)->setTime(23, 59, 59)->format('Y-m-d\TH:i:s\Z') : $endDate;
            $endDate = ( $endDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $endDateRequest)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z') : $endDate;

            $submittedKeywords = ( $request->has('keywords') ? implode(',', $request->input('keywords')) : '' );
            $submittedTopics = ( $request->has('topics') ? implode(',', $request->input('topics')) : '' );
            $submittedSentiments = ( $request->has('sentiments') ? implode(',', $request->input('sentiments')) : '' );
            $searchText = $request->has('searchText') ? $request->input('searchText') : '';
        }

        // search text from wordcloud
        if ($request->has('text')) {
            $searchText = $request->get('text');
        }

        $projectDetail = $this->projectService->getProject($projectId);

        $keywords = [];
        //dd($projectDetail);
        if (isset($projectDetail->projectInfo->keywordList) && count($projectDetail->projectInfo->keywordList) > 0) {
            $keywordLists = $projectDetail->projectInfo->keywordList;
            foreach ($keywordLists as $keywordList) {
                $keyword = $keywordList->keyword;
                $keywordId = $keyword->keywordId;
                $keywordName = $keyword->keywordName;
                $keywords[$keywordId]['value'] = $keywordName;
                $keywords[$keywordId]['selected'] = $this->isKeywordSelected($keywordId, $request);
            }
        }

        $topics = [];
        if (isset($projectDetail->projectInfo->topicList) && count($projectDetail->projectInfo->topicList) > 0) {
            $topicLists = $projectDetail->projectInfo->topicList;
            foreach ($topicLists as $topicList) {
                $topicId = $topicList->topicId;
                $topics[$topicId]['value'] = $topicList->topicName;
                $topics[$topicId]['selected'] = $this->isTopicSelected($topicId, $request);
            }
        }

        $sentiments = [];
        $sentimentArrays = [
            ['1', 'pstv', 'Positive'],
            ['0', 'ntrl', 'Neutral'],
            ['-1', 'ngtv', 'Negative']
        ];
        foreach ($sentimentArrays as $sentiment) {
            $sentiments[$sentiment[1]]['value'] = $sentiment[0];
            $sentiments[$sentiment[1]]['checked'] = $this->isSentimentSelected($sentiment[0], $request);
            $sentiments[$sentiment[1]]['showName'] = $sentiment[2];
        }



        // get ticket type
        $ticketTypes = $this->ticketService->getTicketStatus();
        $data['ticketTypes'] = \GuzzleHttp\json_encode($ticketTypes);

        // get TO
        // $users = $this->userService->getUsers();
        $users = $this->ticketService->getSendToUsers();
        $data['users'] = \GuzzleHttp\json_encode($users);

        $data['keywords'] = $keywords;
        $data['topics'] = $topics;
        $data['sentiments'] = $sentiments;

        $data['projectId'] = $projectId;
        $data['submittedKeywords'] = $submittedKeywords;
        $data['submittedTopics'] = $submittedTopics;
        $data['submittedSentiments'] = $submittedSentiments;
        $data['searchText'] = $searchText;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['shownStartDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $startDate)->format('d/m/y H:i');
        $data['shownEndDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $endDate)->format('d/m/y H:i');

        $data['projectDetail'] = $projectDetail;
        // dd($data);
        return $data;
    }

    function isKeywordSelected($keywordId, $request)
    {
        $select = '';
        if($request->has('filter')) {
            if ($request->has('keywords')) {
                if (in_array($keywordId, $request->input('keywords'))) {
                    $select = 'checked';
                }
            }
        } else {
            $select = 'checked';
        }
        return $select;
    }

    function isTopicSelected($topicId, $request)
    {
        $select = '';
        if($request->has('filter')) {
            if ($request->has('topics')) {
                if (in_array($topicId, $request->input('topics'))) {
                    $select = 'checked';
                }
            }
        } else {
            $select = 'checked';
        }

        return $select;
    }

    function isSentimentSelected($sentiment, $request)
    {
        $select = '';
        if($request->has('filter')) {
            if ($request->has('sentiments')) {
                if (in_array($sentiment, $request->input('sentiments'))) {
                    $select = 'checked';
                }
            }
        } else {
            $select = 'checked';
        }
        return $select;
    }
}
