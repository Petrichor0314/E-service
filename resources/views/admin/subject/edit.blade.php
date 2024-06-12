@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier un module</h1>
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
                                        <label>Nom du module</label>
                                        <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required
                                            placeholder="Nom du module">
                                    </div>

                                    <div class="form-group">
                                        <label>Type de sujet</label>
                                        <select class="form-control" name="type" required>
                                            <option value="">Sélectionnez un type</option>
                                            <option {{ ($getRecord->type == 'Theory') ? 'selected' : '' }} value="Theory">Théorie</option>
                                            <option {{ ($getRecord->type == 'Practical') ? 'selected' : '' }} value="Practical">Pratique</option>
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Actif</option>
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactif</option>
                                        </select>
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

