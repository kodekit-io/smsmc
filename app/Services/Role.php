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

        return 1;

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

    public function getRoleById($id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'idRole' => $id
        ];

        $response = $this->smsmc->post('role/view', $params);

        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    public function getAvailablePermissions()
    {
        return [
            'project_create' => 'Create Project',
            'project_update' => 'Update Project',
            'project_read' => 'View Project',
            'project_delete' => 'Delete Project',
            'engagment_create' => 'Create Engagement',
            'engagment_update' => 'Update Engagement',
            'engagment_read' => 'View Engagement',
            'enggagment_delete' => 'Delete Engagement',
            'register_create' => 'Create Social Media Account',
            'register_update' => 'Update Social Media Account',
            'register_read' => 'View Social Media Account',
            'register_delete' => 'Delete Social Media Account',
            'user_create' => 'Create User',
            'user_update' => 'Update User',
            'user_read' => 'View User',
            'user_delete' => 'Delete User',
            'group_create' => 'Create Group',
            'group_update' => 'Update Group',
            'group_read' => 'View Group',
            'group_delete' => 'Delete Group',
            'role_create' => 'Create Role',
            'role_update' => 'Update Role',
            'role_read' => 'View Role',
            'role_delete' => 'Delete Role',
        ];
    }
}