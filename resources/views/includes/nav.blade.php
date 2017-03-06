<header id="header" uk-sticky>
    <nav class="uk-navbar-container sm-nav-main" uk-navbar>
        <div class="uk-navbar-left">
            <a href="{!! url('/home') !!}" class="sm-logo" title="Sinarmas Social Media Center" uk-tooltip="pos: bottom-left">
                <img src="{!! asset('assets/img/logo.png') !!}" alt="Sinarmas">
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
                            <?php //if (admin) { ?>
                            <li><a href="{!! url('/project-add') !!}"><i class="fa fa-plus fa-fw"></i> Add New Project</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{!! url('/socmed-fb') !!}"><i class="material-icons md-18">donut_large</i> Social Media</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php //if (admin) { ?>
                            <li><a href="{!! url('/socmed-accounts') !!}"><i class="fa fa-user-plus fa-fw"></i> Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="{!! url('/socmed-fb') !!}"><i class="fa fa-facebook fa-fw"></i> Facebook</a></li>
                            <li><a href="{!! url('/socmed-tw') !!}"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
                            <li><a href="{!! url('/socmed-yt') !!}"><i class="fa fa-youtube-play fa-fw"></i> Youtube</a></li>
                            <li><a href="{!! url('/socmed-ig') !!}"><i class="fa fa-instagram fa-fw"></i> Instagram</a></li>
                        </ul>
                    </div>
                </li>
                <?php //if (usercanpost) { ?>
                <li>
                    <a href="{!! url('/engagement-ticket') !!}"><i class="material-icons md-18">mode_comment</i> Engagement</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php //if (admin) { ?>
                            <li><a href="{!! url('/engagement-accounts') !!}"><i class="fa fa-cog fa-fw"></i> Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="{!! url('/engagement-ticket') !!}"><i class="fa fa-ticket fa-fw"></i> Ticket</a></li>
                            <li><a href="{!! url('/engagement-calendar') !!}"><i class="fa fa-calendar fa-fw"></i> Calendar</a></li>
                            <li><a href="{!! url('/engagement-timeline') !!}"><i class="fa fa-hashtag fa-fw"></i> Timeline</a></li>
                        </ul>
                    </div>
                </li>
                <?php //} ?>
                <?php //if (admin) { ?>
                <li>
                    <a href="{!! url('/report-view') !!}"><i class="material-icons md-18">assignment</i> Report</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="{!! url('/report-view') !!}"><i class="fa fa-download fa-fw"></i> View Report</a></li>
                            <li><a href="{!! url('/report-add') !!}"><i class="fa fa-pencil fa-fw"></i> Add New Report</a></li>
                        </ul>
                    </div>
                </li>
                <?php //} ?>
                <li>
                    <a href="{!! url('/account') !!}"><i class="material-icons md-18">account_circle</i> Profile</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="{!! url('/account') !!}"><i class="fa fa-user fa-fw"></i> My Account</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //if (admin) { ?>
                            <li><a href="{!! url('/admin') !!}" title="Only show to Admin" uk-tooltip><i class="fa fa-cogs fa-fw"></i> Setting</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="{!! url('/logout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{!! url('/page-help') !!}" class="sm-nav-round" title="Help" uk-tooltip="pos:left">
                        <span class="fa fa-life-ring"></span>
                    </a>
                </li>
                <li>
                    <a class="sm-nav-round uk-margin-right" title="Notifications" uk-tooltip="pos:left">
                        <span class="fa fa-bell"></span>
                        <span class="uk-badge uk-badge-notification">10</span>
                    </a>
                    <div uk-drop="offset: 0" class="sm-drop-notif">
                        <div class="uk-card uk-card-small uk-card-default">
                            <div class="uk-card-header red white-text uk-clearfix uk-text-bold">
                                <div class="uk-inline">Notifications</div>
                                <div class="uk-float-right ">10 New</div>
                            </div>
                            <div class="uk-card-body">
                                <ul class="uk-list uk-text-small">
                                    <li class="uk-grid-small" uk-grid>
                                        <div class="uk-width-auto@s">
                                            <span class="fa fa-lg fa-exclamation-circle red-text"></span>
                                        </div>
                                        <div class="uk-width-expand@s">
                                            <span class="uk-article-meta">
                                                Sun, Jan 1, 2017 8:23 AM
                                            </span><br>
                                            <a href="">
                                                You have just received a new ticket!
                                                <span class="fa fa-fw fa-arrow-right" title="See details" uk-tooltip></span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="uk-card-footer uk-text-center">
                                <a href="{!! url('/notifications') !!}" class="sm-text-bold grey-text" title="All Notifications" uk-tooltip>See All</a>
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