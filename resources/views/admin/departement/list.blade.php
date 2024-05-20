@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des départements (Total : {{ $departements->count() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/departement/add') }}" class="btn btn-primary">Ajouter nouveau département</a>
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

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Liste des département</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom département</th>
                                            <th>Chef de département</th>
                                            <th>Date Création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departements as $departement)
                                            <tr>
                                                <td>{{ $departement->id }}</td>
                                                <td>{{ $departement->name }}</td>
                                                <td>{{ $departement->head_name}} {{ $departement->head_last_name}}</td>
                                                <td>{{ $departement->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('admin/departement/edit/' . $departement->id) }}"
                                                        class="btn btn-primary">Modifier</a>
                                                    <a href="{{ url('admin/departement/delete/' . $departement->id) }}"
                                                        class="btn btn-danger">Supprimer</a>
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