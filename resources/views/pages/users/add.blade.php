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
                <form id="addUser" method="post" action="{!! url('setting/user/store') !!}">
                    {!! csrf_field() !!}
                    <ul class="uk-child-width-1-2 uk-grid-small uk-grid-match uk-margin" uk-grid>
                        <li><div class="uk-position-relative">
                            <label>Username</label>
                            <input class="uk-input" type="text" name="username">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Email</label>
                            <input class="uk-input" type="text" name="email">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Name</label>
                            <input class="uk-input" type="text" name="name">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Pillar</label>
                            <select name="id_business" class="uk-select" id="pilar_selector">
                                @foreach($pilars as $pilar)
                                    <option value="{!! $pilar->id !!}">{!! $pilar->pilarName !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>User Group</label>
                            <select name="group" class="uk-select" id="group_selector">
                                <option value="" class="">---</option>
                                @foreach($groups as $group)
                                    <option value="{!! $group->id !!}" class="{{ $group->parentId }}">{!! $group->groupName !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Role</label>
                            <select name="role" class="uk-select">
                                @foreach($roles as $role)
                                <option value="{!! $role->idRole !!}">{!! $role->name !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Password</label>
                            <input class="uk-input" type="password" name="password" id="password">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Re-type your password</label>
                            <input class="uk-input" type="password" name="password2" id="password2">
                        </div></li>
                    </ul>
                    <div class="uk-flex uk-flex-between">
                        <a class="uk-modal-close uk-button grey white-text" href="{!! url('setting/user') !!}">CANCEL</a>
                        <input type="submit" class="uk-modal-close uk-button uk-float-right red white-text" value="SAVE" />
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.chained.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/jquery.validate.min.js') !!}"></script>
    {{--<script src="{!! asset('assets/js/pages/ticket-create.js') !!}"></script>--}}

    <script>
    $(document).ready(function() {
        $('#addUser').validate({
            rules: {
                username: {
                    required: true
                },
                email: {
                    required: true
                },
                name: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password2: {
                    required: true,
                    minlength: 6,
                    equalTo: '#password'
                },
                id_business: {
                    required: true
                },
                role: {
                    required: true
                }
            }
        });

        $("#group_selector").chained("#pilar_selector");
    });

    </script>
@endsection
