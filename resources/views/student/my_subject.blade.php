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
    <!-- Content Header (Page header) -->
    <section class="content-header" >
        <div class="container-fluid">
            <div class="row mb-2" style="margin-top: 0.5cm">
                <div class="col-sm-6 display-4 " style="margin-left: 18px">
                    <h1 style="font-family: 'Open Sans', sans-serif; ">Mes Modules <i class="fas fa-book"></i></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 0.75cm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_messages')
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Liste des modules</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" style="background-color: #f8f9fa; color: #333;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th >Nom de Module</th>
                                            <th>Type de module</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                        <tr class="table-row" style="background-color:  #ffffff;">
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->subject_type }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
    <script type="text/javascript">
        // JavaScript for hover effect
        document.addEventListener("DOMContentLoaded", function() {
            const tableRows = document.querySelectorAll(".table-row");
            tableRows.forEach(row => {
                row.addEventListener("mouseover", function() {
                    this.style.backgroundColor = " #9ba8b5";
                });
                row.addEventListener("mouseout", function() {
                    this.style.backgroundColor = " #ffffff";
                });
            });
        });
    </script>
</script>

@endsection

