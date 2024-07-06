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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rapport de présence</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_messages')

                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Rechercher la présence des étudiants</h3>
                        </div>
                        <form method="get" action="{{ url('teacher/attendance/report') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Module</label>
                                        <select class="form-control" id="getSubject" name="subject_id">
                                            <option value="">Sélectionner un module</option>
                                            @foreach ($getSubject as $subject_id=>$subject_name)
                                                <option {{ (Request::get('subject_id') == $subject_id) ? 'selected' : '' }} value="{{ $subject_id }}">{{ $subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Classe</label>
                                        <select class="form-control " id="getClass" name="class_id">
                                            <option value="">Sélectionner une classe</option>
                                            @foreach ($getClass as $class_id=>$class_name)
                                                <option {{ (Request::get('class_id') == $class_id) ? 'selected' : '' }} value="{{ $class_id }}">{{ $class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nom de l'étudiant</label>
                                        <select class="form-control select2" name="student_id">
                                            <option {{ (Request::get('student_id') == '') ? 'selected' : '' }} value="">Tous les étudiants</option>
                                            @foreach($getStudent as $value)
                                                <option {{ (Request::get('student_id') == $value['id']) ? 'selected' : '' }} value="{{$value['id']}}">{{$value['name']}} {{$value['last_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Date</label>
                                        <input type="date" id="getAttendanceDate" class="form-control" name="attendance_date" value="{{ Request::get('attendance_date') }}" placeholder="Date d'assiduité">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Type </label>
                                        <select name="attendance_type" class="form-control ">
                                            <option {{ (Request::get('attendance_type') =='') ? 'selected' : '' }} value="">Tous</option>
                                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : ''}} value="1">Présent</option>
                                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Absent</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 d-flex align-items-end mt-4">
                                        <button class="btn btn-primary">Rechercher</button>
                                        <a href="{{ url('teacher/attendance/report') }}" class="btn btn-success ml-2">Réinitialiser</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    @if(!empty(Request::get('class_id')) || !empty(Request::get('attendance_date')) || !empty(Request::get('student_id')) || !empty(Request::get('subject_id')) || !empty(Request::get('attendance_type')))
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Liste des étudiants</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover" id="attendance-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Identifiant étudiant</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Nom de la classe</th>
                                        <th>Nom de la matière</th>
                                        <th>Date d'assiduité</th>
                                        <th>Heure de début</th>
                                        <th>Heure de fin</th>
                                        <th>Assiduité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value['student_id']}}</td>
                                        <td>{{$value['first_name']}}</td>
                                        <td>{{$value['last_name']}}</td>
                                        <td>{{$value['class_name']}}</td>
                                        <td>{{$value['subject_name']}}</td>
                                        <td>{{date('d-m-Y', strtotime($value['attendance_date']))}}</td>
                                        <td>{{$value['start_time']}}</td>
                                        <td>{{$value['end_time']}}</td>
                                        <td>
                                            @if($value['attendance_type'] == 1)
                                                <span class="badge badge-success">Présent</span>
                                            @else
                                                <span class="badge badge-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucun enregistrement trouvé</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <form method="get" action="{{ route('attendance.export') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                            <input type="hidden" name="student_id" value="{{ Request::get('student_id') }}">
                            <input type="hidden" name="attendance_date" value="{{ Request::get('attendance_date') }}">
                            <input type="hidden" name="attendance_type" value="{{ Request::get('attendance_type') }}">
                            <button type="submit" class="btn btn-primary">Exporter vers Excel</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
