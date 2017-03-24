<?php

namespace App\Http\Controllers;

use App\Service\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * TicketController constructor.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function index()
    {
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.list', $data);
    }

    public function detail($ticketId)
    {
        $ticket = $this->ticket->getTicketById($ticketId);
        $data['ticket'] = $ticket->data->ticketDetail[0];
        $data['ticketId'] = $ticketId;
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.detail', $data);
    }

    public function add()
    {
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.add', $data);
    }

    public function create(Request $request)
    {
        if ($this->ticket->create($request->except(['_token']))) {
            return redirect('ticket');
        }
        return redirect('ticket/add')->withInput();
    }
}
