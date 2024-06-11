@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des filières (Total : {{ $filieres->count() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/filiere/add') }}" class="button">Ajouter nouvelle filière</a>
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


                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-3">
                          
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>#</th>
                                            <th>Nom filière</th>
                                            <th>Coordonnateur de filière</th>
                                            <th>Département</th>
                                            <th>Date Création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filieres as $filiere)
                                            <tr>
                                                <td>{{ $filiere->id }}</td>
                                                <td style="width: 180px">{{ $filiere->name }}</td>
                                                <td style="width: 100%">{{ $filiere->coord_name}} {{ $filiere->coord_last_name}}</td>
                                                <td style="width: 200px">{{ $filiere->departement_name}}</td>
                                                <td>{{ $filiere->created_at }}</td>
                                                <td>
                                                    <a  href="{{ url('admin/filiere/edit/' . $filiere->id) }}" style="margin-right: 20px"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                    <a  href="{{ url('admin/filiere/delete/' . $filiere->id) }}" style="display: inline"
                                                        ><i class="fa-solid fa-trash fa-lg" style="color: #c11515;"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding : 10px; float : right">
{{--                                     {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
 --}}                                </div>


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
