<?php

namespace App\Service;


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

    public function post($request)
    {
        $socmedAttribute = session('socmedAttribute');
        $idMedia = $request->input('media_id');
        $content = $request->input('content');

        if (isset($socmedAttribute[$idMedia])) {
            $socmed = $socmedAttribute[$idMedia];
            $params = [
                'uid' => \Auth::id(),
                'idMedia' => $idMedia,
                'authTokenSocmed' => $socmed['token'],
                'idSocmed' => $socmed['id'],
                'postContent' => $content,
            ];
            if ($request->has('post_date')) {
                $postDate = $request->input('post_date');
                $params['postDate'] = $postDate;
            }
            // additional for fb
            if ($idMedia == 1) {
                $params['postLinkAttachment'] = 'facebook';
                $params['postSourceAttachment'] = 'facebook';
                $params['name'] = 'facebook';
                $params['caption'] = 'facebook';
                $params['description'] = 'facebook';
            }
            // additional for youtube
            if ($idMedia == 5) {
                $params['videoDescription'] = 'youtube';
                $params['videoTags'] = 'youtube';
            }

            $fileFieldName = 'image';
            $socmedFile = '';

            if ($request->hasFile($fileFieldName)) {
                if ($request->file($fileFieldName)->isValid()) {
                    $fileName = 'socmed_' . $idMedia . '_' . strtotime(date('Y-m-d H:i:s')) . '.' . $request->file($fileFieldName)->getClientOriginalExtension();
                    $dirPath = public_path('socmed-images');
                    if (! is_dir($dirPath)) {
                        mkdir($dirPath, 0777, true);
                    }
                    $request->file($fileFieldName)->move($dirPath, $fileName);
                    $fullFilePath = public_path('socmed-images/' . $fileName);

                    $uploadResponse = $this->smsmc->postSocmedFile($fullFilePath, $idMedia);
                    if ($uploadResponse->status == 200) {
                        $socmedFile = $uploadResponse->result->file_path;
                    }
                }
            }

            if ($socmedFile != '') {
                $params['postAttachment'] = $socmedFile;
            }

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
        return [];
    }
}