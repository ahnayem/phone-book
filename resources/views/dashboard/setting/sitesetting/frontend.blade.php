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
            <div class="col-md-12">
            <form action="{{ route('admin.setting.sitesetting.frontend_update') }}" method="POST" enctype="multipart/form-data" id="setting-form" class="needs-validation" novalidate="">
                @csrf

                <div class="card" id="settings-card">
                <div class="card-header">
                    <h4>Frontend Settings</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Frontend settings such as version, about and so on.</p>
                    <div class="form-group row align-items-center">
                        <label for="version" class="form-control-label col-sm-2">Site Title</label>
                        <div class="col-sm-6 col-md-10">
                            <select class="form-control" name="version" required="" id="version">
                                <option value="">Select a version</option>
                                <option value="1" @selected($setting->version == '1')>Version 1</option>
                                <option value="2" @selected($setting->version == '2')>Version 2</option>
                                <option value="3" @selected($setting->version == '3')>Version 3</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a version
                            </div>
                            @error('version')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                        
                    </div>


                    <div class="form-group row align-items-center">
                        <label for="about" class="form-control-label col-sm-2">About</label>
                        <div class="col-sm-6 col-md-10">
                            <textarea class="form-control summernote" name="about" id="about" required="">{!! $setting->about !!}</textarea>
                            <div class="invalid-feedback">
                                Please fill in the about field
                            </div>
                            @error('about')
                                <em class="error"
                                style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>
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
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endpush
