<?php

namespace App\Service;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Ticket
{
    /**
     * @var Smsmc
     */
    private $smsmc;
    /**
     * @var Group
     */
    private $group;

    /**
     * Ticket constructor.
     */
    public function __construct(Smsmc $smsmc, Group $group)
    {
        $this->smsmc = $smsmc;
        $this->group = $group;
    }

    public function getTickets()
    {
        $params = [
            'uid' => \Auth::id()
        ];

        $response = $this->smsmc->post('ticket/view', $params);
        // Log::warning(\GuzzleHttp\json_encode($response));
        if ($response->status == 200) {
            // Log::warning(\GuzzleHttp\json_encode($response->result));
            return $response->result;
        }

        return [];
    }

    public function create($request)
    {
        $message = $request->has('message') ? $request->input('message') : '';
        $types = $request->has('types') ? count($request->input('types')) > 0 ? implode(',', $request->input('types')) : '' : '';
        $from = \Auth::user()->id;
        $idMedia = $request->has('idMedia') ? $request->input('idMedia') : '';
        $postId = $request->has('postId') ? $request->input('postId') : '';
        $to = $request->has('to') ? count($request->input('to')) > 0 ? implode(',', $request->input('to')) : '' : '';
        $toGroups = $request->has('groupsTo') ? count($request->input('groupsTo')) > 0 ? implode(',', $request->input('groupsTo')) : '' : '';
        // $to = 561;
        // $toCc = $request->has('to_cc') ? count($request->input('to_cc')) > 0 ? implode(',', $request->input('to_cc')) : '' : '';
        $postDate = $request->has('postDate') ? $request->input('postDate') : Carbon::create()->format('Y-m-d\TH:i:s\Z');
        $sentiment = $request->has('sentiment') ? $request->input('sentiment') : 'general';

        $params = [
            'uid' => $from,
            'text' => $message,
            'postId' => $postId,
            'tipeId' => $types,
            'from' => $from,
            'send' => $to,
            'idmedia' => $idMedia,
            'postDate' => $postDate,
            'sentiment' => $sentiment,
            'sendGroupId' => $toGroups,
        ];

        if ($request->has('projectId')) {
            $params['pid'] = $request->input('projectId');
        }

        // Log::warning("Ticket from datatable params => " . \GuzzleHttp\json_encode($params));

        $response = $this->smsmc->post('ticket/send', $params);
        //Log::warning('ticket response ' . \GuzzleHttp\json_encode($response));
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
        // Log::warning("TicketService/changeStatus => " . \GuzzleHttp\json_encode($params));
        $response = $this->smsmc->post('ticket/updatestatus', $params);
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

    public function getSendToUsers()
    {
        $params = [
            'uid' => \Auth::id(),
            'userId' => \Auth::id()
        ];
        $userResponse = $this->smsmc->post('user/get', $params);
        if ($userResponse->status == '200') {
            $user = $userResponse->result->user;
            $params = [
                'uid' => \Auth::id(),
                'bussinessId' => $user->idBussiness
            ];
            $response = $this->smsmc->post('ticket/sendto', $params);
            if ($response->status == '200') {
                return $response->result->data;
            }
        }

        return [];
    }

    public function group()
    {
        return $this->group;
    }
}
