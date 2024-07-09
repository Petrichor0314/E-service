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
          <span class="badge badge-warning navbar-badge">{{$unreadCount}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
          <span class="dropdown-item dropdown-header" style="color: green">{{$unreadCount}} Notifications</span>
          <div class="dropdown-divider"></div>
          @if($notifications->count() > 0)
          <ul>
              @foreach($notifications as $notification)
                  <li>
                      {{ $notification->message }}
                      <a href="{{ route('student.markAsRead', $notification->id) }}">Marquer comme lu</a>
                  </li>
              @endforeach
          </ul>
      @else
          <p style="text-align: center;">Aucune nouvelle notification.</p>
      @endif
         
         
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
                    <h1>Mes Notes</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Note de DS</th>
                                        <th>Note d'Examen Final</th>
                                        <th>Note Totale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($marks as $mark)
                                        <tr>
                                            <td>{{ $mark->module_name }}</td>
                                            <td>{{ $mark->midterm }}</td>
                                            <td>{{ $mark->final_exam }}</td>
                                            <td style="color: {{ $mark->total >= 12 ? 'green' : 'red' }};">
                                                {{ $mark->total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Moyenne Totale</th>
                                        <th>{{ number_format($averageTotalMark, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <a href="{{ route('student.downloadMarksPdf') }}" class="btn btn-danger mt-3">Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

