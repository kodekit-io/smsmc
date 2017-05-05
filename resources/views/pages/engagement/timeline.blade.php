@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.timeline.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-grid-small uk-child-width-1-4@m" uk-grid>
            <div id="01"></div>
            <div id="02"></div>
            <div id="03"></div>
            <div id="04"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>

    <script src="{!! asset('assets/js/pages/timeline.js') !!}"></script>
    <script>
    $(document).ready(function() {
        timeline('01',1);
        timeline('02',2);
        timeline('03',5);
        timeline('04',7);
    });
    </script>
@endsection
