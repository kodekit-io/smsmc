<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <h2 class="uk-navbar-item uk-margin-remove uk-text-uppercase sm-text-bold sm-title-sub" title="Project Name" uk-tooltip="pos: bottom">{!! $projectDetail->project->pname !!}</h2>
        <ul class="uk-navbar-nav">
            <li>
                <a href="{!! url('/project-all') !!}"><i class="fa fa-th-large"></i>All Media</a>
            </li>
            <li>
                <a href="{!! url('/project-fb') !!}"><i class="fa fa-facebook"></i>Facebook</a>
            </li>
            <li>
                <a href="{!! url('/project-tw') !!}"><i class="fa fa-twitter"></i>Twitter</a>
            </li>
            <li>
                <a href="{!! url('/project-news') !!}"><i class="fa fa-globe"></i>Online News</a>
            </li>
            <li>
                <a href="{!! url('/project-blog') !!}"><i class="fa fa-rss"></i>Blog</a>
            </li>
            <li>
                <a href="{!! url('/project-forum') !!}"><i class="fa fa-comments"></i>Forum</a>
            </li>
            <li>
                <a href="{!! url('/project-yt') !!}"><i class="fa fa-youtube-play"></i>Video</a>
            </li>
            <li>
                <a href="{!! url('/project-ig') !!}"><i class="fa fa-instagram"></i>Instagram</a>
            </li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        <form method="post" action="">
            {!! csrf_field() !!}
            <a class="uk-navbar-item uk-button grey darken-3 white-text">FILTER <span uk-icon="icon: chevron-down" class="uk-margin-small-left"></span></a>
            <div uk-dropdown="mode: click; offset: 0;" class="uk-width-1-1 dropdown-stack">
                <div class="uk-grid-divider uk-grid-small" uk-grid>
                    <div class="uk-width-1-1">
                        <div class="uk-grid-divider uk-grid-small uk-flex uk-flex-middle">

                            @if(count($keywords) > 0)
                            <div class="uk-width-1-2">
                                <div uk-grid class="uk-grid-small uk-flex uk-flex-middle">
                                    <div class="uk-width-auto@m sm-text-bold">Keyword:</div>
                                    <div class="uk-width-expand@m">
                                        <ul class="sm-list" id="select-keyword">
                                                <li><label><input class="uk-checkbox select-all-keyword" type="checkbox" checked> Select All</label></li>
                                                @foreach($keywords as $keywordId => $keyword)
                                                    <li><label><input class="uk-checkbox" name="keywords[]" type="checkbox" value="{!! $keywordId !!}" {!! $keyword['selected'] !!}> {!! $keyword['value'] !!}</label></li>
                                                @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(count($topics) > 0)
                            <div class="uk-width-1-2">
                                <div uk-grid class="uk-grid-small uk-flex uk-flex-middle">
                                    <div class="uk-width-auto@m sm-text-bold">Topics:</div>
                                    <div class="uk-width-expand@m">
                                        <ul class="sm-list" id="select-topic">
                                            <li><label><input class="uk-checkbox select-all-topic" type="checkbox" checked> Select All</label></li>
                                            @foreach($topics as $topicId => $topic)
                                                <li><label><input class="uk-checkbox" name="topics[]" type="checkbox" value="{!! $topicId !!}" {!! $topic['selected'] !!}> {!! $topic['value'] !!}</label></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

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
                                    <input type="text" class="uk-input uk-form-small uk-width-small" name="startDate" aria-describedby="option-startDate" placeholder="" data-toggle="datepicker" value="{!! $shownStartDate !!}">
                                </div>
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                                    <input type="text" class="uk-input uk-form-small uk-width-small" name="endDate" aria-describedby="option-endDate" placeholder="" data-toggle="datepicker" value="{!! $shownEndDate !!}">
                                </div>
                            </li>
                            <li class="uk-width-expand@m">
                                <div class="uk-inline sm-text-bold">Search:</div>
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: search"></span>
                                    <input class="uk-input uk-form-small uk-width-small" name="searchText" type="text" value="{!! $searchText !!}" placeholder="Filter">
                                </div>
                            </li>
                            <li class="uk-width-auto@m">
                                <button class="uk-button uk-button-small white-text red darken-1 sm-text-bold" name="filter" type="submit" value="filter">UPDATE</button>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </form>

    </div>
</nav>