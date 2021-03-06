@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form id="project_add" class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m " uk-grid method="post" action="{!! url('project/' . $projectId . '/update') !!}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="keywords_number" value="{!! count($keywords) !!}">
            <input type="hidden" name="topics_number" value="{!! count($topics) !!}">
            <input type="hidden" name="excludes_number" value="{!! count($excludes) !!}">
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
                                        <input class="uk-input" id="field_title" name="field_title" type="text" value="{!! $project->pname !!}" required>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="field_group">Pillar</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select" id="field_group" name="field_group" required>
                                            @foreach($pilars as $pilar)
                                            <option value="{!! $pilar->id !!}"
                                                @if($pilar->id == $project->groupId) selected @endif>{!! $pilar->pilarName !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="user_select">Asign to</label>
                                    <div class="uk-form-controls">
                                        <select name="user_id" id="user_select" class="uk-input uk-width-1-1">
                                            @foreach($users as $user)
                                                <option value="{!! $user->idLogin !!}"
                                                    @if($user->idLogin == $project->userId) selected @endif>
                                                    {!! $user->name !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="project_image">Cover Image <span class="uk-text-small">(allowed: JPG or PNG, < 1MB)</span></label>
                                    <div class="uk-form-controls uk-flex uk-flex-inline">
                                        @if(isset($project->pmage))
                                            <div class="uk-cover-container uk-margin-small-right" style="width:40px;height:40px;">
                                                <img src="{!! $project->pmage !!}" uk-cover>
                                            </div>
                                        @endif
                                        <div uk-form-custom="target: true">
                                            <input type="file" id="project_image" name="project_image">
                                            <input class="uk-input uk-form-width-medium" type="text" placeholder="Select image" disabled>
                                        </div>
                                        {{-- <input type="file" id="project_image" name="project_image" /> --}}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="objective">Project Description</label>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="5" placeholder="Your objective about this project" style="height:122px;"  id="field_objective" name="field_objective">{!! $project->description !!}</textarea>
                                     </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <h5 class="uk-card-title">Keyword</h5>
                            <ol id="adv_keyword" class="uk-list-divider sm-list-item">
                                @if (count($keywords) > 0)
                                    @php $x = 1; @endphp
                                    @foreach($keywords as $keyword)
                                        <li><textarea class="uk-textarea field-adv_keyword" rows="6" name="field_adv_keyword[{!! $x !!}]">{!! $keyword->keyword->keywordName !!}</textarea></li>
                                        @php $x++; @endphp
                                    @endforeach
                                @else
                                    <li><textarea class="uk-textarea field-adv_keyword" rows="6" name="field_adv_keyword[1]"></textarea></li>
                                @endif
                            </ol>
                            <a onclick="addRowAdv('adv_keyword')" class="uk-button uk-button-text" title="Add New Keyword" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Keyword</span>
                            </a>

                            <h5 class="uk-card-title">Topic</h5>
                            <ol id="adv_topic" class="uk-list-divider sm-list-item">
                                @if(count($topics) > 0)
                                    @php $x = 1; @endphp
                                    @foreach($topics as $topic)
                                        <li><textarea class="uk-textarea field-adv_topic" rows="6" name="field_adv_topic[{!! $x !!}]">{!! $topic->topicName !!}</textarea></li>
                                        @php $x++; @endphp
                                    @endforeach
                                @else
                                    <li><textarea class="uk-textarea field-adv_topic" rows="6" name="field_adv_topic[1]"></textarea></li>
                                @endif
                            </ol>
                            <a onclick="addRowAdv('adv_topic')" class="uk-button uk-button-text" title="Add New Topic" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Topic</span>
                            </a>

                            <h5 class="uk-card-title">Noise Filter</h5>
                            <ol id="adv_noise" class="uk-list-divider sm-list-item">
                                @if (count($excludes) > 0)
                                    @php $x = 1; @endphp
                                    @foreach($excludes as $exclude)
                                        <li><textarea class="uk-textarea field-adv_noise" rows="6" name="field_adv_noise[{!! $x !!}]">{!! $exclude->noiseKeyName !!}</textarea></li>
                                        @php $x++; @endphp
                                    @endforeach
                                @else
                                    <li><textarea class="uk-textarea field-adv_noise" rows="6" name="field_adv_noise[1]"></textarea></li>
                                @endif
                            </ol>
                            <a onclick="addRowAdv('adv_noise')" class="uk-button uk-button-text" title="Add New Noise Filter" uk-tooltip>
                                <i class="fa fa-plus fa-fw"></i><span class="uk-text-small">Add Noise</span>
                            </a>
                        </div>
                    </div>
                    <div class="uk-card-footer uk-clearfix">
                        <a class="uk-button grey white-text uk-float-left uk-margin-small-left" href="{!! url('home') !!}">Cancel</a>
                        <button class="uk-button red white-text uk-float-right" type="submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/project-edit.js') !!}"></script>
@endsection
