@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modules de Filière</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form method="POST" action="{{ route('coordinateur.modules.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="class_id">Select Class</label>
                                    <select class="form-control select2" id="class_ID" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($filieres as $filiere)
                                            @foreach($filiere->classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="module_id">Select Module</label>
                                    <select class="form-control select2" id="module_ID" name="module_id">
                                        <option value="">Select Module</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="teacher_id">Select Teacher</label>
                                    <select class="form-control select2" id="teacher_id" name="teacher_id">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection



@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
