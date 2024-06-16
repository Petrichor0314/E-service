@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assignation des Modules </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/assign_subject/add') }}" class="button">Assigner Module</a>
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
                                <h3 class="card-title">Recherche Assignation de Modules</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">

                                        <div class  = "form-group col-md-3">
                                            <label>Classe</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('class_name') }}" name = "class_name"
                                                 placeholder = "Nom de la Classe">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Module</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('subject_name') }}" name = "subject_name"
                                                 placeholder = "Nom du Sujet">
                                        </div>
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Effacer</a>
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
                                            <th>Id</th>
                                            <th>Classe</th>
                                            <th>Module</th>
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
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>
                                                @if ($value->status==0)
                                                    Actif
                                                @else
                                                    Inactif
                                                @endif
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/assign_subject/edit/' . $value->id) }}"
                                                    class="btn btn-primary">Modifier</a>
                                                <a href="{{ url('admin/assign_subject/edit_single/' . $value->id) }}"
                                                    class="btn btn-success">Modifier un seul</a>
                                                <a href="{{ url('admin/assign_subject/delete/' . $value->id) }}"
                                                    class="btn btn-danger">Supprimer</a>
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

