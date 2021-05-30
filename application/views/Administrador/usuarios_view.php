  <!-- Main content -->
<section class="content">

    <!-- Tabla de productos registrados -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Usuarios registrados
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="table-usuarios" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Correo</th>

                <?
                if ($opciones!=false) {
                  foreach ($opciones->result() as $opcion) {
                    ?>
                    <th><?= $opcion->opcion ?></th>
                    <?
                  }
                }
                ?>

                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($usuarios) {
                  $conta = 0;
                  foreach ($usuarios->result() as $usuario) {
                    ?>
                    <tr>
                      <td class="txt-centrado"><?= ++$conta ?></td>
                      <td><?= $usuario->nombre ?></td>
                      <td><?= $usuario->correo ?></td>
                      <?
                      if ($opciones!=false) {
                        foreach ($opciones->result() as $opcion) {
                          $checked = '';
                          if ($permisos!=false) {
                            foreach ($permisos->result() as $permiso) {
                              if (($permiso->id_usuario == $usuario->id_user) && ($permiso->id_opcion == $opcion->id_opcion)) {
                                $checked = 'checked';
                              }
                            }
                          }
                          ?>
                          <td class="txt-centrado">
                            <input type="checkbox" name="<?= $opcion->opcion ?>_<?= $usuario->id_user ?>" id="<?= $opcion->opcion ?>_<?= $usuario->id_user ?>" data-user="<?= $usuario->id_user ?>" data-option="<?= $opcion->id_opcion ?>" class="check-opcion" <?= $checked ?>>
                          </td>
                          <?
                        }
                      }
                      ?>
                      <td><a href="<?= base_url('usuarios_quitar/'.encripta($usuario->id_user)) ?>" class="btn btn-warning btn-quitar-usuario" data="<?= $conta ?>">Quitar</a></td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
            <tfoot>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Correo</th>

                <?
                if ($opciones!=false) {
                  foreach ($opciones->result() as $opcion) {
                    ?>
                    <th><?= $opcion->opcion ?></th>
                    <?
                  }
                }
                ?>

                <th>&nbsp;</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

</section>
<!-- /.content -->