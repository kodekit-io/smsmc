@extends('layouts.login')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/login.css') !!}" />
@endsection
@section('content')

    <section class="sm-login uk-container uk-container-small">
        <div class="uk-card uk-card-hover uk-card-default uk-grid-collapse uk-child-width-1-2@m uk-position-center" uk-grid>

            <div class="uk-card-media-left uk-cover-container">
                <img src="{!! asset('assets/img/login.jpg') !!}" alt="Sinarmas" uk-cover>
                <canvas width="300" height="200"></canvas>
                <h1 class="white-text sm-title-login sm-text-lite uk-text-uppercase">Sinarmas Social Media Center</h1>
            </div>
            <div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title uk-margin-bottom">LOGIN</h3>

                    <form action="{!! url('/') !!}/home">
                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" placeholder="username" name="uname">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" placeholder="password" name="upwd">
                            </div>
                        </div>
                        <button class="uk-button white-text red">LOGIN</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
@endsection