@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
<<<<<<< HEAD
              <form method="POST" action="" enctype="multipart/form-data">
=======
              <form method="POST" action="">
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >First name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Name">
<<<<<<< HEAD
                            <div style="color:red">{{ $errors->first('name') }}</div>

=======
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                          <div class="form-group col-md-6">
                            <label >Last name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Last name">
<<<<<<< HEAD
                            <div style="color:red">{{ $errors->first('last_name') }}</div>

=======
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                    </div>   
                   
                    <div class="row">
                        <div class="form-group col-md-6">
<<<<<<< HEAD
                            <label >CIN <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('CIN') }}" name="CIN" required placeholder="CIN">
                            <div style="color:red">{{ $errors->first('CIN') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >CNE <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('CNE') }}" name="CNE" required placeholder="CNE">
                            <div style="color:red">{{ $errors->first('CNE') }}</div>

=======
                            <label >Admission number <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('admission_number') }}" name="admission_number" required placeholder="Admission number">
                          </div>
                          <div class="form-group col-md-6">
                            <label >roll number <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" required placeholder="roll number">
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                        

                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Class  <span style="color: red;">*</span></label>
                             <select class="form-control" required name="class_id">
                                <option value="">Select Class</option>
<<<<<<< HEAD
                                @foreach($getClass as $value)
                                <option {{(old('class_id')=='$value->id') ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                             </select>
                             <div style="color:red">{{ $errors->first('class_id') }}</div>

=======
                             </select>
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                          <div class="form-group col-md-6">
                            <label >Gender  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
<<<<<<< HEAD
                                <option  value="">Select Gender</option>
                                <option {{(old('gender')=='Male') ? 'selected' : ''}} value="Male">Male</option>
                                <option {{(old('gender')=='Female') ? 'selected' : ''}} value="Female">Female</option>

                             </select>
                             <div style="color:red">{{ $errors->first('gender') }}</div>

=======
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>

                             </select>
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                             
                          </div>
                          
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date of birth <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="date of birth">
<<<<<<< HEAD
                            <div style="color:red">{{ $errors->first('date_of_birth') }}</div>

                            
=======
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                          <div class="form-group col-md-6">
                            <label >Mobile Number <span style="color: red;"></span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number') }}" name="mobile_number"  placeholder="mobile_number">
<<<<<<< HEAD
                            <div style="color:red">{{ $errors->first('mobile_number') }}</div>

=======
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Admission Date <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date" required placeholder="admission date">
<<<<<<< HEAD
                            <div style="color:red">{{ $errors->first('admission_date') }}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Profile Pic <span style="color: red;"></span></label>
                            <input type="file" class="form-control"  name="profile_pic">
                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>

=======
                          </div>
                          <div class="form-group col-md-6">
                            <label >Profile Pic <span style="color: red;"></span></label>
                            <input type="file" class="form-control"  name="profile_date">
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                          </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Status  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="status">
                                <option value="">Select Status</option>
<<<<<<< HEAD
                                <option {{(old('status')=='0') ? 'selected' : ''}} value="0">Active</option>
                                <option {{(old('status')=='1') ? 'selected' : ''}} value="1">Inactive</option>

                             </select>
                             <div style="color:red">{{ $errors->first('status') }}</div>

                             
                          </div>
                    </div>   
                      
=======
                                <option value="0">active</option>
                                <option value="1">inactive</option>

                             </select>
                             
                          </div>
                    </div>         
>>>>>>> 38146f258bcf5bec3cee90430204713377009c1e
                  <hr/>
                  <div class="form-group">
                    <label>Email <span style="color: red;">*</span></label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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