@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject List </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/subject/add') }}" class="button">Add New Subject</a>
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
                                <h3 class="card-title">Search Subject</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-3">
                                            <label>Name</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Name">
                                        </div>

                                        <div class  = "form-group col-md-3">
                                            <label>Subject Type</label>
                                            <select class="form-control" name="type" >
                                                <option value="">Select Type</option>
                                                <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory class</option>
                                                <option {{ (Request::get('type') == 'Practical') ? 'selected' : '' }} value="Practical">Practical class</option>
                                            </select>
                                        </div>

                                        
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Search</button>
                                          <a href="{{ url('admin/subject/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-3">
                            
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>Id</th>
                                            <th >Name</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created by</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($getRecord as $value)
                                            <tr>
                                            <td>{{ $value->id }}</td>
                                            <td style="width:300px">{{ $value->name }}</td>
                                            <td>{{ $value->type }}</td>
                                            <td>
                                                @if ($value->status==0)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('m-d-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/subject/edit/' . $value->id) }}"
                                                    style="margin-right: 16px;" ><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                                <a href="{{ url('admin/subject/delete/' . $value->id) }}"
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
