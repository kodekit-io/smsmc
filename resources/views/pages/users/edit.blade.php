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
                <h5 class="uk-card-title">Edit Account</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form id="editUser" method="post" action="{!! url('setting/user/' . $id. '/update') !!}">
                    {!! csrf_field() !!}
                    <ul class="uk-child-width-1-2 uk-grid-small uk-grid-match uk-margin" uk-grid>
                        <li><div class="uk-position-relative">
                            <label>Email</label>
                            <input class="uk-input" type="text" name="email" value="{!! $user->email !!}">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Name</label>
                            <input class="uk-input" type="text" name="name" value="{!! $user->name !!}">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Pilar</label>
                            <select name="id_business" class="uk-select">
                                @foreach($pilars as $pilar)
                                    <option value="{!! $pilar->id !!}" @if($user->idBussiness == $pilar->id) selected @endif>{!! $pilar->pilarName !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>User Group</label>
                            <select name="group" class="uk-select">
                                @foreach($groups as $group)
                                    <option value="{!! $group->id !!}" @if($user->idGroup == $group->id) selected @endif>{!! $group->groupName !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Role</label>
                            <select name="role" class="uk-select">
                                @foreach($roles as $role)
                                    <option value="{!! $role->idRole !!}" @if($user->idRole == $role->idRole) selected @endif>{!! $role->name !!}</option>
                                @endforeach
                            </select>
                        </div></li>
                        <li></li>
                        <li><div class="uk-position-relative">
                            <label>Password</label>
                            <input class="uk-input" type="password" name="password">
                        </div></li>
                        <li><div class="uk-position-relative">
                            <label>Re-type your password</label>
                            <input class="uk-input" type="password" name="password2">
                        </div></li>
                    </ul>
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
            $('#editUser').validate({
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
                    id_business: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    group: {
                        required: true
                    }
                }
            });
        });

    </script>
@endsection
