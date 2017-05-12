<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            @if (is_authorized_to('userCreate'))
            <li>
                <a href="{!! url('setting/user') !!}"> Manage Accounts</a>
            </li>
            @endif
            @if (is_authorized_to('groupCreate'))
            <li>
                <a href="{!! url('setting/group') !!}"> Manage Groups</a>
            </li>
            @endif
            @if (is_authorized_to('roleCreate'))
            <li>
                <a href="{!! url('setting/role') !!}"> Manage Roles</a>
            </li>
            @endif
            {{-- <li>
                <a href="{!! url('setting/notification') !!}"> Notifications Setting</a>
            </li> --}}
        </ul>
    </div>

</nav>
