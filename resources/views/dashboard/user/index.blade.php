@extends('dashboard.master')

@section('page-title')
    <title>Users</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            All the user list shwn on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive p-2">
                        <div class="my-2 text-center text-uppercase">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-user"></i> Add User</a>
                        </div>

                        <table id="users-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
    
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->getRoleNames()->first() }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-icon btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-times"></i></a>
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
            $('#users-table').DataTable();
        });
    </script>
@endpush    
