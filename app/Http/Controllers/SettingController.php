<?php

namespace App\Http\Controllers;

use App\Service\Group;
use App\Service\Role;
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
     * @var Role
     */
    private $role;

    /**
     * SettingController constructor.
     */
    public function __construct(User $user, Group $group, Role $role)
    {
        $this->user = $user;
        $this->group = $group;
        $this->role = $role;
    }

    /****************** ACCOUNT *****************/
    public function account()
    {
        $data['pageTitle'] = 'My Account';
        $userId = \Auth::id();
        $response = $this->user->getUserById($userId);
        $data['user'] = $response->user;
        return view('pages.account', $data);
    }

    public function update(Request $request)
    {
        $id = \Auth::id();
        $response = $this->user->update($request->except(['_token']), $id);
        if ($response->status == '200') {
            return redirect('setting/account');
        }

        return redirect('setting/account')->with(['error' => 'Error.']);
    }


    /****************** USER ******************/
    public function user()
    {
        $data['user'] = $this->user->getUserById(auth()->id())->user;
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
        $roles = $this->role->getRoles();
        $pilars = $this->user->getPilars();
        $groups = $this->group->getGroups();
        $data['roles'] = $roles->data;
        $data['pilars'] = $pilars->group;
        $data['groups'] = $groups->group;
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
        $roles = $this->role->getRoles();
        $pilars = $this->user->getPilars();
        $groups = $this->group->getGroups();
        $data['pageTitle'] = 'Edit Account';
        $data['id'] = $id;
        $data['roles'] = $roles->data;
        $data['pilars'] = $pilars->group;
        $data['groups'] = $groups->group;
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
            return redirect('setting/group');
        } else {
            return redirect('setting/group')->withErrors(['error' => $response->result]);
        }

    }


    /*********** ROLE **********/
    public function role()
    {
        $data['pageTitle'] = 'Manage Role';

        return view('pages.roles.list', $data);
    }

    public function roleList()
    {
        $data = $this->role->getRoles();
        return \GuzzleHttp\json_encode($data);
    }

    public function roleAdd()
    {

    }

    public function roleStore(Request $request)
    {

    }

    public function roleEdit($id)
    {
        $response = $this->role->getRoleById($id);
        $permissions = $this->role->getAvailablePermissions();
        $data['pageTitle'] = 'Edit Group';
        $data['id'] = $id;
        $data['permissions'] = $permissions;
        $data['role'] = $response->data[0];

        return view('pages.roles.edit', $data);

    }

    public function roleUpdate(Request $request, $id)
    {
        $updateResponse = $this->role->update($request, $id);
        if ($updateResponse->status == 200) {
            return redirect('setting/role');
        }
        return redirect('setting/role/' . $id . '/edit');
    }

    public function roleDelete($id)
    {

    }


}
