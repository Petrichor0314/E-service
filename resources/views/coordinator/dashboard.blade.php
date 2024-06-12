@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <!-- Content Header (Page header) --> 
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0"  style="font-family:Arial, sans-serif;">Coordinateur de Secteur Tableau de Bord</h1>
        </div><!-- /.col -->
       
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Enseignants</span>
                  <span class="info-box-number">{{$TotalTeacher}}</span>
                 
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Etudiants</span>
                  <span class="info-box-number">{{$TotalStudent}}</span>
                  
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Classes</span>
                  <span class="info-box-number">{{$TotalClass}}</span>
                 
              </div>
          </div>
      </div>
      
      <div class="col-lg-3 col-6">
          <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text">Nombre Total des Modules</span>
                  <span class="info-box-number">{{$TotalSubject}}</span>
                  
              </div>
          </div>
      </div>
      
        <!-- ./col -->
      </div>
      
      <div class="row mt-4">
        <div class="col-lg-7 col-6  ">
          <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>  
        </div>
        <div class="col-lg-5 col-6">
          <canvas id="pie-chart" width="800" height="450"></canvas>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
   var data = {!! json_encode(['TotalMaleStudent' => $TotalMaleStudent, 'TotalFemaleStudent' => $TotalFemaleStudent]) !!};
    var TotalMaleStudent =  data.TotalMaleStudent; 
    var TotalFemaleStudent =data.TotalFemaleStudent; 
   new Chart(document.getElementById("pie-chart"), {  
    type: 'pie',
    data: {
      labels: ["Étudiants Masculins", "Etudiantes Féminines "],
      datasets: [{
        label: "Etudiants",
        backgroundColor: ["#3e95cd", "#8e5ea2"],
        data: [TotalMaleStudent,TotalFemaleStudent]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Nombre total d’étudiants par sexe'
      }
    }
});
</script>
<script type="text/javascript">
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: { 
      labels: ["","Génie Informatique","Ingénierie des Données", "Transformation Digitale & Intelligence Artificielle", "Génie Civil", "Génie de l'Eau et de l'Environnement","Génie Energétique et Energie Renouvelable","Génie Mécanique"],
      datasets: [
        {
          label: "Nombre des étudiants",
          backgroundColor: ["","#3e95cd","#8e5ea2","#3cba9f","#e8c3b9","#c45850","#b7ff2b","#4a0000"],
          data: [0,50,43,30,60,35,53,35]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Nombre des étudiants dans chaque filière'
      }
    }
});
  </script>
@endsection
