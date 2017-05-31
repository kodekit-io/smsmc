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
            <div id="01">
                <div class="uk-animation-fade uk-card sm-chart-container uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title uk-float-left color-text-facebook uk-text-uppercase"><i class="fa fa-facebook"></i> Facebook</h5>
                        <ul class="uk-float-right uk-subnav uk-margin-remove">
                            <li>
                                <a class="grey-text fa fa-user" title="Switch Account" uk-tooltip></a>
                                <div uk-dropdown="pos: bottom-center">
                                    <ul class="uk-nav uk-navbar-dropdown-nav" uk-switcher="connect: #tlfb">
                                        @foreach($fbAccounts as $fbAccount)
                                            <li><a id="tlfb{{ $fbAccount->engagementId }}">{{ $fbAccount->engagementAuthor }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="grey-text fa fa-info-circle" title="Timeline of Facebook" uk-tooltip></a></li>
                            <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                            <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                        </ul>
                    </div>
                    <ul id="tlfb" class="uk-card-body uk-switcher">
                        @if($fbAccounts)
                            @foreach($fbAccounts as $fbAccount)
                                <li><table id="tablefb{{ $fbAccount->engagementId }}" class="uk-table uk-table-condensed uk-width-1-1 sm-table "></table></li>
                            @endforeach
                        @else
                            <li class="sm-timeline-wrap" style="padding-bottom:25px;">No account found</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div id="02">
                <div class="uk-animation-fade uk-card sm-chart-container uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title uk-float-left color-text-twitter uk-text-uppercase"><i class="fa fa-twitter"></i> Twitter</h5>
                        <ul class="uk-float-right uk-subnav uk-margin-remove">
                            <li>
                                <a class="grey-text fa fa-user" title="Switch Account" uk-tooltip></a>
                                <div uk-dropdown="pos: bottom-center">
                                    <ul class="uk-nav uk-navbar-dropdown-nav" uk-switcher="connect: #tltw">
                                        @if($twAccounts)
                                            @foreach($twAccounts as $twAccount)
                                            <li><a id="tltw{{ $twAccount->engagementId }}">{{ $twAccount->engagementAuthor }}</a></li>
                                            @endforeach
                                        @else
                                            <li>No account found</li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            <li><a class="grey-text fa fa-info-circle" title="Timeline of Twitter" uk-tooltip></a></li>
                            <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                            <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                        </ul>
                    </div>
                    <ul id="tltw" class="uk-card-body uk-switcher">
                        @if($twAccounts)
                            @foreach($twAccounts as $twAccount)
                                <li><table id="tabletw{{ $twAccount->engagementId }}" class="uk-table uk-table-condensed uk-width-1-1 sm-table "></table></li>
                            @endforeach
                        @else
                            <li class="sm-timeline-wrap" style="padding-bottom:25px;">No account found</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div id="03">
                <div class="uk-animation-fade uk-card sm-chart-container uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title uk-float-left color-text-youtube uk-text-uppercase"><i class="fa fa-youtube"></i> Youtube</h5>
                        <ul class="uk-float-right uk-subnav uk-margin-remove">
                            <li>
                                <a class="grey-text fa fa-user" title="Switch Account" uk-tooltip></a>
                                <div uk-dropdown="pos: bottom-center">
                                    <ul class="uk-nav uk-navbar-dropdown-nav" uk-switcher="connect: #tlyt">
                                        @foreach($ytAccounts as $ytAccount)
                                            <li><a id="tlyt{{ $ytAccount->engagementId }}">{{ $ytAccount->engagementAuthor }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="grey-text fa fa-info-circle" title="Timeline of Youtube" uk-tooltip></a></li>
                            <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                            <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                        </ul>
                    </div>
                    <ul id="tlyt" class="uk-card-body uk-switcher">
                        @if($ytAccounts)
                            @foreach($ytAccounts as $ytAccount)
                                <li><table id="tableyt{{ $ytAccount->engagementId }}" class="uk-table uk-table-condensed uk-width-1-1 sm-table "></table></li>
                            @endforeach
                        @else
                            <li class="sm-timeline-wrap" style="padding-bottom:25px;">No account found</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div id="04">
                <div class="uk-animation-fade uk-card sm-chart-container uk-card-hover uk-card-default uk-card-small">
                    <div class="uk-card-header uk-clearfix">
                        <h5 class="uk-card-title uk-float-left color-text-instagram uk-text-uppercase"><i class="fa fa-instagram"></i> Instagram</h5>
                        <ul class="uk-float-right uk-subnav uk-margin-remove">
                            <li>
                                <a class="grey-text fa fa-user" title="Switch Account" uk-tooltip></a>
                                <div uk-dropdown="pos: bottom-center">
                                    <ul class="uk-nav uk-navbar-dropdown-nav" uk-switcher="connect: #ltig">
                                        @foreach($igAccounts as $igAccount)
                                            <li><a id="ltig{{ $igAccount->engagementId }}">{{ $igAccount->engagementAuthor }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="grey-text fa fa-info-circle" title="Timeline of Instagram" uk-tooltip></a></li>
                            <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>
                            <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>
                        </ul>
                    </div>
                    <ul id="ltig" class="uk-card-body uk-switcher">
                        @if($igAccounts)
                            @foreach($igAccounts as $igAccount)
                                <li><table id="tableig{{ $igAccount->engagementId }}" class="uk-table uk-table-condensed uk-width-1-1 sm-table "></table></li>
                            @endforeach
                        @else
                            <li class="sm-timeline-wrap" style="padding-bottom:25px;">No account found</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('page-level-scripts')
    <script src="{!! asset('assets/js/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('assets/js/lib/moment.min.js') !!}"></script>
    <script src="{!! asset('assets/js/pages/timeline.js') !!}"></script>
    <script>
    $(document).ready(function() {
        @foreach($fbAccounts as $fbAccount)
            tline('tablefb{{ $fbAccount->engagementId }}',1,{{ $fbAccount->engagementId }});
        @endforeach
        @foreach($twAccounts as $twAccount)
            tline('tabletw{{ $twAccount->engagementId }}',2,{{ $twAccount->engagementId }});
        @endforeach
        @foreach($ytAccounts as $ytAccount)
            tline('tableyt{{ $ytAccount->engagementId }}',5,{{ $ytAccount->engagementId }});
        @endforeach
        @foreach($igAccounts as $igAccount)
            tline('tableig{{ $igAccount->engagementId }}',7,{{ $igAccount->engagementId }});
        @endforeach
    });
    </script>
@endsection
