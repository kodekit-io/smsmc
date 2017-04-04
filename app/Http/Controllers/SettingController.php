<?php

namespace App\Http\Controllers;

use App\Service\Group;
use App\Service\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Group
     */
    private $group;

    /**
     * SettingController constructor.
     */
    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
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
        $response = $this->user->update($request->except(['_token']), $id);
        if ($response->status == '200') {
            return redirect('setting/user');
        }

        return redirect('setting/user' . $id . '/edit')->with(['error' => 'Error.']);
    }

    public function userDelete($id)
    {
        $this->user->delete($id);
        return redirect('setting/user');
    }
    
    
    
    /******* GROUP ***********/
    public function group()
    {
        $data['pageTitle'] = 'Manage Group';

        return view('pages.groups.list', $data);
    }

    public function groupList()
    {
        $data = $this->group->getGroups();
        return \GuzzleHttp\json_encode($data);
    }

    public function groupAdd()
    {
        $data['pageTitle'] = 'Add Group';

        return view('pages.groups.add', $data);
    }

    public function groupStore(Request $request)
    {
        $response = $this->group->create($request->except(['_token']));
        if ($response->status == '200') {
            return redirect('setting/group');
        }

        return redirect('setting/group/add')->withErrors(['error' => 'Error.']);
    }

    public function groupEdit(Request $request, $id)
    {
        $data['pageTitle'] = 'Edit Group';
        $data['id'] = $id;
        $response = $this->group->getGroupById($id);
        $data['group'] = $response->group;

        return view('pages.groups.edit', $data);
    }

    public function groupUpdate(Request $request, $id)
    {
        $response = $this->group->update($request->except(['_token']), $id);
        if ($response->status == '200') {
            return redirect('setting/group');
        }

        return redirect('setting/group' . $id . '/edit')->with(['error' => 'Error.']);
    }

    public function groupDelete($id)
    {
        $response = $this->group->delete($id);
        if ($response->status == '200') {
            if ($response->result->code == '200') {
                return redirect('setting/group');
            } else {
                return redirect('setting/group')->withErrors(['error' => $response->result->msg]);
            }
        } else {
            return redirect('setting/group')->withErrors(['error' => 'Error when delete the data.']);
        }

    }


}
