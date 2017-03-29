<?php

namespace App\Http\Controllers;

use App\Service\Account;
use App\Service\SocmedRequestParser;
use Illuminate\Http\Request;

class SocmedController extends Controller
{
    use SocmedRequestParser;

    /**
     * @var Account
     */
    protected $accountService;

    /**
     * SocmedController constructor.
     */
    public function __construct(Account $accountService)
    {
        $this->accountService = $accountService;
    }

    public function facebook(Request $request)
    {
        $data = $this->parseRequest($request, 'facebook');
        $data['pageTitle'] = 'Facebook';
        return view('pages.socmed-fb', $data);
    }

    public function twitter(Request $request)
    {
        $data = $this->parseRequest($request, 'twitter');
        $data['pageTitle'] = 'Twitter';
        return view('pages.socmed-tw', $data);
    }

    public function youtube(Request $request)
    {
        $data = $this->parseRequest($request, 'youtube');
        $data['pageTitle'] = 'Youtube';
        return view('pages.socmed-yt', $data);
    }

    public function instagram(Request $request)
    {
        $data = $this->parseRequest($request, 'instagram');
        $data['pageTitle'] = 'Instagram';
        return view('pages.socmed-ig', $data);
    }
}
