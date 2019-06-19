@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar" style="background-color: #750000;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">        
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-th"></i>
                    <span class="title">View Site</span>
                </a>
            </li>
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/home') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            <!-- @can('profile_access')
            <li>
                <a href="{{ route('admin.profiles.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.profile.title')</span>
                </a>
            </li>@endcan -->

            @can('donor_access')
            <li>
                <a href="{{ route('admin.donors.index') }}">
                    <i class="fa fa-gift"></i>
                    <span>Donors</span>
                </a>
            </li>@endcan

            @can('patient_access')
            <li>
                <a href="{{ route('admin.patients.index') }}">
                    <i class="fa fa-wheelchair"></i>
                    <span>Patients</span>
                </a>
            </li>@endcan

            @can('blood_access')
            <li>
                <a href="{{ route('admin.bloods.index') }}">
                    <i class="fa fa-tint"></i>
                    <span>Bloods</span>
                </a>
            </li>@endcan

            @can('blood_request_access')
            <li>
                <a href="{{ route('admin.blood_requests.index') }}">
                    <i class="fa fa-heart"></i>
                    <span>Blood Requests</span>
                </a>
            </li>@endcan
        </ul>
    </section>
</aside>

