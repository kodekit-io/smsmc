<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FrontEndController extends Controller
{
    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard';
        return view('pages.home', $data);
    }
    public function projectAll()
    {
        $data['pageTitle'] = 'All Media';
        return view('pages.project-all', $data);
    }
    public function socmedFB()
    {
        $data['pageTitle'] = 'Facebook';
        return view('pages.socmed-fb', $data);
    }

    public function projectAdd()
    {
        $data['pageTitle'] = 'Create Project';
        return view('pages.project-add', $data);
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

    public function pageHelp()
    {
        $data['pageTitle'] = 'Glossary';
        return view('pages.page-help', $data);
    }
}
