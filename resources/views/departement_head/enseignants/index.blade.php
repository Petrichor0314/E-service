@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des enseignants (Total : {{ $enseignants->total() }})</h1>
                </div>
                <div class="col-sm-6" style="text-align : right;">
                    <a href="{{ url('head/enseignants/add') }}" class="btn btn-primary">Ajouter nouveau enseignant</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Consulter enseignant</h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Nom d'enseignant">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Sexe</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Selectionner le sexe</option>
                                            <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">M</option>
                                            <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">F</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Numéro de téléphone</label>
                                        <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Status</option>
                                            <option {{ (Request::get('status') == '100') ? 'selected' : '' }} value="100">Active</option>
                                            <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Date de création</label>
                                        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                        <a href="{{ url('head/enseignants/index') }}" class="btn btn-success" style="margin-top: 31.5px;">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('_messages')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des enseignants</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo de profile</th>
                                        <th>Nom complet</th>
                                        <th>Email</th>
                                        <th>Sexe</th>
                                        <th>Département</th>
                                        <th>Numéro de téléphone</th>
                                        <th>Status</th>
                                        <th>Date de création</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enseignants as $enseignant)
                                    <tr>
                                        <td>{{ $enseignant->id }}</td>
                                        <td>
                                            @if (!empty($enseignant->getProfile()))
                                                <img src="{{ $enseignant->getProfile() }}" style="height:50px; width:50px; border-radius:50px;" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $enseignant->name }} {{ $enseignant->last_name }}</td>
                                        <td>{{ $enseignant->email }}</td>
                                        <td>{{ $enseignant->gender }}</td>
                                        <td>{{ $enseignant->department->name }}</td>
                                        <td>{{ $enseignant->mobile_number}}</td>
                                        <td>
                                            @if ($enseignant->status == 0)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{ date('m-d-Y H:i A', strtotime($enseignant->created_at)) }}</td>
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('head/enseignants/edit/' . $enseignant->id) }}" class="btn btn-primary">Modifier</a>
                                            <a href="{{ url('head/enseignants/delete/' . $enseignant->id) }}" class="btn btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                                {!! $enseignants->appends(request()->except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
