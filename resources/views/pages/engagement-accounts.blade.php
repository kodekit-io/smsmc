@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-4@xl" uk-grid>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Facebook Login</h5>
                    </div>
                    <div class="uk-card-body">
                        <form class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="yt-email">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="ig-email" type="email" placeholder="email@address">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="ig-email">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="ig-pwd" type="password">
                                </div>
                            </div>
                            <button class="uk-button blue darken-4 white-text">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Twitter Login</h5>
                    </div>
                    <div class="uk-card-body">
                        <form class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="tw-email">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="tw-email" type="email" placeholder="email@address">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="tw-email">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="tw-pwd" type="password">
                                </div>
                            </div>
                            <button class="uk-button blue accent-1 white-text">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Youtube Login</h5>
                    </div>
                    <div class="uk-card-body">
                        <form class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="yt-email">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="yt-email" type="email" placeholder="email@address">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="yt-email">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="yt-pwd" type="password">
                                </div>
                            </div>
                            <button class="uk-button red white-text">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title">Instagram Login</h5>
                    </div>
                    <div class="uk-card-body">
                        <form class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="ig-email">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="ig-email" type="email" placeholder="email@address">
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="ig-email">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="ig-pwd" type="password">
                                </div>
                            </div>
                            <button class="uk-button pink darken-4 white-text">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
@endsection