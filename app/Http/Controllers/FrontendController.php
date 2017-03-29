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

    public function engagementAccounts()
    {
        $data['pageTitle'] = 'Engagement Accounts';
        return view('pages.engagement-accounts', $data);
    }
    public function engagementCalendar()
    {
        $data['pageTitle'] = 'Scheduled Calendar';
        return view('pages.engagement-calendar', $data);
    }
    public function engagementTimeline()
    {
        $data['pageTitle'] = 'Timeline';
        return view('pages.engagement-timeline', $data);
    }

    public function reportView()
    {
        $data['pageTitle'] = 'View Report';
        return view('pages.report-view', $data);
    }
    public function reportAdd()
    {
        $data['pageTitle'] = 'Create Report';
        return view('pages.report-add', $data);
    }

    public function account()
    {
        $data['pageTitle'] = 'My Account';
        return view('pages.account', $data);
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

    public function notif()
    {
        $data['pageTitle'] = 'Notifications';
        return view('pages.notifications', $data);
    }

    public function pageHelp()
    {
        $data['pageTitle'] = 'Glossary';
        return view('pages.page-help', $data);
    }
}
