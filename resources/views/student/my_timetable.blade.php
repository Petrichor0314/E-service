@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2" style="margin-top: 0.5cm">
                    <div class="col-sm-6">
                        <h1 style="font-family: 'Open Sans', sans-serif;">Emploi de temps de ma classe  </h1>
                    </div>
                   
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="timetable-img text-center">
                    <img src="img/content/timetable.png" alt="">
                </div>
                <div id="pdfTitle" style="display: none">EMPLOI DU TEMPS "{{$getClassName}}"</div>

                <div class="table-responsive"  style="overflow-x: hidden; ">
                    <table id="myTable" class="table table-bordered text-center" style="border-collapse: collapse;
                    border: 1px solid black;">
                        <thead >
                         
                            <tr class="bg-light-gray" >
                                <th class="text-uppercase" >
                                </th>
                                <th style="background-color: rgb(20, 207, 207)" class="text-uppercase" >8h30<span style="margin-right: 107px;"></span>10h30</th>
                                <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">10h30<span style="margin-right: 107px;"></span>12h30</th>
                                <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">14h30<span style="margin-right: 107px;"></span>16h30</th>
                                <th style="background-color: rgb(20, 207, 207)" class="text-uppercase">16h30<span style="margin-right: 107px;"></span>18h30</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row">
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

                            <tr class="table-row">
                                <td class="align-middle text-uppercase"  style="background-color: rgb(233, 185, 29)"><strong>Mardi</strong></td>
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

                            <tr class="table-row">
                                <td class="align-middle text-uppercase"  style="background-color: rgb(233, 185, 29)"><strong>Mercredi</strong></td>
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

                            <tr class="table-row">
                                <td class="align-middle text-uppercase"  style="background-color: rgb(233, 185, 29)"><strong>Jeudi</strong></td>
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
                            </tr>
                            <tr class="table-row" >
                                <td class="align-middle text-uppercase"  style="background-color: rgb(233, 185, 29)"><strong>Vendredi</strong></td>
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
                            <tr class="table-row">
                                <td class="align-middle text-uppercase"  style="background-color: rgb(233, 185, 29)"><strong>Samedi</strong></td>
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
                    <div class="form-group d-flex justify-content-center">
                      <button onclick="exportTableToPDF()" class="btn btn-primary">
                        <i class="fas fa-file-pdf"></i> Exporter en PDF
                    </button>                    
                  </div>
                </div>
                
            </div>
 
         
        </section>
        <!-- /.content -->
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
