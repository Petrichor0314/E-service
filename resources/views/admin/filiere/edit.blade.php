@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier une filière</h1>
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

                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" value="{{ $filiere->name }}" name="name" required placeholder="Nom de filière">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Département <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="departement_id">
                                            <option value="">Sélectionner le département</option>
                                            @foreach($departements as $departement)
                                                <option value="{{ $departement->id }}" {{ ($filiere->departements_id == $departement->id) ? 'selected' : '' }}>
                                                    {{ $departement->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('departement_id') }}</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Coordonnateur de filière <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="coord_id">
                                            <option value="">Sélectionner un professeur</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{ ($filiere->coord == $teacher->id) ? 'selected' : '' }}>
                                                    {{ $teacher->name }} {{ $teacher->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div style="color:red">{{ $errors->first('coord_id') }}</div>
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
