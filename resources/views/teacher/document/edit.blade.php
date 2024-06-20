@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter nouveau document</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="POST" action="" enctype="multipart/form-data">
                {{  csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label >Niveau</label>
                    <select class="form-control getClass " name="class_id" required>
                        <option value="">Selectionner</option>
                        @foreach($getClass as $class)
                
                        <option {{$getRecord->class_id == $class->class_id ? 'selected' : ''}}  value="{{$class->class_id}}">{{$class->class_name}}</option>
                       
                        @endforeach

                    </select>                  
                   </div>
                  <div class="form-group">
                    <label >Module</label>
                    <select class="form-control getSubject " name="subject_id" required>
                        <option value="">Selectionner</option>
                        @if(!empty($getSubject))
                        @foreach($getSubject as $subject)
                        <option {{$getRecord->module_id == $subject->module_id ? 'selected' : ''}} value="{{$subject->module_id}}">{{$subject->subject_name}}</option>
                        @endforeach
                        @endif
                    </select>                  
                </div>  
                <div class="form-group ">
                    <label for="exampleInputFile">Document</label>
                        <div class="custom-file">
                          <input type="file" class="form-control"  name="document" >
                          @if(!empty($getRecord->getDocument()))
                                 <a href="{{ $getRecord->getDocument()}}" class="btn btn-primary" download="">Download</a>    
                          @endif
                        </div>
                </div>
                  <div class="form-group">
                    <label >Titre</label>
                    <input type="text" class="form-control" value="{{ $getRecord->title }}" name="title" required placeholder="Titre">
                  </div>
                 
                          
                 <div class="form-group">
                    <label >Description</label>
                                <textarea id="compose-textarea" class="form-control" style="height: 150px"  name="description">
                                    {{ $getRecord->description }}
                                 
                                </textarea>
                </div>
                           
                       
                 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.getClass').change(function(){
        var class_id = $(this).val();
        $.ajax({
            url:"{{url('teacher/document/get_subject')}}",
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
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerHTML = fileName;
    }
  </script>
  <script src="{{url('../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"')}}""></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>
@endsection