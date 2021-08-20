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
                <th>No.</th>
                <th>Nombre</th>
                <!--<th>CHO (Carbohidratos)</th>-->
                <th>Azúcares</th>
                <th>Grasa Total</th>
                <th>Grasa Saturada</th>
                <th>Grasa Trans</th>
                <th>Sodio</th>
                <!--<th>Proteína</th>
                <th>Fibra</th>-->
                <th>Sellos</th>
                <th>Extras</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  $conta = 0;
                  foreach ($productos->result() as $producto) {
                    $cadena_valores = $producto->hidratos.','.$producto->azucaresa.','.$producto->lipidos.','.$producto->acidosgs.','.$producto->acidostrans.','.$producto->sodio.','.$producto->proteina.','.$producto->fibra;
                    $MexLabel = new Etiquetado_mexico($producto->energia, $producto->azucaresa, $producto->acidosgs, $producto->acidostrans, $producto->sodio, $producto->tipo);
                    ?>
                    <tr>
                      <td><?= ++$conta ?></td>
                      <td><?= $producto->nombre ?></td>
                      <!--<td><?= number_format($producto->hidratos, 2) ?> g</td>-->
                      <td><?= number_format($producto->azucaresa, 2) ?> g</td>
                      <td><?= number_format($producto->lipidos, 2) ?> g</td>
                      <td><?= number_format($producto->acidosgs, 2) ?> g</td>
                      <td><?= number_format($producto->acidostrans, 2) ?> g</td>
                      <td><?= number_format($producto->sodio, 2) ?> g</td>
                      <!--<td><?= number_format($producto->proteina, 2) ?> g</td>
                      <td><?= number_format($producto->fibra, 2) ?> g</td>-->
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
    			                           <a class="dropdown-item btn-quitar" href="#" data="azucar" data-info="<?= $cadena_valores ?>">Azucar</a>
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
            <tfoot>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <!--<th>CHO (Carbohidratos)</th>-->
                <th>Azúcares</th>
                <th>Grasa Total</th>
                <th>Grasa Saturada</th>
                <th>Grasa Trans</th>
                <th>Sodio</th>
                <!--<th>Proteína</th>
                <th>Fibra</th>-->
                <th>Sellos</th>
                <th>Extras</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

	<!-- <div class="card card-danger">
		<div class="card-header">
			<h4 class="card-title">
				<i class="fas fa-tachometer-alt"></i> Datos para formulas
			</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>CHO (Carbohidratos)</label>
					<input type="number" id="CHO" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Azúcares</label>
					<input type="number" id="A" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Grasa Total</label>
					<input type="number" id="GT" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Grasa Saturada</label>
					<input type="number" id="GSAT" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Grasa Trans</label>
					<input type="number" id="GTRANS" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Sodio</label>
					<input type="number" id="sodio" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Proteína</label>
					<input type="number" id="P" class="form-control" placeholder="0" step="0.05">
				</div>
				<div class="form-group col-xs-12 col-md-6 col-lg-3">
					<label>Fibra</label>
					<input type="number" id="F" class="form-control" placeholder="0" step="0.05">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="btn-group">
                <button type="button" class="btn btn-lg btn-secondary">Quitar</button>
                <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-1px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item btn-quitar" href="#" data="azucar">Azucar</a>
                        <a class="dropdown-item btn-quitar" href="#" data="grasas">Grasas saturadas</a>
                        <a class="dropdown-item btn-quitar" href="#" data="sodio">Sodio</a>
                        <a class="dropdown-item btn-quitar" href="#" data="energia">Energía</a>
                    </div>
                </button>
            </div>

		</div>
	</div> -->

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