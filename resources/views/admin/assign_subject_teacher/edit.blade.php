@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier l'affectation</h1>
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
                                        <label>Nom du sujet</label>
                                        <select class="form-control" name="subject_id">
                                            <option value="">Sélectionner le sujet</option>
                                            @foreach ($getSubject as $subject)
                                                <option value="{{ $subject->id }}" {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Classe</label>
                                        @foreach ($getClass as $class)
                                            <div>
                                                <label style="font-weight: normal">
                                                    <input type="checkbox" value="{{ $class->id }}" name="class_id[]" 
                                                           {{ in_array($class->id, $assignedClasses) ? 'checked' : '' }}>
                                                    {{ $class->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>                                    
                                    
                                    
                                    <div class="form-group">
                                        <label>Nom du professeur</label>
                                        <select class="form-control" name="teacher_id">
                                            <option value="">Sélectionner le professeur</option>
                                            @foreach ($getTeacher as $teacher)
                                                <option value="{{ $teacher->id }}" {{ $assignment->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                    {{ $teacher->name }} {{ $teacher->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option value="0">Actif</option>
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

