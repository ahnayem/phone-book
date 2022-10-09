@extends('dashboard.master')

@section('page-title')
    <title>User Edit</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.user.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>User Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Users</a></div>
            <div class="breadcrumb-item">User Edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Edit role on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Edit Role</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required=""
                                    value="{{ $user->name }}">
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                                @error('name')
                                    <em class="error"
                                        style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="form-group col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                            required="">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                        @error('email')
                                            <em class="error"
                                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>
                                        @error('password')
                                            <em class="error"
                                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="form-group col-md-6 col-12">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please fill in the phone
                                    </div>
                                    @error('phone')
                                        <em class="error"
                                            style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role" required="">
                                            <option>Select an option</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}"
                                                    @if ($role == $userRole) selected @endif>{{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please fill in the role
                                        </div>
                                        @error('role')
                                            <em class="error"
                                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                        @enderror
                                    </div>
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

@push('js')
@endpush
