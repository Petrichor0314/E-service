@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
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
                                <h3 class="card-title">Search Student</h3>
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
                                            <label>Class</label>
                                            <select class="form-control" name="class">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option {{ (Request::get('class') == $class->name) ? 'selected' : '' }} value="{{ $class->name }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Gender</label>
                                            
                                                 <select class="form-control"   name="gender">
                                                    <option  value="">Select Gender</option>
                                                    <option {{(Request::get('gender')=='male') ? 'selected' : ''}} value="male">Male</option>
                                                    <option {{(Request::get('gender')=='female') ? 'selected' : ''}} value="female">Female</option>
                    
                                                 </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Mobile Number</label>
                                            <input type = "text" class = "form-control" name = "mobile_number" value = "{{ Request::get('mobile_number') }}"
                                                 placeholder = "Mobile Number">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Admission date</label>
                                            <input type = "date" class = "form-control" name = "admission_date" value = "{{ Request::get('admission_date') }}"
                                                 placeholder = "admission date">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Date of birth</label>
                                            <input type = "date" class = "form-control" name = "date_of_birth" value = "{{ Request::get('date_of_birth') }}"
                                                 placeholder = "date of birth">
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Status</label>
                                            <select class="form-control"   name="status">
                                                <option value="">Select Status</option>
                                                <option {{(Request::get('status')=='100') ? 'selected' : ''}} value="100">Active</option>
                                                <option {{(Request::get('status')=='1')? 'selected' : ''}} value="1">Inactive</option>
                
                                             </select>
                                        </div>
                                        <div class = "form-group col-md-2">
                                            <label>Created Date</label>
                                            <input type = "date" class = "form-control" name = "created_at" value = "{{ Request::get('created_at') }}"
                                                 placeholder = "Created Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Search</button>
                                          <a href="{{ url('admin/student/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>




                        @include('_messages')

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Profile Pic</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>CIN</th>
                                            <th>CNE</th>
                                            <th>Class Name</th>
                                            <th>Status</th>
                                            <th>Date of birth</th>
                                            <th>Admission Date</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Created at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if(!empty($value->getProfile()))
                                                    <img src="{{$value->getProfile()}}" style="height:50px; width:50px; border-radius:50px">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }} {{$value->last_name}}</td>
                                                <td>{{$value->gender}}</td>
                                                <td>{{$value->CIN}}</td>
                                                <td>{{$value->CNE}}</td>
                                                <td>{{$value->class_name}}</td>
                                                <td>{{($value->Status==0)? 'Active':'Inactive'}}</td>
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
                                                    <a href="{{ url('admin/student/edit/' . $value->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="{{ url('admin/student/delete/' . $value->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
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
