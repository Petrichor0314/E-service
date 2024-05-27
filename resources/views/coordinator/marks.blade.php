@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Marks</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Midterm Mark</th>
                <th>Final Exam Mark</th>
                <th>Total Mark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentsWithMarks as $data)
                @foreach($data['marks'] as $mark)
                <tr>
                    <td>{{ $data['student']->name }} {{ $data['student']->last_name }}</td>
                    <td>{{ $mark->midterm }}</td>
                    <td>{{ $mark->final_exam }}</td>
                    <td>{{ $mark->total }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('coordinator.exportMarks', 'csv') }}" method="get" class="d-inline">
        <input type="hidden" name="class_id" value="{{ request('class_id') }}">
        <input type="hidden" name="module_id" value="{{ request('module_id') }}">
        <button type="submit" class="btn btn-success">Export to CSV</button>
    </form>
    <form action="{{ route('coordinator.exportMarks', 'excel') }}" method="get" class="d-inline">
        <input type="hidden" name="class_id" value="{{ request('class_id') }}">
        <input type="hidden" name="module_id" value="{{ request('module_id') }}">
        <button type="submit" class="btn btn-success">Export to Excel</button>
    </form>
    <form action="{{ route('coordinator.exportMarks', 'pdf') }}" method="get" class="d-inline">
        <input type="hidden" name="class_id" value="{{ request('class_id') }}">
        <input type="hidden" name="module_id" value="{{ request('module_id') }}">
        <button type="submit" class="btn btn-danger">Download PDF</button>
    </form>
</div>
@endsection
