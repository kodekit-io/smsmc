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
        $this->recordsTotal = count($dtData);
        $this->recordsFiltered = count($dtData);
        $this->data = $dtData;
        $this->draw = 1;
    }
}