@extends('dashboard.master')

@section('page-title')
    <title>Dashboard</title>
@endsection

@section('main-content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Event Category</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_category }}
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
                        <h4>Total Event</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_event }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-images"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Gallery Item</h4>
                    </div>
                    <div class="card-body">
                        {{ $total_gallery }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Blog</h4>
                    </div>
                    <div class="card-body">
                        #
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Upcoming Events <small>(This week)</small></h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.event.index') }}" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-events">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Plan</th>
                                    <th>Event Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($events as $key => $event)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $event->title }}</td>

                                        <td>{!! $event->location !!}</td>
                                        <td>{{ $event->plan }}</td>
                                        <td>{{ Carbon\Carbon::parse($event->date)->format('jS M, Y') }}</td>
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


@push('js')
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
@endpush
