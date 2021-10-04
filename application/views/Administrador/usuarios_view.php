<!-- Main content -->
<section class="content">

    <!-- Tabla de productos registrados -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Usuarios & Permisos
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="table-usuarios" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary txt-centrado">
                <th>No.</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Laboratorios contratados</th>
                <th>Productos por Lab</th>
                <th>Etiquetados contratados</th>
                <th>Índices contratados</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($usuarios) {
                  $conta = 0;
                  foreach ($usuarios->result() as $usuario) {
                    $no_labs  = 0;
                    $no_prods = 0;
                    $labels   = 0;
                    $indexes  = 0;
                    if ($permisos_labs!=false) {
                      foreach ($permisos_labs->result() as $labs) {
                        if ($usuario->id_user == $labs->id_usuario) {
                          $no_labs = $labs->no_labs;
                          $no_prods = $labs->no_productos;
                        }
                      }
                    }
                    if ($permisos_labels!=false) {
                      foreach ($permisos_labels->result() as $label) {
                        if ($label->id_usuario == $usuario->id_user) {
                          $labels++;
                        }
                      }
                    }
                    if ($permisos_indexes!=false) {
                      foreach ($permisos_indexes->result() as $index) {
                        if ($index->id_usuario == $usuario->id_user) {
                          $indexes++;
                        }
                      }
                    }
                    ?>
                    <tr>
                      <td class="txt-centrado"><?= ++$conta ?></td>
                      <td><?= $usuario->nombre ?></td>
                      <td><?= $usuario->correo ?></td>
                      <td class="txt-centrado"><?= $no_labs ?></td>
                      <td class="txt-centrado"><?= $no_prods ?></td>
                      <td class="txt-centrado"><?= $labels ?></td>
                      <td class="txt-centrado"><?= $indexes ?></td>
                      <td>
                        <a href="<?= base_url('usuarios_editar/'.encripta($usuario->id_user).'/0') ?>" class="btn btn-success btn-editar-usuario" data="<?= $conta ?>" title="Editar usuario & permisos"><i class="fas fa-edit" alt="Editar usuario & permisos"></i></a>

                        <a href="<?= base_url('usuarios_eliminar/'.encripta($usuario->id_user)) ?>" class="btn btn-danger btn-quitar-usuario" data="<?= $conta ?>" title="Eliminar usuario"><i class="fas fa-trash-alt" alt="Eliminar usuario"></i></a>

                      </td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

</section>
<!-- /.content -->