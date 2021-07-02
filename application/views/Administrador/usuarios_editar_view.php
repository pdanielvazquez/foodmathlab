<!-- Main content -->
<section class="content">

  <? $usuario = ($usuarios!=false) ? $usuarios->row(0) : false ?>

  <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-4">
      <form method="post" action="<?= base_url('usuarios_guardar_editar') ?>">
        <!-- Tabla de productos registrados -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-user"></i> 
              Editar usuario
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <input type="hidden" name="usuario" id="usuario" value="<?= encripta($usuario->id_user) ?>">
            <div class="form-group">
              <label>Nombre completo</label>
              <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $usuario->nombre ?>" required="required">
            </div>
            <div class="form-group">
              <label>Correo electrónico</label>
              <input type="email" class="form-control" name="correo" id="correo" value="<?= $usuario->correo ?>" required="required">
            </div>
            <div class="form-group">
              <label>Nueva contraseña</label>
              <input type="text" class="form-control" name="password1" id="password1" placeholder="Escriba aquí">
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary justify-content-between">Regresar</a>
            <button class="btn btn-lg btn-primary float-right">Aceptar</button>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </form>
    </div>
  </div>

</section>
<!-- /.content -->