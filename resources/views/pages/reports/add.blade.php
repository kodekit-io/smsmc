@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form id="report_add" action="{!! url('report/create') !!}" method="post">
            {!! csrf_field() !!}
            <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                <div class="uk-card-header uk-clearfix">
                    <h5 class="uk-card-title uk-float-left">Report Information</h5>
                </div>
                <div class="uk-card-body">
                    <div class="uk-child-width-1-2 uk-grid-medium" uk-grid>
                        <div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="title">Report Title</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="title" name="title" type="text" placeholder="Some text...">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="objective">Report Descriptions</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" name="description" rows="5" placeholder="Some text..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="objective">Report Period</label>
                                <div class="uk-form-controls uk-flex uk-flex-middle">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="reportTime uk-input uk-width-small" name="startDate" id="startDate">
                                    </div>
                                    <span class="uk-margin-small-left uk-margin-small-right"> - </span>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="reportTime uk-input uk-width-small" name="endDate" id="endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">

                                <div class="uk-child-width-1-2@m uk-grid-small" uk-grid>
                                    <div class="uk-position-relative">
                                        <label class="uk-form-label" for="type-selector">Report Type</label>
                                        <select class="uk-select" id="type-selector" name="reportType">
                                            <option value="">Choose Type</option>
                                            <option value="project">Project Report</option>
                                            <option value="socmed">Social Media Report</option>
                                        </select>
                                    </div>
                                    <div class="uk-position-relative">
                                        <label class="uk-form-label" for="project-selector">Project / Social Media</label>
                                        <select class="uk-select" id="project-selector" name="project">
                                            @foreach($projectList as $id => $project)
                                                <option value="{!! $id !!}" class="project">{!! $project['name'] !!}</option>
                                            @endforeach
                                            {{--<option value="0" class="socmed">Choose Social Media</option>--}}
                                            @php $lastSocmed = ''; @endphp
                                            @foreach($socmedAccounts as $socmed => $account)
                                                @if($socmed != $lastSocmed)
                                                    <option value="socmed-{!! $socmed !!}" class="socmed">{!! ucwords($socmed) !!}</option>
                                                    @php $lastSocmed = $socmed; @endphp
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-position-relative">
                                        <label class="uk-form-label" for="key-acc-selector">Keyword / Account</label>
                                        <select class="uk-select" id="key-acc-selector" name="keyword[]" multiple>
                                            {{-- <option value="0" class="pid1">All Keyword</option> --}}
                                            @foreach($projectList as $id => $project)
                                                @foreach($project['detail']->keywordList as $keywordList)
                                                    @php $keyword = $keywordList->keyword; @endphp
                                                    <option value="{!! $keyword->keywordId !!}" class="{!! $id !!}">{!! $keyword->keywordName !!}</option>
                                                @endforeach
                                            @endforeach
                                            @foreach($socmedAccounts as $socmed => $accounts)
                                                @foreach($accounts as $account)
                                                    <option value="{!! $account->id !!}" class="socmed-{!! $socmed !!}">{!! $account->name !!}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="uk-position-relative">
                                        <label class="uk-form-label" for="report">Page</label>
                                        <select class="uk-select" id="media-selector" name="media">
                                            <option value="8" class="project">Summary Page</option>
                                            <option value="1" class="project">Facebook</option>
                                            <option value="2" class="project">Twitter</option>
                                            <option value="4" class="project">National News</option>
                                            <option value="9" class="project">International News</option>
                                            <option value="6" class="project">Forum</option>
                                            <option value="3" class="project">Blog</option>
                                            <option value="5" class="project">Video</option>
                                            <option value="7" class="project">Instagram</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="8" class="sm-media uk-margin"></div>
                    <div id="1" class="sm-media uk-margin"></div>
                    <div id="2" class="sm-media uk-margin"></div>
                    <div id="4" class="sm-media uk-margin"></div>
                    <div id="9" class="sm-media uk-margin"></div>
                    <div id="6" class="sm-media uk-margin"></div>
                    <div id="3" class="sm-media uk-margin"></div>
                    <div id="5" class="sm-media uk-margin"></div>
                    <div id="7" class="sm-media uk-margin"></div>

                    <div id="socmed-facebook" class="sm-media uk-margin"></div>
                    <div id="socmed-twitter" class="sm-media uk-margin"></div>
                    <div id="socmed-youtube" class="sm-media uk-margin"></div>
                    <div id="socmed-instagram" class="sm-media uk-margin"></div>
                </div>
                <div class="uk-card-footer uk-clearfix">
                    <button class="uk-button red white-text uk-float-right" type="submit">Save</button>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.chained.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/report-add.js') !!}"></script>
@endsection
