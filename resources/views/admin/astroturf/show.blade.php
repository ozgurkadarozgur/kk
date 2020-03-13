@extends('layouts.admin')

@section('header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><a href="{{ route('admin.facility.show', $astroturf->facility->id) }}">
                            {{ $astroturf->facility->title }}
                        </a>
                        {{ '/' . $astroturf->title }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    @include('admin.astroturf.modal.create_calendar_modal')
    {{ $errors }}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#reservation" data-toggle="tab">Rezervasyon</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ayarlar</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="reservation">
                            @include('admin.astroturf.reservation')
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" method="post" action="{{ route('admin.astroturf.update', $astroturf->id) }}">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">Saha Adı</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''  }}" id="title" name="title" placeholder="Tesis Adı" value="{{ $astroturf->title }}">
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Telefon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="{{ $astroturf->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Adres</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Adres" value="{{ $astroturf->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Fiyat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Fiyat" value="{{ $astroturf->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Çalışma Saatleri</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="time" class="form-control" id="work_hour_start" name="work_hour_start" value="{{ $astroturf->work_hour_start }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" class="form-control" id="work_hour_end" name="work_hour_end" value="{{ $astroturf->work_hour_end }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-2 col-form-label">İl</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select id="city" name="city" class="form-control select2" style="width: 100%;">
                                                    <option selected="selected" value="0">Seçiniz..</option>
                                                    <option>Alaska</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="district" class="col-sm-2 col-form-label">İlçe</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select id="district" name="district" class="form-control select2" style="width: 100%;">
                                                    <option selected="selected" value="0">Seçiniz..</option>
                                                    <option>Alaska</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="services" class="col-sm-2 col-form-label">Hizmetler</label>
                                        <div class="select2-purple">
                                            <select class="form-control select2" id="services" name="services[]" multiple="multiple" data-placeholder="Hizmetleri Seçin..." data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                @foreach($services as $item)
                                                    <option {{ (in_array($item->id, $astroturf->service_list->pluck('id')->toArray())) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info float-right">Kaydet</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('scripts')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('theme/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-daygrid/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-timegrid/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-interaction/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-list/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-bootstrap/main.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-rrule/vendor_rrule.js') }}"></script>
    <script src="{{ asset('theme/plugins/fullcalendar-rrule/main.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            let current_event = {};

            let x = ('{{ $astroturf->work_hour_end }}');
            let x_hour = x.split(':')[0];
            let end_time = '';
            if (x_hour < 12) end_time = (24 + parseInt(x_hour)) + ':00:00';
            else end_time = x;

            let astroturf_calendar = @json($calendar_resource);
            let astroturf_calendar_subscribed = @json($calendar_resource_subscribed);
            console.log(astroturf_calendar);

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            var Calendar = FullCalendar.Calendar;

            //var containerEl = document.getElementById('external-events');
            //var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            var calendar = new Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'rrule', 'list' ],
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                'themeSystem': 'bootstrap',
                selectable: true,
                firstDay: 1,
                eventClick: function(arg) {
                    current_event = arg;
                    console.log(current_event);

                    let startDate = arg.event.start.toLocaleDateString();
                    let startTime = arg.event.start.toLocaleTimeString();
                    let endDate = (arg.event.end) ? arg.event.end.toLocaleDateString() : '';
                    let endTime = (arg.event.end) ? arg.event.end.toLocaleTimeString() : '';
                    let is_subscriber = arg.event.extendedProps.is_subscriber;
                    let event_title = arg.event.title;

                    if (is_subscriber) {
                        document.getElementById('modal_subscribed_event_title_text').innerText = event_title;
                        document.getElementById('modal_subscribed_event_start_date_text').innerText = startDate + " " + startTime;
                        document.getElementById('modal_subscribed_calendar_id').value = arg.event.id;
                        $('#show-subscribed-event-modal').modal('show');
                    } else {
                        document.getElementById('modal_event_title_text').innerText = event_title;
                        document.getElementById('modal_event_start_date_text').innerText = startDate + " " + startTime;
                        document.getElementById('modal_event_end_date_text').innerText = endDate + " " + endTime;
                        document.getElementById('modal_calendar_id').value = arg.event.id;
                        $('#show-event-modal').modal('show');
                    }

                    //document.getElementById('modal_event_is_subscriber_text').innerText = is_subscriber;
                    //document.getElementById('start_date').value = arg.start;
                    //document.getElementById('end_date').value = arg.end;

                    //console.log($('#myModal'))

                },
                selectAllow: function(selectInfo) {
                    console.log('asd',selectInfo)
                    return true;
                },
                select: function(arg) {
                    let now = new Date();

                    if(['timeGridDay', 'timeGridWeek'].includes(calendar.component.props.viewType)){
                        if(arg.start > now) $('#create-calendar-modal').modal('show');
                    }
                    console.log(arg);
                    let startDate = arg.start.toLocaleDateString();
                    let startTime = arg.start.toLocaleTimeString();
                    let endDate = arg.end.toLocaleDateString();
                    let endTime = arg.end.toLocaleTimeString();

                    document.getElementById('start_date_text').innerText = startDate + " " + startTime;
                    document.getElementById('end_date_text').innerText = endDate + " " + endTime;

                    document.getElementById('start_date').value = arg.start;
                    document.getElementById('end_date').value = arg.end;
                    //calendar.unselect()
                },
                eventSources: [
                    {
                        events: astroturf_calendar,
                    },
                    {
                        events: astroturf_calendar_subscribed,
                        color: '#dc3545',     // an option!
                        textColor: 'white' // an option!
                    }
                ],
                slotDuration: '01:00:00',
                //minTime: '10:00:00',
                //maxTime: '27:00:00',
                minTime: ('{{ $astroturf->work_hour_start }}'),
                maxTime: end_time,
                allDaySlot: false,
                buttonText: {
                    'today' : 'Bugün',
                    'month': 'Aylık',
                    'week': 'Haftalık',
                    'day': 'Günlük',
                }
            });
            calendar.setOption('locale', 'tr');
            calendar.render();
            // $('#calendar').fullCalendar()

        })
    </script>
@endsection