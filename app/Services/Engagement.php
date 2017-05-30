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

    public function logout($request, $idMedia)
    {
        $socmedAttribute = session('socmedAttribute')[$idMedia];
        $params = [
            'uid' => \Auth::id(),
            'idMedia' => $idMedia,
            'appkey' => config('services.smsmc.key'),
            'authTokenSocmed' => $socmedAttribute['token'],
            'idSocmed' => $socmedAttribute['id'],
        ];

        return $this->smsmc->post('engagement/logout', $params);
    }

    // public function users($idMedia)
    // {
    //     // $socmedAttribute = session('socmedAttribute')[$idMedia];
    //     $params = [
    //         'uid' => \Auth::id(),
    //         'idMedia' => $idMedia
    //     ];
    //     return $this->smsmc->post('engagement/user', $params);
    // }

    public function post($request)
    {
        $socmedAttribute = session('socmedAttribute');
        $idMedia = $request->input('media_id');

        if (isset($socmedAttribute[$idMedia])) {
            $socmed = $socmedAttribute[$idMedia];
            $params = [
                'uid' => \Auth::id(),
                'idMedia' => $idMedia,
                'authTokenSocmed' => $socmed['token'],
                'idSocmed' => $socmed['id'],
                // 'postContent' => $content,
            ];
            if ($request->has('post_date')) {
                $postDate = $request->input('post_date');
                // $params['postDate'] = Carbon::createFromFormat('d/m/y H:i', $postDate)->format('Y-m-d\TH:i:s\Z');
                $params['postDate'] = Carbon::createFromFormat('d/m/y H:i', $postDate)->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
            } else {
                // $params['postDate'] = Carbon::now()->format('Y-m-d\TH:i:s\Z');
                // $params['postDate'] = Carbon::now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
                $params['postDate'] = '';
            }
            // for fb
            if ($idMedia == 1) {
                $params['postContent'] = $request->input('postContentFb');
                // $params['postAttachment'] = $request->input('postImgFb');
                // $params['postVideoAttachment'] = $request->input('postVidFb');
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
                $videoFieldName = 'video';
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
                $params['postAttachment1'] = '';
                $params['postAttachment2'] = '';
                $params['postAttachment3'] = '';
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

//             $fileFieldName = 'image';
//             $socmedFile = '';
//
//             if ($request->hasFile($fileFieldName)) {
//                 if ($request->file($fileFieldName)->isValid()) {
// //                    $fileName = 'socmed_' . $idMedia . '_' . strtotime(date('Y-m-d H:i:s')) . '.' . $request->file($fileFieldName)->getClientOriginalExtension();
// //                    $dirPath = public_path('socmed-images');
// //                    if (! is_dir($dirPath)) {
// //                        mkdir($dirPath, 0777, true);
// //                    }
// //                    $request->file($fileFieldName)->move($dirPath, $fileName);
// //                    $fullFilePath = public_path('socmed-images/' . $fileName);
//                     //dd($request->file($fileFieldName));
//                     $uploadedFile = $request->file($fileFieldName);
//                     $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
//                     if ($uploadResponse->status == 200) {
//                         $socmedFile = $uploadResponse->result->file_path;
//                     }
//                 }
//             }
//
//             if ($socmedFile != '') {
//                 $params['postAttachment'] = $socmedFile;
//             }

//             $videoFieldName = 'video';
//             $socmedVideo = '';
//
//             if ($request->hasFile($videoFieldName)) {
//                 if ($request->file($videoFieldName)->isValid()) {
// //                    $videoName = 'socmed_' . $idMedia . '_' . strtotime(date('Y-m-d H:i:s')) . '.' . $request->file($videoFieldName)->getClientOriginalExtension();
// //                    $vidPath = public_path('socmed-videos');
// //                    if (! is_dir($vidPath)) {
// //                        mkdir($vidPath, 0777, true);
// //                    }
// //                    $request->file($videoFieldName)->move($vidPath, $videoName);
// //                    $fullVidPath = public_path('socmed-videos/' . $videoName);
//                     $uploadedFile = $request->file($videoFieldName);
//                     $uploadResponse = $this->smsmc->postSocmedFile($uploadedFile->getRealPath(), $idMedia);
//                     if ($uploadResponse->status == 200) {
//                         $socmedVideo = $uploadResponse->result->file_path;
//                     }
//                 }
//             }
//
//             if ($socmedVideo != '') {
//                 $params['postVideoAttachment'] = $socmedVideo;
//             }

            Log::warning(\GuzzleHttp\json_encode($params));

            $response = $this->smsmc->post('engagement/post', $params);
            if ($response->status == 200) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function timeline($idMedia)
    {
        if (isset(session('socmedAttribute')[$idMedia])) {
            $socmedAttribute = session('socmedAttribute')[$idMedia];
            $params = [
                'uid' => \Auth::id(),
                'authTokenSocmed' => $socmedAttribute['token'],
                'idMedia' => $idMedia,
                'idSocmed' => $socmedAttribute['id']
            ];
            $response = $this->smsmc->post('engagement/timeline', $params);
            if ($response->status == 200) {
                return $response->result;
            }
        }
        $class = new StdClass();
        $class->data = [];
        $class->List = 'Timeline';
        return $class;
    }
}
