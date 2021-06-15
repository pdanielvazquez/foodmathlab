  <!-- Main content -->
<section class="content">

      <!-- Tabla de productos registrados -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Productos registrados
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>&nbsp;</th>
                <th>Producto</th>
                <th>Cantidad neta</th>
                <th>Cantidad de la porción</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  $conta = 0;
                  foreach ($productos->result() as $producto) {
                    ?>
                    <tr>
                      <td><?= ++$conta ?></td>
                      <td>
                        <a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" class="btn-descripcion">
                        <?= $producto->nombre ?>
                        <?
                        if ($imagenes!=false) {
                          $contaI = 0;
                          foreach ($imagenes->result() as $imagen) {
                            if ($producto->id_prod == $imagen->id_prod) {
                              ?>
                              <a href="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" title="<?= $producto->nombre.'-'.++$contaI ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=500, height=300, scrollbars=1'); return false;" >
                                <img src="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" class="img-circle elevation-2" alt="Imagen del producto" style="width: 28px; height: 28px; margin: 0 0.2rem;">
                             </a>
                              <?
                            }
                          }
                        }
                        ?>
                        </a>
                      </td>
                      <td><?= number_format($producto->cantidad_neta, 1) ?> g</td>
                      <td><?= number_format($producto->cantidad_porcion, 1) ?> g</td>
                      <td>
                        <a href="<?= base_url('productos_imagenes/'.encripta($producto->id_prod)."/0") ?>" class="btn btn-primary" data="<?= $conta ?>" title="Agregar imagen"><i class="fas fa-images" alt="Agregar imagen"></i></a>
                        <a href="<?= base_url('productos_quitar/'.encripta($producto->id_prod)) ?>" class="btn btn-warning btn-quitar-producto" data="<?= $conta ?>" title="Eliminar el producto"><i class="fas fa-trash-alt" alt="Eliminar producto"></i></a>
                      </td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>&nbsp;</th>
                <th>Producto</th>
                <th>Cantidad neta</th>
                <th>Cantidad de la porción</th>
                <th>&nbsp;</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Modal -->
      <div class="modal fade" id="descripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="descripcionLabel">Ingredientes del producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="descripcionBody">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

</section>
<!-- /.content -->