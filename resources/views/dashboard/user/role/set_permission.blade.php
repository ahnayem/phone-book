@extends('dashboard.master')

@section('page-title')
    <title>Set Permission</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Set Permission</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('admin.user.role.index') }}">Role</a></div>
            <div class="breadcrumb-item">Set Permission</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Set permission on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.user.role.set_permission.update', $role->id) }}" method="post" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="card-header">
                            <h4>Set permission</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" readonly disabled value="{{ $role->name }}" >
                            </div>

                            <h4>Permission list</h4>

                            @foreach ($allpermission as $key => $permission)
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all-{{ $key }}" name="permissions[]" value="{{ $permission->name }}" @if($permission->name == $role->hasPermissionTo($permission->name) ) checked @endif>
                                <label for="checkbox-all-{{ $key }}" class="custom-control-label">&nbsp; {{ $permission->name }}</label>
                            </div>
                            @endforeach

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
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable();
        });
    </script>
@endpush    
