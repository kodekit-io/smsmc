<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\ProjectRequestParser;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ProjectRequestParser;

    /**
     * @var Project
     */
    private $projectService;

    /**
     * ProjectController constructor.
     */
    public function __construct(Project $projectService)
    {
        $this->projectService = $projectService;
    }

    public function allMedia(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'All Media';

        return view('pages.project-all', $data);
    }

    public function facebook(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Facebook';

        return view('pages.project-fb', $data);
    }
}
