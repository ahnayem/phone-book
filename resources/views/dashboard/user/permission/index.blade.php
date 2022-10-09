@extends('dashboard.master')

@section('page-title')
    <title>Permissions</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Permissions</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Permission</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            All the permission list shwn on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive p-2">
                        <div class="my-2 text-center text-uppercase">
                            <a href="{{ route('admin.user.permission.create') }}"
                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Add Permission</a>
                        </div>

                        <table id="permissions-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.permission.edit', $permission->id) }}"
                                                class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('admin.user.permission.destroy', $permission->id) }}"
                                                class="btn btn-icon btn-danger" onclick="return confirm('Are you sure?')"><i
                                                    class="fas fa-times"></i></a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#permissions-table').DataTable();
    });
</script>

{{-- <script>
        function removeItem() {
            confirm("Are you sure!");
        }
    </script> --}}
@endpush
