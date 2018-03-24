<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('img/hosym.png') }}" width="70" />
                         </span>

                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                         </span> <span class="text-muted text-xs block">{{ Auth::user()->duty }}</span> </span>

                </div>
                <div class="logo-element">
                    <i class="fa fa-plus-circle"></i>
                </div>
            </li>

            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>
            <li>
                <a href="{{ route('viewDrugs') }}"><i class="fa fa-medkit"></i> <span class="nav-label">Drugs</span></a>
            </li>
            <li>
                <a href="{{ route('viewInventory') }}"><i class="fa fa-h-square"></i> <span class="nav-label">Inventory</span></a>
            </li>
            @if(Auth::user()->duty == 'admin')
            <li>
                <a href="{{ route('addUser') }}"><i class="fa fa-user-plus"></i> <span class="nav-label">Add Users</span></a>
            </li>
            <li>
                <a href="{{ route('viewUsers') }}"><i class="fa fa-user-md"></i> <span class="nav-label">Users</span></a>
            </li>
            <li>
                <a href="{{ route('showReports') }}"><i class="fa fa-stethoscope"></i> <span class="nav-label">Reports</span></a>
            </li>
            @endif
            {{--<li>--}}
                {{--<a href="#"><i class="fa fa-list"></i> <span class="nav-label">Logs</span></a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="{{ route('getChangePassword') }}"><i class="fa fa-lock"></i> <span class="nav-label">Change Password</span></a>--}}
            {{--</li>--}}

        </ul>

    </div>
</nav>
