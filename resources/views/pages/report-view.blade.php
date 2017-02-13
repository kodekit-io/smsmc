@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-grid-medium uk-child-width-1-1@m" uk-grid>
            <div id="01"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script>
    $(document).ready(function() {
        reportView('01');
    });
    </script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>

    <script src="{!! asset('assets/js/pages/report-view.js') !!}"></script>
@endsection