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
            <h1>Ajouter un nouvel étudiant</h1>
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
              <form method="POST" action="" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Prénom">
                            <div style="color:red">{{ $errors->first('name') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Nom">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>

                          </div>
                    </div>   
                   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >CIN <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('CIN') }}" name="CIN" required placeholder="CIN">
                            <div style="color:red">{{ $errors->first('CIN') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >CNE <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('CNE') }}" name="CNE" required placeholder="CNE">
                            <div style="color:red">{{ $errors->first('CNE') }}</div>

                          </div>
                        

                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Classe  <span style="color: red;">*</span></label>
                             <select class="form-control" required name="class_id">
                                <option value="">Sélectionnez une classe</option>
                                @foreach($getClass as $value)
                                <option {{(old('class_id')=='$value->id') ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                             </select>
                             <div style="color:red">{{ $errors->first('class_id') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Genre  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
                                <option  value="">Sélectionnez le sexe</option>
                                <option {{(old('gender')=='Male') ? 'selected' : ''}} value="Male">Homme</option>
                                <option {{(old('gender')=='Female') ? 'selected' : ''}} value="Female">Femme</option>

                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>

                             
                          </div>
                          
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date de naissance <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="date de naissance">
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>

                            
                          </div>
                          <div class="form-group col-md-6">
                            <label >Numéro de téléphone <span style="color: red;"></span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number') }}" name="mobile_number"  placeholder="numéro de téléphone">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>

                          </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date d'admission <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date" required placeholder="date d'admission">
                            <div style="color:red">{{ $errors->first('admission_date') }}</div>

                          </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputFile">Photo de profil</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input form-control" id="exampleInputFile" name="profile_pic" onchange="updateFileName(this)">
                                <label class="custom-file-label" for="exampleInputFile">Choisir image</label>
                              </div>
                            </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Statut  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="status">
                                <option value="">Sélectionnez un statut</option>
                                <option {{(old('status')=='0') ? 'selected' : ''}} value="0">Actif</option>
                                <option {{(old('status')=='1') ? 'selected' : ''}} value="1">Inactif</option>

                             </select>
                             <div style="color:red">{{ $errors->first('status') }}</div>

                             
                          </div>
                    </div>   
                      
                  <hr/>
                  <div class="form-group">
                    <label>Email <span style="color: red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" name="password" required placeholder="Mot de passe">
                  </div>  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Soumettre</button>
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
