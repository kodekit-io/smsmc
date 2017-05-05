<form action="{!! url('home') !!}" method="get" id="searchform">
    <nav class="uk-navbar-container sm-nav-sub" uk-navbar>

        @if (is_authorized_to('viewAllProject'))
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="#"><span class="uk-visible@m">Project </span>Group <i uk-icon="icon: chevron-down" class="uk-margin-small-left"></i></a>
                    <div uk-dropdown="offset: 0">
                        <ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">
                            <li>
                                <label>
                                    <input class="uk-checkbox" name="pgroup"
                                           onclick="submitThisForm(this)" type="checkbox" id="select-group"
                                           @if($pgroup == 0) checked @endif
                                           value="0" /> All Group
                                </label>
                            </li>
                            @foreach($groups as $group)
                            <li>
                                <label>
                                    <input class="uk-checkbox" onclick="submitThisForm(this)"
                                           type="checkbox" value="{!! $group->id !!}"
                                           @if($pgroup == $group->id) checked @endif
                                           name="pgroup" /> {!! $group->pilarName !!}
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        @endif
        <div class="uk-navbar-right">
            <div class="uk-navbar-item">
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: search"></span>
                    <input class="uk-input uk-form-small" type="text" name="text" value="{!! $text !!}" placeholder="Search Project" id="searchtext">
                </div>
            </div>
        </div>
    </nav>
</form>
