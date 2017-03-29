<?php

namespace App\Service;


class User
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * User constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function getUsers()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('user/list', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    public function create($data)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'userName' => $data['username'],
            'password' => $data['password'],
            'conPassWord' => $data['password2'],
            'email' => $data['email'],
            'name' => $data['name'],
            'idBussiness' => 2,
            'idRole' => 2
        ];
        $response = $this->smsmc->post('user/add', $params);

        dd($response);

        return $response;
    }

    public function update($id, $data)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'userId' => $id,
            'email' => $data['email'],
            'name' => $data['name']
        ];
        if (isset($data['password'])) {
            $params['password'] = $data['password'];
            $params['conPassWord'] = $data['password2'];
        }
        $response = $this->smsmc->post('user/edit', $params);

        return $response;
    }

    public function delete($id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'userId' => $id
        ];
        $response = $this->smsmc->post('user/delete', $params);

        return $response;
    }
}