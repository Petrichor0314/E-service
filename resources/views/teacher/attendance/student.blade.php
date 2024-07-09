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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Présence des étudiants</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        @include('_messages')

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Rechercher la présence des étudiants</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Matière</label>
                                            <select class="form-control getSubject select2"  name="subject_id" required>
                                                <option value="">Sélectionnez une matière</option>
                                                @foreach ($getSubject as $subject_id => $subject_name)
                                                    <option {{ (Request::get('subject_id') == $subject_id) ? 'selected' : '' }} value="{{ $subject_id }}">{{ $subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Classe</label>
                                            <select class="form-control getClass select2"  name="class_id" required>
                                                <option value="">Sélectionnez une classe</option>
                                                
                                                @foreach ($getClass as $class_id => $class_name)
                                                    <option {{ (Request::get('class_id') == $class_id) ? 'selected' : '' }} value="{{ $class_id }}">{{ $class_name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Heure de début</label>
                                            <select name="start_time" id="getStartTime" class="form-control select2" required>
                                                <option value="">Sélectionnez l'heure de début</option>
                                                <option {{ (Request::get('start_time') == '08:30') ? 'selected' : '' }} value="08:30">08:30</option>
                                                <option {{ (Request::get('start_time') == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                                <option {{ (Request::get('start_time') == '14:30') ? 'selected' : '' }} value="14:30">14:30</option>
                                                <option {{ (Request::get('start_time') == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Heure de fin</label>
                                            <select name="end_time" id="getEndTime" class="form-control select2" required>
                                                <option value="">Sélectionnez l'heure de fin</option>
                                                <option {{ (Request::get('end_time') == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                                <option {{ (Request::get('end_time') == '12:30') ? 'selected' : '' }} value="12:30">12:30</option>
                                                <option {{ (Request::get('end_time') == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                                <option {{ (Request::get('end_time') == '18:30') ? 'selected' : '' }} value="18:30">18:30</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Date d'assiduité</label>
                                            <input type="date" id="getAttendanceDate" class="form-control" name="attendance_date" value="{{ Request::get('attendance_date') }}" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                            <a href="{{ url('teacher/attendance/student') }}" class="btn btn-success ml-2" style="margin-top: 31.5px;width:3cm">Réinitialiser</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
                            <form action="{{ url('teacher/attendance/student/save') }}" method="post">
                                {{ csrf_field() }}
                                <div class="card shadow-sm">
                                   
                                    <div class="card-body p-0">
                                        <table class="table table-hover table-striped">
                                            <thead class="bg-success">
                                                <tr style="font-size: 1.1rem ;  white-space: nowrap;" class="text-center">
                                                    <th>Numéro d'étudiant</th>
                                                    <th>Prénom</th>
                                                    <th>Nom</th>
                                                    <th>Assiduité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($getStudent) && $getStudent->count())
                                                    <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                                                    <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                    <input type="hidden" name="start_time" value="{{ Request::get('start_time') }}">
                                                    <input type="hidden" name="end_time" value="{{ Request::get('end_time') }}">
                                                    <input type="hidden" name="attendance_date" value="{{ Request::get('attendance_date') }}">
                                                    @foreach($getStudent as $value)
                                                        @php
                                                            $attendance_type = '';
                                                            $getAttendance = $value->getAttendance($value->id, Request::get('subject_id'), Request::get('class_id'), Request::get('start_time'), Request::get('end_time'), Request::get('attendance_date'));
                                                            if (!empty($getAttendance->attendance_type)) {
                                                                $attendance_type = $getAttendance->attendance_type;
                                                            }
                                                        @endphp
                                                        <tr class="text-center">
                                                            <td>{{ $value->id }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->last_name }}</td>
                                                            <td>
                                                                <input style="width:30px; height:30px;" type="checkbox" {{ ($attendance_type == '1') ? 'checked' : '' }} name="{{ $value->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">Aucun étudiant trouvé</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center p-3">
                                        <button class="btn btn-primary" style="width: 160px">Prendre l'assiduité</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.getSubject').change(function(){
            var subject_id = $(this).val();
            $.ajax({
                url: "{{ url('teacher/attendance/get_class') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    subject_id: subject_id,
                },
                dataType: "json",
                success: function(response){
                    $('.getClass').html(response.html);
                },
            });
        });
    });
</script>
<script  type="text/javascript">
$(document).ready(function() {
    $('#getStartTime').change(function() {
        var selectedStartTime = $(this).val();
        var $endTimeSelect = $('#getEndTime');
        
        // Send an AJAX request to the server
        $.ajax({
            url: "{{ url('teacher/attendance/get-end-times') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                start_time: selectedStartTime
            },
            dataType: 'json',
            success: function(response) {
                // Clear existing options
                $endTimeSelect.empty();
                // Add new options based on response
                $.each(response.end_times, function(index, value) {
                    $endTimeSelect.append('<option value="' + value + '">' + value + '</option>');
                });
            }
        });
    });
});
</script>


@endsection
