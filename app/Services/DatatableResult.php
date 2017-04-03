<?php
namespace App\Service;


use Illuminate\Support\Facades\Log;

class DatatableResult
{
    public $data;
    public $recordsTotal;
    public $recordsFiltered;
    public $draw;


    public function setData($data)
    {
        $dtData = $data->result->chartData;
        $totalRecords = $data->result->totalConvo;
        $this->recordsTotal = $totalRecords;
        $this->recordsFiltered = $totalRecords;
//        $this->recordsTotal = count($dtData);
//        $this->recordsFiltered = count($dtData);
        $this->data = $dtData;
        $this->chartName = $data->result->chartName;
        $this->chartId = $data->result->chartId;
        $this->chartInfo = $data->result->chartInfo;
    }

    public function setDraw($draw)
    {
        $this->draw = $draw;
    }
}
