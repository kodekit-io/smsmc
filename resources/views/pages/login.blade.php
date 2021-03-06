@extends('layouts.login')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/login.css') !!}" />
@endsection
@section('content')
    <section class="sm-login ">
        <div class="uk-position-center">
            <div class="uk-card uk-card-hover uk-card-default uk-grid-collapse uk-child-width-1-2@m" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="{!! asset('assets/img/login.jpg') !!}" alt="Sinar Mas" uk-cover>
                    <canvas width="400" height="340"></canvas>
                    <h1 class="white-text sm-title-login sm-text-lite uk-text-uppercase">Sinar Mas Social Media Center</h1>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title uk-margin-bottom">SINAR MAS LOGIN</h3>
                        <form action="{!! url('login') !!}" method="post" id="login">
                            {!! csrf_field() !!}
                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                                    <input class="uk-input" type="text" placeholder="username" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <input class="uk-input" type="password" placeholder="password" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="uk-flex uk-flex-middle uk-flex-between uk-width-1-1">
                                <label>
                                    <input class="uk-checkbox" type="checkbox" id="remember">
                                    <span class="uk-text-small grey-text">Remember me</span>
                                </label>
                                <button class="uk-button white-text red" type="submit">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/login.js') !!}"></script>
@endsection
