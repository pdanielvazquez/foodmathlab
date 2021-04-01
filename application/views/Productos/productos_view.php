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
                <th>Categoría</th>
                <th>Marca</th>
                <th>Producto</th>
                <th>Precio</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  foreach ($productos->result() as $producto) {
                    ?>
                    <tr>
                      <td>
                        <?
                        $txt_categoria = '-';
                        if ($categorias!=false) {
                          foreach ($categorias->result() as $categoria) {
                            if ($categoria->id_categoria == $producto->id_categoria){
                              $txt_categoria = $categoria->categoria;
                              break;
                            }
                          }
                        }
                        echo $txt_categoria;
                        ?>
                      </td>
                      <td>
                        <?
                        $txt_marca ='-';
                        if ($marcas!=false) {
                          foreach ($marcas->result() as $marca) {
                            if ($marca->id_marca == $producto->id_marca){
                              $txt_marca = $marca->marca;
                              break;
                            }
                          }
                        }
                        echo $txt_marca;
                        ?>
                      </td>
                      <td>
                        <a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" class="btn-descripcion">
                        <?= $producto->nombre ?>
                        </a>
                      </td>
                      <td><?= $producto->precio ?></td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Producto</th>
                <th>Precio</th>
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