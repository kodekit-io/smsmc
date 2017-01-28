<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#">Project Group <span uk-icon="icon: chevron-down"></span></a>
                <div uk-dropdown="offset: 0">
                    <ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">
                        <li><label><input class="uk-checkbox" type="checkbox"> All Group</label></li>
                        <li><label><input class="uk-checkbox" type="checkbox"> Group PO</label></li>
                        <li><label><input class="uk-checkbox" type="checkbox"> Group APP</label></li>
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