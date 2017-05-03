@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/lib/dataTables.timeline.css') !!}" />
    <link href="//vjs.zencdn.net/5.11/video-js.min.css" rel="stylesheet">
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
    <script src="//vjs.zencdn.net/5.11/video.min.js"></script>
    <script src="{!! asset('assets/js/lib/youtube.min.js') !!}"></script>

    <script src="{!! asset('assets/js/pages/timeline.js') !!}"></script>
    <script>
    $(document).ready(function() {
        timeline('01','facebook');
        timeline('02','twitter');
        timeline('03','youtube');
        timeline('04','instagram');
    });
    </script>
@endsection
