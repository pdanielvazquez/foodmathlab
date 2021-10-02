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
              Datos del usuario
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <input type="hidden" name="usuario_editar" id="usuario_editar" value="<?= encripta($usuario->id_user) ?>">
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

      <form method="post" action="<?= base_url('usuarios_ab') ?>">
        <!-- Tabla de productos registrados -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-flask"></i>
              Laboratorios
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $permiso_lab = ($permisos_labs!=false)? $permisos_labs->row(0) : false;
            ?>
            <input type="hidden" name="usuario_lab" id="usuario_lab" value="<?= encripta($usuario->id_user) ?>">
            <div class="form-group">
              <label>Número de Laboratorios contratados</label>
              <input type="number" class="form-control txt-centrado" name="no_labs" id="no_labs" value="<?= ($permiso_lab!=false)? $permiso_lab->no_labs : '' ?>" required="required" placeholder="0" min="1" >
            </div>
            <div class="form-group">
              <label>Número máximo de productos por Laboratorio</label>
              <input type="number" class="form-control txt-centrado" name="no_max_prod" id="no_max_prod" value="<?= ($permiso_lab!=false)? $permiso_lab->no_productos: '' ?>" required="required" placeholder="0" min="1">
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

    <div class="col-xs-12 col-md-6 col-lg-4">
      <form method="post" action="<?= base_url('usuarios_as') ?>">
        <input type="hidden" name="usuario_subpermisos" id="usuario_subpermisos" value="<?= encripta($usuario->id_user) ?>">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-indent"></i>
              Secciones
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bg-secondary txt-centrado">
                  <th>Módulo</th>
                  <th>Apartado</th>
                  <th>Activo</th>
                </tr>
              </thead>
              <tbody>
                <?
                if ($opciones!=false) {
                  foreach ($opciones->result() as $opcion) {
                    if($subopciones!=false){
                      foreach ($subopciones->result() as $subopcion) {
                        if ($subopcion->id_opcion==$opcion->id_opcion) {
                          $checked= '';
                          if ($permisos_submenu!=false) {
                            foreach ($permisos_submenu->result() as $permiso) {
                              if (($permiso->id_opcion == $opcion->id_opcion) && ($permiso->orden_submenu == $subopcion->orden_submenu)) {
                                $checked = 'checked="checked"';
                              }
                            }
                          }
                          ?>
                          <tr class="txt-centrado">
                            <th><?= $opcion->opcion ?></th>
                            <td><?= $subopcion->opcion_submenu ?></td>
                            <td>
                              <input type="checkbox" name="sub_<?= $opcion->id_opcion ?>_<?= $subopcion->orden_submenu ?>" id="sub_<?= $opcion->id_opcion ?>_<?= $subopcion->orden_submenu ?>" <?= $checked ?> >
                            </td> 
                          </tr>
                          <?
                        }
                      }
                    }
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary justify-content-between">Regresar</a>
            <button class="btn btn-lg btn-primary float-right">Actualizar</button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-4">
      <!-- Etiquetados -->
      <form method="post" action="<?= base_url('usuarios_al') ?>">
        <input type="hidden" name="usuario_labels" id="usuario_labels" value="<?= encripta($usuario->id_user) ?>">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-tag"></i> 
              Etiquetados
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bg-secondary txt-centrado">
                  <th>País</th>
                  <th>Activo</th>
                </tr>
              </thead>
              <tbody>
                <?
                  foreach ($etiquetados as $cve => $val) {
                    $checked = '';
                    if ($permisos_labels!=false) {
                      foreach ($permisos_labels->result() as $permiso) {
                        if ($permiso->etiquetado == $cve) {
                          $checked = 'checked="checked"';
                        }
                      }
                    }
                  ?>
                  <tr class="txt-centrado">
                    <th><?= $val ?></th>
                    <td>
                      <input type="checkbox" name="label_<?= $cve ?>" id="label_<?= $cve ?>" value="<?= $cve ?>" <?= $checked ?> >
                    </td> 
                  </tr>
                  <?
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary justify-content-between">Regresar</a>
            <button class="btn btn-lg btn-primary float-right">Actualizar</button>
          </div>
        </div>
      </form>
      <!-- /.Etiquetados -->

      <!-- Indices -->
      <form method="post" action="<?= base_url('usuarios_ai') ?>">
        <input type="hidden" name="usuario_index" id="usuario_index" value="<?= encripta($usuario->id_user) ?>">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-tag"></i> 
              Índices
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="bg-secondary txt-centrado">
                  <th>Índice</th>
                  <th>Activo</th>
                </tr>
              </thead>
              <tbody>
                <?
                  foreach ($indices as $cve => $val) {
                    $checked = '';
                    if ($permisos_indices!=false) {
                      foreach ($permisos_indices->result() as $pindice) {
                        if ($pindice->indice == $cve) {
                          $checked = 'checked="checked"';
                        }
                      }
                    }
                  ?>
                  <tr class="txt-centrado">
                    <th><?= $val ?></th>
                    <td>
                      <input type="checkbox" name="index_<?= $cve ?>" id="index_<?= $cve ?>" value="<?= $cve ?>" <?= $checked ?> >
                    </td> 
                  </tr>
                  <?
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="<?= base_url('usuarios') ?>" class="btn btn-secondary justify-content-between">Regresar</a>
            <button class="btn btn-lg btn-primary float-right">Actualizar</button>
          </div>
        </div>
      </form>
      <!-- /.Indices -->
    </div>
  </div>

</section>
<!-- /.content