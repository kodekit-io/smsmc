@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-ticket')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-grid-medium uk-child-width-1-1@m" uk-grid>
            <div id="01">
                <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title uk-float-left">Ticket List</h5>
                        <a href="{!! url('ticket/add') !!}" title="Create New Ticket" class="uk-button red white-text uk-float-right">Create New Ticket</a>
                    </div>
                    <div class="uk-card-body">
                        <table id="ticketList" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/jszip.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/extensions/buttons.html5.min.js') !!}"></script>
    {{-- <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script> --}}
    <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script>

    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/ticket-list.js') !!}"></script>

    <script>
    $(document).ready(function() {
        ticketList('ticketList');
    });

    </script>
@endsection
