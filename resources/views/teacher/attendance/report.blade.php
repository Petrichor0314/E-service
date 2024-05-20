@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="display-4">Attendance Report</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    @include('_messages')

                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Search Student Attendance</h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Subject</label>
                                        <select class="form-control" id="getSubject" name="subject_id">
                                            <option value="">Select Subject</option>
                                            @foreach ($getSubject as $subject_id=>$subject_name)
                                                <option {{ (Request::get('subject_id') == $subject_id) ? 'selected' : '' }} value="{{ $subject_id }}">{{ $subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Class</label>
                                        <select class="form-control" id="getClass" name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach ($getClass as $class_id=>$class_name)
                                                <option {{ (Request::get('class_id') == $class_id) ? 'selected' : '' }} value="{{ $class_id }}">{{ $class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Student Name</label>
                                        <select class="form-control" name="student_id">
                                            <option {{ (Request::get('student_id') == '') ? 'selected' : '' }} value="">All students</option>
                                            @foreach($getStudent as $value)
                                                <option {{ (Request::get('student_id') == $value['id']) ? 'selected' : '' }} value="{{$value['id']}}">{{$value['name']}} {{$value['last_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Attendance Date</label>
                                        <input type="date" id="getAttendanceDate" class="form-control" name="attendance_date" value="{{ Request::get('attendance_date') }}" placeholder="Attendance Date">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Attendance Type</label>
                                        <select name="attendance_type" class="form-control">
                                            <option {{ (Request::get('attendance_type') == '') ? 'selected' : '' }} value="">All</option>
                                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Absent</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ url('teacher/attendance/report') }}" class="btn btn-success ml-2">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    @if(!empty(Request::get('class_id')) || !empty(Request::get('attendance_date')) || !empty(Request::get('student_id')) || !empty(Request::get('subject_id')) || !empty(Request::get('attendance_type')))
                    <div class="card mt-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" >
                            <table class="table table-hover" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Student Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Attendance Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value['student_id']}}</td>
                                        <td>{{$value['first_name']}}</td>
                                        <td>{{$value['last_name']}}</td>
                                        <td>{{$value['class_name']}}</td>
                                        <td>{{$value['subject_name']}}</td>
                                        <td>{{date('d-m-Y',strtotime($value['attendance_date']))}}</td>
                                        <td>{{$value['start_time']}}</td>
                                        <td>{{$value['end_time']}}</td>
                                        <td>
                                            @if($value['attendance_type'] == 1)
                                                <span class="badge badge-success">Present</span>
                                            @else
                                                <span class="badge badge-danger">Absent</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Record not found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                      
                    </div>
                    @endif

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
@section('script')




@endsection