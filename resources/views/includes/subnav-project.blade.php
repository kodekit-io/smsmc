<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <h2 class="uk-navbar-item uk-margin-remove uk-text-uppercase sm-text-bold sm-title-sub" title="Project Name" uk-tooltip="pos: bottom">Project Name</h2>
        <ul class="uk-navbar-nav">
            <li>
                <a href="{!! url('/') !!}/project-all"><i class="fa fa-th-large"></i>All Media</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-fb"><i class="fa fa-facebook"></i>Facebook</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-tw"><i class="fa fa-twitter"></i>Twitter</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-news"><i class="fa fa-globe"></i>Online News</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-blog"><i class="fa fa-rss"></i>Blog</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-forum"><i class="fa fa-comments"></i>Forum</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-yt"><i class="fa fa-youtube-play"></i>Video</a>
            </li>
            <li>
                <a href="{!! url('/') !!}/project-ig"><i class="fa fa-instagram"></i>Instagram</a>
            </li>
        </ul>
    </div>
    <div class="uk-navbar-right">

        <a class="uk-navbar-item uk-button grey darken-3 white-text">FILTER <span uk-icon="icon: chevron-down" class="uk-margin-small-left"></span></a>
        <div uk-dropdown="mode: click; offset: 0;" class="uk-width-1-1 dropdown-stack">
            <div class="uk-grid-divider uk-grid-small" uk-grid>
                <div class="uk-width-1-1">
                    <div class="uk-grid-divider uk-grid-small" uk-grid>
                        <div class="uk-width-1-2">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-auto@m sm-text-bold">Keyword:</div>
                                <div class="uk-width-expand@m">
                                    <ul class="sm-list">
                                        <li><label><input class="uk-checkbox" type="checkbox"> Select All</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Keyword</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Keyword</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Keyword</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Keyword</label></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-auto@m sm-text-bold">Topics:</div>
                                <div class="uk-width-expand@m">
                                    <ul class="sm-list">
                                        <li><label><input class="uk-checkbox" type="checkbox"> Select All</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Topic</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Topic</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Topic</label></li>
                                        <li><label><input class="uk-checkbox" type="checkbox"> Topic</label></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <ul uk-grid class="uk-grid-divider uk-grid-small">
                        <li class="uk-width-auto@m">
                            <ul class="sm-list" style="margin-top:5px">
                                <li class="sm-text-bold">Sentiment:</li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Positive</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Neutral</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Negative</label></li>
                            </ul>
                        </li>
                        <li class="uk-width-auto@m">
                            <div class="uk-inline sm-text-bold">Date Range:</div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="uk-input uk-form-small uk-width-small" name="startDate" aria-describedby="option-startDate" placeholder="" data-toggle="datepicker">
                            </div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="uk-input uk-form-small uk-width-small" name="endDate" aria-describedby="option-endDate" placeholder="" data-toggle="datepicker">
                            </div>
                        </li>
                        <li class="uk-width-auto@m">
                            <div class="uk-inline sm-text-bold">Search:</div>
                            <form class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: search"></span>
                                <input class="uk-input uk-form-small uk-width-small" type="text" placeholder="Filter">
                            </form>
                        </li>
                        <li class="uk-width-expand@m">
                            <button class="uk-button uk-button-small white-text red darken-1 sm-text-bold uk-float-right" name="filter" value="1" type="submit">UPDATE</button>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
</nav>