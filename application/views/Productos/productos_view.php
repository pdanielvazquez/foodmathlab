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
              <tr>
                <th>Producto</th>
                <th>Cantidad neta</th>
                <th>Cantidad de la porción</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  foreach ($productos->result() as $producto) {
                    ?>
                    <tr>
                      <td>
                        <a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" class="btn-descripcion">
                        <?= $producto->nombre ?>
                        </a>
                      </td>
                      <td><?= number_format($producto->cantidad_neta, 1) ?> g</td>
                      <td><?= number_format($producto->cantidad_porcion, 1) ?> g</td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Producto</th>
                <th>Cantidad neta</th>
                <th>Cantidad de la porción</th>
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