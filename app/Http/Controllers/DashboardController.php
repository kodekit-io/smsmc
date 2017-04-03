<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\Smsmc;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    public function dashboard(Request $request)
    {
        $totalPage = $request->has('totalPage') ? $request->get('totalPage') : 0;
        $data['pageTitle'] = 'Dashboard';
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 4;
        $projectResponse = $this->projectService->projectList($currentPage, $perPage, $totalPage);
        //dd($projectResponse);
        $projects = $projectResponse->projectList;
        $totalRow = $projectResponse->totalProject;
        $collection = new Collection($projects);
        $currentPageSearchResults = $collection->all();
        $totalPage = floor($totalRow / $perPage);
        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, $totalRow, $perPage);
        $data['projects'] = $paginatedSearchResults
            ->appends(['totalPage' => $totalPage])
            ->withPath('home');
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
