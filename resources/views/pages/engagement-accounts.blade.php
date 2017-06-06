@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m " uk-grid>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-facebook uk-margin-remove uk-text-uppercase"><i class="fa fa-facebook-square"></i> Facebook Account</h5>
                        <a href="javascript:popup('http://document.mediawave.co.id/sinarmas-plus/facebook/login',720,720)" class="uk-button uk-button-primary uk-button-small color-facebook" title="Add Facebook User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(count($fbAccounts) > 0)
                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            @foreach($fbAccounts as $fbAccount)
                                <li>
                                    <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/1') !!}">
                                        {!! csrf_field() !!}
                                        <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                        <p class="sm-text-bold">{{ $fbAccount->engagementAuthor }}</p>
                                        {{-- <button class="uk-button uk-button-default uk-button-small" type="submit">
                                            <i class="fa fa-close"></i> LOGOUT
                                        </button> --}}
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-twitter uk-margin-remove uk-text-uppercase"><i class="fa fa-twitter-square"></i> Twitter Account</h5>
                        <a href="javascript:popup('http://document.mediawave.co.id/sinarmas-plus/twitter/login?uid={{ Auth::user()->id }}
',720,720)" class="uk-button uk-button-primary uk-button-small color-twitter" title="Add Twitter User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(count($twAccounts) > 0)
                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            @foreach($twAccounts as $twAccount)
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/2') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">{{ $twAccount->engagementAuthor }}</p>
                                    {{-- <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button> --}}
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-youtube uk-margin-remove uk-text-uppercase"><i class="fa fa-youtube-square"></i> Youtube Account</h5>
                        <a href="javascript:popup('http://document.mediawave.co.id/sinarmas-plus/sinarmas-plus/youtube/login',720,720)" class="uk-button uk-button-primary uk-button-small color-youtube" title="Add Youtube User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(count($ytAccounts) > 0)
                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            @foreach($ytAccounts as $ytAccount)
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/3') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">{{ $ytAccount->engagementAuthor }}</p>
                                    {{-- <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button> --}}
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-instagram uk-margin-remove uk-text-uppercase"><i class="fa fa-instagram"></i> Instagram Account</h5>
                        <a href="javascript:popup('http://document.mediawave.co.id/sinarmas-plus/instagram/login',720,720)" class="uk-button uk-button-primary uk-button-small color-instagram" title="Add Instagram User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(count($igAccounts) > 0)
                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            @foreach($igAccounts as $igAccount)
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/4') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">{{ $igAccount->engagementAuthor }}</p>
                                    {{-- <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button> --}}
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @endif
                </div>
            </div>

            {{--
            <div>
                <div class="uk-animation-fade uk-card uk-placeholder uk-card-small uk-position-relative">
                    <div class="uk-card-header">
                        <h5 class="uk-card-title color-text-facebook"><i class="fa fa-facebook fa-fw"></i> Facebook Account</h5>
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
                <div class="uk-animation-fade uk-card uk-placeholder uk-card-small uk-position-relative">
                    <div class="uk-card-header">
                        <h5 class="uk-card-title color-text-twitter"><i class="fa fa-twitter fa-fw"></i> Twitter Account</h5>
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
                <div class="uk-animation-fade uk-card uk-placeholder uk-card-small uk-position-relative">
                    <div class="uk-card-header">
                        <h5 class="uk-card-title color-text-youtube"><i class="fa fa-youtube fa-fw"></i> Youtube Account</h5>
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
                <div class="uk-animation-fade uk-card uk-placeholder uk-card-small uk-position-relative">
                    <div class="uk-card-header">
                        <h5 class="uk-card-title color-text-instagram"><i class="fa fa-instagram fa-fw"></i> Instagram Account</h5>
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
            --}}
        </div>
    </section>

@endsection

@section('page-level-scripts')
@endsection
