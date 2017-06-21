<header id="header" uk-sticky>
    <nav class="uk-navbar-container sm-nav-main" uk-navbar>
        <div class="uk-navbar-left">
            <a href="{!! url('/home') !!}" class="sm-logo" title="Sinar Mas Social Media Center" uk-tooltip="pos: bottom-left">
                <img src="{!! asset('assets/img/logo.svg') !!}" alt="Sinar Mas">
                <div class="sm-logo-round"></div>
            </a>
            <h1 class="sm-title-page">{!! $pageTitle !!}</h1>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
                <li>
                    <a href="{!! url('/home') !!}"><i class="material-icons md-18">work</i> Project</a>
                    <div uk-dropdown="offset: 0" class="uk-overflow-auto uk-height-medium uk-max-height-medium uk-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav" id="projectList">
                            @if (is_authorized_to('projectCreate'))
                            <li><a href="{!! url('project/add') !!}"><i class="fa fa-plus fa-fw"></i> Add New Project</a></li>
                            <li class="uk-nav-divider"></li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li>
                    <a><i class="material-icons md-18">donut_large</i> Social Media</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            @if (is_authorized_to('projectCreate'))
                            <li><a href="{!! url('/socmed-accounts') !!}"><i class="fa fa-user-plus fa-fw"></i> Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            @endif
                            @if(isset($g_accounts->facebook) && count($g_accounts->facebook) > 0)
                            <li><a href="{!! url('socmed/facebook') !!}"><i class="fa fa-facebook fa-fw"></i> Facebook</a></li>
                            @endif
                            @if(isset($g_accounts->twitter) && count($g_accounts->twitter) > 0)
                            <li><a href="{!! url('socmed/twitter') !!}"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
                            @endif
                            @if(isset($g_accounts->youtube) && count($g_accounts->youtube) > 0)
                            <li><a href="{!! url('socmed/youtube') !!}"><i class="fa fa-youtube-play fa-fw"></i> Youtube</a></li>
                            @endif
                            @if(isset($g_accounts->instagram) && count($g_accounts->instagram) > 0)
                            <li><a href="{!! url('socmed/instagram') !!}"><i class="fa fa-instagram fa-fw"></i> Instagram</a></li>
                            @endif
                            @if(
                            (isset($g_accounts->instagram) && count($g_accounts->instagram) == 0) &&
                            (isset($g_accounts->facebook) && count($g_accounts->facebook) == 0) &&
                            (isset($g_accounts->twitter) && count($g_accounts->twitter) == 0) &&
                            (isset($g_accounts->youtube) && count($g_accounts->youtube) == 0))
                            <li class="uk-text-center">No account found.<br>Please contact<br>your administrator.</li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if (is_authorized_to('engagementRead'))
                <li>
                    <a href="{!! url('/engagement/list') !!}"><i class="material-icons md-18">mode_comment</i> Engagement</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            @if (is_authorized_to('engagementCreate'))
                            <li><a href="{!! url('/engagement-accounts') !!}"><i class="fa fa-cog fa-fw"></i> Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            @endif
                            <li><a href="{!! url('/engagement/list') !!}"><i class="fa fa-file fa-fw"></i> All Engagement</a></li>
                            <li><a href="{!! url('/engagement/calendar') !!}"><i class="fa fa-calendar fa-fw"></i> Calendar</a></li>
                            <li><a href="{!! url('/engagement/timeline') !!}"><i class="fa fa-hashtag fa-fw"></i> Timeline</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (is_authorized_to('projectCreate'))
                <li>
                    <a href="{!! url('report') !!}"><i class="material-icons md-18">assignment</i> Report</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="{!! url('report') !!}"><i class="fa fa-download fa-fw"></i> Download Excel Report</a></li>
                            <li><a href="{!! url('report/add') !!}"><i class="fa fa-file-excel-o fa-fw"></i> Create Excel Report</a></li>
                            <li><a href="{!! url('report/pdf') !!}"><i class="fa fa-file-pdf-o fa-fw"></i> Create PDF Report</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                <li>
                    <a href="{!! url('setting/account') !!}" class="sm-nav-round" title="Account" uk-tooltip="pos:left">
                        <span class="fa fa-user"></span>
                    </a>
                    {{-- <a href="{!! url('setting/account') !!}"><i class="material-icons md-18">account_circle</i> Profile</a> --}}
                    <div uk-dropdown="pos:bottom-center">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><span>Hi, Name {{-- {!! $user->name !!} --}}!</span></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="{!! url('setting/account') !!}"><i class="fa fa-user fa-fw"></i> My Account</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="{!! url('ticket') !!}"><i class="fa fa-ticket fa-fw"></i> My Ticket</a></li>
                            <li class="uk-nav-divider"></li>
                            @if (is_authorized_to('userRead') || is_authorized_to('groupRead') || is_authorized_to('roleRead'))
                            <li><a href="{!! url('setting/user') !!}" title="Setting" uk-tooltip><i class="fa fa-cogs fa-fw"></i> Setting</a></li>
                            <li class="uk-nav-divider"></li>
                            @endif
                            <li><a href="{!! url('/logout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{!! url('/page-media') !!}" class="sm-nav-round" title="List of Media" uk-tooltip="pos:left">
                        <span class="fa fa-newspaper-o"></span>
                    </a>
                </li>
                <li>
                    <a href="{!! url('/page-help') !!}" class="sm-nav-round" title="Glossary" uk-tooltip="pos:left">
                        <span class="fa fa-life-ring"></span>
                    </a>
                </li>
                <li>
                    <a class="sm-nav-round uk-margin-right notification-badge" title="Notifications" uk-tooltip="pos:left">
                        <span class="fa fa-bell"></span>

                    </a>
                    <div uk-drop="offset: 0" class="sm-drop-notif">
                        <div class="uk-card uk-card-small uk-card-default">
                            <div class="uk-card-header red white-text uk-clearfix uk-text-bold">
                                <div class="uk-inline">Notifications</div>
                                <div class="uk-float-right notification-number"></div>
                            </div>
                            <div class="uk-card-body">
                                <ul class="uk-list uk-text-small notification-list">

                                </ul>
                            </div>
                            <div class="uk-card-footer uk-text-center">
                                <a href="{!! url('/notifications') !!}" class="uk-button uk-button-small uk-button-danger" title="All Notifications" uk-tooltip>See All</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    @section('page-level-nav')
    @show
</header>
