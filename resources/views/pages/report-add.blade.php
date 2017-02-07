@extends('layouts.default')
@section('page-level-styles')
    <link rel="stylesheet" href="{!! asset('assets/css/dataTables.smsmc.css') !!}" />
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small">
            <div class="uk-card-body">
                <div class="uk-grid-medium uk-child-width-1-1@m" uk-grid>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script>
    $(document).ready(function() {
        reportView('01');
    });
    </script>
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/extension/wordcloud.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/datatables/dataTables.smsmc.js') !!}"></script>

    <script src="{!! asset('assets/js/pages/report-add.js') !!}"></script>
@endsection