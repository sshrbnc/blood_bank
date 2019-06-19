@inject('request', 'Illuminate\Http\Request')

<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px; background-color: #900000;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="../assets/img/prc_logo.png" style="width: 35px; height: 35px;"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">PRC Blood Bank</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #aa0000;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div id="user">
            <div style="float: right; margin-right: 50px;">
                <li style="list-style: none; font-size: 20px; color: white;" class="dropdown">
                    <i class="fa fa-user"></i> <a style="color: white;" data-toggle="dropdown" class="dropdown-toggle" a href="#">&nbsp;{{ @Auth::user()->name }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        @can('user_view')
                        <li>
                            <a href="{{ route('admin.users.show',[@Auth::user()->id]) }}">
                                Profile
                            </a>
                        </li>
                        @endcan
                        <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                            <a href="{{ route('auth.change_password') }}">
                                Change Password
                            </a>
                        </li> 

                        <li>
                            <a href="#logout" onclick="$('#logout').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>
    </nav>
</header>