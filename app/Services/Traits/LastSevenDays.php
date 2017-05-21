<?php
/**
 * Created by PhpStorm.
 * User: thor
 * Date: 3/4/2017
 * Time: 9:19 AM
 */

namespace App\Service;


use Carbon\Carbon;

trait LastSevenDays
{
    public function getLastSevenDaysRange()
    {
        $lastSevenDays = Carbon::today()->subDay(7);
        //$endDate = $lastSevenDays->copy()->setTime(23, 59, 59)->format('Y-m-d\TH:i:s\Z');
        $endDate = Carbon::now()->format('Y-m-d\TH:i:s\Z');
        $startDate = $lastSevenDays->setTime(00, 00, 01)->format('Y-m-d\TH:i:s\Z');

        return [
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
    }
}
