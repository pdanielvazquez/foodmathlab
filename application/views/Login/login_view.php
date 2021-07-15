<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Food Math Lab</title>
  <link rel="icon" type="img/icon" href="<?= base_url('vendor') ?>/dist/img/logos/nutrimotor-logo-bn.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/toastr/toastr.min.css">
  <!-- Estilos propios -->
  <link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/login.css">
</head>
<body class="hold-transition login-page">

  <video autoplay muted loop id="myVideo">
    <source src="<?= base_url('vendor/dist/video/video.mp4') ?>" type="video/mp4">
  </video>

<div id="grid"></div>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b>Food</b>MATHLAB</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicio de sesión</p>

      <form action="<?= base_url('App/login') ?>" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Usuario" name="email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">       
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-danger btn-block btn-lg">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      </div>
    <!-- /.card-body -->
      <div class="card-footer text-center">
          <a href="<?= base_url('registro') ?>" class="btn btn-default bg-gray">Crear una cuenta</a>
        <hr>
        <strong>Copyright &copy; 2021 <a href="https://www.nutrimonitor.com/" target="_blank">nutrimotor.com</a></strong> Todos los derechos reservados
      </div>
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('vendor') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('vendor') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('vendor') ?>/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('vendor') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('vendor') ?>/plugins/toastr/toastr.min.js"></script>

<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      showConfirmButton: false,
      timer: 6000
    });

    var error = <?= $error ?>;
    var tipo  = <?= $tipo ?>;
    var mensaje = 'Acceso incorrecto';
    if (error==1){
      switch(tipo){
        case 1: mensaje = 'El usuario no existe';
          break;
        case 2: mensaje = 'La contraseña es incorrecta';
          break;
      }
      Toast.fire({
        icon: 'error',
        title: mensaje,
      })  
    }
})
</script>

</body>
</html>
