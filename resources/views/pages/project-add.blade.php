@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-4@xl" uk-grid>
            <div class="uk-width-1-1">
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Project Information</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-child-width-1-2 uk-grid-medium" uk-grid>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="title">Project Title</label>
                                    <div class="uk-form-controls">
                                        <input class="uk-input" id="title" type="text" placeholder="Some text...">
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="group">Project Group</label>
                                    <div class="uk-form-controls">
                                        <select class="uk-select" id="group">
                                            <option>Group 01</option>
                                            <option>Group 02</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="objective">Project Objective</label>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="5" placeholder="Your objective about this project" style="height:122px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1">
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-body">
                        <ul class="uk-flex-right" uk-tab>
                            <li><a>Simple Mode</a></li>
                            <li><a>Advanced Mode</a></li>
                        </ul>
                        <ul class="uk-switcher uk-margin">
                            <li>
                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Keyword</h5>
                                    <div class="uk-form-controls">
                                        <input class="uk-input uk-width-1-4" id="k1" type="text" placeholder="Keyword">
                                    </div>
                                    <a class="uk-button uk-button-text uk-margin-small-top">Add more keyword</a>
                                </div>

                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Topic</h5>
                                    <div class="uk-form-controls">
                                        <input class="uk-input uk-width-1-4" id="t1" type="text" placeholder="Topic">
                                    </div>
                                    <a class="uk-button uk-button-text uk-margin-small-top">Add more topic</a>
                                </div>

                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Noise Filter</h5>
                                    <div class="uk-form-controls">
                                        <input class="uk-input uk-width-1-4" id="n1" type="text" placeholder="Filter">
                                    </div>
                                    <a class="uk-button uk-button-text uk-margin-small-top">Add more filter</a>
                                </div>
                            </li>
                            <li>
                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Keyword</h5>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="6"></textarea>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Topic</h5>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="6"></textarea>
                                    </div>
                                </div>

                                <div class="uk-margin">
                                    <h5 class="uk-card-title">Noise Filter</h5>
                                    <div class="uk-form-controls">
                                        <textarea class="uk-textarea" rows="6"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-card-footer uk-clearfix">
                        <a class="uk-button red white-text uk-float-right">Save Project</a>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
@endsection