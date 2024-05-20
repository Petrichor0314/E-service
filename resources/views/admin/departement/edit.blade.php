@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modifier un département</h1>
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
                                        <input type="text" class="form-control" value="{{ $departement->name }}" name="name" required
                                            placeholder="Nom de département">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label >Chef de département  <span style="color: red;">*</span></label>
                                         <select class="form-control"  name="head_id">
                                            <option value="">Sélectionner un professeur</option>
                                            @foreach($teachers as $teacher)
                                            <option {{(old('teacher_id')=='$teacher->id') ? 'selected' : ''}} value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->last_name}}</option>
                                            @endforeach
                                         </select>
                                         <h6 style="color:red">Laisser vide pour avoir le chef département actuel</h6>
                                         <div style="color:red">{{ $errors->first('teacher_id') }}</div>
            
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
