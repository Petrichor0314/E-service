<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>{{ !empty($header_title) ? $header_title : '' }} - School</title>

  <!-- Fonts and Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Plugins CSS -->

  <link rel="stylesheet" href="{{url('public/css/button.css')}}">
  <link rel="stylesheet" href="{{url('public/css/my_account.css')}}">
  <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- Theme style -->
  @livewireStyles
  <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css') }}">

  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  @include('layouts.header')

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  <!-- Control Sidebar -->
  @include('layouts.footer')

</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@yield('scripts')
<script>
    // Directly add the event listener and handle the request
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
            } else {
                $('#module_id').empty().append('<option value="">Select Module</option>');
            }
        });


        
    });
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('public/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('public/plugins/chart.js/Chart.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('public/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- Daterangepicker -->
<script src="{{ url('public/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('public/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('public/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ url('public/dist/js/demo.js') }}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('public/dist/js/pages/dashboard.js') }}"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

@livewireScripts


<!-- Initialize Select2 -->
<script type="text/javascript">
  $(document).ready(function() {
      $('.select2').select2({
          placeholder: 'Select a class',
          allowClear: true
      });
  });
</script>
@yield('script')
</body>
</html>
