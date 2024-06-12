@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier un administrateur</h1>
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
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $getRecord->name) }}" required placeholder="Prénom">
                                    </div>
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ old('last_name', $getRecord->last_name) }}" required placeholder="Nom">
                                    </div>
                                    <div class="form-group ">
                                        <label>Photo de profil <span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="profile_pic">
                                        <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                        @if (!empty($getRecord->getProfile()))
                                            <img src="{{ $getRecord->getProfile() }}"
                                                style="width: auto; height: 50px;">
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $getRecord->email) }}" required placeholder="Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mot de passe</label>
                                        <input type="text" class="form-control" name="password" placeholder="Nouveau mot de passe">
                                        <p>Entrez un nouveau mot de passe ici, sinon laissez vide</p>
                                    </div>
                                </div>
                                <div class="card-footer">
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

