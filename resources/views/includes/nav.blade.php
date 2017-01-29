<header uk-sticky>
    <nav class="uk-navbar-container sm-nav-main" uk-navbar>
        <div class="uk-navbar-left">
            <a href="./" class="sm-logo" title="Sinarmas Social Media Center" uk-tooltip="pos: bottom-left">
                <img src="{!! asset('assets/img/logo.png') !!}" alt="Sinarmas" data-rjs="2">
                <div class="sm-logo-round"></div>
            </a>
            <h1 class="sm-title-page">{!! $pageTitle !!}</h1>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="{!! url('/') !!}"><i class="material-icons md-18">work</i> Project</a>
                    <div uk-dropdown="offset: 0" class="uk-overflow-auto uk-height-medium uk-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav" id="projectList">
                            <?php //if (admin) { ?>
                            <li><a href="#">Add New Project</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{!! url('/') !!}/socmed-fb"><i class="material-icons md-18">donut_large</i> Social Media</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php //if (admin) { ?>
                            <li><a href="#">Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="{!! url('/') !!}/socmed-fb">Facebook</a></li>
                            <li><a href="{!! url('/') !!}">Twitter</a></li>
                            <li><a href="{!! url('/') !!}">Youtube</a></li>
                            <li><a href="{!! url('/') !!}">Instagram</a></li>
                        </ul>
                    </div>
                </li>
                <?php //if (usercanpost) { ?>
                <li>
                    <a href="#"><i class="material-icons md-18">mode_comment</i> Engagement</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <?php //if (admin) { ?>
                            <li><a href="#">Manage Accounts</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="#">Ticket</a></li>
                            <li><a href="#">Calendar</a></li>
                            <li><a href="#">Stream</a></li>
                        </ul>
                    </div>
                </li>
                <?php //} ?>
                <?php //if (admin) { ?>
                <li>
                    <a href="#"><i class="material-icons md-18">assignment</i> Report</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="#">View Report</a></li>
                            <li><a href="#">Add New Report</a></li>
                        </ul>
                    </div>
                </li>
                <?php //} ?>
                <li>
                    <a href="#"><i class="material-icons md-18">account_circle</i> UserName</a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="#">My Account</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //if (admin) { ?>
                            <li><a href="#">Manage Account</a></li>
                            <li class="uk-nav-divider"></li>
                            <?php //} ?>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="" class="sm-nav-notif">
                        <span class="fa fa-bell"></span>
                        <span class="uk-badge uk-badge-notification">10</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    @section('page-level-nav')
    @show
</header>