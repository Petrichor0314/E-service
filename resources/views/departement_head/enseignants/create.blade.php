@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter enseignant</h1>
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
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Name">
                            <div style="color:red">{{ $errors->first('name') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Nom <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Last name">
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
                            <label >Gender  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
                                <option  value="">Select Gender</option>
                                <option {{(old('gender')=='Male') ? 'selected' : ''}} value="Male">Male</option>
                                <option {{(old('gender')=='Female') ? 'selected' : ''}} value="Female">Female</option>

                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>
    
                          </div>
                          
                    </div>  

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date de naissance <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="date of birth">
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>

                            
                          </div>
                          <div class="form-group col-md-6">
                            <label >Numéro de téléphone <span style="color: red;">*</span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number') }}" name="mobile_number"  placeholder="mobile_number">
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>

                          </div>
                    </div>   
                    <div class="row">
 
                        <div class="form-group col-md-6">
                            <label >Status  <span style="color: red;">*</span></label>
                            <select class="form-control"  required name="status">
                                <option value="">Select Status</option>
                                <option {{(old('status')=='0') ? 'selected' : ''}} value="0">Active</option>
                                <option {{(old('status')=='1') ? 'selected' : ''}} value="1">Inactive</option>
                                
                            </select>
                            <div style="color:red">{{ $errors->first('status') }}</div>
                            
                            
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
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Mot de passe <span style="color: red;">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ajouter</button>
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