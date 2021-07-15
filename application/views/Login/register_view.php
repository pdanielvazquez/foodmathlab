<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

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

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b>Food</b>MATHLAB</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registrar una nueva cuenta</p>

      <form action="nuevo_usuario" method="post" id="formRegister">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" id="nombre" minlength="10" maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo electrónico" name="correo" id="correo" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password1" id="password1" minlength="8" maxlength="16">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirmar contraseña" name="password2" id="password2" minlength="8" maxlength="16">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" >
              <label for="agreeTerms">
               Estoy de acuerdo con los <a href="#">terminos</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-danger btn-block">Confirmar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.form-box -->
    <div class="card-footer text-center">
          <a href="<?= base_url() ?>" class="btn btn-default bg-gray">Ya tengo una cuenta</a>
        <hr>
        <strong>Copyright &copy; 2021 <a href="https://www.nutrimonitor.com/" target="_blank">nutrimotor.com</a></strong> Todos los derechos reservados
      </div>
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

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
      showConfirmButton: true,
      timerProgressBar: true,
      timer: 6000
    });

    $('#formRegister').on('submit', function(){
      var name = $('#nombre').val();
      var email = $('#correo').val();
      var pass1 = $('#password1').val();
      var pass2 = $('#password2').val();
      var datos ={
        'name'  : name,
        'email' : email,
        'pass1' : pass1,
      }
      $.ajax({
        type: 'POST',
        url : 'nuevo_usuario',
        data: datos,
        success: function(data){
          Toast.fire({
            icon: 'success',
            title: 'La cuenta se ha creado exitosamente'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "login";
            }
          })
          /*Pausar transicion*/
          setTimeout(
          function() 
          {
            window.location = "login";
          }, 6000);
        }
      });
      return false;
    });


  });
</script>

</body>
</html>
