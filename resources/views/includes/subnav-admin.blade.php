<nav class="uk-navbar-container sm-nav-sub" uk-navbar>
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            @if (is_authorized_to('userRead'))
            <li>
                <a href="{!! url('setting/user') !!}"> Manage Accounts</a>
            </li>
            @endif
            @if (is_authorized_to('groupRead'))
            <li>
                <a href="{!! url('setting/group') !!}"> Manage Groups</a>
            </li>
            @endif
            @if (is_authorized_to('roleRead'))
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
