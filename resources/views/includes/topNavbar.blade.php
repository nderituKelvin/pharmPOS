<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">Marigat Dispensary Pharmacy</span>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
        <li>
            <button href="{{ route('viewCart') }}" onclick="window.location.href='{{ route('viewCart') }}'" class="btn btn-danger btn-md" style="color:#fff;"> <i class="fa fa-shopping-cart"></i>  Cart</button>
        </li>
    </ul>
</nav>
