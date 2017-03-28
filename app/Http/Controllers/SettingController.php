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

    public function userAdd()
    {
        $data['pageTitle'] = 'Add Account';

        return view('pages.users.add', $data);
    }

    public function userStore(Request $request)
    {
        $response = $this->user->create($request->except(['_token']));
        if ($response->status == '200') {
            return redirect('setting/user');
        }

        return redirect('setting/user/add')->withErrors(['error' => 'Error.']);
    }
}
