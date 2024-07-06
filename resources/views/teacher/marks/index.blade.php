@extends('layouts.app')

@section('content')
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
  
      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">0 Notifications</span>    
          <div class="dropdown-divider"></div>
         
          <p>No new notifications.</p>
      
         
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Entrer les notes</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form id="marksForm" method="POST" action="{{ route('teacher.marks.store') }}" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    @include('_messages')
                                    <label for="class_id">Sélectionnez une classe</label>
                                    <select class="form-control select2" id="class_id" name="class_id">
                                        <option value="">Sélectionnez une classe</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="module_id">Sélectionnez un module</label>
                                    <select class="form-control select2" id="module_id" name="module_id">
                                        <option value="">Sélectionnez un module</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Entrer les notes</label>
                                    <table class="table table-bordered" id="marksTable">
                                        <thead>
                                            <tr>
                                                <th>Élève</th>
                                                <th>Note de la session</th>
                                                <th>Note du bac</th>
                                                <th>Note totale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Notes des étudiants seront ajoutées dynamiquement -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer les notes</button>
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
    function calculateTotal(midterm, finalExam) {
        if (midterm !== '' && finalExam !== '') {
            return ((midterm * 0.4) + (finalExam * 0.6)).toFixed(2);
        }
        return '';
    }

    function applyTotalStyles(totalElement, totalValue) {
        if (totalValue >= 12) {
            totalElement.css('color', 'green');
        } else {
            totalElement.css('color', 'red');
        }
    }

    function validateInput(inputElement) {
        var value = inputElement.val().replace(',', '.'); // Replace comma with dot
        var floatValue = parseFloat(value);
        if (isNaN(floatValue) || floatValue < 0 || floatValue > 20) {
            inputElement.addClass('is-invalid');
            inputElement.next('.invalid-feedback').text('Please enter a valid number between 0 and 20.');
            return false;
        } else {
            inputElement.removeClass('is-invalid');
            inputElement.next('.invalid-feedback').text('');
            return true;
        }
    }

    function convertCommaToDot() {
        $('.midterm, .final_exam').each(function() {
            var value = $(this).val();
            $(this).val(value.replace(',', '.'));
        });
    }

    $(document).ready(function() {
        $('#class_id').change(function() {
            console.log('Class selected');
            var classId = $(this).val();
            if (classId) {
                var url = '{{ route("teacher.get.modules") }}?class_id=' + classId;
                console.log('Fetching modules from URL:', url);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        console.log('Modules fetched:', data); // Debugging statement
                        var moduleSelect = $('#module_id');
                        moduleSelect.empty();
                        moduleSelect.append('<option value="">Select Module</option>');
                        $.each(data.modules, function(index, module) {
                            moduleSelect.append('<option value="' + module.id + '">' + module.name + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Fetch error:', textStatus, errorThrown);
                        alert('An error occurred while fetching modules. Please try again.');
                    }
                });

                // Clear students table when class is changed
                $('#marksTable tbody').empty();
            } else {
                $('#module_id').empty().append('<option value="">Select Module</option>');
                $('#marksTable tbody').empty();
            }
        });

        $('#module_id').change(function() {
            var classId = $('#class_id').val();
            var moduleId = $(this).val();
            if (classId && moduleId) {
                var studentUrl = '{{ route("teacher.get.students.and.marks") }}?class_id=' + classId + '&module_id=' + moduleId;
                console.log('Fetching students and marks from URL:', studentUrl);
                $.ajax({
                    url: studentUrl,
                    method: 'GET',
                    success: function(data) {
                        console.log('Students and marks fetched:', data); // Debugging statement
                        var marksTableBody = $('#marksTable tbody');
                        marksTableBody.empty();
                        $.each(data.students, function(index, student) {
                            var row = '<tr>' +
                                '<td>' + student.name + ' ' + student.last_name + '</td>' +
                                '<td><input type="number" name="midterm[' + student.id + ']" class="form-control midterm" data-student-id="' + student.id + '" value="' + (student.midterm !== null ? student.midterm : '') + '" />' +
                                '<div class="invalid-feedback" ></div></td>' +
                                '<td><input type="number" name="final_exam[' + student.id + ']" class="form-control final_exam" data-student-id="' + student.id + '" value="' + (student.final !== null ? student.final : '') + '" />' +
                                '<div class="invalid-feedback" ></div></td>' +
                                '<td><input type="text" name="total[' + student.id + ']" class="form-control total" value="' + (student.total !== null ? student.total : '') + '" readonly /></td>' +
                                '</tr>';
                            marksTableBody.append(row);
                        });

                        // Attach event listeners to new inputs
                        $('.midterm, .final_exam').on('input', function() {
                            var studentId = $(this).data('student-id');
                            var midterm = $('input[name="midterm[' + studentId + ']"]').val();
                            var finalExam = $('input[name="final_exam[' + studentId + ']"]').val();
                            var total = calculateTotal(midterm, finalExam);
                            var totalElement = $('input[name="total[' + studentId + ']"]');
                            totalElement.val(total);
                            applyTotalStyles(totalElement, total);

                            // Validate inputs
                            validateInput($(this));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Fetch error:', textStatus, errorThrown);
                        alert('An error occurred while fetching students. Please try again.');
                    }
                });
            } else {
                $('#marksTable tbody').empty();
            }
        });

        $('#marksForm').on('submit', function(e) {
            convertCommaToDot(); // Convert commas to dots before submission
            var isValid = true;
            $('.midterm, .final_exam').each(function() {
                if (!validateInput($(this))) {
                    isValid = false;
                }
            });
            if (!isValid) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(".is-invalid").first().offset().top
                }, 1000);
            }
        });
    });

    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection

