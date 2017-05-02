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
                        <h5 class="uk-card-title color-text-facebook"><i class="fa fa-facebook fa-fw"></i> Facebook Login</h5>
                    </div>
                    <div class="uk-card-body">
                        @if(! isset($socmedAttribute[1]))
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-login/1') !!}">
                            {!! csrf_field() !!}
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">Username</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="username" name="username"  >
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="password" name="password" type="password">
                                </div>
                            </div>
                            <button class="uk-button color-facebook white-text" type="submit">LOGIN</button>
                        </form>
                        @else
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-logout/1') !!}">
                            {!! csrf_field() !!}
                            <button class="uk-button color-facebook white-text" type="submit">LOGOUT</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title color-text-twitter"><i class="fa fa-twitter fa-fw"></i> Twitter Login</h5>
                    </div>
                    <div class="uk-card-body">
                        @if(! isset($socmedAttribute[2]))
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-login/2') !!}">
                            {!! csrf_field() !!}
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">Username</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="username" name="username"  >
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="password" name="password" type="password">
                                </div>
                            </div>
                            <button class="uk-button color-twitter white-text" type="submit">LOGIN</button>
                        </form>
                        @else
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-logout/2') !!}">
                            {!! csrf_field() !!}
                            <button class="uk-button color-twitter white-text" type="submit">LOGOUT</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title color-text-youtube"><i class="fa fa-youtube fa-fw"></i> Youtube Login</h5>
                    </div>
                    <div class="uk-card-body">
                        @if(! isset($socmedAttribute[5]))
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-login/5') !!}">
                            {!! csrf_field() !!}
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">Username</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="username" name="username"  >
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="password" name="password" type="password">
                                </div>
                            </div>
                            <button class="uk-button color-youtube white-text" type="submit">LOGIN</button>
                        </form>
                        @else
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-logout/5') !!}">
                            {!! csrf_field() !!}
                            <button class="uk-button color-youtube white-text" type="submit">LOGOUT</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title color-text-instagram"><i class="fa fa-instagram fa-fw"></i> Instagram Login</h5>
                    </div>
                    <div class="uk-card-body">
                        @if(! isset($socmedAttribute[7]))
                        <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-login/7') !!}">
                            {!! csrf_field() !!}
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username">Username</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="username" name="username"  >
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="password">Password</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="password" name="password" type="password">
                                </div>
                            </div>
                            <button class="uk-button color-instagram white-text" type="submit">LOGIN</button>
                        </form>
                        @else
                            <form class="uk-form-stacked" method="post" action="{!! url('engagement/account-logout/7') !!}">
                                {!! csrf_field() !!}
                                <button class="uk-button color-instagram white-text" type="submit">LOGOUT</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
@endsection