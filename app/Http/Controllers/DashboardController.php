<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\Smsmc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @var Project
     */
    private $projectService;
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * DashboardController constructor.
     */
    public function __construct(Project $projectService, Smsmc $smsmc)
    {
        $this->projectService = $projectService;
        $this->smsmc = $smsmc;
    }

    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard';

        return view('pages.home', $data);
    }

    public function getProjectList()
    {
        $projectList = $this->projectService->projectList();

        return \GuzzleHttp\json_encode($projectList);
    }

    public function getBrandEquity($projectId)
    {
        $params = [
            'pid' => $projectId
        ];

        $brandEquity = $this->smsmc->post('project/brandequity', $params);

        if ($brandEquity->status == 200) {
            return $brandEquity->result;
        }

        return [];
    }
}
