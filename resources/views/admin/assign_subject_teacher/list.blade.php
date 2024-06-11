@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"> 
                    <div class="col-sm-6">
                        <h1>Subjects Assignement List </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('admin/assign_subject_teacher/add') }}" class="button">Assign Subject To Teacher</a>
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
                                <h3 class="card-title">Search Subject Assignements</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">

                                        <div class="form-group col-md-2">
                                            <label>Class</label>
                                            <select class="form-control" name="class">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option {{ (Request::get('class') == $class->name) ? 'selected' : '' }} value="{{ $class->name }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Subject</label>
                                            <select class="form-control" name="subject">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option {{ (Request::get('subject') == $subject->name) ? 'selected' : '' }} value="{{ $subject->name }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Teacher</label>
                                            <select class="form-control" name="teacher">
                                                <option value="">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option {{ (Request::get('teacher') == $teacher->name) ? 'selected' : '' }} value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class = "form-group col-md-3">
                                            <label>Date</label>
                                            <input type = "date" class = "form-control" name = "date" value = "{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-3">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Search</button>
                                          <a href="{{ url('admin/assignassign_subject_teacher_subject/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        



                        @include('_messages')

                        <!-- /.card -->

                        <div class="card mt-4">
                           
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1rem ;  white-space: nowrap;">
                                            <th>#</th>
                                            <th>Teacher</th>
                                            <th>Subject</th>
                                            <th>Class</th>
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
                                            <td>{{ $value->teacher_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>
                                                @if ($value->status == 0)
                                                Active
                                                @else
                                                Inactive
                                                @endif
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('m-d-Y', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/assign_subject_teacher/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/assign_subject_teacher/edit_single/' . $value->id) }}" class="btn btn-success">Edit Single</a>
                                                <a href="{{ url('admin/assign_subject_teacher/delete/' . $value->id) }}" class="btn btn-danger">Delete</a>
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
