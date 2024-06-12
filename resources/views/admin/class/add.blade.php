@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ajouter nouvelle classe</h1>
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
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group col-md-6">
                                        <label>Nom </label>
                                        <input type="text" class="form-control" name="name" required
                                            placeholder="Nom de classe">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Filière <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="filiere_id">
                                            <option value="">Sélectionner la filière</option>
                                            @foreach($filieres as $filiere)
                                            <option {{ (old('filiere_id') == $filiere->id) ? 'selected' : '' }} value="{{ $filiere->id }}">{{ $filiere->name }}</option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('departements_id') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
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
