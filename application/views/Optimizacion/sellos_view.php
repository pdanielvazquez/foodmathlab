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
            <a class="btn btn-primary float-right btn-all" href="<?= base_url('nom051') ?>" style="margin:2px" >Ver todos
              <span class="badge badge-warning" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $conta ?></span>
            </a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Lab</th>
                <th>Azúcares</th>
                <th>Grasa Total</th>
                <th>Grasa Saturada</th>
                <th>Grasa Trans</th>
                <th>Sodio</th>
                <th>Sellos</th>
                <th>Extras</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos!=false) {

                  $conta = 0;
                  foreach ($productos->result() as $producto) {

                    $cantidad_neta = explode(" ", $producto->cantidad_neta);
                    $c_neta = array(
                      'valor' =>  $cantidad_neta[0], 
                      'unidad'=>  (count($cantidad_neta)>0) ? $cantidad_neta[1]: 'g',
                    );

                    $cantidad_porcion = explode(" ", $producto->cantidad_porcion);
                    $c_porcion = array(
                      'valor' =>  $cantidad_porcion[0],
                      'unidad' =>  (count($cantidad_porcion)>0) ? $cantidad_porcion[1]: 'g',
                    );

                    $energia_kj = explode(" ", $producto->energia_kj);
                    $e_kj = array(
                      'valor' =>  $energia_kj[0],
                      'unidad' =>  (count($energia_kj)>0) ? $energia_kj[1]: 'kJ',
                    );

                    $energia_kcal = explode(" ", $producto->energia);
                    $e_kcal = array(
                      'valor' =>  $energia_kcal[0],
                      'unidad' =>  (count($energia_kcal)>0) ? $energia_kcal[1]: 'kcal',
                    );

                    $lipidos = explode(" ", $producto->lipidos);
                    $lipids = array(
                      'valor' =>  $lipidos[0],
                      'unidad' =>  (count($lipidos)>0) ? $lipidos[1] : 'g' ,
                    );

                    $sodio = explode(" ", $producto->sodio);
                    $sodium = array(
                      'valor' =>  $sodio[0],
                      'unidad' =>  (count($sodio)>0) ? $sodio[1] : 'mg' ,
                    );

                    $hidratos = explode(" ", $producto->hidratos);
                    $carbo = array(
                      'valor' =>  $hidratos[0],
                      'unidad' =>  (count($hidratos)>0) ? $hidratos[1] : 'g' ,
                    );

                    $fibra = explode(" ", $producto->fibra);
                    $fiber = array(
                      'valor' =>  $fibra[0],
                      'unidad' =>  (count($fibra)>0) ? $fibra[1] : 'g' ,
                    );

                    $azucar = explode(" ", $producto->azucaresa);
                    $sugar = array(
                      'valor' =>  $azucar[0],
                      'unidad' =>  (count($azucar)>0) ? $azucar[1] : 'g' ,
                    );

                    $proteinas = explode(" ", $producto->proteinas);
                    $protein = array(
                      'valor' =>  $proteinas[0],
                      'unidad' =>  (count($proteinas)>0) ? $proteinas[1] : 'g' ,
                    );

                    $grasasSat = explode(" ", $producto->acidosgs);
                    $fatty_sat = array(
                      'valor' =>  $grasasSat[0],
                      'unidad' =>  (count($grasasSat)>0) ? $grasasSat[1] : 'g' ,
                    );

                    $grasasTrans = explode(" ", $producto->acidostrans);
                    $fatty_trans = array(
                      'valor' =>  $grasasTrans[0],
                      'unidad' =>  (count($grasasTrans)>0) ? $grasasTrans[1] : 'g' ,
                    );
                    
                    $cadena_valores = $carbo['valor'].','.$sugar['valor'].','.$lipids['valor'].','.$fatty_sat['valor'].','.$fatty_trans['valor'].','.$sodium['valor'].','.$protein[''].','.$fiber['valor'];
                    $MexLabel = new Etiquetado_mexico($e_kcal['valor'], $sugar['valor'], $fatty_sat['valor'], $fatty_trans['valor'], $sodium['valor'], $producto->tipo);
                    ?>
                    <tr>
                      <td><?= ++$conta ?></td>
                      <td>
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
                      </td>
                      <td><?= $producto->grupo ?></td>
                      <td><?= number_format($sugar['valor'], 2) ?> g</td>
                      <td><?= number_format($lipids['valor'], 2) ?> g</td>
                      <td><?= number_format($fatty_sat['valor'], 2) ?> g</td>
                      <td><?= number_format($fatty_trans['valor'], 2) ?> g</td>
                      <td><?= number_format($sodium['valor'], 2) ?> g</td>
                      <td>
                        <?
                        $sellos = 0;
                        if ($MexLabel->getExcesoCalorias()==1)
                          $sellos++;
                        if ($MexLabel->getExcesoAzucares()==1)
                          $sellos++;
                        if ($MexLabel->getExcesoGrasasTrans()==1)
                          $sellos++;
                        if ($MexLabel->getExcesoGrasasSat()==1)
                          $sellos++;
                        if ($MexLabel->getExcesoSodio()==1)
                          $sellos++;
                        echo $sellos;
                        ?>
                      </td>
                      <td>
                      	<div class="btn-group">
    			                
    			                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
    			                    <span class="sr-only">Toggle Dropdown</span>
    			                    <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-1px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  <?
                                  if ($MexLabel->getExcesoAzucares()==1){
                                    ?>
    			                           <a class="dropdown-item btn-quitar" href="#" data="azucar" data-info="<?= $cadena_valores ?>">Azúcar</a>
                                    <?
                                  }
                                  if ($MexLabel->getExcesoGrasasSat()==1){
                                    ?>
    			                           <a class="dropdown-item btn-quitar" href="#" data="grasas" data-info="<?= $cadena_valores ?>">Grasas saturadas</a>
                                    <?
                                  }
                                  if ($MexLabel->getExcesoSodio()==1){
                                    ?>
    			                           <a class="dropdown-item btn-quitar" href="#" data="sodio" data-info="<?= $cadena_valores ?>">Sodio</a>
                                    <?
                                  }
                                  if ($MexLabel->getExcesoCalorias()==1){
                                    ?>
    			                           <a class="dropdown-item btn-quitar" href="#" data="energia" data-info="<?= $cadena_valores ?>">Energía</a>
                                    <?
                                  }
                                  ?>
    			                    </div>
    			                </button>
                          <button type="button" class="btn btn-danger">Quitar</button>
    			              </div>
                      </td>
                    </tr>
                    <?
                    unset($MexLabel);
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
      <div class="modal fade" id="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="descripcionLabel">Resultados</h5>
              <button type="button" class="close close-respuesta" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="response">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-respuesta" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

</section>
<!-- /.content -->