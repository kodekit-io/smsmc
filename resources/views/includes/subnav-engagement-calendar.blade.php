<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li><a href="{!! url('/') !!}/engagement-ticket"><i class="fa fa-ticket fa-fw"></i> Ticket</a></li>
            <li><a href="{!! url('/') !!}/engagement-calendar"><i class="fa fa-calendar fa-fw"></i> Calendar</a></li>
            <li><a href="{!! url('/') !!}/engagement-timeline"><i class="fa fa-hashtag fa-fw"></i> Timeline</a></li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        <a class="uk-navbar-item uk-button grey darken-3 white-text">FILTER <span uk-icon="icon: chevron-down" class="uk-margin-small-left"></span></a>
        <div uk-dropdown="mode: click; offset: 0;" class="uk-width-1-1 dropdown-stack">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-expand@m">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-auto@m sm-text-bold">Channel:</div>
                        <div class="uk-width-expand@m">
                            <ul class="sm-list">
                                <li><label><input class="uk-checkbox" type="checkbox"> Select All</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Facebook</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Twitter</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Youtube</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Instagram</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Online News</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Forum</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox"> Blog</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="uk-width-auto@m">
                    <button class="uk-button uk-button-small white-text red darken-1 sm-text-bold uk-float-right" name="filter" value="1" type="submit">UPDATE</button>
                </div>
            </div>
        </div>
    </div>
</nav>