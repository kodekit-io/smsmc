@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
    {{-- @include('includes.subnav-engagement-ticket') --}}
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card-default uk-card-small uk-card-body uk-margin">
            <div class="uk-flex uk-flex-middle uk-flex-between">
                <h3 class="uk-margin-remove uk-width-auto">My Ticket</h3>
                <a href="{!! url('ticket/add') !!}" class="uk-button uk-button-primary uk-button-small uk-width-auto black">
                    <i class="fa fa-ticket"></i> Create New Ticket
                </a>
            </div>
            <hr>
            <table id="ticketList" class="uk-table uk-table-small uk-table-striped uk-width-1-1 sm-table"></table>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>
    {{-- <script src="{!! asset('assets/js/datatables/extensions/dataTables.buttons.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/jszip.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/buttons.html5.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/pdfmake.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('assets/js/datatables/extensions/vfs_fonts.js') !!}"></script> --}}

    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/ticket-list.js') !!}"></script>

    <script>
    $(document).ready(function() {
        ticketList('ticketList');
    });

    </script>
@endsection
