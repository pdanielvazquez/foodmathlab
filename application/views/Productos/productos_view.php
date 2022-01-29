<!-- Main content -->
<section class="content">

      <!-- Tabla de productos registrados -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Productos registrados
          </h3>
          <?
            $conta=0;
            if ($grupos!=false) {
              
              foreach ($grupos->result() as $grupo) {
                  $no_prods=0;
                  /*Verificar el numero de productos por Laboratorio*/
                  if ($productos!=false) {
                    foreach ($productos->result() as $producto) {
                      if ($producto->id_grupo == $grupo->id_grupo) {
                        $no_prods++;
                        $conta++;
                      }
                    }
                  }

                  $active = ($conta == 0) ? 'active' : '';
                  ?>
                    <a class="btn btn-default text-red float-right btn-filter" href="#" style="margin:2px" data="<?= $grupo->nombre ?>"><?= $grupo->nombre ?>
                    <span class="badge badge-warning" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $no_prods ?></span>
                    </a>
                  <?
              }
            }
            ?>
            <a class="btn btn-primary float-right btn-all" href="<?= base_url('productos_registrados') ?>" style="margin:2px" >Ver todos
              <span class="badge badge-warning" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $conta ?></span>
            </a>
          
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Producto</th>
                <th>Labs</th>
                <!-- <th>Cantidad neta</th>
                <th>Cantidad de la porción</th> -->
                <th>Opciones</th>
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
                        <!-- <a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" class="btn-descripcion-lab" data-lab="<?= $producto->id_grupo ?>"> -->
                        <a href="<?= base_url('productos_informacion/'.encripta($producto->id_prod)) ?>" class="" data="<?= $conta ?>" title="Ver la información del producto" >
                        <?= $producto->producto ?>
                        </a>
                        <?
                        if ($imagenes!=false) {
                          $contaI = 0;
                          foreach ($imagenes->result() as $imagen) {
                            if ($producto->id_prod == $imagen->id_prod) {
                              ?>
                              <a href="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" title="<?= $producto->producto.'-'.++$contaI ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=500, height=300, scrollbars=1'); return false;" >
                                <img src="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" class="img-circle elevation-2" alt="Imagen del producto" style="width: 28px; height: 28px; margin: 0 0.2rem;">
                             </a>
                              <?
                            }
                          }
                        }
                        ?>

                        <!-- <a href="<?= base_url('productos_descripcion/'.encripta($producto->id_prod).'/0') ?>" class="btn btn-success btn-ver-producto" title="Ver el producto" target="_blank" onclick="window.open(this.href, this.target, 'width=1000, height=800'); return false;"><i class="fas fa-search" alt="Ver el producto"></i></a> -->

                      </td>
                      <td><?= $producto->grupo ?></td>
                      <!-- <td><?= number_format($producto->cantidad_neta, 1) ?> g</td>
                      <td><?= number_format($producto->cantidad_porcion, 1) ?> g</td> -->
                      <td>
                        
                        <a href="<?= base_url('productos_informacion/'.encripta($producto->id_prod)) ?>" class="btn btn-warning" data="<?= $conta ?>" title="Ver la información del producto" ><i class="fas fa-search" alt="Ver la información del producto"></i></a>
                        
                        <a href="<?= base_url('productos_editar/'.encripta($producto->id_prod).'/0') ?>" class="btn btn-success btn-editar-producto" data="<?= $conta ?>" title="Editar el producto" ><i class="fas fa-edit" alt="Editar producto"></i></a>

                        <a href="<?= base_url('productos_imagenes/'.encripta($producto->id_prod)."/0") ?>" class="btn btn-primary" data="<?= $conta ?>" title="Agregar imagen"><i class="fas fa-images" alt="Agregar imagen"></i></a>

                        <a href="<?= base_url('productos_quitar/'.encripta($producto->id_prod)) ?>" class="btn btn-danger btn-quitar-producto" data="<?= $conta ?>" title="Eliminar el producto"><i class="fas fa-trash-alt" alt="Eliminar producto"></i></a>

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

      <!-- Modal -->
      <div class="modal fade" id="descripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="descripcionLabel">Ingredientes del producto</h5>
              <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="descripcionBody">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

</section>
<!-- /.content -->