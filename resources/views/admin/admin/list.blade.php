@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des Administrateurs (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/admin/add') }}" class="button">Ajouter un nouvel administrateur</a>
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
                                <h3 class="card-title">Rechercher un administrateur</h3>
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
                                            <label>Prénom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('last_name') }}" name = "last_name"
                                                 placeholder = "Prénom">
                                        </div>
                                        <div class = "form-group col-md-3">
                                            <label>Email</label>
                                            <input type = "text" class = "form-control" name = "email" value = "{{ Request::get('email') }}"
                                                 placeholder = "Email">
                                        </div>
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('admin/admin/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Effacer</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card">
                           
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>Id</th>
                                            <th>Photo de profil</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if(!empty($value->getProfileDirect()))
                                                    <img src="{{$value->getProfileDirect()}}" style="height:50px; width:50px; border-radius:50px">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ date('m-d-Y H:i A',strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/admin/edit/' . $value->id) }}"  style="margin-right: 20px;"
                                                        ><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                    <a href="{{ url('admin/admin/delete/' . $value->id) }}"     
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

