<?php

namespace App\Http\Controllers;

use App\Service\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * SettingController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        $data['pageTitle'] = 'Manage Accounts';

        return view('pages.users.list', $data);
    }

    public function userList()
    {
        $data = $this->user->getUsers();
        return \GuzzleHttp\json_encode($data);
    }
}
