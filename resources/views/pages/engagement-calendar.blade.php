@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/fullcalendar.css') !!}" />
@endsection
@section('page-level-nav')
    @include('includes.subnav-engagement-calendar')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card no-header uk-card-hover uk-card-default uk-card-small uk-width-1-1">
            <div id="01" class="uk-card-body"></div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/fullcalendar.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/calendar.js') !!}"></script>
    <script>
    $(document).ready(function() {
        calendar('01');
    });
    </script>
@endsection