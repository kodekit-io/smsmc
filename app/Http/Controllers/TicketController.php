<?php

namespace App\Http\Controllers;

use App\Service\Ticket;
use App\Service\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * @var Ticket
     */
    private $ticket;
    /**
     * @var User
     */
    protected $userService;

    /**
     * TicketController constructor.
     */
    public function __construct(Ticket $ticket, User $userService)
    {
        $this->ticket = $ticket;
        $this->userService = $userService;
    }

    public function index()
    {
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.list', $data);
    }

    public function ticketList()
    {
        $result = $this->ticket->getTickets();

        return \GuzzleHttp\json_encode($result);
    }

    public function detail($ticketId)
    {
        $ticket = $this->ticket->getTicketById($ticketId);
        $data['ticket'] = $ticket->data->ticketDetail[0];
        $data['userId'] = \Auth::user()->id;
        $data['threads'] = $ticket->data->threadDetail;
        $data['ticketId'] = $ticketId;
        $data['pageTitle'] = 'Ticket';

        return view('pages.tickets.detail', $data);
    }

    public function reply(Request $request, $ticketId)
    {
        if ($this->ticket->reply($ticketId, $request->get('reply_content'))) {
            return redirect('ticket/' . $ticketId . '/detail');
        }
        return redirect('ticket/' . $ticketId . '/detail')->withErrors(['error' => 'Can not reply the ticket.']);
    }

    public function changeStatus(Request $request, $ticketId)
    {
        if ($this->ticket->changeStatus($ticketId, $request->get('ticket_status'))) {
            return redirect('ticket/' . $ticketId . '/detail');
        }
        return redirect('ticket/' . $ticketId . '/detail')->withErrors(['error' => 'Can not change ticket status.']);
    }

    public function add()
    {
        $users = $this->userService->getUsers();
        $data['ticketTypes'] = $this->ticket->getTicketStatus();
        $data['users'] = $users->user;
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.add', $data);
    }

    public function create(Request $request)
    {
        if ($this->ticket->create($request)) {
            return redirect('ticket');
        }
        return redirect('ticket/add')->withInput();
    }

    public function createTicketFromConvo(Request $request)
    {
        // Log::warning($request->all());
        if ($this->ticket->create($request)) {
            return 1;
        }
        return 0;
    }
}
