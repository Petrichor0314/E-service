@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des modules de département </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('head/modules/add') }}" class="btn btn-primary">Ajouter nouveau module</a>
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
                                <h3 class="card-title">Consulter un module</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-3">
                                            <label>Nom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Nom de module">
                                        </div>
                                        
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date d'ajout">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('head/modules/index') }}" class="btn btn-success" style="margin-top: 31.5px;">Annuler</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste des modules</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom de module</th>
                                            <th>Crée par</th>
                                            <th>Date de création</th>
                                            <th>Dernière modification</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($modules as $module)
                                            <tr>
                                            <td>{{ $module->id }}</td>
                                            <td>{{ $module->name }}</td>
                                
                                            <td>{{ $module->creator->name }} {{ $module->creator->last_name }}</td>
                                            <td>{{ date('m-d-Y H:i A', strtotime($module->created_at)) }}</td>
                                            <td>{{ date('m-d-Y H:i A', strtotime($module->updated_at)) }}</td>
                                            <td>
                                                <a href="{{ url('head/modules/edit/' . $module->id) }}"
                                                    class="btn btn-primary">Modifier</a>
                                                <a href="{{ url('head/modules/delete/' . $module->id) }}"
                                                    class="btn btn-danger">Supprimer</a>
                                            </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                <div style="padding : 10px; float : right">
                                    {!! $modules->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
