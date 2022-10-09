@extends('dashboard.master')

@section('page-title')
    <title>Event Create</title>
@endsection

@push('css')
@endpush

@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.event.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Event Create</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.event.index') }}">
                    Event</a></div>
            <div class="breadcrumb-item">Event Create</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Create event Create on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.event.store') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Create Event</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required=""
                                    value="{{ old('title') }}">
                                <div class="invalid-feedback">
                                    Please fill in the title
                                </div>
                                @error('title')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Choose Plan</label>
                                <select class="form-control" name="plan" required="" id="plan">
                                    <option value="">Select an option</option>
                                    <option value="Simple">Simple</option>
                                    <option value="Better">Better</option>
                                    <option value="Best">Best</option>
                                </select>

                                <div class="invalid-feedback">
                                    Please select in the plan
                                </div>
                                @error('plan')
                                    <em class="error" id="category_error"
                                        style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Location</label>
                                <textarea class="form-control summernote" name="location">{{ old('location') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill in the location
                                </div>
                                @error('location')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control summernote" name="description">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill in the description
                                </div>
                                @error('description')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>FAQ Description</label>
                                <textarea class="form-control summernote" name="faq_description">{{ old('faq_description') }}</textarea>
                                <div class="invalid-feedback">
                                    Please fill in the faq description
                                </div>
                                @error('faq_description')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date" required="">
                                <div class="invalid-feedback">
                                    Please fill in the date
                                </div>
                                @error('date')
                                    <em class="error" style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="photo" accept="image/png, image/jpeg, image/jpg" required="">
                                <div class="invalid-feedback">
                                    Please fill in the photo
                                </div>
                                @error('photo')
                                    <em class="error"
                                        style="display: inline-block; color: #f05e5e ">{{ $message }}</em>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Add Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });

    $("select").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
</script>
@endpush
