@extends('layouts.app')
@section('content')
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ajouter ou Modifier une séance  </h1>
                    </div>
                   
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">



                <div class="row">
                    <div class="col-md-12">
                        @include('_messages')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chercher une séance</h3>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Classe</label>
                                            <select class="form-control getClass select2" name="class_id" required>
                                                <option value="">Selectionner</option>
                                                @foreach($getClass as $filiere)
                                                @foreach($filiere->classes as $class)
                                                <option {{Request::get('class_id') == $class->id ? 'selected' : ''}}  value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Module</label>
                                            <select class="form-control getSubject select2" name="subject_id" required>
                                                <option value="">Selectionner</option>
                                                @if(!empty($getSubject))
                                                @foreach($getSubject as $subject)
                                                <option {{Request::get('subject_id') == $subject->module_id ? 'selected' : ''}} value="{{$subject->module_id}}">{{$subject->subject_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Type Séance </label>
                                            <select  name="session_type" class="form-control select2" required>
                                                <option value="">Selectionner</option> 
                                                <option {{Request::get('session_type') == 'COURS' ? 'selected' : ''}} value="COURS">COURS</option>
                                                <option {{Request::get('session_type') == 'TD' ? 'selected' : ''}} value="TD">TD</option>
                                                <option {{Request::get('session_type') == 'TP' ? 'selected' : ''}} value="TP">TP</option>
                                                
                                              </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Rechercher</button>
                                            <a href="{{ url('coordinator/class_timetable/list') }}" class="btn btn-success" style="margin-top: 31.5px;">Réinitialiser</a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        
                       
                        @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')) && !empty(Request::get('session_type')))
                        
                        <form id="myForm" action="{{url('coordinator/class_timetable/add')}}" method="post">
                            {{csrf_field()}}
                            
                            <input type="hidden" name="subject_id" value="{{Request::get('subject_id')}}">
                            <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
                            <input type="hidden" name="session_type" value="{{Request::get('session_type')}}">
                           
                        <div class="card">
                           
                          <p class="btn btn-success " id="toggleButton" style="font-size:20px; display:block;">Afficher <span style="color: black; font-size:22px;">"{{$getClassName}}"</span> Emploi du temps <i class="fa-solid fa-arrow-down" style="color: #ffffff;"></i></p>
                          <p class="btn btn-success " id="toggleButton_2" style="font-size:20px; color:blue; display:none;">Masquer <span style="color: black; font-size:22px;">"{{$getClassName}}"</span> Emploi du temps  <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i></p>
                        
                        <div id="targetElement"  style="display: none; ">
                          <div class="timetable-img text-center">
                              <img src="img/content/timetable.png" alt="">
                          </div>
                          <div class="table-responsive">
                              <table class="table table-bordered text-center">
                                  <thead>
                                      <tr class="bg-light-gray">
                                          <th class="text-uppercase">
                                          </th>
                                          <th style="background-color: rgb(20, 207, 207)" class="text-uppercase" >8h30<span style="margin-right: 107px;"></span>10h30</th>
                                          <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">10h30<span style="margin-right: 107px;"></span>12h30</th>
                                          <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">14h30<span style="margin-right: 107px;"></span>16h30</th>
                                          <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">16h30<span style="margin-right: 107px;"></span>18h30</th>
                                          
                                      </tr>
                                  </thead>  
                                  <tbody>
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Lundi</strong></td>
          
                                          @php
                                          $a = 0;
                                          $b = 0;
                                          $c = 0;
                                          $d = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][0]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          <div class="font-size13 text-light-gray">{{$subject['week'][0]['amphi_name'][$key]}} {{$subject['week'][0]['bloc_name'][$key]}} {{$subject['week'][0]['room_number'][$key]}}</div>
                                                        
                                                      </td>
                                                      @php
                                                      $a = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                      <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                      @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                      @endif
                                                      @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                      @endif
                                                  </td>
                                                      @php
                                                      $a = 1;
                                                     @endphp
                                                  @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($a == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                      <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                      @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                      @endif
                                                      @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                      @endif
                                                  </td>
                                                    @php
                                                    $b = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                      <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                      @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                      @endif
                                                      @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                      @endif
                                                  </td>
                                                    @php
                                                    $b = 1;
                                                @endphp
                                                   @endif
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($b == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                  <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                  @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                  @endif
                                                  @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                  @endif
                                              </td>
                                                  @php
                                                  $c = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                  <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                  @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                  @endif
                                                  @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                  @endif
                                              </td>
                                                  @php
                                                  $c = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($c == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                  <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                  @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                  @endif
                                                  @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                  @endif
                                              </td>
                                                @php
                                                $d = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                  <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                  @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                  @endif
                                                  @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                  @endif
                                              </td>
                                                @php
                                                $d = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($d == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                 
                                      </tr>
          
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Mardi</strong></td>
                                          @php
                                          $A = 0;
                                          $B = 0;
                                          $C = 0;
                                          $D = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                          @endif
                                                         @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                          @endif                                              
                                                      </td>
                                                      @php
                                                      $A = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                      @endif                                              
                                                  </td>
                                                  @php
                                                  $A = 1;
                                                 @endphp
                                              @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($A == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                      @endif                                              
                                                  </td>
                                                    @php
                                                    $B = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                      @endif                                              
                                                  </td>
                                                    @php
                                                    $B = 1;
                                                @endphp
                                                   @endif
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($B == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                  @endif                                              
                                              </td>
                                                  @php
                                                  $C = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                  @endif                                              
                                              </td>
                                                  @php
                                                  $C = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($C == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                  @endif                                              
                                              </td>
                                                @php
                                                $D = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                  @endif                                              
                                              </td>
                                                @php
                                                $D = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($D == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                         
                                         
                                      </tr>
          
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Mercredi</strong></td>
                                          @php
                                          $K = 0;
                                          $L = 0;
                                          $M = 0;
                                          $O = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                          @endif
                                                         @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                          @endif                                                 
                                                      </td>
                                                      @php
                                                      $K = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                  @php
                                                  $K = 1;
                                                 @endphp
                                              @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($K == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                    @php
                                                    $L = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                    @php
                                                    $L = 1;
                                                @endphp
                                                   @endif
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($L == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                  @php
                                                  $M = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                  @php
                                                  $M = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($M == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                @php
                                                $O = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                @php
                                                $O = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($O == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                         
                                      </tr>
          
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Jeudi</strong></td>
                                          @php
                                          $k = 0;
                                          $l = 0;
                                          $m = 0;
                                          $o = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                          @endif
                                                         @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                          @endif                                                 
                                                      </td>
                                                      @php
                                                      $k = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                  @php
                                                  $k = 1;
                                                 @endphp
                                              @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($k == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                    @php
                                                    $l = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                      @endif                                                 
                                                  </td>
                                                    @php
                                                    $l = 1;
                                                @endphp
                                                   @endif
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($l == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                  @php
                                                  $m = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                  @php
                                                  $m = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($m == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                @php
                                                $o = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                  @endif                                                 
                                              </td>
                                                @php
                                                $o = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($o == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
          
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Vendredi</strong></td>
                                          @php
                                          $t = 0;
                                          $y = 0;
                                          $u = 0;
                                          $i = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                          @endif
                                                         @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                          @endif                                                   
                                                      </td>
                                                      @php
                                                      $t = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                      @endif                                                   
                                                  </td>
                                                  @php
                                                  $t = 1;
                                                 @endphp
                                              @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($t == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                      @endif                                                   
                                                  </td>
                                                    @php
                                                    $y = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                      @endif                                                   
                                                  </td>
                                                    @php
                                                    $y = 1;
                                                @endphp
                                                   @endif
                                                   
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($y == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                  @endif                                                   
                                              </td>
                                                  @php
                                                  $u = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                  @endif                                                   
                                              </td>
                                                  @php
                                                  $u = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($u == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                  @endif                                                   
                                              </td>
                                                @php
                                                $i = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                  @endif                                                   
                                              </td>
                                                @php
                                                $i = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($i == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                         
                                      </tr>
                                      <tr>
                                          <td class="align-middle  text-uppercase" style="background-color: rgb(233, 185, 29)"><strong>Samedi</strong></td>
                                          @php
                                          $T = 0;
                                          $Y = 0;
                                          $U = 0;
                                          $I = 0;
                                      
                                          @endphp
                                          @foreach ($getRecord as $subject)
                                             
          
                                             @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                                  @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '10:30')
                                                      <td>
                                                          <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                          <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                          @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                          <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                          @endif
                                                         @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                          <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                          @endif                                                  
                                                      </td>
                                                      @php
                                                      $T = 1;
                                                     @endphp
                                                  @endif
                                                  @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                  <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                      @endif                                                  
                                                  </td>
                                                  @php
                                                  $T = 1;
                                                 @endphp
                                              @endif
                                           @endforeach       
                                           @endforeach  
                                                  <?php
                                                  if ($T == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                
                                                @foreach ($getRecord as $subject)
          
                                                  @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                                   @if ($startTime === '10:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                      @endif                                                  
                                                  </td>
                                                    @php
                                                    $Y = 1;
                                                @endphp
                                                   @endif
                                                   @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                   <td>
                                                      <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                      <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                      @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                      <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                      @endif
                                                     @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                      <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                      @endif                                                  
                                                  </td>
                                                    @php
                                                    $Y = 1;
                                                @endphp
                                                   @endif
                                                  @endforeach
                                                  @endforeach
                                                  <?php
                                                  if ($Y == 0) {
                                                    echo '<td class="empty-cell"></td>';
                                                  } 
                                                ?>
                                                   
                                                @foreach ($getRecord as $subject)
          
                                                 @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '16:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                  @endif                                                  
                                              </td>
                                                  @php
                                                  $U = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                                 <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                  @endif                                                  
                                              </td>
                                                  @php
                                                  $U = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($U == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
          
                                              @foreach ($getRecord as $subject)
                                               @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                               @if ($startTime === '16:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                  @endif                                                  
                                              </td>
                                                @php
                                                $I = 1;
                                              @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                               <td>
                                                  <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                  <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                  @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                  <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                  @endif
                                                 @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                  <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                  @endif                                                  
                                              </td>
                                                @php
                                                $I = 1;
                                              @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($I == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                         
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                          <div class="card-header"> 
                            <h3 class="card-title ">Ajouter / Modifier une séance</h3>   
                          </div>
                          <div class="card-body p-0">
                            <table class="table table-striped">
                              <thead class="bg-success">
                                <tr style="font-size: 1rem ;  white-space: nowrap;">
                                  <th>Jours</th>
                                  <th>Debut</th>
                                  <th>Fin</th>
                                  <th>Type du seance </th>
                                  <th>Amphi</th>
                                  <th>Bloc </th>
                                  <th>Numero Salle</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($week as $value)
                                  <tr>
                                    <th> <input type="hidden" name="timetable[{{$i}}][week_id]" value="{{$value['week_id']}}"> {{$value['week_name']}}</th>
                                    <td>
                                     
                                      <select  name="timetable[{{ $i }}][start_time]" class="form-control">
                                        <option value="">Select Start Time</option> 
                                        <option {{ (old('timetable[' . $i . '][start_time]', $value['start_time']) == '08:30') ? 'selected' : '' }} value="08:30">08:30</option>
                                        <option {{ (old('timetable[' . $i . '][start_time]', $value['start_time']) == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                        <option {{ (old('timetable[' . $i . '][start_time]', $value['start_time']) == '14:30') ? 'selected' : '' }} value="14:30">14:30</option>
                                        <option {{ (old('timetable[' . $i . '][start_time]', $value['start_time']) == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                      </select>
                                    </td>
                                    <td>
                                      
                                      <select  name="timetable[{{ $i }}][end_time]" class="form-control">
                                        <option value="">Select End Time </option> 
                                        <option {{ (old('timetable[' . $i . '][end_time]', $value['end_time']) == '10:30') ? 'selected' : '' }} value="10:30">10:30</option>
                                        <option {{ (old('timetable[' . $i . '][end_time]', $value['end_time']) == '12:30') ? 'selected' : '' }} value="12:30">12:30</option>
                                        <option {{ (old('timetable[' . $i . '][end_time]', $value['end_time']) == '16:30') ? 'selected' : '' }} value="16:30">16:30</option>
                                        <option {{ (old('timetable[' . $i . '][end_time]', $value['end_time']) == '18:30') ? 'selected' : '' }} value="18:30">18:30</option>
                                      </select>
                                    </td>
                                    <td>
                                        <select  name="timetable[{{ $i }}][session_type]" class="form-control">
                                            <option value="">Select Session Type</option> 
                                            <option {{ (old('timetable[' . $i . '][session_type]', $value['session_type']) == 'COURS') ? 'selected' : '' }} value="COURS">COURS</option>
                                            <option {{ (old('timetable[' . $i . '][session_type]', $value['session_type']) == 'TD') ? 'selected' : '' }} value="TD">TD</option>
                                            <option {{ (old('timetable[' . $i . '][session_type]', $value['session_type']) == 'TP') ? 'selected' : '' }} value="TP">TP</option>
                                          </select>
                                        
                                    </td>
                                    <td>
                                        <select name="timetable[{{ $i }}][amphi_name]" class="form-control">
                                            <option value="">Select Amphi</option> 
                                            <option {{ (old('timetable.' . $i . '.amphi_name', $value['amphi_name']) == 'A') ? 'selected' : '' }} value="A">A</option>
                                            <option {{ (old('timetable.' . $i . '.amphi_name', $value['amphi_name']) == 'B') ? 'selected' : '' }} value="B">B</option>
                                          </select>
                                    </td>
                                    <td>
                                        <select name="timetable[{{ $i }}][bloc_name]" class="form-control">
                                            <option value="">Select Bloc</option> 
                                            <option {{ (old('timetable.' . $i . '.bloc_name', $value['bloc_name']) == 'A') ? 'selected' : '' }} value="A">A</option>
                                            <option {{ (old('timetable.' . $i . '.bloc_name', $value['bloc_name']) == 'B') ? 'selected' : '' }} value="B">B</option>
                                          </select>
                                    </td>
                                      
                                    <td>
                                        <input type="text" style="width:200px" name="timetable[{{$i}}][room_number]" class="form-control" value="{{$value['room_number']}}">
                                      </td>
                                      
                                  </tr>
                                  @php
                                  $i++;
                                  @endphp
                                @endforeach
                              </tbody>
                            </table>
                            <div style="text-align: center; padding:20px;">
                              <button class="btn btn-primary" style="width: 160px">Submit</button>
                              <button type="button" class="btn btn-danger " style="width: 160px ; margin-left:20px;" onclick="setFormAction('{{url('coordinator/class_timetable/delete')}}')">Delete</button>
                            </div>
                          </div>
                        </div>
                    </form>
                   
                      @endif
                      <div class="card" id="secondViewContainer" style="display: none; "  >
                        <div class="timetable-img text-center">
                            <img src="img/content/timetable.png" alt="">
                        </div>
                        <div class="table-responsive"  >
                            <table class="table table-bordered text-center" >
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-uppercase">
                                        </th>
                                        <th class="text-uppercase" >8h30<span style="margin-right: 100px;"></span>10h30</th>
                                        <th class="text-uppercase">10h30<span style="margin-right: 100px;"></span>12h30</th>
                                        <th class="text-uppercase">14h30<span style="margin-right: 100px;"></span>16h30</th>
                                        <th class="text-uppercase">16h30<span style="margin-right: 100px;"></span>18h30</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle  text-uppercase"><strong>Lundi</strong></td>
                    
                                        @php
                                        $a = 0;
                                        $b = 0;
                                        $c = 0;
                                        $d = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][0]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        <div class="font-size13 text-light-gray">{{$subject['week'][0]['amphi_name'][$key]}} {{$subject['week'][0]['bloc_name'][$key]}} {{$subject['week'][0]['room_number'][$key]}}</div>
                                                      
                                                    </td>
                                                    @php
                                                    $a = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                    <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                    @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                    @endif
                                                    @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                    @endif
                                                </td>
                                                    @php
                                                    $a = 1;
                                                   @endphp
                                                @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($a == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                    <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                    @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                    @endif
                                                    @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                    @endif
                                                </td>
                                                  @php
                                                  $b = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][0]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                    <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                    @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                    @endif
                                                    @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                    @endif
                                                </td>
                                                  @php
                                                  $b = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($b == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                @endif
                                                @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                @endif
                                            </td>
                                                @php
                                                $c = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                @endif
                                                @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                @endif
                                            </td>
                                                @php
                                                $c = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($c == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][0]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                @endif
                                                @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                @endif
                                            </td>
                                              @php
                                              $d = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][0]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{ $subject['week'][0]['session_type'][$key] }}</span>
                                                <div class="margin-10px-top font-size14">{{ $subject['name'] }}</div>
                                                @if (!empty($subject['week'][0]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][0]['amphi_name'][$key] }}</div>
                                                @endif
                                                @if (!empty($subject['week'][0]['bloc_name'][$key]) || !empty($subject['week'][0]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][0]['bloc_name'][$key] }} - Salle {{ $subject['week'][0]['room_number'][$key] }}</div>
                                                @endif
                                            </td>
                                              @php
                                              $d = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($d == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                               
                                    </tr>
                    
                                    <tr>
                                        <td class="align-middle text-uppercase"><strong>Mardi</strong></td>
                                        @php
                                        $A = 0;
                                        $B = 0;
                                        $C = 0;
                                        $D = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                        @endif
                                                       @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                        @endif                                              
                                                    </td>
                                                    @php
                                                    $A = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                    @endif                                              
                                                </td>
                                                @php
                                                $A = 1;
                                               @endphp
                                            @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($A == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                    @endif                                              
                                                </td>
                                                  @php
                                                  $B = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][1]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                    @endif                                              
                                                </td>
                                                  @php
                                                  $B = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($B == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                @endif                                              
                                            </td>
                                                @php
                                                $C = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                @endif                                              
                                            </td>
                                                @php
                                                $C = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($C == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][1]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                @endif                                              
                                            </td>
                                              @php
                                              $D = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][1]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][1]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][1]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][1]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][1]['bloc_name'][$key]) || !empty($subject['week'][1]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][1]['bloc_name'][$key] }} - Salle {{ $subject['week'][1]['room_number'][$key] }}</div>
                                                @endif                                              
                                            </td>
                                              @php
                                              $D = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($D == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                                       
                                       
                                    </tr>
                    
                                    <tr>
                                        <td class="align-middle text-uppercase"><strong>Mercredi</strong></td>
                                        @php
                                        $K = 0;
                                        $L = 0;
                                        $M = 0;
                                        $O = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                        @endif
                                                       @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                        @endif                                                 
                                                    </td>
                                                    @php
                                                    $K = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                @php
                                                $K = 1;
                                               @endphp
                                            @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($K == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                  @php
                                                  $L = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][2]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                  @php
                                                  $L = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($L == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                                @php
                                                $M = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                                @php
                                                $M = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($M == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][2]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                              @php
                                              $O = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][2]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][2]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][2]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][2]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][2]['bloc_name'][$key]) || !empty($subject['week'][2]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][2]['bloc_name'][$key] }} - Salle {{ $subject['week'][2]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                              @php
                                              $O = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($O == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                                       
                                    </tr>
                    
                                    <tr>
                                        <td class="align-middle text-uppercase"><strong>Jeudi</strong></td>
                                        @php
                                        $k = 0;
                                        $l = 0;
                                        $m = 0;
                                        $o = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                        @endif
                                                       @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                        @endif                                                 
                                                    </td>
                                                    @php
                                                    $k = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                @php
                                                $k = 1;
                                               @endphp
                                            @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($k == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                  @php
                                                  $l = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][3]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                    @endif                                                 
                                                </td>
                                                  @php
                                                  $l = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($l == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                                @php
                                                $m = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                                @php
                                                $m = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($m == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][3]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                              @php
                                              $o = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][3]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][3]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][3]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][3]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][3]['bloc_name'][$key]) || !empty($subject['week'][3]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][3]['bloc_name'][$key] }} - Salle {{ $subject['week'][3]['room_number'][$key] }}</div>
                                                @endif                                                 
                                            </td>
                                              @php
                                              $o = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($o == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                    
                                    <tr>
                                        <td class="align-middle text-uppercase"><strong>Vendredi</strong></td>
                                        @php
                                        $t = 0;
                                        $y = 0;
                                        $u = 0;
                                        $i = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                        @endif
                                                       @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                        @endif                                                   
                                                    </td>
                                                    @php
                                                    $t = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                    @endif                                                   
                                                </td>
                                                @php
                                                $t = 1;
                                               @endphp
                                            @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($t == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                    @endif                                                   
                                                </td>
                                                  @php
                                                  $y = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][4]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                    @endif                                                   
                                                </td>
                                                  @php
                                                  $y = 1;
                                              @endphp
                                                 @endif
                                                 
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($y == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                @endif                                                   
                                            </td>
                                                @php
                                                $u = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                @endif                                                   
                                            </td>
                                                @php
                                                $u = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($u == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][4]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                @endif                                                   
                                            </td>
                                              @php
                                              $i = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][4]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][4]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][4]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][4]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][4]['bloc_name'][$key]) || !empty($subject['week'][4]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][4]['bloc_name'][$key] }} - Salle {{ $subject['week'][4]['room_number'][$key] }}</div>
                                                @endif                                                   
                                            </td>
                                              @php
                                              $i = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($i == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                                       
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-uppercase"><strong>Samedi</strong></td>
                                        @php
                                        $T = 0;
                                        $Y = 0;
                                        $U = 0;
                                        $I = 0;
                                    
                                        @endphp
                                        @foreach ($getRecord as $subject)
                                           
                    
                                           @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                                @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '10:30')
                                                    <td>
                                                        <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                        <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                        @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                        <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                        @endif
                                                       @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                        <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                        @endif                                                  
                                                    </td>
                                                    @php
                                                    $T = 1;
                                                   @endphp
                                                @endif
                                                @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                    @endif                                                  
                                                </td>
                                                @php
                                                $T = 1;
                                               @endphp
                                            @endif
                                         @endforeach       
                                         @endforeach  
                                                <?php
                                                if ($T == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                              
                                              @foreach ($getRecord as $subject)
                    
                                                @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                                 @if ($startTime === '10:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                    @endif                                                  
                                                </td>
                                                  @php
                                                  $Y = 1;
                                              @endphp
                                                 @endif
                                                 @if ($startTime === '08:30' && $subject['week'][5]['end_time'][$key] === '12:30')
                                                 <td>
                                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                    <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                    @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                    <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                    @endif
                                                   @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                    <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                    @endif                                                  
                                                </td>
                                                  @php
                                                  $Y = 1;
                                              @endphp
                                                 @endif
                                                @endforeach
                                                @endforeach
                                                <?php
                                                if ($Y == 0) {
                                                  echo '<td class="empty-cell"></td>';
                                                } 
                                              ?>
                                                 
                                              @foreach ($getRecord as $subject)
                    
                                               @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                               @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '16:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                @endif                                                  
                                            </td>
                                                @php
                                                $U = 1;
                                            @endphp
                                               @endif
                                               @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                               <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                @endif                                                  
                                            </td>
                                                @php
                                                $U = 1;
                                            @endphp
                                               @endif
                                              @endforeach
                                              @endforeach
                                              <?php
                                              if ($U == 0) {
                                                echo '<td class="empty-cell"></td>';
                                              } 
                                            ?>
                                            
                    
                                            @foreach ($getRecord as $subject)
                                             @foreach ($subject['week'][5]['start_time'] as $key => $startTime)
                                             @if ($startTime === '16:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                @endif                                                  
                                            </td>
                                              @php
                                              $I = 1;
                                            @endphp
                                             @endif
                                             @if ($startTime === '14:30' && $subject['week'][5]['end_time'][$key] === '18:30')
                                             <td>
                                                <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">{{$subject['week'][5]['session_type'][$key]}}</span>
                                                <div class="margin-10px-top font-size14">{{$subject['name']}}</div>
                                                @if (!empty($subject['week'][5]['amphi_name'][$key]))
                                                <div class="font-size13 text-light-gray">Amphi {{ $subject['week'][5]['amphi_name'][$key] }}</div>
                                                @endif
                                               @if (!empty($subject['week'][5]['bloc_name'][$key]) || !empty($subject['week'][5]['room_number'][$key]))
                                                <div class="font-size13 text-light-gray">Bloc {{ $subject['week'][5]['bloc_name'][$key] }} - Salle {{ $subject['week'][5]['room_number'][$key] }}</div>
                                                @endif                                                  
                                            </td>
                                              @php
                                              $I = 1;
                                            @endphp
                                             @endif
                                            @endforeach
                                            @endforeach
                                            <?php
                                            if ($I == 0) {
                                              echo '<td class="empty-cell"></td>';
                                            } 
                                          ?>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /.row -->
               
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            
        </section>
        <!-- /.content -->
    </div>
   
@endsection
@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
var toggleButton = document.getElementById('toggleButton');
var toggleButton_2 = document.getElementById('toggleButton_2');
var targetElement = document.getElementById('targetElement');

toggleButton.addEventListener('click', function() {
  if (targetElement.style.display === 'none') {
    targetElement.style.display = 'block';
    toggleButton_2.style.display = 'block';
    toggleButton.style.display = 'none';
  } 

  
});
toggleButton_2.addEventListener('click', function() {
  if (targetElement.style.display === 'block') {
    targetElement.style.display = 'none';
    toggleButton_2.style.display = 'none';
    toggleButton.style.display = 'block';

  }
});
  </script>
  <script type="text/javascript">
    function setFormAction(actionUrl) {
        document.getElementById('myForm').action = actionUrl;
        document.getElementById('myForm').submit();
    }
</script>

 

<script type="text/javascript">
    $('.getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
            url:"{{url('coordinator/class_timetable/get_subject')}}",
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
<script>
  $(document).ready(function() {
        $('.select2').select2();
    });
$(document).ready(function() {
    $('select[name^="timetable["][name$="][start_time]"]').change(function() {
        var selectedStartTime = $(this).val();
        var $endTimeSelect = $(this).closest('tr').find('select[name$="[end_time]"]');
        
        // Send an AJAX request to the server
        $.ajax({
            url: "{{url('coordinator/class_timetable/get-end-times')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                start_time: selectedStartTime
            },
            dataType: 'json',
            success: function(response) {
                // Clear existing options
                $endTimeSelect.empty();
                // Add new options based on response
                $.each(response.end_times, function(index, value) {
                    $endTimeSelect.append('<option value="' + value + '">' + value + '</option>');
                });
            }
        });
    });
});
</script>


@endsection
