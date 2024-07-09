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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Afficher les Notes</h1>
                </div>
            </div>
        </div>
    </section>
    @include('_messages')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form id="marksForm" method="POST" action="{{ route('coordinator.getMarks') }}" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @include('_messages')
                                    <label for="class_id">Sélectionnez une Classe</label>
                                    <select class="form-control select2" id="class_id" name="class_id">
                                        <option value="">Sélectionnez une Classe</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="module_id">Sélectionnez un Module</label>
                                    <select class="form-control select2" id="module_id" name="module_id">
                                        <option value="">Sélectionnez un Module</option>
                                    </select>
                                </div>

                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Afficher les Notes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#class_id').change(function() {
            var classId = $(this).val();
            if (classId) {
                var url = '{{ route("teacher.get.modules") }}?class_id=' + classId;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        var moduleSelect = $('#module_id');
                        moduleSelect.empty();
                        moduleSelect.append('<option value="">Sélectionnez un Module</option>');
                        $.each(data.modules, function(index,module) {
                            moduleSelect.append('<option value="' + module.id + '">' + module.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Une erreur s\'est produite lors de la récupération des modules. Veuillez réessayer.');
                    }
                });
            } else {
                $('#module_id').empty().append('<option value="">Sélectionnez un Module</option>');
            }
        });

        $('.select2').select2();
    });
</script>
@endsection

