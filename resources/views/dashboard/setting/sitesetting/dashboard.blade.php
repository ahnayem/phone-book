@extends('dashboard.master')

@section('page-title')
    <title>Site Setting</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Site Setting</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Site Setting</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Update site information on this page.
        </p>

        <div class="row mt-sm-4">
            {{-- <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Jump To</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="#" class="nav-link active">General</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">SEO</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Email</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">System</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Security</a></li>
                      <li class="nav-item"><a href="#" class="nav-link">Automation</a></li>
                    </ul>
                  </div>
                </div>
            </div> --}}
            <div class="col-md-12">
            <form action="{{ route('admin.setting.sitesetting.dashboard_update') }}" method="POST" enctype="multipart/form-data" id="setting-form">
                @csrf

                <div class="card" id="settings-card">
                <div class="card-header">
                    <h4>General Settings</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">General settings such as, site title, site description so on.</p>
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-2">Site Title</label>
                        <div class="col-sm-6 col-md-10">
                            <input type="text" name="title" class="form-control" id="site-title" value="{{ $setting->title }}">
                            @error('title')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-phone" class="form-control-label col-sm-2">Site Phone</label>
                        <div class="col-sm-6 col-md-10">
                            <input type="text" name="phone" class="form-control" id="site-phone" value="{{ $setting->phone }}">
                            @error('phone')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-email" class="form-control-label col-sm-2">Site Email</label>
                        <div class="col-sm-6 col-md-10">
                            <input type="email" name="email" class="form-control" id="site-email" value="{{ $setting->email }}">
                            @error('email')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-website" class="form-control-label col-sm-2">Site Website</label>
                        <div class="col-sm-6 col-md-10">
                            <input type="text" name="website" class="form-control" id="site-website" value="{{ $setting->website }}">
                            @error('website')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-address" class="form-control-label col-sm-2">Site Address</label>
                        <div class="col-sm-6 col-md-10">
                            <input type="text" name="address" class="form-control" id="site-address" value="{{ $setting->address }}">
                            @error('address')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-2">Site Description</label>
                        <div class="col-sm-6 col-md-10">
                            <textarea class="form-control" name="description" id="site-description">{!! $setting->description !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-2">Site Logo</label>
                        <div class="col-sm-6 col-md-10">
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input" id="site-logo">
                                <label class="custom-file-label">Choose File</label>
                            </div>
                            <div class="form-text text-muted">
                                The image must have a maximum size of 1MB
                                <p><a href="/storage/{{ $setting->logo }}" target="_blank">Current logo</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label class="form-control-label col-sm-2">Favicon</label>
                        <div class="col-sm-6 col-md-10">
                            <div class="custom-file">
                                <input type="file" name="favicon" class="custom-file-input" id="site-favicon">
                                <label class="custom-file-label">Choose File</label>
                            </div>
                            <div class="form-text text-muted">
                                The image must have a maximum size of 1MB
                                <p><a href="/storage/{{ $setting->favicon }}" target="_blank">Current logo</a></p>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label class="form-control-label col-sm-2 mt-3">Google Analytics Code</label>
                        <div class="col-sm-6 col-md-10">
                            <textarea class="form-control codeeditor" name="google_analytics_code"></textarea>
                        </div>
                    </div> --}}
                </div>
                <div class="card-footer bg-whitesmoke">
                    <button class="btn btn-primary" id="save-btn">Save Changes</button>
                    {{-- <button class="btn btn-secondary" type="button">Reset</button> --}}
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@endsection

@push('js')
@endpush
