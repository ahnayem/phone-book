@extends('dashboard.master')

@section('page-title')
    <title>Profile</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Change information about yourself on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <form action="{{ route('admin.profile.update') }}" method="post" class="needs-validation"
                        novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                    required="">
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" readonly value="{{ $user->email }}">
                            </div>

                            <div class="row">

                                <div class="form-group col-md-12 col-12">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please fill in the phone
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Address</label>
                                    <textarea class="form-control summernote-simple" name="address">{!! $user->address !!}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Profile photo</label>
                                <input type="file" class="form-control" name="profile_photo_path">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image"
                            @if ($user->profile_photo_path) src="/storage/{{ $user->profile_photo_path }}"
                            @else
                                src="{{ asset('backend/img/avatar/avatar-1.png') }}" @endif
                            class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Registerd since</div>
                                <div class="profile-widget-item-value">{{ $user->created_at->format('d M, Y') }}</div>
                            </div>

                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name">{{ auth()->user()->name }} <div
                                class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> {{ $user->getRoleNames()->first() }}
                            </div>
                        </div>

                        <div class="card-footer">
                            <span><strong>Phone: </strong>{{ $user->phone }}</span><br>
                            <span><strong>Email: </strong>{{ $user->email }}</span><br>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <form action="{{ route('admin.profile.password.update') }}" method="post" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Password update</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control" name="password" required="">
                                <div class="invalid-feedback">
                                    Please fill in the password
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password" required="">
                                <div class="invalid-feedback">
                                    Please fill in the confirm password
                                </div>
                            </div>



                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
