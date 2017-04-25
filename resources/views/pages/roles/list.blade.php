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
                <h5 class="uk-card-title uk-float-left">Manage Roles</h5>
                {{--<a href="{!! url('setting/group/add') !!}" title="Add Role" class="uk-button red white-text uk-float-right">Add Group</a>--}}
            </div>
            <div class="uk-card-body">
                @if (count($errors) > 0)
                    <div class="uk-alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table id="roles" class="uk-table uk-table-striped"></table>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/roles.js') !!}"></script>
@endsection
