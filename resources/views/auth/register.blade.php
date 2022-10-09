@extends('auth.partials.main')
@php
$setting = \App\Models\Setting\SiteSetting::first();
@endphp
@section('title')
    <title>Register &mdash; {{ $setting->title }}</title>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/vendor/selectric/public/selectric.css') }}">
@endpush

@section('main-content')
    <div id="app">
        <section class="section">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="/storage/{{ $setting->logo }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('auth.create_user') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control" name="name" autofocus required value="{{ old('name') }}">

                                        <div class="invalid-feedback">
                                            please fill in your name
                                        </div>
                                        @error('name')
                                            <em class="error"
                                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" required value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            please fill in your email
                                        </div>
                                        @error('email')
                                            <em class="error"
                                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength"
                                                data-indicator="pwindicator" name="password" required>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>

                                            <div class="invalid-feedback">
                                                please fill in your password
                                            </div>
                                            @error('password')
                                                <em class="error"
                                                    style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control"
                                                name="password_confirmation" required>

                                            <div class="invalid-feedback">
                                                please fill in confirm password
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mt-2 text-muted text-center">
                            Already have an account? <a href="{{ route('auth.login') }}">Login Here</a>
                        </div>

                        <div class="text-center mt-2">
                            Copyright &copy; {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
@endpush
