@extends('layouts.default')
@section('page-level-styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form id="project_add" class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m " uk-grid method="post" action="{!! url('project/create') !!}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="uk-width-1-1">
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Project Information</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-child-width-1-3 uk-grid-medium" uk-grid>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="field_title">Project Title</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="field_title" name="field_title" type="text" placeholder="Some text..." required>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="field_group">Pillar</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select" id="field_group" name="field_group" required>
                                            @foreach($pilars as $pilar)
                                            <option value="{!! $pilar->id !!}">{!! $pilar->pilarName !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="user_select">User</label>
                                    <div class="uk-form-controls">
                                        <select name="user_id" id="user_select" class="uk-input uk-width-1-1">
                                            @foreach($users as $user)
                                                <option value="{!! $user->idLogin !!}">{!! $user->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="project_image">Cover Image <span class="uk-text-small">(allowed: JPG or PNG, < 1MB)</span></label>
                                    <div class="uk-form-controls">
                                        <input type="file" id="project_image" name="project_image" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="objective">Project Description</label>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="5" placeholder="Your objective about this project" style="height:122px;"  id="field_objective" name="field_objective"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="uk-flex-right" uk-tab>
                            <li><a>Simple Mode</a></li>
                            <li><a>Advanced Mode</a></li>
                        </ul>
                        <ul class="uk-switcher uk-margin">
                            {{--Simple--}}
                            <li>
                                <h5 class="uk-card-title">Keyword</h5>
                                <ol id="keyword" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowItem('keyword')" class="uk-button uk-button-text" title="Add New Keyword" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Keyword</span>
                                </a>

                                <h5 class="uk-card-title">Topic</h5>
                                <ol id="topic" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowItem('topic')" class="uk-button uk-button-text" title="Add New Topic" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Topic</span>
                                </a>

                                <h5 class="uk-card-title">Noise Filter</h5>
                                <ol id="noise" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowItem('noise')" class="uk-button uk-button-text" title="Add New Noise Filter" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Noise</span>
                                </a>
                            </li>
                            {{--Advanced--}}
                            <li>
                                <h5 class="uk-card-title">Keyword</h5>
                                <ol id="adv_keyword" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowAdv('adv_keyword')" class="uk-button uk-button-text" title="Add New Keyword" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Keyword</span>
                                </a>

                                <h5 class="uk-card-title">Topic</h5>
                                <ol id="adv_topic" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowAdv('adv_topic')" class="uk-button uk-button-text" title="Add New Topic" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Topic</span>
                                </a>

                                <h5 class="uk-card-title">Noise Filter</h5>
                                <ol id="adv_noise" class="uk-list-divider sm-list-item"></ol>
                                <a onclick="addRowAdv('adv_noise')" class="uk-button uk-button-text" title="Add New Noise Filter" uk-tooltip>
                                    <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Noise</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-card-footer uk-clearfix">
                        <button class="uk-button red white-text uk-float-right" type="submit">Save Project</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{!! asset('assets/js/pages/project-add.js') !!}"></script>

    <script>
        $("#user_select").select2();
    </script>
@endsection
