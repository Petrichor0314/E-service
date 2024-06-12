@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="container">
        <h1>Notes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Note de DS</th>
                    <th>Note d'examen final</th>
                    <th>Note totale</th>
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
            <button type="submit" class="btn btn-success">Exporter vers CSV</button>
        </form>
        <form action="{{ route('coordinator.exportMarks', 'excel') }}" method="get" class="d-inline">
            <input type="hidden" name="class_id" value="{{ request('class_id') }}">
            <input type="hidden" name="module_id" value="{{ request('module_id') }}">
            <button type="submit" class="btn btn-success">Exporter vers Excel</button>
        </form>
        <form action="{{ route('coordinator.exportMarks', 'pdf') }}" method="get" class="d-inline">
            <input type="hidden" name="class_id" value="{{ request('class_id') }}">
            <input type="hidden" name="module_id" value="{{ request('module_id') }}">
            <button type="submit" class="btn btn-danger">Télécharger en PDF</button>
        </form>
        <form action="{{ route('coordinator.archiveMarks') }}" method="post" class="d-inline">
            @csrf
            <input type="hidden" name="class_id" value="{{ request('class_id') }}">
            <input type="hidden" name="module_id" value="{{ request('module_id') }}">
            <button type="submit" class="btn btn-warning">Archiver les notes</button>
        </form>
    </div>
</div>
@endsection

