<?php

namespace App\Service;


use Carbon\Carbon;

class Report
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Report constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function getReports()
    {
        $params = [
            'uid' => \Auth()->id()
        ];
        $response = $this->smsmc->post('report/view', $params);
        if ($response->status == '200') {
            return $response->result;
        }
        return [];
    }

    public function store($request)
    {
        $title = $request->input('title');
        $desc = $request->input('description');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $reportType = $request->input('reportType');
        $projectId = $request->input('project');
        $mediaId = $request->input('media');
        $keyword = $request->input('keyword');
        $charts = $request->input('charts');

        $startDateTz = Carbon::createFromFormat('d/m/Y H:i', $startDate)->format('Y-m-d\TH:i:s\Z');
        $endDateTz = Carbon::createFromFormat('d/m/Y H:i', $endDate)->format('Y-m-d\TH:i:s\Z');
        $reportTypeId = $reportType == 'project' ? 1 : 2;
        $chartList = [];
        foreach ($charts as $chart) {
            $chartList[] = $reportTypeId . $mediaId . $chart;
        }
        $chartList = implode(',', $chartList);

        $params = [
            'StartDate' => $startDateTz,
            'EndDate' => $endDateTz,
            'brandId' => $keyword,
            'sentiment' => '-1,0,1',
            'reportDate' => Carbon::now()->format('Y-m-d\TH:i:s\Z'),
            'description' => $desc,
            'mediaId' => $mediaId,
            'name' => $title,
            'reportType' => $reportTypeId,
            'chartList' => $chartList
        ];

        if ($reportTypeId == 1) {
            $params['pid'] = $projectId;
        } else {
            $params['uid'] = \Auth::id();
        }

        $response = $this->smsmc->post('report/create', $params);
        if ($response->status == '200') {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $params = [
            'id' => $id
        ];
        $response = $this->smsmc->post('report/delete', $params);
        if ($response->status == '200') {
            return true;
        }
        return false;
    }
}
