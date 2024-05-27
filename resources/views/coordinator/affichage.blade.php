@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Marks</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form id="marksForm" method="POST" action="{{ route('coordinator.getMarks') }}" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @include('_messages')
                                    <label for="class_id">Select Class</label>
                                    <select class="form-control select2" id="class_id" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="module_id">Select Module</label>
                                    <select class="form-control select2" id="module_id" name="module_id">
                                        <option value="">Select Module</option>
                                    </select>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">View Marks</button>
                                </div>
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
        $('#class_id').change(function() {
            var classId = $(this).val();
            if (classId) {
                var url = '{{ route("teacher.get.modules") }}?class_id=' + classId;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        var moduleSelect = $('#module_id');
                        moduleSelect.empty();
                        moduleSelect.append('<option value="">Select Module</option>');
                        $.each(data.modules, function(index, module) {
                            moduleSelect.append('<option value="' + module.id + '">' + module.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('An error occurred while fetching modules. Please try again.');
                    }
                });
            } else {
                $('#module_id').empty().append('<option value="">Select Module</option>');
            }
        });

        $('.select2').select2();
    });
</script>
@endsection
