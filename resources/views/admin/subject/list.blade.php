@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des modules </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/subject/add') }}" class="button">Ajouter un module</a>
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
                                <h3 class="card-title">Recherche de module</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-3">
                                            <label>Nom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Nom">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Type de module</label>
                                            <select class="form-control" name="type" >
                                                <option value="">Sélectionnez un type</option>
                                                <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Classe théorique</option>
                                                <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Classe pratique</option>
                                            </select>
                                        </div>

                                        
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('admin/subject/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Effacer</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-3">
                            
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>Identifiant</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Statut</th>
                                            <th>Créé par</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($getRecord as $value)
                                            <tr>
                                            <td>{{ $value->id }}</td>
                                            <td style="width:300px">{{ $value->name }}</td>
                                            <td>{{ $value->type }}</td>
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
                                                <a href="{{ url('admin/subject/edit/' . $value->id) }}"
                                                    style="margin-right: 16px;" ><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                <a href="{{ url('admin/subject/delete/' . $value->id) }}"
                                                    ><i class="fa-solid fa-trash fa-lg" style="color: #c11515;"></i></a>
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

