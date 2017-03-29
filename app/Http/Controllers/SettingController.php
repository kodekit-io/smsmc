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

    public function userEdit(Request $request, $id)
    {
        $data['pageTitle'] = 'Edit Account';
        $data['id'] = $id;
        $response = $this->user->getUserById($id);
        $data['user'] = $response->user;

        return view('pages.users.edit', $data);
    }

    public function userUpdate(Request $request, $id)
    {
        $response = $this->user->updateUser($request->except(['_token']), $id);
        if ($response->status == '200') {
            return redirect('setting/user');
        }

        return redirect('setting/user' . $id . '/edit')->with(['error' => 'Error.']);
    }

    public function userDelete($id)
    {
        $response = $this->user->deleteUser($id);
        return redirect('setting/user');
    }


}
