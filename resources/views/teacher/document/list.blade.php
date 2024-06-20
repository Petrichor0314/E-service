@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des Documents </h1>
                    </div>
                    <div class="col-sm-6" style="text-align : right;">
                        <a href="{{ url('teacher/document/add') }}"  class="button">Ajouter nouveau document</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class  = "card ">
                            <div class="card-header">
                                <h3 class="card-title">Rechercher un Document</h3>
                            </div>
                            <form method = "get" action = "">
                                <div class  = "card-body">
                                    <div class="row">
                                        <div class  = "form-group col-md-3">
                                            <label>Classe</label>
                                            <select class="form-control getClass " name="class_id" >
                                                <option value="">Selectionner</option>
                                                @foreach($getClass as $class)
                                        
                                                <option {{Request::get('class_id') == $class->class_id ? 'selected' : ''}}  value="{{$class->class_id}}">{{$class->class_name}}</option>
                                               
                                                @endforeach
                        
                                            </select>  
                                        </div>
                                        <div class  = "form-group col-md-3">
                                            <label>Module</label>
                                            <select class="form-control getSubject " name="subject_id" >
                                                <option value="">Selectionner</option>
                                                @if(!empty($getSubject))
                                                @foreach($getSubject as $subject)
                                                <option {{Request::get('subject_id') == $subject->module_id ? 'selected' : ''}} value="{{$subject->module_id}}">{{$subject->subject_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>  
                                        </div>
                                        <div class = "form-group col-md-3">
                                            <label>titre</label>
                                            <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title"  placeholder="Titre">

                                        </div>
                                       
                                        <div class = "form-group col-md-3">
                                            <label>Date de création</label>
                                            <input type = "date" class = "form-control" name = "date" value ="{{ Request::get('date') }}"
                                                 placeholder = "Date">
                                        </div>
                                        <div class = "form-group col-md-6">
                                          <button class="btn btn-primary" style="margin-top: 31.5px;">Rechercher</button>
                                          <a href="{{ url('teacher/document/list') }}" class="btn btn-success ml-2" style="margin-top: 31.5px;">Réinitialiser</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @include('_messages')

                        <div class="card">
                           
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-success">
                                        <tr style="font-size: 1.1rem ;  white-space: nowrap;">
                                            <th>#</th>
                                            <th>Classe</th>
                                            <th>Module </th>
                                            <th>titre </th>
                                            <th>Description </th> 
                                            <th>Document </th>
                                            <th>Date de création</th>   
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                      @foreach($getRecord as $document)
                                      <tr>
                                          <td>{{ $document->id }}</td>
                                          <td>{{ $document->class_name }}</td>
                                          <td>{{ $document->subject_name }}</td>
                                          <td>{{ $document->title }}</td>
                                          <td>{{ $document->description }}</td>
                                          <td>
                                            @if(!empty($document->getDocument()))
                                            <a href="{{ $document->getDocument()}}" class="btn btn-primary" download="">Download</a>    
                                            @endif
                                          </td>
                                          <td>
                                            {{ date('d-m-Y', strtotime($document->created_at)) }}
                                          </td>
                                          <td>
                                            <a href="{{ url('teacher/document/edit/' . $document->id) }}" style="margin-right: 20px"><i class="fa-solid fa-pen-to-square fa-lg"></i></a>
                                            <a href="{{ url('teacher/document/delete/' . $document->id) }}"><i class="fa-solid fa-trash fa-lg" style="color: #c11515; display:inline"></i></a>
                                        </td>  
                                      </tr>
                                    
                                      @endforeach
                                       
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
