<?php

namespace App\Service;


use Illuminate\Support\Facades\Log;

trait DatatableSorter
{
    public function datatableSorter($idMedia, $order, $params)
    {
        $orderCol = $order[0]['column'];
        $orderSort = $order[0]['dir'];
        if ($orderCol > 0) {
            $cols = [];
            switch ($idMedia) {
                case "1":
                    $cols = $this->fbCols();
                    break;
                case "2":
                    $cols = $this->twitterCols();
                    break;
                case "4":
                    $cols = $this->newsCols();
                    break;
                case "9":
                    $cols = $this->newsCols();
                    break;
                case "3":
                    $cols = $this->blogCols();
                    break;
                case "6":
                    $cols = $this->forumCols();
                    break;
                case "5":
                    $cols = $this->ytCols();
                    break;
                case "7":
                    $cols = $this->instCols();
                    break;
            }
            if (array_key_exists($orderCol, $cols)) {
                $params['sort'] = $cols[$orderCol] . ' ' . $orderSort;
            }
            return $params;
        }
        return $params;
    }
    public function fbCols()
    {
        return [
            "2" => "published_at",
            "3" => "author",
            "6" => "comment_count",
            "7" => "like_count",
            "8" => "share_count",
            "98" => "content",
            "99" => "url",
        ];
    }

    public function twitterCols()
    {
        return [
            "2" => "created_at",
            "3" => "author",
            "98" => "user_followers_count",
            "98" => "content",
            "99" => "url",
        ];
    }

    public function newsCols()
    {
        return [
            "2" => "published_at",
            "3" => "author",
            "99" => "url",
        ];
    }

    public function blogCols()
    {
        return [
            "2" => "published_at",
            "3" => "author",
            "99" => "url",
        ];
    }

    public function forumCols()
    {
        return [
            "2" => "published_at",
            "98" => "url",
            "99" => "author",
        ];
    }

    public function ytCols()
    {
        return [
            "2" => "created_at",
            "3" => "author",
            "5" => "comment_count",
            "6" => "read_count",
            "99" => "url",
        ];
    }

    public function instCols()
    {
        return [
            "2" => "published_at",
            "3" => "author",
            "5" => "comment_count",
            "6" => "like_count",
            "98" => "content",
            "99" => "url",
        ];
    }
}