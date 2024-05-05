@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page headerr) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List (Total : {{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add new Student</a>
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
                                                    <img src="{{$value->getProfile()}}" style="height: :50px; width:50px; border-radius:50px">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }} {{$value->last_name}}</td>
                                                <td>{{$value->gender}}</td>
                                                <td>{{$value->admission_number}}</td>
                                                <td>{{$value->roll_number}}</td>
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
                                                <td>{{ date('m-d-Y H:i A',strtotime($value->created_at)) }}</td>
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
