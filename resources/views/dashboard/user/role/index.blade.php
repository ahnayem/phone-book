@extends('dashboard.master')

@section('page-title')
    <title>Roles</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Roles</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Role</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            All the role list shwn on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive p-2">
                        <div class="my-2 text-center text-uppercase">
                            <a href="{{ route('admin.user.role.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="far fa-edit"></i> Add Role</a>
                        </div>

                        <table id="roles-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td><a href="{{ route('admin.user.role.set_permission', $role->id) }}"
                                                class="btn btn-icon btn-info"><i class="fas fa-plus-circle"></i> Set
                                                permission</a></td>
                                        <td>
                                            <a href="{{ route('admin.user.role.edit', $role->id) }}"
                                                class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('admin.user.role.destroy', $role->id) }}"
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
        $('#roles-table').DataTable();
    });
</script>
@endpush
