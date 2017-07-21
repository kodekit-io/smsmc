@extends('layouts.default')

@section('page-level-styles')
@endsection

@section('page-level-nav')
    @include('includes.subnav-home')
@endsection

@section('content')

    <section class="sm-main sm-dashboard uk-container uk-container-expand uk-position-relative">
        <div id="projectGrid" class="uk-grid-medium uk-grid-match uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-4@m" uk-grid>
            @if (count($projects) > 0)
                @foreach($projects as $project)
                <div id="{!! $project->pid !!}">
                    <div class="uk-card uk-card-hover uk-card-default uk-card-small">
                        <div class="uk-card-media-top uk-position-relative uk-background-cover sm-cover" style="background-image:url(
                            @if(($project->pmage == 'null') || ($project->pmage == ''))
                                {!! asset('images/default.jpg') !!}
                            @else
                                {!! $project->pmage !!}
                            @endif
                            )">
                            <div class="sm-cover-overlay"></div>
                            <h4 class="white-text sm-title-cover">{!! $project->pname !!}</h4>
                        </div>
                        <div class="uk-card-body">
                            <div uk-grid class="uk-grid-collapse uk-text-small">
                                <div class="uk-width-2-5">Date Create</div>
                                <div class="uk-width-3-5 sm-text-bold"><span class="pdate"></span></div>
                                <div class="uk-width-2-5">Project Group</div>
                                <div class="uk-width-3-5 sm-text-bold">{!! $project->pgroup !!}</div>
                            </div>
                        </div>
                        <div class="uk-card-footer uk-flex uk-flex-middle uk-flex-between">
                            @if (is_authorized_to('projectEdit') || is_authorized_to('projectDelete'))
                            <div class="uk-inline">
                                <a class="grey-text" uk-icon="icon: more-vertical"></a>
                                <div class="sm-card-action" uk-drop="mode: click; pos: right-center;">
                                    <a class="sm-edit-project uk-icon-button green white-text" uk-icon="icon: pencil" title="Edit Project" uk-tooltip data-id="{!! $project->pid !!}" data-name="{!! $project->pname !!}"></a>
                                    <a class="sm-delete-project uk-icon-button red white-text" uk-icon="icon: trash" title="Delete Project" uk-tooltip data-id="{!! $project->pid !!}" data-name="{!! $project->pname !!}"></a>
                                </div>
                            </div>
                            @endif
                            <a href="{!! url('project/all/' . $project->pid) !!}" class="uk-button uk-button-text red-text" title="Project {!! $project->pname !!}" uk-tooltip>View Project</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @if (is_authorized_to('projectCreate'))
                    <div class="uk-position-center uk-text-center uk-card uk-card-default uk-card-body uk-width-auto@m">
                        <a href="{{ url('/project/add') }}" class="red-text"><i class="fa fa-plus fa-3x"></i><br>Create Your First Project</a>
                    </div>
                @else
                    <div class="uk-position-center uk-text-center uk-card uk-card-default uk-card-body uk-width-auto@m">
                        You don't have any project yet.<br>
                        Please contact your administrator.
                    </div>
                @endif
            @endif
        </div>
        @if (count($projects) > 0)
        <div class="uk-position-bottom-center">{{ $projects->links() }}</div>
        @endif


    </section>

    {{-- <div class="uk-alert-danger sm-alert uk-animation-slide-top-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Alert notification sample! will automatically hidden after 10 sec</p>
    </div> --}}
@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/echarts/echarts.js') !!}"></script>
    <script src="{!! asset('assets/js/echarts/echarts.theme.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/home.js') !!}"></script>
    <script>
        $(document).ready(function() {
            @foreach($projects as $project)
                var pid = '{!! $project->pid !!}';
                var pdate = moment.parseZone('{!! $project->pdate !!}').format('lll');
                // imgCover(pid);
                $('#'+pid).find('.pdate').text(pdate);
            @endforeach
        });
    </script>
@endsection
