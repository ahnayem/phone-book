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
