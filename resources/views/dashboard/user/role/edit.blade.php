@extends('dashboard.master')

@section('page-title')
    <title>Role Edit</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.user.role.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Role update</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.user.role.index') }}">Roles</a></div>
            <div class="breadcrumb-item">Role edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Edit Staff on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.user.role.update', $role->id) }}" method="post" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Edit Role</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required=""
                                    value="{{ $role->name }}">
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                                @error('name')
                                    <em class="error"
                                        style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
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
