@extends('dashboard.master')

@section('page-title')
    <title>Contact List</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Contact List</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Contact List</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            All the contact list shown on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive p-2">
                        <div class="my-2 text-center text-uppercase">
                            <a href="{{ route('phonebook.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="fas fa-plus-circle"></i> Add Contact</a>
                        </div>

                        <table id="contacts-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Make Favourite</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contacts as $key => $contact)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="/storage/{{ $contact->photo }}" target="_blank"><img
                                                    src="/storage/{{ $contact->photo }}" class="img-thumbnail" height="70"
                                                    width="70" alt=""></a></td>

                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone  }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="custom-switch-checkbox"
                                                    class="custom-switch-input"
                                                    onclick="changeFavourite(event.target, {{ $contact->id }})"
                                                    @checked($contact->favourite == 'Active')>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                        <td>{{ Carbon\Carbon::parse($contact->created_at)->format('jS M, Y') }}</td>
                                        <td>

                                            <a href="{{ route('phonebook.edit', $contact->id) }}"
                                                class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('phonebook.destroy', $contact->id) }}"
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
        $('#contacts-table').DataTable();
    });
</script>

<script>
    function changeFavourite(_this, id) {
        var favourite = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
        let _token = $('meta[name="csrf-token"]').attr('content');

        console.log(favourite);

        $.ajax({
            url: `{{ route('phonebook.favourite_update') }}`,
            type: 'get',
            data: {
                _token: _token,
                id: id,
                favourite: favourite
            },
            success: function(result) {

                if (result.warning) {
                    @include('dashboard.partials.json_response')
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    @include('dashboard.partials.json_response')
                }
            },
        });
    }
</script>
@endpush
