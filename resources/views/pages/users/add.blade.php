@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-admin')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header">
                <h5 class="uk-card-title">Create New Account</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form class="open-ticket" method="post" action="{!! url('setting/user/store') !!}">
                    {!! csrf_field() !!}
                    <div class="uk-margin">
                        <label>Username</label>
                        <input class="uk-input" type="text" name="username">
                    </div>
                    <div class="uk-margin">
                        <label>Email</label>
                        <input class="uk-input" type="text" name="email">
                    </div>
                    <div class="uk-margin">
                        <label>Name</label>
                        <input class="uk-input" type="text" name="name">
                    </div>
                    <div class="uk-margin">
                        <label>Password</label>
                        <input class="uk-input" type="password" name="password">
                    </div>
                    <div class="uk-margin">
                        <label>Re-type your password</label>
                        <input class="uk-input" type="password" name="password2">
                    </div>
                    <div class="uk-margin">
                        <label>Role</label>
                        <select name="role" class="uk-select">
                            @foreach($roles as $role)
                            <option value="{!! $role->idRole !!}">{!! $role->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-flex uk-flex-between">
                        <a class="uk-modal-close uk-button grey white-text" href="{!! url('setting/user') !!}">CANCEL</a>
                        <input type="submit" class="uk-modal-close uk-button uk-float-right red white-text" value="SEND" />
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    {{--<script src="{!! asset('assets/js/pages/ticket-create.js') !!}"></script>--}}

    <script>
    $(document).ready(function() {

    });

    </script>
@endsection
