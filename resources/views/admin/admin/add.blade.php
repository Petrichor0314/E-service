@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter nouveau admin</h1>
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
                  <div class="form-group">
                    <label >Prenom</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Nom">
                  </div>
                  <div class="form-group">
                    <label >Nom</label>
                    <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" required placeholder="Prénom">
                  </div>
                  <div class="form-group ">

                    <div class="row">
                        <label for="exampleInputFile">Photo de profil</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input form-control" id="exampleInputFile" name="profile_pic" onchange="updateFileName(this)">
                          <label class="custom-file-label" for="exampleInputFile">Choisir image</label>
                      </div>  
                    </div>
                  

                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class='form-control' name='status'>
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                </div>
                  <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" name="password" required placeholder="Mot de passe">
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