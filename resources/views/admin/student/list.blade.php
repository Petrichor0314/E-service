@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des étudiants (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/student/add') }}" class="button">Ajouter un nouvel étudiant</a>
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
                                <h3 class="card-title">Rechercher un étudiant</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-2">
                                            <label>Prénom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Prénom">
                                        </div>
                                        <div class  = "form-group col-md-2">
                                            <label>Nom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('last_name') }}" name = "last_name"
                                                 placeholder = "Nom">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Email</label>
                                            <input type = "text" class = "form-control" name = "email" value = "{{ Request::get('email') }}"
                                                 placeholder = "Email">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>CIN</label>
                                            <input type = "text" class = "form-control" name = "CIN" value = "{{ Request::get('CIN') }}"
                                                 placeholder = "CIN">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>CNE</label>
                                            <input type = "text" class = "form-control" name = "CNE" value = "{{ Request::get('CNE') }}"
                                                 placeholder = "CNE">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Classe</label>
                                            <select class="form-control" name="class">
                                                <option value="">Sélectionner une classe</option>
                                                @foreach ($classes as $class)
                                                    <option {{ (Request::get('class') == $class->name) ? 'selected' : '' }} value="{{ $class->name }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Sexe</label>
                                            
                                                 <select class="form-control"   name="gender">
                                                    <option  value="">Sélectionner un genre</option>
                                                    <option {{(Request::get('gender')=='male') ? 'selected' : ''}} value="male">Masculin</option>
                                                    <option {{(Request::get('gender')=='female') ? 'selected' : ''}} value="female">Féminin</option>
                    
                                                 </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Numéro de mobile</label>
                                            <input type = "text" class = "form-control" name = "mobile_number" value = "{{ Request::get('mobile_number') }}"
                                                 placeholder = "Numéro de mobile">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Date de naissance</label>
                                            <input type = "date" class = "form-control" name = "date_of_birth" value = "{{ Request::get('date_of_birth') }}"
                                                 placeholder = "Date de naissance">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Date d'inscription</label>
                                            <input type = "date" class = "form-control" name = "admission_date" value = "{{ Request::get('admission_date') }}"
                                                 placeholder = "Date d'inscription">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Statut</label>
                                            <select class="form-control"   name="status">
                                                <option value="">Sélectionner un statut</option>
                                                <option {{(Request::get('status')=='100') ? 'selected' : ''}} value="100">Actif</option>
                                                <option {{(Request::get('status')=='1')? 'selected' : ''}} value="1">Inactif</option>
                
                                             </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Date de création</label>
                                            <input type = "date" class = "form-control" name = "created_at" value = "{{ Request::get('created_at') }}"
                                                 placeholder = "Date de création">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('admin/student/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Réinitialiser</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>




                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-3">
                            
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>ID</th>
                                            <th>Photo de profil</th>
                                            <th>Nom</th>
                                            <th>Genre</th>
                                            <th>CIN</th>
                                            <th>CNE</th>
                                            <th>Nom de la classe</th>
                                            <th>Statut</th>
                                            <th>Date de naissance</th>
                                            <th>Date d'inscription</th>
                                            <th>Numéro de mobile</th>
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
                                                <td>{{ $value->name }} {{$value->last_name}}</td>
                                                <td>{{$value->gender}}</td>
                                                <td>{{$value->CIN}}</td>
                                                <td>{{$value->CNE}}</td>
                                                <td>{{$value->class_name}}</td>
                                                <td>{{($value->Status==0)? 'Actif':'Inactif'}}</td>
                                                <td style="white-space: nowrap;">
                                                    @if(!empty($value->date_of_birth))
                                                    {{date('d-m-Y',strtotime($value->date_of_birth))}}
                                                    @endif
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    @if(!empty($value->admission_date))
                                                    {{date('d-m-Y',strtotime($value->admission_date))}}
                                                    @endif
                                                   </td>
                                                <td>{{$value->mobile_number}}</td>
                                                <td>{{ $value->email }}</td>
                                                <td style="white-space: nowrap;">{{ date('m-d-Y H:i A',strtotime($value->created_at)) }}</td>
                                                <td style="min-width:150px ;">
                                                    <a href="{{ url('admin/student/edit/' . $value->id) }}"  style="margin-right: 20px;"
                                                        ><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                    <a href="{{ url('admin/student/delete/' . $value->id) }}"
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

