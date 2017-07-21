<?php

namespace App\Service;


use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use stdClass;

class Engagement
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Engagement constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function login($request, $idMedia)
    {
        $params = [
            'uid' => \Auth::id(),
            'usernameSocmed' => $request->input('username'),
            'passwordSocmed' => $request->input('password'),
            'idMedia' => $idMedia,
            'appkey' => config('services.smsmc.key')
        ];

        return $this->smsmc->post('engagement/login', $params);
    }

    public function logout($engagementId)
    {
        $params = [
            'uid' => \Auth::id(),
            'enggagementId' => $engagementId
        ];

        return $this->smsmc->post('engagement/user/delete', $params);
    }

    public function getLoggedInAccounts($idMedia)
    {
        $params = [
            'uid' => auth()->id(),
            'idMedia' => $idMedia
        ];
        $response = $this->smsmc->post('engagement/user', $params);
        if ($response->status == 200) {
            return $response->result->data;
        }
        return [];
    }

    public function post($request)
    {
        $idMedia = $request->input('media_id');

        $params = [
            'uid' => \Auth::id(),
            'idMedia' => $idMedia
        ];

        switch ($idMedia) {
            // facebook
            case '1':
                $params['idSocmed'] = $request->input('accFb');
                break;
            // twitter
            case '2':
                $params['idSocmed'] = $request->input('accTw');
                break;
            // youtube
            case '5':
                $params['idSocmed'] = $request->input('accYt');
                break;
            // instagram
            case '7':
                $params['idSocmed'] = $request->input('accIg');
                break;
        }

        if ($request->has('post_date')) {
            $postDate = $request->input('post_date');
            // $params['postDate'] = Carbon::createFromFormat('d/m/y H:i', $postDate)->format('Y-m-d\TH:i:s\Z');
            $params['postDate'] = Carbon::createFromFormat('d/m/y H:i', $postDate)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
        }
        // for fb
        if ($idMedia == 1) {
            $params['postContent'] = $request->input('postContentFb');
            $params['name'] = '';
            $params['caption'] = '';
            $params['description'] = '';

            // imgFB
            $fileFieldName = 'postImgFb';
            $socmedFile = '';
            if ($request->hasFile($fileFieldName)) {
                if ($request->file($fileFieldName)->isValid()) {
                    $uploadedFile = $request->file($fileFieldName);
                    $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedFile = $uploadResponse->result->file_path;
                    }
                }
            }
            if ($socmedFile != '') {
                $params['postAttachment'] = $socmedFile;
            }

            // vidFB
            $videoFieldName = 'postVidFb';
            $socmedVideo = '';
            if ($request->hasFile($videoFieldName)) {
                if ($request->file($videoFieldName)->isValid()) {
                    $uploadedFile = $request->file($videoFieldName);
                    $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedVideo = $uploadResponse->result->file_path;
                    }
                }
            }
            if ($socmedVideo != '') {
                $params['postVideoAttachment'] = $socmedVideo;
            }
        }
        // for twiiter
        if ($idMedia == 2) {
            $params['postContent'] = $request->input('postContentTw');
            // img
            $fileFieldName = 'postImgTw1';
            $socmedFile = '';
            if ($request->hasFile($fileFieldName)) {
                if ($request->file($fileFieldName)->isValid()) {
                    $uploadedFile = $request->file($fileFieldName);
                    $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedFile = $uploadResponse->result->file_path;
                    }
                }
            }
            if ($socmedFile != '') {
                $params['postAttachment0'] = $socmedFile;
            }
            // $params['postAttachment0'] = $request->input('postImgTw1');
//            $params['postAttachment1'] = '';
//            $params['postAttachment2'] = '';
//            $params['postAttachment3'] = '';
        }
        // for youtube
        if ($idMedia == 5) {
            // $params['postVideoAttachment'] = $request->input('postVidYt');
            $params['postContent'] = $request->input('postContentYt');
            $params['videoDescription'] = $request->input('postDescYt');
            // vid
            $videoFieldName = 'postVidYt';
            $socmedVideo = '';
            if ($request->hasFile($videoFieldName)) {
                if ($request->file($videoFieldName)->isValid()) {
                    $uploadedFile = $request->file($videoFieldName);
                    $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedVideo = $uploadResponse->result->file_path;
                    }
                }
            }
            if ($socmedVideo != '') {
                $params['postVideoAttachment'] = $socmedVideo;
            }
        }
        // for instagram
        if ($idMedia == 7) {
            // $params['postAttachment'] = $request->input('postImgIg');
            $params['postContent'] = $request->input('postContentIg');
            // img
            $fileFieldName = 'postImgIg';
            $socmedFile = '';
            if ($request->hasFile($fileFieldName)) {
                if ($request->file($fileFieldName)->isValid()) {
                    $uploadedFile = $request->file($fileFieldName);
                    $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedFile = $uploadResponse->result->file_path;
                    }
                }
            }
            if ($socmedFile != '') {
                $params['postAttachment'] = $socmedFile;
            }
        }

        // Log::warning(\GuzzleHttp\json_encode($params));

        $response = $this->smsmc->post('engagement/post', $params);
        if ($response->status == 200) {
            return true;
        }
        return false;
    }

    public function timeline($idMedia,$idSocmed)
    {
        $params = [
            'uid' => \Auth::id(),
            //'authTokenSocmed' => $socmedAttribute['token'],
            'idMedia' => $idMedia,
            'idSocmed' => $idSocmed
            // 'idSocmed' => $socmedAttribute['id']
        ];
        $response = $this->smsmc->post('engagement/timeline', $params);
        if ($response->status == 200) {
            return $response->result;
        } else {
            $class = new StdClass();
            $class->data = [];
            $class->List = 'Timeline';
            return $class;
        }
    }
}
