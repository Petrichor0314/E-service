@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Teacher</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section> --}}


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Nom</th>
                          <th>Prenom</th>
                          <th>Devoir Surveillé</th>
                          <th>Examen Final</th>
                          <th>Résultat</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <tr>
                          <td>Hmida</td>
                          <td>l3egreb</td>
                          <td>11.4</td>
                          <td>12.5</td>
                          <td><input disabled type="text">R</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>NetFront 3.1</td>
                          <td>Embedded devices</td>
                          <td>-</td>
                          <td>C</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>NetFront 3.4</td>
                          <td>Embedded devices</td>
                          <td>-</td>
                          <td>A</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>Dillo 0.8</td>
                          <td>Embedded devices</td>
                          <td>-</td>
                          <td>X</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>Links</td>
                          <td>Text only</td>
                          <td>-</td>
                          <td>X</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>Lynx</td>
                          <td>Text only</td>
                          <td>-</td>
                          <td>X</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>IE Mobile</td>
                          <td>Windows Mobile 6</td>
                          <td>-</td>
                          <td>C</td>
                        </tr>
                        <tr>
                          <td>Misc</td>
                          <td>PSP browser</td>
                          <td>PSP</td>
                          <td>-</td>
                          <td>C</td>
                        </tr>
                        <tr>
                          <td>Other browsers</td>
                          <td>All others</td>
                          <td>-</td>
                          <td>-</td>
                          <td>U</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div


        </section>
        <!-- /.content -->
    </div>
@endsection





