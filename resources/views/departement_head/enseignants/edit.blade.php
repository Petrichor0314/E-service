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
            <h1>Modifier enseignant</h1>
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
              <form method="POST" action="{{ url('head/enseignants/update/' . $enseignant->id) }}" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name', $enseignant->name) }}" name="name" required placeholder="Name">
                            <div style="color:red">{{ $errors->first('name') }}</div>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name', $enseignant->last_name) }}" name="last_name" required placeholder="Last name">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>
                          </div>
                    </div>   

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>CIN <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('CIN', $enseignant->CIN) }}" name="CIN" required placeholder="CIN">
                            <div style="color:red">{{ $errors->first('CIN') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender <span style="color: red;">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{ (old('gender', $enseignant->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ (old('gender', $enseignant->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>
                          </div>
                    </div>  

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Date de naissance <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth', $enseignant->date_of_birth) }}" name="date_of_birth" required placeholder="date of birth">
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Numéro de téléphone <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('mobile_number', $enseignant->mobile_number) }}" name="mobile_number" placeholder="mobile_number">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>
                          </div>
                    </div>   

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Status <span style="color: red;">*</span></label>
                            <select class="form-control" required name="status">
                                <option value="">Select Status</option>
                                <option {{ (old('status', $enseignant->status) == '0') ? 'selected' : '' }} value="0">Active</option>
                                <option {{ (old('status', $enseignant->status) == '1') ? 'selected' : '' }} value="1">Inactive</option>
                            </select>
                            <div style="color:red">{{ $errors->first('status') }}</div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Photo de profile</label>
                        <input type="file" class="form-control" name="profile_pic">
                        <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                      </div>

                      @if (!empty($enseignant->getProfile()))
                      <div class="form-group col-md-6">
                          <img src="{{ $enseignant->getProfile() }}" style="height:100px; width:100px; border-radius:50px;" alt="">
                      </div>
                      @endif
                 
                  <hr/>
                  <div class="form-group">
                    <label>Email <span style="color: red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email', $enseignant->email) }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Password (Laisser vide si vous ne voulez pas changer)">
                  </div>  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
