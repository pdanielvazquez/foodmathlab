<!-- Main content -->
<section class="content">

  
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
          <form method="post" action="<?= base_url('usuarios_guardar_nuevo') ?>">
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
                <div class="form-group">
                  <label>Nombre completo</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" required="required">
                </div>
                <div class="form-group">
                  <label>Correo electrónico</label>
                  <input type="email" class="form-control" name="correo" id="correo" required="required">
                </div>
                <div class="form-group">
                  <label>Contraseña</label>
                  <input type="text" class="form-control" name="password1" id="password1" placeholder="Escriba aquí" required="required">
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-lg btn-primary float-right">Crear</button>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </form>

          <!-- Tabla de productos registrados -->
          <div class="card card-gray">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-flask"></i>
                Laboratorios
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <label>Número de Laboratorios contratados</label>
                <input type="number" class="form-control txt-centrado" name="no_labs" id="no_labs" placeholder="0" min="1" disabled="disabled" >
              </div>
              <div class="form-group">
                <label>Número máximo de productos por Laboratorio</label>
                <input type="number" class="form-control txt-centrado" name="no_max_prod" id="no_max_prod" placeholder="0" min="1" disabled="disabled">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>

      <div class="col-xs-12 col-md-6 col-lg-4">
          <div class="card card-gray">
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
                            ?>
                            <tr class="txt-centrado">
                              <th><?= $opcion->opcion ?></th>
                              <td><?= $subopcion->opcion_submenu ?></td>
                              <td>
                                <input type="checkbox" name="sub_<?= $opcion->id_opcion ?>_<?= $subopcion->orden_submenu ?>" id="sub_<?= $opcion->id_opcion ?>_<?= $subopcion->orden_submenu ?>" disabled="disabled" >
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
          </div>
      </div>

      <div class="col-xs-12 col-md-6 col-lg-4">
        <!-- Etiquetados -->
          <div class="card card-gray">
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
                    ?>
                    <tr class="txt-centrado">
                      <th><?= $val ?></th>
                      <td>
                        <input type="checkbox" name="label_<?= $cve ?>" id="label_<?= $cve ?>" value="<?= $cve ?>" disabled="disabled">
                      </td> 
                    </tr>
                    <?
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        <!-- /.Etiquetados -->

        <!-- Indices -->
          <div class="card card-gray">
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
                    ?>
                    <tr class="txt-centrado">
                      <th><?= $val ?></th>
                      <td>
                        <input type="checkbox" name="index_<?= $cve ?>" id="index_<?= $cve ?>" value="<?= $cve ?>" disabled="disabled">
                      </td> 
                    </tr>
                    <?
                    }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        <!-- /.Indices -->
      </div>
    </div>

</section>
<!-- /.content