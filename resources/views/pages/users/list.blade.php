@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-admin')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card no-header uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-header uk-clearfix">
                <h5 class="uk-card-title uk-float-left">Manage Accounts</h5>
                @if (is_authorized_to('userCreate'))
                    <a href="{!! url('setting/user/add') !!}" title="Add User" class="uk-button red white-text uk-float-right">Add User</a>
                @endif
            </div>
            <div class="uk-card-body">
                <table id="users" class="uk-table uk-table-striped"></table>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script>
        var $canEdit = '{!! is_authorized_to('userUpdate') !!}';
        var $canDelete = '{!! is_authorized_to('userDelete') !!}';
    </script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/users.js') !!}"></script>
@endsection
