@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Timetable  </h1>
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
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-uppercase">
                                </th>
                                <th class="text-uppercase">8h30  10h30</th>
                                <th class="text-uppercase">8h30  12h30</th>
                                <th class="text-uppercase">14h30  16h30</th>
                                <th class="text-uppercase">16h30  18h30</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">Monday</td>
                                <td>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">Dance</span>
                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td>
                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Yoga</span>
                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                    <div class="font-size13 text-light-gray">Marta Healy</div>
                                </td>

                                <td>
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Dance</span>
                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                               
                            </tr>

                            <tr>
                                <td class="align-middle">Tuesday</td>
                                <td>
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">10:00-11:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td class="bg-light-gray">
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">10:00-11:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td>
                                    <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Art</span>
                                    <div class="margin-10px-top font-size14">10:00-11:00</div>
                                    <div class="font-size13 text-light-gray">Kate Alley</div>
                                </td>
                                <td>
                                    <span class="bg-green padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Yoga</span>
                                    <div class="margin-10px-top font-size14">10:00-11:00</div>
                                    <div class="font-size13 text-light-gray">Marta Healy</div>
                                </td>
                               
                               
                            </tr>

                            <tr>
                                <td class="align-middle">Wednesday</td>
                                <td>
                                    <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                    <div class="margin-10px-top font-size14">11:00-12:00</div>
                                </td>
                                <td>
                                    <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                    <div class="margin-10px-top font-size14">11:00-12:00</div>
                                </td>
                                <td>
                                    <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                    <div class="margin-10px-top font-size14">11:00-12:00</div>
                                </td>
                                <td>
                                    <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                    <div class="margin-10px-top font-size14">11:00-12:00</div>
                                </td>
                               
                            </tr>

                            <tr>
                                <td class="align-middle">Thursday</td>
                                <td class="bg-light-gray">
                                    <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Art</span>
                                    <div class="margin-10px-top font-size14">12:00-1:00</div>
                                    <div class="font-size13 text-light-gray">Kate Alley</div>

                                </td>
                                <td>
                                    <span class="bg-purple padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Art</span>
                                    <div class="margin-10px-top font-size14">12:00-1:00</div>
                                    <div class="font-size13 text-light-gray">Kate Alley</div>
                                </td>
                                <td>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Dance</span>
                                    <div class="margin-10px-top font-size14">12:00-1:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td>
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">12:00-1:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                
                            </tr>

                            <tr>
                                <td class="align-middle">Friday</td>
                                <td>
                                    <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">James Smith</div>
                                </td>
                                <td>
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td class="bg-light-gray">
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>

                                </td>
                                <td>
                                    <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">James Smith</div>
                                </td>
                               
                            </tr>
                            <tr>
                                <td class="align-middle">Saturday</td>
                                <td>
                                    <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">James Smith</div>
                                </td>
                                <td>
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>
                                </td>
                                <td class="bg-light-gray">
                                    <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">Ivana Wong</div>

                                </td>
                                <td>
                                    <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                    <div class="margin-10px-top font-size14">1:00-2:00</div>
                                    <div class="font-size13 text-light-gray">James Smith</div>
                                </td>
                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          <!--  <div class="container-fluid">

          

                <div class="row">
                    <div class="col-md-12">
                        @include('_messages')
                        
                       
                        
                        @foreach($getRecord as $value)
                           
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">{{$value['name']}}</h3>
                          </div>
                          <div class="card-body p-0">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Week</th>
                                  <th>Start Time</th>
                                  <th>End Time</th>
                                  <th>Room Number</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($value['week'] as $valueW)
                                <tr>
                                    <td>{{$valueW['week_name']}}</td> 
                                    <td>{{!empty($valueW['start_time']) ? date('h:i',strtotime($valueW['start_time'])):''}}</td> 
                                    <td>{{!empty($valueW['end_time']) ? date('h:i',strtotime($valueW['end_time'])):''}}</td> 
                                   
                                    <td>{{$valueW['room_number']}}</td>  
                                    
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            
                          </div>
                        </div>
                       
                       @endforeach
                      
                    </div>
                </div>
                <-- /.row -->

                <!-- /.row -->
            <!--</div><!-- /.container-fluid -->
         
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
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
