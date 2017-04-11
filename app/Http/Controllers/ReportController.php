<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @var Report
     */
    private $report;
    /**
     * @var Project
     */
    private $project;

    /**
     * ReportController constructor.
     */
    public function __construct(Report $report, Project $project)
    {
        $this->report = $report;
        $this->project = $project;
    }

    public function index() {
        $data['pageTitle'] = 'View Report';
        return view('pages.reports.list', $data);
    }

    public function reportList() {
        return \GuzzleHttp\json_encode($this->report->getReports());
    }

    public function add() {
        $projectResponse = $this->project->projectList(0, 100);
        $projects = $projectResponse->projectList;
        $projectList = [];
        foreach ($projects as $project) {
            $projectList[$project->pid]['name'] = $project->pname;
            $detail = $this->project->getProject($project->pid);
            $projectList[$project->pid]['detail'] = $detail->projectInfo;
        }
        // dd($projectList);
        $data['projectList'] = $projectList;
        $data['pageTitle'] = 'Create Report';
        return view('pages.reports.add', $data);
    }

    public function create(Request $request) {
        // dd($request->all());
        if ($this->report->store($request)) {
            return redirect('report');
        }
        return redirect('report/add')->withErrors(['error' => 'Error.']);
    }

    public function delete($id) {
        if ($this->report->delete($id)) {
            return redirect('report');
        }
        return redirect('report')->withErrors(['error' => 'Error.']);
    }

}
