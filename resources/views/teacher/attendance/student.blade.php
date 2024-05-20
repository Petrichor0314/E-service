@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Attendance</h1>
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

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Search Student Attendance</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Subject</label>
                                            <select class="form-control" id="getSubject" name="subject_id" required>
                                                <option value="">Select Subject</option>
                                                @foreach ($getSubject as $subject_id => $subject_name)
                                                    <option {{ (Request::get('subject_id') == $subject_id) ? 'selected' : '' }} value="{{ $subject_id }}">{{ $subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Class</label>
                                            <select class="form-control" id="getClass" name="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach ($getClass as $class_id => $class_name)
                                                    <option {{ (Request::get('class_id') == $class_id) ? 'selected' : '' }} value="{{ $class_id }}">{{ $class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Start Time</label>
                                            <select name="start_time" id="getStartTime" class="form-control" required>
                                                <option value="">Select Start Time</option>
                                                <option {{ (Request::get('start_time') == '08:30') ? 'selected' : '' }} value="08:30">08:30</option>
                                                <option {{ (Request::get('start_time') == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                                <option {{ (Request::get('start_time') == '14:30') ? 'selected' : '' }} value="14:30">14:30</option>
                                                <option {{ (Request::get('start_time') == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>End Time</label>
                                            <select name="end_time" id="getEndTime" class="form-control" required>
                                                <option value="">Select End Time</option>
                                                <option {{ (Request::get('end_time') == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                                <option {{ (Request::get('end_time') == '12:30') ? 'selected' : '' }} value="12:30">12:30</option>
                                                <option {{ (Request::get('end_time') == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                                <option {{ (Request::get('end_time') == '18:30') ? 'selected' : '' }} value="18:30">18:30</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Attendance Date</label>
                                            <input type="date" id="getAttendanceDate" class="form-control" name="attendance_date" value="{{ Request::get('attendance_date') }}" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" style="margin-top: 31.5px;  width:3cm">Search</button>
                                            <a href="{{ url('teacher/attendance/student') }}" class="btn btn-secondary" style="margin-top: 31.5px;width:3cm">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
                            <form action="{{ url('teacher/attendance/student/save') }}" method="post">
                                {{ csrf_field() }}
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h3 class="card-title">Student List</h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-hover table-striped">
                                            <thead class="thead-dark">
                                                <tr class="text-center">
                                                    <th>Student Id</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Attendance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($getStudent) && $getStudent->count())
                                                    <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                                                    <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                    <input type="hidden" name="start_time" value="{{ Request::get('start_time') }}">
                                                    <input type="hidden" name="end_time" value="{{ Request::get('end_time') }}">
                                                    <input type="hidden" name="attendance_date" value="{{ Request::get('attendance_date') }}">
                                                    @foreach($getStudent as $value)
                                                        @php
                                                            $attendance_type = '';
                                                            $getAttendance = $value->getAttendance($value->id, Request::get('subject_id'), Request::get('class_id'), Request::get('start_time'), Request::get('end_time'), Request::get('attendance_date'));
                                                            if (!empty($getAttendance->attendance_type)) {
                                                                $attendance_type = $getAttendance->attendance_type;
                                                            }
                                                        @endphp
                                                        <tr class="text-center">
                                                            <td>{{ $value->id }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->last_name }}</td>
                                                            <td>
                                                                <input style="width:30px; height:30px;" type="checkbox" {{ ($attendance_type == '1') ? 'checked' : '' }} name="{{ $value->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">No students found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center p-3">
                                        <button class="btn btn-primary" style="width: 160px">Take Attendance</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
