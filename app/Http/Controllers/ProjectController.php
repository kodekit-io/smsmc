<?php

namespace App\Http\Controllers;

use App\Service\Project;
use App\Service\ProjectRequestParser;
use App\Service\Ticket;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ProjectRequestParser;

    /**
     * @var Project
     */
    protected $projectService;
    /**
     * @var Ticket
     */
    protected $ticketService;

    /**
     * ProjectController constructor.
     */
    public function __construct(Project $projectService, Ticket $ticketService)
    {
        $this->projectService = $projectService;
        $this->ticketService = $ticketService;
    }

    public function add()
    {
        $data['pageTitle'] = 'Create Project';
        return view('pages.project-add', $data);
    }

    public function create(Request $request)
    {
        $response = $this->projectService->create($request->except(['_token']));
        if ($response->status == '200') {
            return redirect('home');
        }

        return redirect('project/add')->withErrors(['error' => $response->result]);
    }

    public function edit(Request $request, $id)
    {
        $projectInfo = $this->projectService->getProjectById($id);
        $data['projectId'] = $id;
        $data['project'] = $projectInfo->project;
        $data['keywords'] = $projectInfo->projectInfo->keywordList;
        $data['topics'] = $projectInfo->projectInfo->topicList;
        $data['excludes'] = $projectInfo->projectInfo->noiseKeywordList;
        $data['pageTitle'] = 'Edit Project';

        return view('pages.project-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $response = $this->projectService->update($request->except(['_token']), $id);
        if ($response->status == '200') {
            return redirect('home');
        }

        return redirect('project/' . $id . '/edit')->withErrors(['error' => $response->result]);
    }

    public function delete($projectId)
    {
        $response = $this->projectService->delete($projectId);
        if ($response->status == '200') {
            return redirect('home');
        }

        return redirect('home')->withErrors(['error' => $response->result]);
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

    public function twitter(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Twitter';

        return view('pages.project-tw', $data);
    }

    public function news(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Online News';

        return view('pages.project-news', $data);
    }

    public function blog(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Blog';
        return view('pages.project-blog', $data);
    }

    public function forum(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Forum';
        return view('pages.project-forum', $data);
    }

    public function youtube(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Video';
        return view('pages.project-yt', $data);
    }

    public function instagram(Request $request, $projectId)
    {
        $data = $this->parseRequest($request, $projectId);
        $data['pageTitle'] = 'Instagram';
        return view('pages.project-ig', $data);
    }
}
