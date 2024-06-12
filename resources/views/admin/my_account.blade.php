@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- Page Heading -->
            <h1>Mon Compte</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Card -->
            <div class="card card-primary card-outline"> 
             <div class="card-body box-profile">
              <div class="text-center">
                <!-- Profile Picture -->
                <img class="profile-user-img img-circle img-fluid elevation-2"  style="height: 105px; width: 105px" 
                src="{{ Auth::user()->getProfileDirect() }}"
                     alt="Profile Picture">  
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>

              <p class="text-muted text-center">Admin</p>

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

              {{-- <!-- View Timetable Button -->
              <a href="{{ url('student/my_timetable') }}" class="btn btn-primary btn-block"><b>Horaire</b></a> --}}
             </div>
            </div>


          </div>
          <div class="col-md-9">
            <!-- Display Messages -->
            @include('_messages')

            <!-- Account Form -->
            <div class="card">
            <div  class="card-body">
              <!-- Account Form -->
              <form method="POST" action="">
                {{  csrf_field() }}
                <div class="card-body">
                  <div class="row">  
                  <div class="form-group col-md-6">
                    <!-- First Name -->
                    <label >Prénom</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',$getRecord->name) }}" required placeholder="Prénom">
                  </div>
                  <div class="form-group col-md-6">
                    <!-- Last Name -->
                    <label>Nom</label>
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name',$getRecord->last_name) }}" required placeholder="Nom">
                    <div style="color:red">{{ $errors->first('last_name') }}</div>
                  </div>
                  
                  </div>
                  
                  <div class="row">
                       
                    <div class="form-group col-md-6">
                      <!-- Gender -->
                      <label >Sexe  <span style="color: red;"></span></label>
                       <select class="form-control"  required name="gender">
                          <option  value="">Choisissez le sexe</option>
                          <option {{(old('gender',$getRecord->gender)=='Male') ? 'selected' : ''}} value="Male">Masculin</option>
                          <option {{(old('gender',$getRecord->gender)=='Female') ? 'selected' : ''}} value="Female">Féminin</option>

                       </select>
                       <div style="color:red">{{ $errors->first('gender') }}</div>

                       
                    </div>
                    <div class="form-group col-md-6">
                      <!-- Mobile Number -->
                      <label >Numéro de Téléphone <span style="color: red;"></span></label>
                      <input type="text" class="form-control"  value="{{ old('mobile_number',$getRecord->mobile_number) }}" name="mobile_number"  placeholder="Numéro de Téléphone">
                      <div style="color:red">{{ $errors->first('mobile_number') }}</div>

                    </div>
                    
              </div>  
              <div class="row">
                <div class="form-group col-md-6">
                    <!-- Date of Birth -->
                    <label >Date de Naissance <span style="color: red;"></span></label>
                    <input type="date" class="form-control" required value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" name="date_of_birth" required placeholder="Date de Naissance">
                    <div style="color:red">{{ $errors->first('date_of_birth') }}</div>

                    
                  </div>
                  <div class="form-group col-md-6">
                    <!-- Profile Picture -->
                    <label >Photo de Profil <span style="color: red;"></span></label>
                    <input type="file" class="form-control"  name="profile_pic">
                    <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                    @if(!empty($getRecord->getProfile()))
                      <img src="{{$getRecord->getProfile()}}" style="width: auto; height: 50px;">
                    @endif  

                  </div>  
                 
            </div>   
            </div>   
                  <div class="row">  
                    
                    <div class="form-group col-md-6">
                      <!-- Email -->
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email) }}" required placeholder="Email">
                      <div style="color:red">{{ $errors->first('email') }}</div>
                    </div>
                    
                    </div>
                </div>
                <div class="card-footer">
                  <!-- Update Button -->
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
