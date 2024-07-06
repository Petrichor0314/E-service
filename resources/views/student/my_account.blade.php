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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="font-family: 'Open Sans', sans-serif;">Mon compte</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline"> 
             <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-circle img-fluid elevation-2"  style="height: 105px; width: 105px" 
                src="{{ Auth::user()->getProfileDirect() }}"
                     alt="Photo de profil">  
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>

              <p class="text-muted text-center">Élève</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Sexe</b> <a class="float-right">{{$getRecord->gender}}</a>
                </li>
                
                <li class="list-group-item">
                  <b>Âge</b> <a class="float-right">{{ carbon\Carbon::parse($getRecord->date_of_birth)->age }} ans</a>
                </li>
                <li class="list-group-item">
                  <b>Téléphone</b> <a class="float-right">{{$getRecord->mobile_number}}</a>
                </li>
                
              </ul>

              <a href="{{ url('student/my_timetable') }}" class="btn btn-primary btn-block"><b>Horaire</b></a>
             </div>
            </div>


          </div>
          <div class="col-md-9">
            @include('_messages')
            <!-- general form elements -->
            <div class="card">
            <div  class="card-body">
              <form method="POST" action="" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" name="name" required placeholder="Prénom">
                            <div style="color:red">{{ $errors->first('name') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name',$getRecord->last_name) }}" name="last_name" required placeholder="Nom">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>

                          </div>
                    </div>   
                   
                    
                    <div class="row">
                       
                          <div class="form-group col-md-6">
                            <label >Genre  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
                                <option  value="">Sélectionner le genre</option>
                                <option {{(old('gender',$getRecord->gender)=='Male') ? 'selected' : ''}} value="Male">Homme</option>
                                <option {{(old('gender',$getRecord->gender)=='Female') ? 'selected' : ''}} value="Female">Femme</option>

                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>

                             
                          </div>
                          <div class="form-group col-md-6">
                            <label >Numéro de téléphone <span style="color: red;"></span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number',$getRecord->mobile_number) }}" name="mobile_number"  placeholder="Numéro de téléphone">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>

                          </div>
                          
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date de naissance <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" name="date_of_birth" required placeholder="Date de naissance">
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>
                        </div>
                        
                          <div class="form-group col-md-6">
                            <label for="exampleInputFile">Photo de profil</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input form-control" id="exampleInputFile" name="profile_pic" onchange="updateFileName(this)">
                              <label class="custom-file-label" for="exampleInputFile">Choisir image</label>
                            </div>
                          </div>  
                    </div>   
                    
                   
                      
                  <hr/>
                  <div class="form-group">
                    <label>Email <span style="color: red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email',$getRecord->email) }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
              </form>
            </div>
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
  <script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerHTML = fileName;
    }
</script>
  <script src="{{url('../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"')}}""></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>
@endsection
