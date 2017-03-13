@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form id="report_add">
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
                                    <input class="uk-input" id="title" type="text" placeholder="Some text...">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="objective">Report Descriptions</label>
                                <div class="uk-form-controls">
                                    <textarea class="uk-textarea" rows="4" placeholder="Some text..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="objective">Report Period</label>
                                <div class="uk-form-controls">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="datetimepicker uk-input uk-width-small" name="startDate" aria-describedby="option-startDate">
                                    </div>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="datetimepicker uk-input uk-width-small" name="endDate" aria-describedby="option-endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="report">Report Type</label>
                                <div class="uk-child-width-1-2@m uk-grid-small" uk-grid>
                                    <div>
                                        <select class="uk-select" id="type-selector">
                                            <option value="">Choose Type</option>
                                            <option value="project">Project Report</option>
                                            <option value="socmed">Social Media Report</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select class="uk-select" id="project-selector">
                                            <option value="pid1" class="project">Project 1</option>
                                            <option value="pid2" class="project">Project 2</option>
                                            <option value="pid3" class="project">Project 3</option>
                                            <option value="0" class="socmed">Choose Social Media</option>
                                            <option value="socmed-facebook" class="socmed">Facebook</option>
                                            <option value="socmed-twitter" class="socmed">Twitter</option>
                                            <option value="socmed-youtube" class="socmed">Youtube</option>
                                            <option value="socmed-instagram" class="socmed">Instagram</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select class="uk-select" id="key-acc-selector">
                                            <option value="all1" class="pid1">All Keyword</option>
                                            <option value="key1" class="pid1">Keyword 1</option>
                                            <option value="key2" class="pid1">Keyword 2</option>
                                            <option value="key3" class="pid1">Keyword 3</option>
                                            <option value="all2" class="pid2">All Keyword</option>
                                            <option value="keyA" class="pid2">Keyword A</option>
                                            <option value="keyB" class="pid2">Keyword B</option>
                                            <option value="keyC" class="pid2">Keyword C</option>
                                            <option value="fb1" class="socmed-facebook">Facebook Account 1</option>
                                            <option value="fb2" class="socmed-facebook">Facebook Account 2</option>
                                            <option value="fb3" class="socmed-facebook">Facebook Account 3</option>
                                            <option value="tw1" class="socmed-twitter">Twitter Account 1</option>
                                            <option value="tw2" class="socmed-twitter">Twitter Account 2</option>
                                            <option value="tw3" class="socmed-twitter">Twitter Account 3</option>
                                        </select>
                                    </div>
                                    <div>
                                        <select class="uk-select" id="media-selector">
                                            <option value="project-summary" class="project">Summary Page</option>
                                            <option value="project-facebook" class="project">Facebook</option>
                                            <option value="project-twitter" class="project">Twitter</option>
                                            <option value="project-news" class="project">Online News</option>
                                            <option value="project-forum" class="project">Forum</option>
                                            <option value="project-blog" class="project">Blog</option>
                                            <option value="project-video" class="project">Video</option>
                                            <option value="project-instagram" class="project">Instagram</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="project-summary" class="sm-media uk-margin"></div>
                    <div id="project-facebook" class="sm-media uk-margin"></div>
                    <div id="project-twitter" class="sm-media uk-margin"></div>
                    <div id="project-news" class="sm-media uk-margin"></div>
                    <div id="project-forum" class="sm-media uk-margin"></div>
                    <div id="project-blog" class="sm-media uk-margin"></div>
                    <div id="project-video" class="sm-media uk-margin"></div>
                    <div id="project-instagram" class="sm-media uk-margin"></div>

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
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.chained.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/report-add.js') !!}"></script>
@endsection