@extends('dashboard.master')

@section('page-title')
    <title>Event</title>
@endsection



@section('main-content')

@section('main-content-title')
    <div class="section-header">
        <h1>Event</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Event</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            All the event list shown on this page.
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="table-responsive p-2">
                        <div class="my-2 text-center text-uppercase">
                            <a href="{{ route('admin.event.create') }}" class="btn btn-icon icon-left btn-primary"><i
                                    class="fas fa-plus-circle"></i> Add Event</a>
                        </div>

                        <table id="events-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Plan</th>
                                    <th>Event Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($events as $key => $event)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href="/storage/{{ $event->photo }}" target="_blank"><img
                                                    src="/storage/{{ $event->photo }}" class="img-thumbnail" height="70"
                                                    width="70" alt=""></a></td>

                                        <td>{{ $event->title }}</td>

                                        <td>{!! $event->location !!}</td>
                                        <td>{{ $event->plan }}</td>
                                        <td>{{ Carbon\Carbon::parse($event->date)->format('jS M, Y') }}</td>
                                        <td>
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" name="custom-switch-checkbox"
                                                    class="custom-switch-input"
                                                    onclick="changeStatus(event.target, {{ $event->id }})"
                                                    @checked($event->status == 'Active')>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                        <td>

                                            <button class="btn btn-primary event-details"
                                                data-event-id="{{ $event->id }}"><i class="fas fa-eye"></i></button>
                                            <a href="{{ route('admin.event.edit', $event->id) }}"
                                                class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('admin.event.destroy', $event->id) }}"
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

        <div class="modal fade" tabindex="-1" role="dialog" id="event-modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <hr>
                        
                        <h5 id="event-title"></h5>
                        <p><span><strong>Plan: </strong></span><span id="event-plan"></span></p>
                        <p><span><strong>Location: </strong></span><span id="event-location"></span></p>
                        <small><strong>Event Date: </strong> <span id="event-date"></span></small>
                        <hr>
                        <p id="event-description"></p>
                        <hr>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $('#events-table').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $("body").on("click", ".event-details", function() {

            var event_id = $(this).data("event-id");

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.event.get_event') }}",
                data: {
                    'id': event_id
                },
                success: function(data) {
                    data = JSON.parse(data);
                    $('#event-modal').modal('show');
                    $('#event-title').text(data.title);
                    $('#event-date').text(data.date);
                    $('#event-location').html(data.location);
                    $('#event-plan').html(data.plan);
                    $('#event-description').html(data.description);
                },
            });
        });
    });
</script>
<script>
    function changeStatus(_this, id) {
        var status = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.event.status_update') }}`,
            type: 'get',
            data: {
                _token: _token,
                id: id,
                status: status
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
