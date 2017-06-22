<?php

namespace App\Service;


class Group
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

    public function getGroups()
    {
        $params = [
            'uid' => \Auth::user()->id
        ];

        $response = $this->smsmc->post('group/list', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    public function create($data)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'groupName' => $data['name'],
            'bussinessId' => $data['id_business'],
            'description' => $data['group_desc'],
        ];

        $response = $this->smsmc->post('group/add', $params);

        return $response;
    }

    public function update($data, $id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'groupId' => $id,
            'groupName' => $data['name']
        ];

        $response = $this->smsmc->post('group/edit', $params);

        return $response;
    }

    public function delete($id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'groupId' => $id
        ];
        $response = $this->smsmc->post('group/delete', $params);

        return $response;
    }

    public function getGroupById($id)
    {
        $params = [
            'uid' => \Auth::user()->id,
            'groupId' => $id
        ];

        $response = $this->smsmc->post('group/get', $params);

        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

}