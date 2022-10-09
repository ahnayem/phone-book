@extends('dashboard.master')

@section('page-title')
    <title>Contact Edit</title>
@endsection

@push('css')
@endpush

@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('phonebook.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Contact Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('phonebook.index') }}">
                    Event</a></div>
            <div class="breadcrumb-item">Contact Edit</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Contact edit on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('phonebook.update', $contact->id) }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Contact Edit</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required=""
                                    value="{{ $contact->name }}">
                                <div class="invalid-feedback">
                                    Please fill in the name
                                </div>
                                @error('name')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" required=""
                                    value="{{ $contact->phone }}">
                                <div class="invalid-feedback">
                                    Please fill in the phone
                                </div>
                                @error('phone')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required=""
                                    value="{{ $contact->email }}">
                                <div class="invalid-feedback">
                                    Please fill in the email
                                </div>
                                @error('email')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="photo"
                                    accept="image/png, image/jpeg, image/jpg"><br>
                                <p>Current image:<br><a href="/storage/{{ $contact->photo }}" target="_blank"><img
                                            src="/storage/{{ $contact->photo }}" class="img-thumbnail" height="150"
                                            width="150" alt=""></a></p>
                                <div class="invalid-feedback">
                                    Please fill in the photo
                                </div>
                                @error('photo')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
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
