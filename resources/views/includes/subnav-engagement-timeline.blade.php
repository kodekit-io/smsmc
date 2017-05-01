<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            {{-- <li><a href="{!! url('ticket') !!}"><i class="fa fa-ticket fa-fw"></i> Ticket</a></li> --}}
            <li><a href="{!! url('/') !!}/engagement-calendar"><i class="fa fa-calendar fa-fw"></i> Calendar</a></li>
            <li><a href="{!! url('/') !!}/engagement-timeline"><i class="fa fa-hashtag fa-fw"></i> Timeline</a></li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        <a class="uk-navbar-item uk-button grey darken-3 white-text">FILTER <span uk-icon="icon: chevron-down" class="uk-margin-small-left"></span></a>
        <div uk-dropdown="mode: click; offset: 0;" class="uk-width-1-1 dropdown-stack">
            <div class="uk-grid-divider uk-grid-small" uk-grid>
                <div class="uk-width-1-1">
                    <ul uk-grid class="uk-grid-small">
                        <li class="uk-width-auto@m">
                            <div class="uk-inline sm-text-bold">Date Range:</div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="startDate" aria-describedby="option-startDate">
                            </div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="endDate" aria-describedby="option-endDate">
                            </div>
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
