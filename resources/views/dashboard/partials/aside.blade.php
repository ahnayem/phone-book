@php
$setting = \App\Models\Setting\SiteSetting::first();
@endphp
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ $setting->title }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            {{-- <a href="index.html">{{ $setting->title }}</a> --}}
            <img src="/storage/{{ $setting->favicon }}" alt="{{ $setting->title }}" height="50px" width="50px">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>


            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>


            <li class="nav-item dropdown {{ request()->is('dashboard/phone-book/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-calendar-check"></i>
                    <span>Phone Book</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('dashboard/phone-book/index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('phonebook.index') }}">All Contact</a></li>
                    <li class="{{ request()->is('dashboard/phone-book/favourite') ? 'active' : '' }}"><a class="nav-link"
                            href="#">Favourite Contact</a></li>
                </ul>
            </li>

            @role('Admin')
                <li class="menu-header">Settings</li>
                <li class="nav-item dropdown {{ request()->is('dashboard/setting/*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i>
                        <span>Website Setting</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('dashboard/setting/sitesetting/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setting.sitesetting.dashboard') }}">Dashboard Setting</a></li>

                        <li class="{{ request()->is('dashboard/setting/sitesetting/frontend') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setting.sitesetting.frontend') }}">Frontend Setting</a></li>
                    </ul>
                </li>
            @endrole

            {{-- @role('Admin')
                <li class="menu-header">User Management</li>
                <li class="nav-item dropdown {{ request()->is('dashboard/user/*') ? 'active' : '' }} mb-5">
                    <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                        <span>User</span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-link {{ request()->is('dashboard/user/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}">All User</a>
                        </li>

                        <li class="nav-link {{ request()->is('dashboard/user/create') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.create') }}">Register Staff</a>
                        </li>

                        <li class="nav-link {{ request()->is('dashboard/user/role/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.role.index') }}">Role</a>
                        </li>

                        <li class="nav-link {{ request()->is('dashboard/user/permission/index') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.permission.index') }}">Permission</a>
                        </li>
                    </ul>
                </li>
            @endrole --}}


        </ul>

    </aside>
</div>
