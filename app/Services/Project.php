<?php

namespace App\Service;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Project
{
    /**
     * @var Smsmc
     */
    private $smsmc;

    /**
     * Project constructor.
     */
    public function __construct(Smsmc $smsmc)
    {
        $this->smsmc = $smsmc;
    }

    public function projectList($page = 0, $row = 4, $totalPage = 0)
    {
        $params['uid'] =Auth::user()->id;
        if ($page != 0) {
            $params['page'] = $page;
        }
        if ($row != 4) {
            $params['row'] = $row;
        }
        if ($totalPage != 0) {
            $params['totalPage'] = $totalPage;
        }
        // Log::warning(\GuzzleHttp\json_encode($params));
        $projectList = $this->smsmc->post('project/list', $params);
        if ($projectList->status == 200) {
            return $projectList->result;
        }

        return [];
    }

    public function projectDetail($projectId)
    {
        $params = [
            'pid' => $projectId
        ];

        $projectDetail = $this->smsmc->post('project/getEdit', $params, true, true, false);
        if ($projectDetail->status == 200) {
            return $projectDetail->result;
        }

        return [];
    }

    public function getProject($projectId)
    {
        $params = [
            'pid' => $projectId
        ];

        $projectDetail = $this->smsmc->post('project/get', $params);
        if ($projectDetail->status == 200) {
            return $projectDetail->result;
        }

        return [];
    }

    public function create($data)
    {
        $mode = 'simple';
        $title = $data['field_title'];
        $group = $data['field_group'];
        $objective = $data['field_objective'];
        $keywords = $data['field_keyword'];
        $topics = $data['field_topic'];
        $noises = $data['field_noise'];
        $advKeywords = $data['field_adv_keyword'];
        $advTopics = $data['field_adv_topic'];
        $advNoises = $data['field_adv_noise'];

        $params = [
            'uid' => \Auth::user()->id,
            'pname' => $title,
            //'pgroup' => $group
        ];

        if ($advKeywords[1][1] != '') {
            $mode = 'advanced';
        }

        if ($mode == 'simple') {
            // keywords
            if ($this->countField($keywords) > 0) {
                foreach ($keywords as $key => $keyword) {
                    $words = $this->generateWords($keyword);
                    $params['mo' . $key] = $words;
                }
            }
            // topics
            if ($this->countField($topics) > 0) {
                foreach ($topics as $key => $topic) {
                    $words = $this->generateWords($topic);
                    $params['to' . $key] = $words;
                }
            }
            // noises
            if ($this->countField($noises) > 0) {
                foreach ($noises as $key => $noise) {
                    $words = $this->generateWords($noise);
                    $params['no' . $key] = $words;
                }
            }
        } else {
            // keywords
            foreach ($advKeywords as $key => $keyword) {
                $params['mo' . $key] = $keyword;
            }
            // topics
            foreach ($advTopics as $key => $topic) {
                $params['to' . $key] = $topic;
            }
            // noises
            foreach ($advNoises as $key => $noise) {
                $params['no' . $key] = $noise;
            }
        }

        return $this->smsmc->post('project/add', $params);
    }

    public function getProjectById($projectId)
    {
        $params = [
            'pid' => $projectId
        ];
        $response = $this->smsmc->post('project/getEdit', $params);

        return $response->result;
    }

    public function update(array $inputs, $projectId)
    {
        $oriKeywordsNumber = $inputs['keywords_number'];
        $oriTopicsNumber = $inputs['topics_number'];
        $oriExcludesNumber = $inputs['excludes_number'];

        $keywordNumber = $this->countField($inputs['field_adv_keyword']);
        $topicNumber = $this->countField($inputs['field_adv_topic']);
        $excludeNumber = $this->countField($inputs['field_adv_noise']);

        $keywords = $inputs['field_adv_keyword'];
        $topics = $inputs['field_adv_topic'];
        $excludes = $inputs['field_adv_noise'];

        $params['pname'] = $inputs['field_title'];
        $params['pid'] = $projectId;

        if ($oriKeywordsNumber >= $keywordNumber) {
            for ($x = 1; $x <= $oriKeywordsNumber; $x++) {
                if (isset($keywords[$x])) {
                    $params['mo' . $x] = $keywords[$x];
                } else {
                    $params['mo' . $x] = '';
                }
            }
        } else {
            foreach ($keywords as $id => $keyword) {
                $params['mo' . $id] = $keyword;
            }
        }

        if ($oriTopicsNumber >= $topicNumber) {
            for ($x = 1; $x <= $oriTopicsNumber; $x++) {
                if (isset($topics[$x])) {
                    $params['to' . $x] = $topics[$x];
                } else {
                    $params['to' . $x] = '';
                }

            }
        } else {
            foreach ($topics as $id => $topic) {
                $params['to' . $id] = $topic;
            }
        }

        if ($oriExcludesNumber >= $excludeNumber) {
            for ($x = 1; $x <= $oriExcludesNumber; $x++) {
                if (isset($excludes[$x])) {
                    $params['no' . $x] = $excludes[$x];
                } else {
                    $params['no' . $x] = '';
                }
            }
        } else {
            foreach ($excludes as $id => $exclude) {
                $params['no' . $id] = $exclude;
            }
        }

        Log::warning("update project ==> project/edit ==> " . \GuzzleHttp\json_encode($params));

        return $this->smsmc->post('project/edit', $params);
    }

    public function delete($projectId)
    {
        $params = [
            'pid' => $projectId
        ];
        $response = $this->smsmc->post('project/delete', $params);

        return $response;
    }

    public function getPilars()
    {
        $params = [
            'uid' => \Auth::id()
        ];
        $response = $this->smsmc->post('pilar/list', $params);
        if ($response->status == '200') {
            return $response->result;
        }

        return [];
    }

    private function generateWords($keyword)
    {
        $words = '';
        foreach ($keyword as $word) {
            $w = ( $word == '' ? $word : '' . $word );
            $words .= $this->validateInput($w);
        }
        return $words;
    }

    private function validateInput($w)
    {
        $word = str_replace("'", "\\'", $w);

        if (preg_match('/AND /', $word)) {
            $word = $this->parseConjunction($word, 'AND');
        } elseif (preg_match('/OR /', $word)) {
            $word = $this->parseConjunction($word, 'OR');
        } elseif (preg_match('/NOT /', $word)) {
            $word = $this->parseConjunction($word, 'NOT');
        } else {
            $word = $this->spaceToVerticalBar($word);
        }

        return $word;
    }

    private function parseConjunction($word, $conjuction)
    {
        $conj = $conjuction . ' ';
        $xplodedWord = explode($conj, $word);
        $word = $xplodedWord[1];
        $word = $this->spaceToVerticalBar($word);
        return ' ' . $conj . $word;
    }

    private function spaceToVerticalBar($word)
    {
        if (preg_match('/\s/', $word)) {
            $word = '|' . $word . '|';
        }
        return $word;
    }

    private function countField($field)
    {
        $x = 0;
        if (count($field) > 0) {
            foreach ($field as $value) {
                $y = 0;
                if ($value != '') {
                    $y = 1;
                }
                $x += $y;
            }
        }

        return $x;
    }

    public function getPaginatedProjects($request, $path)
    {
        $totalPage = $request->has('totalPage') ? $request->get('totalPage') : 0;
        $currentPage = LengthAwarePaginator::resolveCurrentPage() == 0 ? 0 : LengthAwarePaginator::resolveCurrentPage() - 1;
        $perPage = 8;
        $projectResponse = $this->projectList($currentPage, $perPage, $totalPage);
        $projects = $projectResponse->projectList;
        $totalRow = $projectResponse->totalProject;
        $collection = new Collection($projects);
        $currentPageSearchResults = $collection->all();
        $totalPage = $projectResponse->totalPage;
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, $totalRow, $perPage);
        return $paginatedSearchResults
            ->appends(['totalPage' => $totalPage])
            ->withPath($path);
    }


}
