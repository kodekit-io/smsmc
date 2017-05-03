<?php

namespace App\Http\Controllers;

use App\Service\Account;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * @var Account
     */
    private $account;

    /**
     * FrontEndController constructor.
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function socmedAccounts()
    {
        $data['socmed'] = $this->account->getSocialAccounts()[0];
        $data['pageTitle'] = 'Social Media Accounts';
        return view('pages.socmed-accounts', $data);
    }

    public function socmedAccountsSave(Request $request)
    {
        $this->account->updateSocialAccount($request->except(['_token']));
        return redirect('socmed-accounts');
    }

    public function engagementCalendar()
    {
        $data['pageTitle'] = 'Scheduled Posts';
        return view('pages.engagement.calendar', $data);
    }
    public function engagementTimeline()
    {
        $data['pageTitle'] = 'Timeline';
        return view('pages.engagement.timeline', $data);
    }
    public function engagementAdd()
    {
        $data['pageTitle'] = 'New Engagement';
        return view('pages.engagement.add', $data);
    }
    public function engagementReply()
    {
        $data['pageTitle'] = 'Reply Engagement';
        return view('pages.engagement.reply', $data);
    }
    public function engagementDetail()
    {
        $data['pageTitle'] = 'Engagement Detail';
        return view('pages.engagement.detail', $data);
    }
    public function engagementList()
    {
        $data['pageTitle'] = 'All Engagement';
        return view('pages.engagement.list', $data);
    }

    public function admin()
    {
        $data['pageTitle'] = 'Manage Accounts';
        return view('pages.admin', $data);
    }
    public function adminAdd()
    {
        $data['pageTitle'] = 'Add Account';
        return view('pages.admin-add', $data);
    }
    public function adminEdit()
    {
        $data['pageTitle'] = 'Edit Account';
        return view('pages.admin-edit', $data);
    }
    public function adminGroup()
    {
        $data['pageTitle'] = 'Manage Groups';
        return view('pages.admin-group', $data);
    }
    public function adminNotif()
    {
        $data['pageTitle'] = 'Manage Notifications';
        return view('pages.admin-notif', $data);
    }

    public function pageHelp()
    {
        $data['pageTitle'] = 'Glossary';
        return view('pages.page-help', $data);
    }

    public function media()
    {
        $data['pageTitle'] = 'List of Media';
        return view('pages.page-media', $data);
    }
}
