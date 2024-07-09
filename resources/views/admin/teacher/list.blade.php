@extends('layouts.app')
@section('content')
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
  
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 Notifications</span>    
          <div class="dropdown-divider"></div>
         
          <p>No new notifications.</p>
      
         
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Listes des Enseignants (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/teacher/add') }}" class="button">Ajouter un nouveau enseignant</a>
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
                                <h3 class="card-title">Rechercher un enseignant</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-3">
                                            <label>Prenom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Name">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Nom</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('last_name') }}" name = "last_name"
                                                 placeholder = "Last Name">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Email</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('email') }}" name = "email"
                                                 placeholder = "Email">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Sexe</label>
                                            <select class="form-control" name="gender" >
                                                <option value="">Select Gender</option>
                                                <option {{ (Request::get('type') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (Request::get('type') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class = "form-group col-md-3">
                                            <label>Numero Telephone</label>
                                            <input type = "text" class = "form-control" name = "mobile_number" value = "{{ Request::get('mobile_number') }}"
                                                 placeholder = "Mobile Number">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Status</label>
                                            <select class="form-control" name="status" >
                                                <option value="">Status</option>
                                                <option {{ (Request::get('type') == 100) ? 'selected' : '' }} value="100">Active</option>
                                                <option {{ (Request::get('type') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                            </select>
                                        </div>

                                        <div class = "form-group col-md-3">
                                            <label>Date de creation</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"> 
                                        </div>

                                        <div class = "form-group col-md-4" style="margin-top: 20px" >
                                          <button class="btn btn-primary" >Rechercher</button>
                                          <a href="{{ url('admin/teacher/list') }}" class="btn btn-success ml-2" >Réinitialiser</a>
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
                                            <th>#</th>
                                            <th>Photo de profil</th>
                                            <th>Nom complet</th>
                                            <th>Email</th>
                                            <th>Sexe</th>
                                            <th>Date de naissance</th>
                                            <th>Numéro de téléphone</th>
                                            <th>État </th>
                                            <th>Date de creation</th>
                                        
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>

                                            <td>
                                                @if (!empty($value->getProfileDirect()))
                                                    <img src="{{ $value->getProfileDirect() }}" style="height:50px; width:50px; border-radius:50px;" alt="">
                                                @endif
                                            </td>

                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->gender }}</td>

                                            <td>
                                                @if (!empty($value->date_of_birth))                                               
                                                {{ date('m-d-Y', strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>

                                            <td>{{ $value->mobile_number}}</td>
                                            <td>
                                                @if ($value->status==0)
                                                    Actif
                                                @else
                                                    Inactif
                                                @endif
                                            </td>

                                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ url('admin/teacher/edit/' . $value->id) }}"
                                                     style="margin-right: 20px;"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                <a href="{{ url('admin/teacher/delete/' . $value->id) }}"
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

