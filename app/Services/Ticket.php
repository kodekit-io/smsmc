<?php

namespace App\Service;


use Carbon\Carbon;

class Ticket
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Ticket constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function create($data)
    {
        $userId = \Auth::user()->id;
        $message = $data['message'];
        $types = $data['types'];
        // $to = $data['to'];
        $to = 561;
        $toCc = $data['to_cc'];
        $postDate = Carbon::create()->format('Y-m-d\TH:i:s\Z');
        $sentiment = 'general';

        $params = [
            'uid' => $userId,
            'text' => $message,
            'postId' => '',
            'tipeId' => 1,
            'from' => $userId,
            'send' => $to,
            'idmedia' => '',
            'postDate' => $postDate,
            'sentiment' => $sentiment
        ];

        $response = $this->smsmc->post('ticket/send', $params);
        if ($response->status == '200') {
            return true;
        }

        return false;
    }

    public function getTicketById($ticketId)
    {
        $params = [
            'ticketId' => $ticketId,
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('ticket/detail', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return '';
    }
}