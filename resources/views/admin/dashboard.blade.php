@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Admin Dashboard</h1>
        </div>  
       
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Enseignants</span>
                  <span class="info-box-number">{{$TotalTeacher}}</span>
                 
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Etudiants</span>
                  <span class="info-box-number">{{$TotalStudent}}</span>
                  
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Classes</span>
                  <span class="info-box-number">{{$TotalClass}}</span>
                 
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Modules</span>
                  <span class="info-box-number">{{$TotalSubject}}</span>
                  
              </div>
          </div>
      </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
     
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection