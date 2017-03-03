@extends('layouts.default')

@section('page-level-styles')
@endsection

@section('page-level-nav')
    @include('includes.subnav-home')
@endsection

@section('content')
    <section class="sm-main uk-container uk-container-expand">
        <div id="projectGrid" class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-3@m uk-child-width-1-4@xl" uk-grid></div>
    </section>

    <div class="uk-alert-danger sm-alert uk-animation-slide-top-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Alert notification sample! will automatically hidden after 10 sec</p>
    </div>
@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/home.js') !!}"></script>
    <script>
        $(document).ready(function() {
            $('#select-group').checkAll(
                { container: $('ul'), showIndeterminate: true }
            );
        });
    </script>
@endsection