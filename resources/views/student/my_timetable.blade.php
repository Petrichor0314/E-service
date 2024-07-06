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
        <span class="badge badge-warning navbar-badge">{{$unreadCount}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
        <span class="dropdown-item dropdown-header" style="color: green">{{$unreadCount}} Notifications</span>
        <div class="dropdown-divider"></div>
        @if($notifications->count() > 0)
        <ul>
            @foreach($notifications as $notification)
                <li>
                    {{ $notification->message }}
                    <a href="{{ route('student.markAsRead', $notification->id) }}">Marquer comme lu</a>
                </li>
            @endforeach
        </ul>
    @else
        <p style="text-align: center;">Aucune nouvelle notification.</p>
    @endif
       
       
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $header_title }}</h1>
                </div>
            </div>
        </div>
        <div id="pdfTitle" style="display: none">EMPLOI DU TEMPS "{{$getClassName}}"</div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="timetable-img text-center">
                <img src="img/content/timetable.png" alt="">
            </div>
            <div class="table-responsive" style="overflow-x: hidden;">
                @php
                $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                $timeSlots = [
                    '8:30 AM' => '10:30 AM',
                    '10:30 AM' => '12:30 PM',
                    '2:30 PM' => '4:30 PM',
                    '4:30 PM' => '6:30 PM'
                ];
                @endphp

                <table id="myTable" class="table table-bordered text-center">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="text-uppercase"></th>
                            @foreach ($timeSlots as $start => $end)
                                <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">{{ $start }}<span style="margin-right: 70px;"></span>{{ $end }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($days as $dayName)
                            <tr>
                                <td class="align-middle text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>{{ $dayName }}</strong></td>
                                @php
                                $daySlots = array_fill(0, count($timeSlots), null);
                                @endphp
                                @foreach ($getRecord as $subject)
                                    @foreach ($subject['week'] as $week)
                                        @if ($week['week_name'] == $dayName && $week['start_time'] && $week['end_time'])
                                            @foreach ($timeSlots as $startTime => $endTime)
                                                @php
                                                $slotIndex = array_search($startTime, array_keys($timeSlots));
                                                $sessionStart = strtotime($week['start_time']);
                                                $sessionEnd = strtotime($week['end_time']);
                                                $slotStart = strtotime($startTime);
                                                $slotEnd = strtotime($endTime);

                                                // Check if session falls within or overlaps the slot
                                                if (($sessionStart >= $slotStart && $sessionStart < $slotEnd) || 
                                                    ($sessionStart <= $slotStart && $sessionEnd > $slotStart)) {
                                                    $daySlots[$slotIndex][] = $subject['name'];
                                                }
                                                @endphp
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach

                                @foreach ($daySlots as $slot)
                                    @if (is_null($slot))
                                        <td class="empty-cell"></td>
                                    @else
                                        <td>
                                            @foreach ($slot as $subjectName)
                                                <div class="margin-10px-top font-size14">{{ $subjectName }}</div>
                                            @endforeach
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group d-flex justify-content-center">
                  <button onclick="exportTableToPDF()" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> Exporter en PDF
                </button>                    
              </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script type="text/javascript">
  async function exportTableToPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      // Add title
      const title = document.getElementById('pdfTitle').innerText;
      const titleX = doc.internal.pageSize.getWidth() / 2;
      doc.setFontSize(18);
      doc.text(title, titleX, 20, { align: 'center' });

      // Offset the start position of the table
      const startY = 40;

      const elementHTML = document.getElementById('myTable');
      const canvas = await html2canvas(elementHTML);
      const imgData = canvas.toDataURL('image/png');
      const imgProps = doc.getImageProperties(imgData);
      const pdfWidth = doc.internal.pageSize.getWidth();
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

      doc.addImage(imgData, 'PNG', 0, startY, pdfWidth, pdfHeight);
      doc.save('subjects.pdf');
  }

  document.getElementById('exportButton').addEventListener('click', exportTableToPDF);
</script>


<script type="text/javascript">
    $('.getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
            url:"{{url('admin/class_timetable/get_subject')}}",
            type:"POST",
            data:{
                "_token": "{{csrf_token()}}",
                class_id:class_id,
            },
            dataType:"json",
            success:function(response){
             $('.getSubject').html(response.html);
            },
        });

    });
</script>

@endsection
