<?php

namespace App\Service;


class SimpleAPIResponse
{

    public $status;
    public $result;

    /**
     * CustomAPIResponse constructor.
     */
    public function __construct($status, $result)
    {
        $this->status = $status;
        $this->result = $result;
    }

}