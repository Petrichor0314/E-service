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
              <form method="POST" action="">
                {{  csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >First name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Name">
                          </div>
                          <div class="form-group col-md-6">
                            <label >Last name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Last name">
                          </div>
                    </div>   
                   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Admission number <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{ old('admission_number') }}" name="admission_number" required placeholder="Admission number">
                          </div>
                          <div class="form-group col-md-6">
                            <label >roll number <span style="color: red;"></span></label>
                            <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" required placeholder="roll number">
                          </div>
                        

                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Class  <span style="color: red;">*</span></label>
                             <select class="form-control" required name="class_id">
                                <option value="">Select Class</option>
                             </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label >Gender  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>

                             </select>
                             
                          </div>
                          
                    </div>  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Date of birth <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth" required placeholder="date of birth">
                          </div>
                          <div class="form-group col-md-6">
                            <label >Mobile Number <span style="color: red;"></span></label>
                            <input type="text" class="form-control"  value="{{ old('mobile_number') }}" name="mobile_number"  placeholder="mobile_number">
                          </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Admission Date <span style="color: red;">*</span></label>
                            <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date" required placeholder="admission date">
                          </div>
                          <div class="form-group col-md-6">
                            <label >Profile Pic <span style="color: red;"></span></label>
                            <input type="file" class="form-control"  name="profile_date">
                          </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >Status  <span style="color: red;">*</span></label>
                             <select class="form-control"  required name="status">
                                <option value="">Select Status</option>
                                <option value="0">active</option>
                                <option value="1">inactive</option>

                             </select>
                             
                          </div>
                    </div>         
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