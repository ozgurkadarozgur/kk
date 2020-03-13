@section('styles')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('theme/plugins/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/fullcalendar-daygrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/fullcalendar-timegrid/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/fullcalendar-bootstrap/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/fullcalendar-list/main.min.css') }}">

    <style>
        .fc-today{
            background-color: #fcf8e3;
        }

        .fc-event{
            cursor: pointer;
        }

        .fc-title {
            white-space: normal;
        }

    </style>

@endsection
    @include('admin.astroturf.modal.show_event_modal')
    @include('admin.astroturf.modal.show_subscribed_event_modal')
    <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

