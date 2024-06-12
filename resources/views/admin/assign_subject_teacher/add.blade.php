@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Affecter Nouveau Module à Professeur</h1>
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
                                        <label>Nom de Module</label>
                                        <select class='form-control' name='subject_id' required>
                                            <option value="">Sélectionner un Module</option>
    
                                            @foreach ($getSubject as $subject )
    
                                            <option value="{{ $subject->id}}"> {{ $subject->name }} </option>
    
                                            @endforeach
    
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Classe</label>
                                        <select class="select2" multiple="multiple" name="class_id[]" data-placeholder="Sélectionner une classe" style="width: 100%;">
                                            @foreach ($getClass as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Nom du Professeur</label>
                                        <select class='form-control' name='teacher_id' required>
                                            <option value="">Sélectionner un Professeur</option>
    
                                            @foreach ($getTeacher as $teacher )
    
                                            <option value="{{ $teacher->id}}"> {{ $teacher->name }} {{ $teacher->last_name }} </option>
    
                                            @endforeach
    
                                        </select>
                                        
                                    </div>
                                

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option value="0">Active</option>
                                            <option value="1">Inactif</option>
                                        </select>
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

