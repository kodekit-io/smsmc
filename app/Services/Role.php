<?php

namespace App\Service;


class Role
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Role constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function getRoles()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('role/view', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    public function create($data)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'roleName' => $data['name'],
            'bussinessId' => 2
        ];

        $response = $this->smsmc->post('role/add', $params);

        return $response;
    }

    public function update($request, $id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'idRole' => $id,
            'name' => $request->input('name'),
        ];

        $permissions = $this->getAvailablePermissions();
        foreach ($permissions as $permissionId => $permission) {
            $permissions = $request->input('permissions');
            $params[$permissionId] = 0;
            if (isset($permissions[$permissionId]) && $permissions[$permissionId] == 1) {
                $params[$permissionId] = 1;
            }
        }

        $response = $this->smsmc->post('role/edit', $params);

        return $response;
    }

    public function delete($id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'roleId' => $id
        ];
        $response = $this->smsmc->post('role/delete', $params);

        return $response;
    }

    public function getRoleById($id, $userId = '')
    {
        $params = [
            'idRole' => $id
        ];
        if ($userId == '') {
            $params['uid'] = \Auth::user()->id;
        } else {
            $params['uid'] = $userId;
        }

        $response = $this->smsmc->post('role/view', $params);

        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    public function getAvailablePermissions()
    {
        return [
            'projectCreate' => 'Create Project',
            'projectUpdate' => 'Update Project',
            'projectRead' => 'View Project',
            'projectDelete' => 'Delete Project',
            'engagmentCreate' => 'Create Engagement',
            'engagmentUpdate' => 'Update Engagement',
            'engagmentRead' => 'View Engagement',
            'enggagmentDelete' => 'Delete Engagement',
            'registerCreate' => 'Create Social Media Account',
            'registerUpdate' => 'Update Social Media Account',
            'registerRead' => 'View Social Media Account',
            'registerDelete' => 'Delete Social Media Account',
            'userCreate' => 'Create User',
            'userUpdate' => 'Update User',
            'userRead' => 'View User',
            'userDelete' => 'Delete User',
            'groupCreate' => 'Create Group',
            'groupUpdate' => 'Update Group',
            'groupRead' => 'View Group',
            'groupDelete' => 'Delete Group',
            'roleCreate' => 'Create Role',
            'roleUpdate' => 'Update Role',
            'roleRead' => 'View Role',
            'roleDelete' => 'Delete Role',
        ];
    }
}