<?php

namespace App\Http\Controllers;
// ini_set('max_execution_time', 500);

use App\Service\Account;
use App\Service\LastSevenDays;
use App\Service\Project;
use App\Service\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{

    use LastSevenDays;

    /**
     * @var Report
     */
    private $report;
    /**
     * @var Project
     */
    private $project;
    /**
     * @var Account
     */
    private $account;

    /**
     * ReportController constructor.
     */
    public function __construct(Report $report, Project $project, Account $account)
    {
        $this->report = $report;
        $this->project = $project;
        $this->account = $account;
    }

    public function index() {
        $data['pageTitle'] = 'Download Excel';
        return view('pages.reports.list', $data);
    }

    public function reportList() {
        return \GuzzleHttp\json_encode($this->report->getReports());
    }

    public function add() {
        // project
        $projectResponse = $this->project->projectList(0, 100);
        $projects = $projectResponse->projectList;
        $projectList = [];
        foreach ($projects as $project) {
            $projectList[$project->pid]['name'] = $project->pname;
            $detail = $this->project->getProject($project->pid);
            $projectList[$project->pid]['detail'] = $detail->projectInfo;
        }
        // socmed
        $socmedAccounts = count($this->account->getSocialAccounts()) > 0 ? $this->account->getSocialAccounts()[0] : [];

        //dd($socmedAccounts);
        $data['projectList'] = $projectList;
        $data['socmedAccounts'] = $socmedAccounts;
        $data['pageTitle'] = 'Create Excel';
        return view('pages.reports.add', $data);
    }

    public function create(Request $request) {
        // dd($request->all());
        // Log::debug("request ==> " . \GuzzleHttp\json_encode($request->all()));
        if ($this->report->store($request)) {
            return redirect('/delay/5/reportlist');
        }
        return redirect('report/add')->withErrors(['error' => 'Error.']);
    }

    public function delete($id) {
        if ($this->report->delete($id)) {
            return redirect('report');
        }
        return redirect('report')->withErrors(['error' => 'Error.']);
    }

    public function pdf(Request $request)
    {
        $projectList = $this->project->projectList(0, 1000);
        $last7DaysRange = $this->getLastSevenDaysRange();
        $startDate = $last7DaysRange['startDate'];
        $endDate = $last7DaysRange['endDate'];
        $projectId = '';
        if ($request->has('filter')) {
            $startDateRequest = $request->input('startDate');
            $endDateRequest = $request->input('endDate');
            $startDate = ( $startDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $startDateRequest)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z') : $startDate;
            $endDate = ( $endDateRequest != '' ) ? Carbon::createFromFormat('d/m/y H:i', $endDateRequest)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z') : $endDate;
            $projectId = $request->input('projectId');
        }
        $data['projects'] = $projectList->projectList;
        $data['projectId'] = $projectId;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['shownStartDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $startDate)->format('d/m/y H:i');
        $data['shownEndDate'] = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $endDate)->format('d/m/y H:i');

        $data['pageTitle'] = 'Create PDF';
        return view('pages.reports.pdf', $data);
    }

    public function downloadPdf(Request $request)
    {
        $projectId = $request->input('projectId');
        $project = $this->project->getProjectById($projectId);
        $data = $request->all();
        $data['projectName'] = $project->project->pname;
        $data['pageTitle'] = 'Show Image';

        $path = url('/assets/img/logo.png');
        if(config('misc.logo_url')){
            $path = config('misc.logo_url');
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        if($type=='svg') {
            $data['logo'] = $path;
        } else {
            $file = file_get_contents($path);
            $data['logo'] = 'data:image/' . $type . ';base64,' . base64_encode($file);
        }

        // return view('pages.reports.pdf-downloaded', $data);

        $pdf = \PDF::loadView('pages.reports.pdf-downloaded', $data);
        $pdf->setPaper('A4', 'potrait');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        $filename = 'SM-Report-'.str_slug($project->project->pname).'-'.date('Ymdhis');
        return $pdf->download($filename.'.pdf');
    }

}
