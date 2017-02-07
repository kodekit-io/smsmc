@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <form class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-4@xl" uk-grid>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Facebook</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-form-controls uk-margin">
                            <input class="uk-input" id="fb" type="text" placeholder="Facebook">
                        </div>
                        <a class="uk-button uk-button-text uk-margin-top">Add more Facebook</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Twitter</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-form-controls uk-margin">
                            <input class="uk-input" id="tw" type="text" placeholder="Twitter">
                        </div>
                        <a class="uk-button uk-button-text uk-margin-top">Add more Twitter</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Youtube</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-form-controls uk-margin">
                            <input class="uk-input" id="yt" type="text" placeholder="Youtube">
                        </div>
                        <a class="uk-button uk-button-text uk-margin-top">Add more Youtube</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Instagram</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-form-controls uk-margin">
                            <input class="uk-input" id="ig" type="text" placeholder="Instagram">
                        </div>
                        <a class="uk-button uk-button-text uk-margin-top">Add more Instagram</a>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1">
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small uk-card-body uk-clearfix">
                    <button class="uk-button red white-text uk-float-right">Save</button>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('page-level-scripts')
@endsection