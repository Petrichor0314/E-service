@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Titre de la page -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier l'affectation d'un module</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- colonne de gauche -->
                    <div class="col-md-12">
                        <!-- Formulaire -->
                        <div class="card card-primary">
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Nom de la classe</label>
                                        <select class='form-control' name='class_id' required>
                                            <option value="">Sélectionner la classe</option>

                                            @foreach ($getClass as $class )

                                            <option  {{ ( $getRecord->class_id == $class->id ) ? 'selected' : '' }} value="{{ $class->id }}"> {{ $class->name }} </option>

                                            @endforeach

                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Nom du module</label>
                                            @foreach ($getSubject as $subject )
                                                @php
                                                    $checked = "";
                                                @endphp
                                                @foreach ($getAssignSubjectID as $subjectAssign )
                                                    @if ($subjectAssign->subject_id == $subject->id)
                                                        @php
                                                            $checked = "checked";
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                                <div>
                                                    <label style="font-weight: normal">
                                                        <input {{$checked   }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]"> {{ $subject->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label>Statut</label>
                                        <select class='form-control' name='status'>
                                            <option {{($getRecord->status == 0 ) ? 'selected' : '' }} value="0">Actif</option>
                                            <option {{($getRecord->status == 1 ) ? 'selected' : '' }} value="1">Inactif</option>
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
                    <!-- colonne de droite -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

