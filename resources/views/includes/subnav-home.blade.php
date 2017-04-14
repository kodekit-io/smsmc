<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#"><span class="uk-visible@m">Project </span>Group <i uk-icon="icon: chevron-down" class="uk-margin-small-left"></i></a>
                <div uk-dropdown="offset: 0">
                    <ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">
                        <li><label><input class="uk-checkbox" type="checkbox" id="select-group" checked> All Group</label></li>
                        @foreach($groups as $group)
                            <li><label><input class="uk-checkbox" type="checkbox" value="{!! $group->id !!}"> {!! $group->pilarName !!}</label></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        <form class="uk-navbar-item">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: search"></span>
                <input class="uk-input uk-form-small" type="text" placeholder="Search Project">
            </div>
        </form>
    </div>
</nav>