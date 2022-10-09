@php
if (session('logged_in')) {
} else {
    session(['logged_in' => date('Y-m-d H:i:s', time())]);
}

$login_time = session('logged_in');
$now_time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $login_time);

$diff_time = $now_time->diffForHumans();

@endphp
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a>
            </li>
        </ul>


    </form>



    <ul class="navbar-nav navbar-right">
        {{-- @role('Admin')
            <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i
                        class="far fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                        @if ($alert_quantity_unread->count() > 0)
                            <div class="float-right">
                                <a href="{{ route('dashboard.mark_as_read') }}">Mark All As Read</a>
                            </div>
                        @endif
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons h-auto">
                        @foreach ($alert_quantity_unread as $unread)
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    <strong>{{ $unread->product->name }}</strong> <small> quantity is now bellow 20</small>
                                    <div class="time">{{ $unread->created_at->diffForHumans() }}</div>
                                </div>
                            </a>
                        @endforeach

                        @if ($alert_quantity_unread->count() == 0)
                            <a class="dropdown-item">
                                <div class="dropdown-item-desc">
                                    There is no unread notication right now.
                                </div>
                            </a>
                        @endif

                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
        @endrole --}}


        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image"
                    @if (auth()->user()->profile_photo_path) src="/storage/{{ auth()->user()->profile_photo_path }}"
                            @else
                                src="{{ asset('backend/img/avatar/avatar-1.png') }}" @endif
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"><small>Logged in {{ $diff_time }}</small></div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                {{-- <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a> --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
