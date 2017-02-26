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
                                    <textarea class="uk-textarea" rows="5" placeholder="Some text..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="objective">Report Period</label>
                                <div class="uk-form-controls">
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="uk-input uk-width-small" name="startDate" aria-describedby="option-startDate" placeholder="" data-toggle="datepicker">
                                    </div>
                                    <div class="uk-inline">
                                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                        <input type="text" class="uk-input uk-width-small" name="endDate" aria-describedby="option-endDate" placeholder="" data-toggle="datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="report">Report Type</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="report">
                                        <option value="project">Project Report</option>
                                        <option value="socmed">Social Media Report</option>
                                    </select>
                                </div>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="project">
                                        <option>Choose</option>
                                        <option value="pid1" class="project">Project 1</option>
                                        <option value="pid2" class="project">Project 2</option>
                                        <option value="pid3" class="project">Project 3</option>
                                        <option value="facebook" class="socmed">Facebook</option>
                                        <option value="twitter" class="socmed">Twitter</option>
                                        <option value="youtube" class="socmed">Youtube</option>
                                        <option value="instagram" class="socmed">Instagram</option>
                                    </select>
                                </div>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="key">
                                        <option value="all1" class="pid1">All Keyword</option>
                                        <option value="key1" class="pid1">Keyword 1</option>
                                        <option value="key2" class="pid1">Keyword 2</option>
                                        <option value="key3" class="pid1">Keyword 3</option>
                                        <option value="all2" class="pid2">All Keyword</option>
                                        <option value="keyA" class="pid2">Keyword A</option>
                                        <option value="keyB" class="pid2">Keyword B</option>
                                        <option value="keyC" class="pid2">Keyword C</option>
                                        <option value="fb1" class="facebook">Facebook 1</option>
                                        <option value="fb2" class="facebook">Facebook 2</option>
                                        <option value="fb3" class="facebook">Facebook 3</option>
                                        <option value="tw1" class="twitter">Twitter 1</option>
                                        <option value="tw2" class="twitter">Twitter 2</option>
                                        <option value="tw3" class="twitter">Twitter 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="uk-card-title">Choose Chart</h5>
                    <div class="uk-child-width-1-4 uk-grid-small uk-margin-top" uk-grid>
                        <li>
                            <label for="checkedAll">
                            <input class="uk-checkbox" type="checkbox" name="checkedAll" id="checkedAll" class="filled-in" />
                            Select All</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id1" value="1" class="filled-in checkSingle" />
                            <label for="id1">Brand Equity</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id2" value="2" class="filled-in checkSingle" />
                            <label for="id2">Share of Voice</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id3" value="3" class="filled-in checkSingle" />
                            <label for="id3">Volume Trending</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id4" value="4" class="filled-in checkSingle" />
                            <label for="id4">Media Distribution</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id5" value="5" class="filled-in checkSingle" />
                            <label for="id5">Sentiment Media Distribution</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id6" value="6" class="filled-in checkSingle" />
                            <label for="id6">Topic Distribution</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id12" value="12" class="filled-in checkSingle" />
                            <label for="id12">Sentiment Brand Distribution</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id8"  value="8" class="filled-in checkSingle" />
                            <label for="id8">Cloud</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="id9" value="9" class="filled-in checkSingle" />
                            <label for="id9">Media Per Brand Distribution</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="idF" value="F" class="filled-in checkSingle" />
                            <label for="idF">Media Details</label>
                        </li>
                        <li>
                            <input class="uk-checkbox" type="checkbox" name="widgets[]" id="idE"  value="E" class="filled-in checkSingle" />
                            <label for="idE">Influencer</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="uk-card-footer uk-clearfix">
                <button class="uk-button red white-text uk-float-right" type="submit">Save</button>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.chained.js') !!}"></script>
    <script>
    $(document).ready(function() {
        $("#project").chained("#report");
        $("#key").chained("#project");
    });
    </script>
@endsection