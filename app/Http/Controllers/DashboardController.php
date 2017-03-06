<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\Smsmc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $endDate = Carbon::now('Asia/Jakarta')->format('Y-m-d\TH:i:s\Z');
        $startDate = Carbon::parse('-2 weeks', 'Asia/Jakarta')->format('Y-m-d\TH:i:s\Z');

        $params = [
            'pid' => $projectId,
            'StartDate' => $startDate,
            'EndDate' => $endDate,
            'sentiment' => '1,0,-1',
        ];
        $result = $this->smsmc->post('project/brandequity', $params);
        return \GuzzleHttp\json_encode($result->result);
    }
}
