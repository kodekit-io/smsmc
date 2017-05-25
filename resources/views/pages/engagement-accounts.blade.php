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
                        <a href="javascript:popup('https://www.facebook.com/v2.8/dialog/oauth?app_id=219214895250942&redirect_uri=http%3A%2F%2Ftestdevel.com&version=v2.8',720,720)" class="uk-button uk-button-primary uk-button-small color-facebook" title="Add Facebook User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(! isset($socmedAttribute[1]))
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @else

                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/1') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/1') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-twitter uk-margin-remove uk-text-uppercase"><i class="fa fa-twitter-square"></i> Twitter Account</h5>
                        <a href="javascript:popup('//103.16.199.58/sinarmas-plus/twitter/login',720,720)" class="uk-button uk-button-primary uk-button-small color-twitter" title="Add Twitter User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(! isset($socmedAttribute[2]))
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @else

                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/2') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/2') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/2') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-youtube uk-margin-remove uk-text-uppercase"><i class="fa fa-youtube-square"></i> Youtube Account</h5>
                        <a href="javascript:popup('https://accounts.google.com/signin/oauth/oauthchooseaccount?client_id=831371170934-udapit5jhjj56pft5l2drc9gjhfeclf3.apps.googleusercontent.com&as=-60df4ad5507eb7d2&destination=https%3A%2F%2Fgoogle-developers.appspot.com&approval_state=!ChRSdlhqbmc4b2U4YzF2bUp2RnJPaRIfNDBuOExDLUVXODBZVU9xWmlfQjdtUi1FRGFYYnd4VQ∙ADiIGyEAAAAAWSemDydrX2xdfRaf9R4LYwWd1EGmflpi&xsrfsig=AHgIfE9lacw16is5JLPbLdr0n7AlsXPUgw&flowName=GeneralOAuthFlow',600,600)" class="uk-button uk-button-primary uk-button-small color-youtube" title="Add Youtube User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(! isset($socmedAttribute[5]))
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @else

                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/3') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            <div>
                <div class="uk-animation-fade uk-card uk-card-default uk-card-body uk-card-small uk-position-relative">
                    <div class="uk-flex uk-flex-middle uk-flex-between uk-margin"><h5 class="color-text-instagram uk-margin-remove uk-text-uppercase"><i class="fa fa-instagram"></i> Instagram Account</h5>
                        <a href="javascript:popup('https://www.instagram.com/accounts/login/',600,600)" class="uk-button uk-button-primary uk-button-small color-instagram" title="Add Instagram User" uk-tooltip><i class="fa fa-user-plus"></i> Add User</a>
                    </div>
                    @if(! isset($socmedAttribute[7]))
                        <div class="uk-height-small">
                            <div class="uk-position-center">No user data found!</div>
                        </div>
                    @else

                        <ul class="uk-grid-small uk-grid-match uk-child-width-1-3" uk-grid>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/4') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form class="uk-panel uk-padding-small uk-background-muted uk-text-center" method="post" action="{!! url('engagement/account-logout/4') !!}">
                                    {!! csrf_field() !!}
                                    <img class="uk-border-circle" src="{!! asset('images/default-avatar.png') !!}" width="100" height="100" alt="Username">
                                    <p class="sm-text-bold">Username</p>
                                    <button class="uk-button uk-button-default uk-button-small" type="submit">
                                        <i class="fa fa-close"></i> LOGOUT
                                    </button>
                                </form>
                            </li>
                        </ul>
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
