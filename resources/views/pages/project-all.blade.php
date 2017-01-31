@extends('layouts.default')
@section('page-level-nav')
    @include('includes.subnav-project')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div id="projectAll" class="uk-grid-medium" uk-grid uk-sortable="handle: .uk-card-header"></div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/project-all.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/401-brandEquity.js') !!}"></script>
    <script src="{!! asset('assets/js/charts/113-sentiment.js') !!}"></script>
@endsection