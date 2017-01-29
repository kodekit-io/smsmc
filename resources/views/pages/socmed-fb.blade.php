@extends('layouts.default')
@section('page-level-nav')
    @include('includes.subnav-socmed')
@endsection
@section('content')

    <section class="sm-main uk-container uk-container-expand">
        <div class="uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-3@m uk-child-width-1-4@xl uk-grid" uk-grid>
            <div>Chart Matrix</div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/project-all.js') !!}"></script>
@endsection