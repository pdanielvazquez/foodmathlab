<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Foodmathlab | Recuperar contraseña</title>

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
  <link rel="stylesheet" href="<?= base_url('vendor/dist/css/login.css') ?>">

</head>
<body class="hold-transition register-page" id="body-register">
<div class="register-box">
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="<?= base_url() ?>" class="h1"><b>Food</b>MATHLAB</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Recuperación de contraseña</p>

      <form id="formRegister" method="post" action="<?= base_url('buscar_correo') ?>">

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo electrónico" name="correo" id="correo" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="g-recaptcha" data-sitekey="6Lc8_q4cAAAAAOL3l_vno4GaPdCt8OrD-oerT5M8"></div>
        </div>
        <div class="input-group mb-3">
          <button type="submit" class="btn btn-danger btn-block">Enviar correo</button>
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

<!-- Recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  
<script>

  var onloadCallback = function() {
      alert("grecaptcha is ready!");
    };

  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      showConfirmButton: false,
      timer: 6000
    });

    var error = <?= $error ?>;
    var mensaje = '';
    var icono = 'error';
    if (error>0) {

      switch(error){
        case 1:
          mensaje = ' El correo no esta registrado';
          break;
        case 2:
          mensaje = 'Indica que no eres un robot';
          break;
        case 3:
          mensaje = 'El correo de recuperación fue enviado exitosamente';
          icono = 'success';
          break;
        case 4:
          mensaje = 'Hubo un error en el envío del correo de recuperación';
          break;
      }

      Toast.fire({
        icon: icono,
        title: mensaje,
      });  

    }
    
  });

</script>

</body>
</html>
