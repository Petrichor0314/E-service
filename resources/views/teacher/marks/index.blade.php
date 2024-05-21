@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Enter Marks</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form id="marksForm" method="POST" action="{{ route('teacher.marks.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="class_id">Select Class</label>
                                    <select class="form-control" id="class_id" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="module_id">Select Module</label>
                                    <select class="form-control" id="module_id" name="module_id">
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Enter Marks</label>
                                    <table class="table table-bordered" id="marksTable">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Midterm Mark</th>
                                                <th>Final Exam Mark</th>
                                                <th>Total Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Student marks will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Marks</button>
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
    document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    const classSelect = document.getElementById('class_id');
    const moduleSelect = document.getElementById('module_id');

    classSelect.addEventListener('change', function () {
        console.log('Class changed');
        const classId = this.value;
        console.log('Selected class ID:', classId);
        if (classId) {
            fetch('{{ route("teacher.getModules") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ class_id: classId })
            })
            .then(response => {
                console.log('Response received');
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);
                moduleSelect.innerHTML = '<option value="">Select Module</option>';
                data.modules.forEach(module => {
                    const option = document.createElement('option');
                    option.value = module.id;
                    option.textContent = module.name;
                    moduleSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
        } else {
            moduleSelect.innerHTML = '<option value="">Select Module</option>';
        }
    });
});

</script>
@endsection
