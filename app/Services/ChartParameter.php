<?php

namespace App\Service;


use Illuminate\Http\Request;

class ChartParameter
{
    public $projectId;
    public $startDate;
    public $endDate;
    public $keywords;
    public $topics;
    public $sentiments;
    public $text;

    public function __construct(Request $request)
    {
        $this->projectId = $request->has('projectId') ? $request->input('projectId') : '';
        $this->startDate = $request->has('startDate') ? $request->input('startDate') : '';
        $this->endDate = $request->has('endDate') ? $request->input('endDate') : '';
        $this->keywords = $request->has('keywords') ? $request->input('keywords') : '';
        $this->topics = $request->has('topics') ? $request->input('topics') : '';
        $this->sentiments = $request->has('sentiments') ? $request->input('sentiments') : '';
        $this->text = $request->has('text') ? $request->input('text') : '';
    }
}