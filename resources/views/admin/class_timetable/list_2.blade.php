@extends('layouts.app')

@section('content')
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Messages Dropdown Menu -->
   
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">0</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">0 Notifications</span>    
        <div class="dropdown-divider"></div>
       
        <p>No new notifications.</p>
    
       
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Calendar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top mb-3">
                            <!-- Search Class Form -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Chercher une classe</h3>
                                </div>
                                <form method="get" action="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Classe</label>
                                                <select class="form-control getClass select2" name="class_id" required>
                                                    <option value="">Selectionner</option>
                                                    @foreach($getClass as $filiere)
                                                        @foreach($filiere->classes as $class)
                                                            <option {{ Request::get('class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Rechercher</button>
                                                <a href="{{ url('coordinator/class_timetable/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Réinitialiser</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Draggable Subjects -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Draggable Subjects</h4>
                                </div>
                                <div class="card-body">
                                    <div id="external-events">
                                        @foreach($getSubject as $subject)
                                            <div class="external-event bg-info" data-subject-id="{{ $subject->module_id }}">{{ $subject->subject_name }}</div>
                                        @endforeach
                                        <div class="checkbox">
                                            <label for="drop-remove">
                                                <input type="checkbox" id="drop-remove"> remove after drop
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Create Event -->
                        </div>
                    </div>

                    <!-- Calendar Section -->
                    <div class="col-md-9">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <div id="calendar"></div>
                            </div>
                        </div>
                        <button type="button" id="save-timetable" class="btn btn-success">Save Timetable</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('script')
<script>
$(function () {
    function ini_events(ele) {
        ele.each(function () {
            var eventObject = {
                title: $.trim($(this).text()),
                subject_id: $(this).data('subject-id')
            };
            $(this).data('eventObject', eventObject);
            $(this).draggable({
                zIndex: 1070,
                revert: true,
                revertDuration: 0
            });
        });
    }

    ini_events($('#external-events div.external-event'));

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText,
                subject_id: $(eventEl).data('subject-id'),
                backgroundColor: window.getComputedStyle(eventEl).getPropertyValue('background-color'),
                borderColor: window.getComputedStyle(eventEl).getPropertyValue('background-color'),
                textColor: window.getComputedStyle(eventEl).getPropertyValue('color'),
            };
        }
    });

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: '',
            center: '',
            right: ''
        },
        initialView: 'timeGridWeek',
        views: {
            timeGridWeek: {
                titleFormat: { year: 'numeric', month: 'short', day: 'numeric' },
                dayHeaderFormat: { weekday: 'long' },
                hiddenDays: [0], // Hide Sunday
                slotLabelInterval: '00:30:00', // 30-minute intervals
                slotMinTime: '08:00:00',
                slotMaxTime: '18:30:00',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                dayHeaderContent: function(args) {
                    return {
                        html: '<div class="fc-day-number">' + args.date.toLocaleDateString(undefined, { weekday: 'long' }) + '</div>'
                    };
                },
                hour12: true
            }
        },
        themeSystem: 'bootstrap',
        editable: true,
        droppable: true,
        allDaySlot: false,
        drop: function(info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },
        eventReceive: function(info) {
            // Additional code if needed when event is received
        },
        eventDrop: function(info) {
            if (info.event.extendedProps.subject_id) {
                // Additional code if needed when event is dropped
            }
        },
        eventClick: function(info) {
            if (confirm('Are you sure you want to delete this event?')) {
                info.event.remove();
            }
        }
    });

    calendar.render();

    $('#save-timetable').click(function() {
        var events = calendar.getEvents();
        var timetable = [];
        
        events.forEach(function(event) {
            var start = new Date(event.start);
            var end = event.end ? new Date(event.end) : null;

            var startTime = formatAMPM(start);
            var endTime = end ? formatAMPM(end) : null;

            timetable.push({
                title: event.title,
                start_time: startTime,
                end_time: endTime,
                week_id: start.getDay(),
                session_type: '', 
                subject_id: event.extendedProps.subject_id,
                amphi_name: event.extendedProps.amphi_name || '',
                bloc_name: event.extendedProps.bloc_name || '',
                room_number: event.extendedProps.room_number || ''
            });
        });

        $.ajax({
            url: "{{ url('coordinator/class_timetable/insert_update') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                class_id: $('select[name="class_id"]').val(),
                timetable: JSON.stringify(timetable)
            },
            success: function(response) {
                alert(response.success);
            },
            error: function(response) {
                console.log(response);
                alert(response.responseJSON.error);
            }
        });
    });

    function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }

    $('.getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
            url:"{{url('coordinator/class_timetable/get_subject')}}",
            type:"POST",
            data:{
                "_token": "{{csrf_token()}}",
                class_id:class_id,
            },
            dataType:"json",
            success:function(response){
                $('#external-events').html(response.html);
                ini_events($('#external-events div.external-event'));
            }
        });
    });
});
</script>

<style>
    /* Hide half-hour slots */
    .fc-timegrid-slot-lane-frame div:nth-child(odd) {
        display: none;
    }
</style>  
@endsection
