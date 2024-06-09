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
                        <a href="{{ url('head/modules/add') }}"  class="button">Ajouter nouveau module</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Consulter un module</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Nom</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nom de module">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date</label>
                                        <input type="date" id="date" class="form-control" name="date" placeholder="Date d'ajout">
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                        @include('_messages')

                        <div class="card">
                           
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1.1rem ;  white-space: nowrap;">
                                            <th>#</th>
                                            <th>Nom de module</th>
                                            <th>Crée par</th>
                                            <th>Date de création</th>
                                            <th>Dernière modification</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modules-body">
                                        @foreach($modules as $module)
                                            <tr>
                                                <td>{{ $module->id }}</td>
                                                <td style="width: 200px">{{ $module->name }}</td>
                                                <td>{{ $module->creator->name }} {{ $module->creator->last_name }}</td>
                                                <td>{{ date('m-d-Y H:i A', strtotime($module->created_at)) }}</td>
                                                <td>{{ date('m-d-Y H:i A', strtotime($module->updated_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('head/modules/edit/' . $module->id) }}" style="margin-right: 20px"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                    <a href="{{ url('head/modules/delete/' . $module->id) }}"><i class="fa-solid fa-trash fa-lg" style="color: #c11515; display:inline"></i></a>
                                                </td>   
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right">
                                    {!! $modules->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
  
 </script>


    <script>
        document.getElementById('name').addEventListener('input', function() {
            fetchModules();
        });

        document.getElementById('search').addEventListener('click', function(e) {
            e.preventDefault();
            fetchModules();
        });

        function fetchModules() {
            let name = document.getElementById('name').value;
            let date = document.getElementById('date').value;

            let url = "{{ route('modules.search') }}";

            fetch(url + '?name=' + name + '&date=' + date, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('modules-body');
                tbody.innerHTML = '';

                data.forEach(module => {
                    let row = `
                        <tr>
                            <td>${module.id}</td>
                            <td>${module.name}</td>
                            <td>${module.creator.name} ${module.creator.last_name}</td>
                            <td>${module.created_at}</td>
                            <td>${module.updated_at}</td>
                            <td>
                                <a href="head/modules/edit/${module.id}" style="margin-right: 20px"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                <a href="head/modules/delete/${module.id}"><i class="fa-solid fa-trash fa-lg" style="color: #c11515;"></i></a>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error fetching modules:', error));
        }
    </script>
@endsection
