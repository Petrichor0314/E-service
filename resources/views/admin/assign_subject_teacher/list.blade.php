@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"> 
                    <div class="col-sm-6">
                        <h1>Liste des affectations de modules </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/assign_subject_teacher/add') }}" class="button">Affecter un module à un enseignant</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">



                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">

                        <div class  = "card ">
                            <div class="card-header">
                                <h3 class="card-title">Rechercher les affectations de modules</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">

                                        <div class="form-group col-md-2">
                                            <label>Classe</label>
                                            <select class="form-control" name="class">
                                                <option value="">Sélectionner une classe</option>
                                                @foreach ($classes as $class)
                                                    <option {{ (Request::get('class') == $class->name) ? 'selected' : '' }} value="{{ $class->name }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Module</label>
                                            <select class="form-control" name="subject">
                                                <option value="">Sélectionner un module</option>
                                                @foreach ($subjects as $subject)
                                                    <option {{ (Request::get('subject') == $subject->name) ? 'selected' : '' }} value="{{ $subject->name }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Enseignant</label>
                                            <select class="form-control" name="teacher">
                                                <option value="">Sélectionner un enseignant</option>
                                                @foreach ($teachers as $teacher)
                                                    <option {{ (Request::get('teacher') == $teacher->name) ? 'selected' : '' }} value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('admin/assignassign_subject_teacher_subject/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Effacer</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-4">
                           
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>#</th>
                                            <th>Enseignant</th>
                                            <th>Module</th>
                                            <th>Classe</th>
                                            <th>Statut</th>
                                            <th>Créé par</th>
                                            <th>Créé le</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->teacher_name }}</td>
                                            <td style="width: 100px" >{{ $value->subject_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>
                                                @if ($value->status == 0)
                                                Actif
                                                @else
                                                Inactif
                                                @endif
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td style="width: 120px">{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                                            <td style="width: 300px">
                                                <a href="{{ url('admin/assign_subject_teacher/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/assign_subject_teacher/edit_single/' . $value->id) }}" class="btn btn-success">Edit Single</a>
                                                <a href="{{ url('admin/assign_subject_teacher/delete/' . $value->id) }}" style="display: inline" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding : 10px; float : right">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

