<?php

namespace App\Http\Controllers;

use App\Service\Account;
use App\Service\SocmedRequestParser;
use App\Service\Ticket;
use App\Service\User;
use Illuminate\Http\Request;

class SocmedController extends Controller
{
    use SocmedRequestParser;

    /**
     * @var Account
     */
    protected $accountService;
    /**
     * @var Ticket
     */
    protected $ticketService;
    /**
     * @var User
     */
    protected $userService;

    /**
     * SocmedController constructor.
     * @param Account $accountService
     * @param Ticket $ticketService
     */
    public function __construct(Account $accountService, Ticket $ticketService, User $userService)
    {
        $this->accountService = $accountService;
        $this->ticketService = $ticketService;
        $this->userService = $userService;
    }

    public function facebook(Request $request)
    {
        $data = $this->parseRequest($request, 'facebook');
        $data['pageTitle'] = 'Facebook';
        $data['activeFb'] = 'class="uk-active"';
        return view('pages.socmed-fb', $data);
    }

    public function twitter(Request $request)
    {
        $data = $this->parseRequest($request, 'twitter');
        $data['pageTitle'] = 'Twitter';
        $data['activeTw'] = 'class="uk-active"';
        return view('pages.socmed-tw', $data);
    }

    public function youtube(Request $request)
    {
        $data = $this->parseRequest($request, 'youtube');
        $data['pageTitle'] = 'Youtube';
        $data['activeVid'] = 'class="uk-active"';
        return view('pages.socmed-yt', $data);
    }

    public function instagram(Request $request)
    {
        $data = $this->parseRequest($request, 'instagram');
        $data['pageTitle'] = 'Instagram';
        $data['activeIg'] = 'class="uk-active"';
        return view('pages.socmed-ig', $data);
    }
}
