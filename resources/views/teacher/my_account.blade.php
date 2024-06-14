@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
            <div class="card card-primary card-outline"> 
             <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-circle img-fluid elevation-2"  style="height: 105px; width: 105px" 
                src="{{ Auth::user()->getProfileDirect() }}"
                     alt="User profile picture">  
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>

              <p class="text-muted text-center">Professeur</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Sexe</b> <a class="float-right">{{$getRecord->gender}}</a>
                </li>
                
                <li class="list-group-item">
                  <b>Age</b> <a class="float-right">{{ carbon\Carbon::parse($getRecord->date_of_birth)->age }} ans</a>
                </li>
                <li class="list-group-item">
                  <b>Téléphone</b> <a class="float-right">{{$getRecord->mobile_number}}</a>
                </li>
                
              </ul>

              <a href="{{ url('teacher/my_timetable') }}" class="btn btn-primary btn-block"><b>Timetable</b></a>
             </div>
            </div>


          </div>
          <div class="col-md-9">

            @include('_messages')
            
            <div class="card">
             <div class="card-body">

              <form method="POST" action="" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Prénom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name', $getRecord->name ) }}" name="name" required placeholder="Name">
                            <div style="color:red">{{ $errors->first('name') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" required placeholder="Last name">
                            <div style="color:red">{{ $errors->first('last_name') }}</div>

                          </div>
                    </div>   
                   
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label >CIN <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('CIN',$getRecord->CIN) }}" name="CIN" required placeholder="CIN">
                            <div style="color:red">{{ $errors->first('CIN') }}</div>

                        </div>

                        <div class="form-group col-md-6">
                            <label >Sexe  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
                                <option  value="">Select Gender</option>
                                <option {{(old('gender',$getRecord->gender)=='Male') ? 'selected' : ''}} value="Male">Male</option>
                                <option {{(old('gender',$getRecord->gender)=='Female') ? 'selected' : ''}} value="Female">Female</option>

                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>
    
                          </div>
                          
                    </div>  

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date de naissance <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth',$getRecord->date_of_birth) }}" name="date_of_birth" required placeholder="date of birth">
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>

                            
                          </div>
                          <div class="form-group col-md-6">
                            <label >Numéro de téléphone <span style="color: red;">*</span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number',$getRecord->mobile_number) }}" name="mobile_number"  placeholder="mobile_number">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>

                          </div>
                    </div>   
                    <div class="row">
 
                        

                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label >Profile Pic <span style="color: red;"></span></label>
                        <input type="file" class="form-control"  name="profile_pic">
                        <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                    </div> --}}
                    
                    <div class="row">
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