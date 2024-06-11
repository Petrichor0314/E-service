<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('public/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{url('public/css/login.css')}}">
</head>
<body class="hold-transition login-page" >
  <div class="login-box">
    <div class="left-side">
    </div>
    <div class="card form-content">
      <div class="text-center">
        <img style="width:auto; height: 55px" src="{{url('upload/profile/logoedit.png')}}">
      </div>
      <div class="card-body">
        <p class="login-box-msg-1">Bienvenue sur la plateforme Universe</p>
        <p class="login-box-msg">Une plateforme de gestion moderne</p>
        @include('_messages')
        <form action="{{url('login')}}" method="POST">
          {{ csrf_field() }}
          <div class=" mb-3 input-field">    
            <input required name="email" type="email" class="form-control" placeholder="Email d'utilisateur"> 
          </div>  
          <div class=" mb-3 input-field">
            <input required name="password" type="password" class="form-control" placeholder="Mot de Passe">
            <div class="input-group-append">
             
            </div>
          </div>
          <div class="row">

              <button class="button" type="submit" class="btn btn-primary btn-block">Se connecter</button>
            
          </div>
        </form> 
        <p class="mb-1">
          <a href="{{url('forgot-password')}}">mot de pase oublié ?</a>
        </p>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
  </body>
</html>
