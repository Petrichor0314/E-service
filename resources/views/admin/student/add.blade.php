@extends('layouts.app')
@section('content')
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
                            <label >Photo de profil <span style="color: red;"></span></label>
                            <input type="file" class="form-control"  name="profile_pic">
                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>

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
