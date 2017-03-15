<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <h2 class="uk-navbar-item uk-margin-remove uk-text-uppercase sm-text-bold sm-title-sub" title="Social Media" uk-tooltip="pos: bottom">Social Media</h2>
        <ul class="uk-navbar-nav">
            <li><a href="{!! url('socmed/facebook') !!}"><i class="fa fa-facebook fa-fw"></i> Facebook</a></li>
            <li><a href="{!! url('socmed/twitter') !!}"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
            <li><a href="{!! url('socmed/youtube') !!}"><i class="fa fa-youtube-play fa-fw"></i> Youtube</a></li>
            <li><a href="{!! url('socmed/instagram') !!}"><i class="fa fa-instagram fa-fw"></i> Instagram</a></li>
        </ul>
    </div>
    <div class="uk-navbar-right">

        <a class="uk-navbar-item uk-button grey darken-3 white-text">FILTER <span uk-icon="icon: chevron-down" class="uk-margin-small-left"></span></a>
        <div uk-dropdown="mode: click; offset: 0;" class="uk-width-1-1 dropdown-stack">
            <div class="uk-grid-divider uk-grid-small" uk-grid>
                <div class="uk-width-1-1">
                    <div uk-grid class="uk-grid-small uk-flex uk-flex-middle">
                        <div class="uk-width-auto@m sm-text-bold">Accounts:</div>
                        <div class="uk-width-expand@m">
                            <ul class="sm-list" id="select-account">
                                <li><label><input class="uk-checkbox select-all-account" type="checkbox" checked> Select All</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox" checked> Account</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox" checked> Account</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox" checked> Account</label></li>
                                <li><label><input class="uk-checkbox" type="checkbox" checked> Account</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <ul uk-grid class="uk-grid-small uk-flex uk-flex-middle">
                        <li class="uk-width-auto@m">
                            <ul class="sm-list">
                                <li class="sm-text-bold">Sentiment:</li>
                                @foreach($sentiments as $sentimentId => $sentiment)
                                    <li><label><input class="uk-checkbox" name="sentiments[]" type="checkbox" value="{!! $sentiment['value'] !!}" {!! $sentiment['checked'] !!}> {!! $sentiment['showName'] !!}</label></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="uk-width-auto@m">
                            <div class="uk-inline sm-text-bold">Date Range:</div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="startDate" aria-describedby="option-startDate" value="{!! $shownStartDate !!}">
                            </div>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                <input type="text" class="datetimepicker uk-input uk-form-small uk-width-small" name="endDate" aria-describedby="option-endDate" value="{!! $shownEndDate !!}">
                            </div>
                        </li>
                        <li class="uk-width-expand@m">
                            <div class="uk-inline sm-text-bold">Search:</div>
                            <form class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: search"></span>
                                <input class="uk-input uk-form-small uk-width-small" name="searchText" type="text" value="{!! $searchText !!}" placeholder="Filter">
                            </form>
                        </li>
                        <li class="uk-width-auto@m">
                            <button class="uk-button uk-button-small white-text red darken-1 sm-text-bold" name="filter" type="submit">UPDATE</button>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
</nav>