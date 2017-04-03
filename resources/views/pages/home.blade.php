@extends('layouts.default')

@section('page-level-styles')
@endsection

@section('page-level-nav')
    @include('includes.subnav-home')
@endsection

@section('content')
    <section class="sm-main uk-container uk-container-expand">
        <div id="projectGrid" class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-3@m uk-child-width-1-4@xl" uk-grid>
            @foreach($projects as $project)
            <div id="{!! $project->pid !!}">
                <div class="uk-card uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header">
                        <h5 class="uk-card-title uk-text-truncate">{!! $project->pname !!}</h5>
                        </div>
                    <div class="uk-card-body">
                        <div uk-grid class="uk-grid-collapse">
                            <div class="uk-width-1-1">
                                <div id="chartCover{!! $project->pid !!}" class="sm-chartcover"></div>
                                </div>
                            <div class="uk-width-2-5">Date Create</div>
                            <div class="uk-width-3-5">: {!! $project->pdate !!}</div>
                            <div class="uk-width-2-5">Project Group</div>
                            <div class="uk-width-3-5">: {!! $project->pgroup !!}</div>
                            </div>
                        </div>
                    <div class="uk-card-footer uk-clearfix">
                        <div class="uk-inline">
                            <a class="grey-text" uk-icon="icon: more-vertical"></a>
                            <div class="sm-card-action" uk-drop="pos: right-center">
                                <a class="sm-edit-project uk-icon-button green white-text" uk-icon="icon: pencil" title="Edit Project" uk-tooltip data-id="{!! $project->pid !!}" data-name="{!! $project->pname !!}"></a>
                                <a class="sm-delete-project uk-icon-button red white-text" uk-icon="icon: trash" title="Delete Project" uk-tooltip data-id="{!! $project->pid !!}" data-name="{!! $project->pname !!}"></a>
                            </div>
                        </div>
                        <a href="{!! url('project/all/' . $project->pid) !!}" class="uk-button uk-button-text uk-float-right red-text" title="Project {!! $project->pname !!}" uk-tooltip>View Project</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div class="uk-alert-danger sm-alert uk-animation-slide-top-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Alert notification sample! will automatically hidden after 10 sec</p>
    </div>
@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/home_new.js') !!}"></script>
{{--    <script src="{!! asset('assets/js/pages/home.js') !!}"></script>--}}
    <script>
        $(document).ready(function() {
            @foreach($projects as $project)
            chartCover('{!! $project->pid !!}');
            @endforeach
            $('#select-group').checkAll(
                { container: $('ul'), showIndeterminate: true }
            );
        });
    </script>
@endsection