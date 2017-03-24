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
        $message = $data['message'];
        $types = ( count($data['types']) > 0 ? implode(',', $data['types']) : '' );
        $from = \Auth::user()->id;
        // $to = $data['to'];
        $to = 561;
        $toCc = $data['to_cc'];
        $postDate = Carbon::create()->format('Y-m-d\TH:i:s\Z');
        $sentiment = 'general';

        $params = [
            'uid' => $to,
            'text' => $message,
            'postId' => '',
            'tipeId' => $types,
            'from' => $to,
            'send' => $from,
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

    public function reply($ticketId, $content)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'ticketId' => $ticketId,
            'text' => $content
        ];

        $response = $this->smsmc->post('ticket/reply', $params);
        if ($response->status == '200') {
            return true;
        }

        return false;
    }

    public function changeStatus($ticketId, $status)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'ticketId' => $ticketId,
            'statusId' => $status
        ];
        $response = $this->smsmc->post('ticket/updateStatus', $params);
        if ($response->status == '200') {
            return true;
        }

        return false;
    }

    public function getTicketStatus()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];
        $response = $this->smsmc->post('ticket/status', $params);
        if ($response->status == '200') {
            return $response->result->data;
        }

        return [];
    }

    public function getTicketType()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];
        $response = $this->smsmc->post('ticket/tipe', $params);
        if ($response->status == '200') {
            return $response->result->data;
        }

        return [];
    }
}