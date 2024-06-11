@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/teacher/add') }}" class="button">Add New Teacher</a>
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
                                <h3 class="card-title">Search Teacher</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-2">
                                            <label>Name</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('name') }}" name = "name"
                                                 placeholder = "Name">
                                        </div>

                                        <div class  = "form-group col-md-2">
                                            <label>Last Name</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('last_name') }}" name = "last_name"
                                                 placeholder = "Last Name">
                                        </div>

                                        <div class  = "form-group col-md-2">
                                            <label>Email</label>
                                            <input type = "text" class = "form-control" value = "{{ Request::get('email') }}" name = "email"
                                                 placeholder = "Email">
                                        </div>

                                        <div class  = "form-group col-md-2">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" >
                                                <option value="">Select Gender</option>
                                                <option {{ (Request::get('type') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (Request::get('type') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class = "form-group col-md-2">
                                            <label>Mobile Number</label>
                                            <input type = "text" class = "form-control" name = "mobile_number" value = "{{ Request::get('mobile_number') }}"
                                                 placeholder = "Mobile Number">
                                        </div>

                                        {{-- <div class = "form-group col-md-2">
                                            <label>Marital Status</label>
                                            <input type = "text" class = "form-control" name = "marital_status" value = "{{ Request::get('marital_status') }}"
                                                 placeholder = "Marital Status">
                                        </div> --}}

                                        {{-- <div class = "form-group col-md-2">
                                            <label>Current Address</label>
                                            <input type = "text" class = "form-control" name = "address" value = "{{ Request::get('address') }}"
                                                 placeholder = "Current Address">
                                        </div> --}}

                                        <div class  = "form-group col-md-2">
                                            <label>Status</label>
                                            <select class="form-control" name="status" >
                                                <option value="">Status</option>
                                                <option {{ (Request::get('type') == 100) ? 'selected' : '' }} value="100">Active</option>
                                                <option {{ (Request::get('type') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                            </select>
                                        </div>

                                        {{-- <div class = "form-group col-md-2">
                                            <label>Date Of Joining</label>
                                            <input type = "date" class = "form-control" name = "admission_date" value = "{{ Request::get('admission_date') }}">
                                        </div> --}}

                                        <div class = "form-group col-md-2">
                                            <label>Created Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"> 
                                        </div>

                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Search</button>
                                          <a href="{{ url('admin/teacher/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Clear</a>
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
                                            <th>Profile Pic</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Date Of Birth</th>
{{--                                             <th>Date Of Joining</th>
 --}}                                            <th>Mobile Number</th>
{{--                                             <th>Marital Status</th>
 --}}{{--                                             <th>Address</th>
 --}}                                       <th>Status</th>
                                            <th>Created at</th>
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

                                            {{-- <td>
                                                @if (!empty($value->admission_date))                                               
                                                {{ date('m-d-Y ', strtotime($value->admission_date)) }}
                                                @endif
                                            </td> --}}

                                            <td>{{ $value->mobile_number}}</td>
{{--                                             <td>{{ $value->marital_status }}</td>
 --}}{{--                                             <td>{{ $value->address }}</td>
 --}}
                                            <td>
                                                @if ($value->status==0)
                                                    Active
                                                @else
                                                    Inactive
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
