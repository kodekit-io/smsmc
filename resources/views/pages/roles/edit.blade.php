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
                <h5 class="uk-card-title">Edit Role</h5>
            </div>
            <div class="uk-card-body">
                <hr>
                <form class="open-ticket" method="post" action="{!! url('setting/role/' . $id. '/update') !!}">
                    {!! csrf_field() !!}
                    <div class="uk-margin">
                        <label>Name</label>
                        <input class="uk-input" type="text" name="name" value="{!! $role->name !!}">
                    </div>
                    <div class="uk-margin">
                        <label>Permissions</label><br>
                        @foreach($permissions as $permissionId => $permission)
                            <input type="checkbox"
                               name="permissions[{!! $permissionId !!}]"
                               value="1"
                               @if ($role->{$permissionId} == '1') checked @endif /> {!! $permission !!}
                        @endforeach
                    </div>
                    <div class="uk-flex uk-flex-between">
                        <a class="uk-modal-close uk-button grey white-text" href="{!! url('setting/role') !!}">CANCEL</a>
                        <input type="submit" class="uk-modal-close uk-button uk-float-right red white-text" value="SAVE" />
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
