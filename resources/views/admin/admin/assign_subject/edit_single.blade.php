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
                        <h1>Modifier l'attribution de matière</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Nom de la classe</label>
                                        <select class='form-control' name='class_id' required>
                                            <option value="">Sélectionner une classe</option>

                                            @foreach ($getClass as $class )

                                            <option  {{ ( $getRecord->class_id == $class->id ) ? 'selected' : '' }} value="{{ $class->id }}"> {{ $class->name }} </option>

                                            @endforeach

                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Nom de la matière</label>
                                        <select class='form-control' name='subject_id' required>
                                            <option value="">Sélectionner un module</option>

                                            @foreach ($getSubject as $subject )

                                            <option  {{ ( $getRecord->subject_id == $subject->id ) ? 'selected' : '' }} value="{{ $subject->id }}"> {{ $subject->name }} </option>

                                            @endforeach

                                        </select>
                                        
                                    </div>


                                    <div class="form-group">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option {{($getRecord->status == 0 ) ? 'selected' : '' }} value="0">Actif</option>
                                            <option {{($getRecord->status == 1 ) ? 'selected' : '' }} value="1">Inactif</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
