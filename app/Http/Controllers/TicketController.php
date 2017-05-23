<?php

namespace App\Http\Controllers;

use App\Service\Notification;
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
     * @var Notification
     */
    private $notification;

    /**
     * TicketController constructor.
     */
    public function __construct(Ticket $ticket, User $userService, Notification $notification)
    {
        $this->ticket = $ticket;
        $this->userService = $userService;
        $this->notification = $notification;
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

    public function detail($ticketId, $isNotif = 0)
    {
        $ticket = $this->ticket->getTicketById($ticketId);
        $data['ticket'] = $ticket->data->ticketDetail[0];
        $data['userId'] = \Auth::user()->id;
        $data['threads'] = $ticket->data->threadDetail;
        $data['ticketId'] = $ticketId;
        $data['pageTitle'] = 'Ticket';

        if ($isNotif) {
            // set notif to read
        }

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
            // return redirect('ticket/' . $ticketId . '/detail');
            return redirect('ticket');
        }
        // return redirect('ticket/' . $ticketId . '/detail')->withErrors(['error' => 'Can not change ticket status.']);
        return redirect('ticket')->withErrors(['error' => 'Can not change ticket status.']);
    }

    public function add()
    {
        // $users = $this->userService->getUsers();
        $users = $this->ticket->getSendToUsers();
        $data['ticketTypes'] = $this->ticket->getTicketStatus();
        $data['users'] = $users;
        $data['pageTitle'] = 'Ticket';
        return view('pages.tickets.add', $data);
    }

    public function create(Request $request)
    {
        if ($this->ticket->create($request)) {
            return redirect('ticket')->withInput()->withErrors(['error' => 'Your ticket has been sent successfully.']);
        }
        return redirect('ticket/add')->withInput()->withErrors(['error' => 'A problem has been occured while submitting your ticket.']);
    }

    public function createTicketFromConvo(Request $request)
    {
        // Log::warning($request->all());
        if ($this->ticket->create($request)) {
            return 1;
        }
        return 0;
    }

    public function notif()
    {
        $data['pageTitle'] = 'Notifications';
        return view('pages.notifications', $data);
    }

    public function notifList()
    {
        $notif = $this->notification->getNotifications();
        return \GuzzleHttp\json_encode($notif);
    }
}
