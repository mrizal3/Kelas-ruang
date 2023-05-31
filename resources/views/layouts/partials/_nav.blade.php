<nav class="navbar navbar-expand-lg main-navbar">
    <a href="dashboard-general.html" class="navbar-brand sidebar-gone-hide">Universitas Perjuangan</a>
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    <form class="form-inline ml-auto">
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->nama }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('profile/ganti-password') }}" class="dropdown-item has-icon">
                    <i class="fas fa-lock"></i> Ganti Password
                </a>
                <div class="dropdown-divider"></div>
                <a  href="{{ url('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>