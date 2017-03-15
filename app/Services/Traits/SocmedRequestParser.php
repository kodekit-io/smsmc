<?php

namespace App\Service;


use Carbon\Carbon;
use Illuminate\Http\Request;

trait SocmedRequestParser
{
    use LastSevenDays;

    function parseRequest(Request $request)
    {
        $last7DaysRange = $this->getLastSevenDaysRange();
        $startDate = $last7DaysRange['startDate'];
        $endDate = $last7DaysRange['endDate'];
        $searchText = '';
        $submittedAccounts = '';
        $submittedSentiments = '';

        if ($request->has('filter')) {
            $startDateRequest = $request->input('startDate');
            $endDateRequest = $request->input('endDate');
            $startDate = ( $startDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $startDateRequest)->setTime(00, 00, 01)->format('Y-m-d\TH:i:s\Z') : $startDate;
            $endDate = ( $endDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $endDateRequest)->setTime(23, 59, 59)->format('Y-m-d\TH:i:s\Z') : $endDate;
            $submittedSentiments = ( $request->has('sentiments') ? implode(',', $request->input('sentiments')) : '' );
            $searchText = $request->has('searchText') ? $request->input('searchText') : '';
        }

        // search text from wordcloud
        if ($request->has('text')) {
            $searchText = $request->get('text');
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

        $data['sentiments'] = $sentiments;

        $data['submittedSentiments'] = $submittedSentiments;
        $data['searchText'] = $searchText;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['shownStartDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $startDate)->format('d-m-y H:i');
        $data['shownEndDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $endDate)->format('d-m-y H:i');

        return $data;
    }

    function isKeywordSelected($keywordId, $request)
    {
        $select = '';
        if ($request->has('keywords')) {
            if (in_array($keywordId, $request->input('keywords'))) {
                $select = 'checked';
            }
        } else {
            $select = 'checked';
        }
        return $select;
    }

    function isTopicSelected($topicId, $request)
    {
        $select = '';
        if ($request->has('topics')) {
            if (in_array($topicId, $request->input('keywords'))) {
                $select = 'checked';
            }
        } else {
            $select = 'checked';
        }
        return $select;
    }

    function isSentimentSelected($sentiment, $request)
    {
        $select = '';
        if ($request->has('sentiments')) {
            if (in_array($sentiment, $request->input('sentiments'))) {
                $select = 'checked';
            }
        } else {
            $select = 'checked';
        }
        return $select;
    }
}