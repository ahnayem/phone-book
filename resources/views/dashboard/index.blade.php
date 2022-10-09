@extends('dashboard.master')

@section('page-title')
    <title>Dashboard</title>
@endsection

@section('main-content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        @role('Admin')
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_user }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User <small>(This week)</small></h4>
                    </div>
                    <div class="card-body">
                        {{ $total_user_this_week }}
                    </div>
                </div>
            </div>
        </div>
        @endrole
        <div class="@hasrole('Admin') col-lg-3 @else col-lg-6 @endhasrole col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-images"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Contact</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_contact }}
                    </div>
                </div>
            </div>
        </div>
        <div class="@hasrole('Admin') col-lg-3 @else col-lg-6 @endhasrole col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Contact <small>(This week)</small></h4>
                    </div>
                    <div class="card-body">
                        {{ $total_contact_added_this_week }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @role('Admin')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent User <small>(This week)</small></h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-users">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Member Since</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($latest_5 as $key => $contact)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $contact->name }}</td>

                                        <td>{!! $contact->email !!}</td>
                                        <td>{{ Carbon\Carbon::parse($contact->created_at)->format('jS M, Y') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('User')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Contact <small>(This week)</small></h4>
                    <div class="card-header-action">
                        <a href="{{ route('phonebook.index') }}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-users">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($latest_5 as $key => $contact)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{!! $contact->email !!}</td>
                                        <td>{{ Carbon\Carbon::parse($contact->created_at)->format('jS M, Y') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endrole

    </div>
@endsection


@push('js')

@endpush
