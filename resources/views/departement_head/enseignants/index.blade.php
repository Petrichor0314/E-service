@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des enseignants (Total : <span id="enseignants-count">{{ $enseignants->total() }}</span>)</h1>
                </div>
                <div class="col-sm-6" style="text-align : right;">
                    <a href="{{ url('head/enseignants/add') }}" class="button">Ajouter nouveau enseignant</a>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Nom</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Nom d'enseignant">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Last name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Email</label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sexe</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Selectionner le sexe</option>
                                        <option value="Male">M</option>
                                        <option value="Female">F</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Numéro de télé</label>
                                    <input type="text" id="mobile_number" class="form-control" name="mobile_number" placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Status</option>
                                        <option value="100">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Date de création</label>
                                    <input type="date" id="date" class="form-control" name="date">
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    @include('_messages')

                    <div class="card">
                       
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead class="bg-success">
                                    <tr style="font-size: 1.1rem ;  white-space: nowrap;"  >
                                        <th>#</th>
                                        <th>Profile</th>
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
                                <tbody id="enseignants-body">
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
                                        <td>{{ $enseignant->mobile_number }}</td>
                                        <td>
                                            @if ($enseignant->status == 0)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{ date('m-d-Y H:i A', strtotime($enseignant->created_at)) }}</td>
                                        <td style="min-width: 150px;">
                                            <a href="{{ url('head/enseignants/edit/' . $enseignant->id) }}" style="margin-right: 20px" ><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                            <a href="{{ url('head/enseignants/delete/' . $enseignant->id) }}"><i class="fa-solid fa-trash fa-lg" style="color: #c11515; display:inline"></i></a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('name').addEventListener('input', fetchEnseignants);
        document.getElementById('last_name').addEventListener('input', fetchEnseignants);
        document.getElementById('email').addEventListener('input', fetchEnseignants);
        document.getElementById('gender').addEventListener('change', fetchEnseignants);
        document.getElementById('mobile_number').addEventListener('input', fetchEnseignants);
        document.getElementById('status').addEventListener('change', fetchEnseignants);
        document.getElementById('date').addEventListener('input', fetchEnseignants);
        document.getElementById('search').addEventListener('click', function(e) {
            e.preventDefault();
            fetchEnseignants();
        });

        function fetchEnseignants() {
            let name = document.getElementById('name').value;
            let last_name = document.getElementById('last_name').value;
            let email = document.getElementById('email').value;
            let gender = document.getElementById('gender').value;
            let mobile_number = document.getElementById('mobile_number').value;
            let status = document.getElementById('status').value;
            let date = document.getElementById('date').value;

            let url = "{{ route('enseignants.search') }}";

            fetch(url + '?name=' + name + '&last_name=' + last_name + '&email=' + email + '&gender=' + gender + '&mobile_number=' + mobile_number + '&status=' + status + '&date=' + date, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                let tbody = document.getElementById('enseignants-body');
                let count = document.getElementById('enseignants-count');
                tbody.innerHTML = '';
                count.innerHTML = data.length;

                data.forEach(enseignant => {
                    let row = `
                        <tr>
                            <td>${enseignant.id}</td>
                            <td>${enseignant.profile ? `<img src="${enseignant.profile}" style="height:50px; width:50px; border-radius:50px;" alt="">` : ''}</td>
                            <td>${enseignant.name} ${enseignant.last_name}</td>
                            <td>${enseignant.email}</td>
                            <td>${enseignant.gender}</td>
                            <td>${enseignant.department}</td>
                            <td>${enseignant.mobile_number}</td>
                            <td>${enseignant.status == 0 ? 'Active' : 'Inactive'}</td>
                            <td>${enseignant.created_at}</td>
                            <td style="min-width: 150px;">
                                <a href="head/enseignants/edit/${enseignant.id}" class="btn btn-primary">Modifier</a>
                                <a href="head/enseignants/delete/${enseignant.id}" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error fetching enseignants:', error));
        }
    });
</script>
@endsection
