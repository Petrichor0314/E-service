@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container">
        @include('_messages')
        <h1>Sélectionnez les critères pour visualiser les notes archivées</h1>
        <form action="{{ route('coordinator.viewArchivedMarks') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="class_id">Classe</label>
                <select name="class_id" id="class_id" class="form-control select2" required>
                    <option value="">Sélectionnez une classe</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="module_id">Module</label>
                <select name="module_id" id="module_id" class="form-control select2" required>
                    <option value="">Sélectionnez un module</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="year">Année</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Visualiser les notes archivées</button>
        </form>
    </div>

</div>
@endsection

