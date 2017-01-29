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
}
