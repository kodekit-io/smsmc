<?php

namespace App\Http\Controllers;

use App\Service\Engagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EngagementController extends Controller
{
    /**
     * @var Engagement
     */
    private $engagement;

    /**
     * EngagementController constructor.
     */
    public function __construct(Engagement $engagement)
    {
        $this->engagement = $engagement;
    }

    public function accounts()
    {
        $data['fbAccounts'] = $this->engagement->getLoggedInAccounts(1);
        $data['twAccounts'] = $this->engagement->getLoggedInAccounts(2);
        $data['ytAccounts'] = $this->engagement->getLoggedInAccounts(5);
        $data['igAccounts'] = $this->engagement->getLoggedInAccounts(7);
        $data['pageTitle'] = 'Engagement Accounts';
        return view('pages.engagement-accounts', $data);
    }

    public function login(Request $request, $idMedia)
    {
        $response = $this->engagement->login($request, $idMedia);
        if ($response->status == 200) {
            $this->saveSocmedToken($response->result, $idMedia);
        }
        return redirect('engagement-accounts');
    }

    public function logout($idSocmed)
    {
        $this->engagement->logout($idSocmed);
        return redirect('engagement-accounts');
    }

    public function add()
    {
        $socmedAttribute = session('socmedAttribute');
        $data['fbAccounts'] = $this->engagement->getLoggedInAccounts(1);
        $data['twAccounts'] = $this->engagement->getLoggedInAccounts(2);
        $data['ytAccounts'] = $this->engagement->getLoggedInAccounts(5);
        $data['igAccounts'] = $this->engagement->getLoggedInAccounts(7);

        $data['socmeds'] = get_socmeds([4,9,3,6]);
        $data['socmedAttributes'] = $socmedAttribute;
        $data['pageTitle'] = 'New Engagement';
        return view('pages.engagement.add', $data);
    }

    public function post(Request $request)
    {
        if ($this->engagement->post($request)) {
            return redirect('engagement/list')->withInput()->withErrors(['error' => 'Your post has been sent successfully.']);
        }
        return redirect('engagement/add')->withInput()->withErrors(['error' => 'A problem has been occured while submitting your post.']);
    }

    public function getTimeline($idMedia, $idSocmed)
    {
        return \GuzzleHttp\json_encode($this->engagement->timeline($idMedia,$idSocmed));
    }

    private function saveSocmedToken($result, $idMedia)
    {
        $socmedAttribute = [];
        if (session()->has('socmedAttribute')) {
            $socmedAttribute = session('socmedAttribute');
        }
        $socmedAttribute[$idMedia] = [
            'token' => $result->token,
            'id' => $result->user->id,
            'email' => $result->user->email,
            'userName' => $result->user->userName
        ];

        session(['socmedAttribute' => $socmedAttribute]);
        Storage::put('socmed.json', \GuzzleHttp\json_encode($socmedAttribute));
    }

    private function removeSocmedToken($idMedia)
    {
        $socmedAttribute = session('socmedAttribute');
        array_pull($socmedAttribute, $idMedia);
        session()->forget('socmedAttribute');
        session(['socmedAttribute' => $socmedAttribute]);
        Storage::put('socmed.json', \GuzzleHttp\json_encode($socmedAttribute));
    }

    public function engagementCalendar()
    {
        $data['pageTitle'] = 'Scheduled Posts';
        return view('pages.engagement.calendar', $data);
    }
    public function engagementTimeline()
    {
        $data['fbAccounts'] = $this->engagement->getLoggedInAccounts(1);
        $data['twAccounts'] = $this->engagement->getLoggedInAccounts(2);
        $data['ytAccounts'] = $this->engagement->getLoggedInAccounts(5);
        $data['igAccounts'] = $this->engagement->getLoggedInAccounts(7);

        $data['pageTitle'] = 'Timeline';
        return view('pages.engagement.timeline', $data);
    }

    public function engagementReply()
    {
        $data['pageTitle'] = 'Reply Engagement';
        return view('pages.engagement.reply', $data);
    }
    public function engagementDetail()
    {
        $data['pageTitle'] = 'Engagement Detail';
        return view('pages.engagement.detail', $data);
    }
    public function engagementList()
    {
        $data['pageTitle'] = 'All Engagement';
        return view('pages.engagement.list', $data);
    }
}
