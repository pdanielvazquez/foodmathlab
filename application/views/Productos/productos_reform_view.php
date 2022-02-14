  <!-- Main content -->
<section class="content">

      <!-- Tabla de productos registrados -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Reformulación de Productos
          </h3>
          
         </div>
        <!-- /.card-header -->
        <div class="card-body" >
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary" align="center">
                <th>No.</th>
                <th>Producto</th>
                <th>Labs</th>
                <th>Reformulaciones</th>
                <th>Reformulación</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  $conta = 0;
                  foreach ($productos->result() as $producto) {
				            $conta_r=0;
                    ?>
                    <tr>
                      <td class="txt-centrado"><?= ++$conta ?></td>
                      <td><?= $producto->producto?></td>
                      <td><?= $producto->grupo ?></td>
                      <td class="txt-centrado">
                        <?
                        if ($productos_reform!=false) {
                          foreach ($productos_reform->result() as $reformulado) {
                            if ($producto->id_prod == $reformulado->id_prod_original) {
                              $conta_r++;
                            }
                          }
                        }
                        echo $conta_r;
                        ?>
                      </td>
                      <td align="center">
					  	          <a href="<?= base_url('productos_reform_editar/'.encripta($producto->id_prod)."/0")?>" class="btn btn-labeled btn-warning" data="<?= $conta ?>" title="Agregar una reformulación al producto" >
						              <i class="fas fa-plus" alt="Reformulación producto"></i></a>
                        <?
                        if ($conta_r>0) {
                           ?>
                            <a href="<?=base_url('grupos_reform/').encripta($producto->id_prod)?>" class="btn btn-labeled btn-info" title="Ver reformulaciones del producto">
                              <i class="fas fa-search" alt="Cantidad de Reformulaciones"></i>
                            </a>  
                           <?
                         }
                         else{
                          ?>
                            <a class="btn btn-labeled btn-info disabled" title="Ver reformulaciones del producto" >
                              <i class="fas fa-search" alt="Cantidad de Reformulaciones"></i>
                            </a> 
                          <?
                         }
                        ?>
                        
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

      <!-- Modal 
      <div class="modal fade" id="descripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="descripcionLabel">Cantidad de Reformulaciones</h5>
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
      </div>-->

</section>
<!-- /.content -->