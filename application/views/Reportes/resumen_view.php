<!-- Main content -->
<section class="content">

	<div class="row">
		
		

		<!-- Tabla estadística, graficas y etiquetados -->
		<div class="col-12">
			<div class="card card-danger">
		        <div class="card-header">
		          <h3 class="card-title" style="width: 100%">
		          	<div class="row">
		          		<div class="col-xs-12 col-md-6 col-lg-6">
				            <i class="fas fa-poll"></i>
				            Resumen
		          		</div>
		          		<div class="col-xs-12 col-md-6 col-lg-6" style="text-align: right;">
				            No. de productos: <?= ($productos!=false) ? count($productos->result()) : 0 ?>
		          		</div>	
		          	</div>
		          </h3>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		        	<table class="table table-bordered table-hover table-striped">
		        		<thead>
		        			<tr>
			        			<th>Concepto</th>
			        			<th>Media</th>
			        			<th>DE</th>
			        			<th>Moda</th>
			        			<th>Mediana</th>
			        			<th>Mínimo</th>
			        			<th>Máximo</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?
			        		if ($campos!=false) {
			        			foreach ($campos as $etiqueta => $campo) {
			        				?>
			        				<tr>
			        					<td><?= $etiqueta ?></td>
			        					<td><?= number_format($campo['media'], 2) ?></td>
			        					<td><?= number_format($campo['de'], 2) ?></td>
			        					<td><?= number_format($campo['moda'], 2) ?></td>
			        					<td><?= number_format($campo['mediana'], 2) ?></td>
			        					<td><?= number_format($campo['minimo'], 2) ?></td>
			        					<td><?= number_format($campo['maximo'], 2) ?></td>
			        				</tr>
			        				<?
			        			}
			        		}
			        		?>
		        		</tbody>
		        	</table>
		        </div>
		    </div>

		    <!-- Gráficos -->
		    <div class="row">

		    	<?
			    if ($campos!=false) {
			    	foreach ($campos as $etiqueta => $campo) {
				    	$labels = array();
				    	$data = array();
				    	$unidad = ($campo['campo']=='energia') ? 'kcal': 'gramos';
			    		if ($productos!=false) {
			    			foreach ($productos->result() as $producto) {
			    				$atributo = $campo['campo'];
			    				array_push($data, number_format($producto->$atributo, 2));
			    				array_push($labels, explode(' ', $producto->nombre)[0] );
			    			}
			    		}
			    	?>
				    	<!-- Card con gráfica incluida -->
				    	<div class="col-xs-12 col-md-6 col-lg-4">
				    		<div class="card card-danger">
				    			<div class="card-header">
				    				<h3 class="card-title">
				    					<i class="fas fa-chart-area"></i>
				    					<?= $etiqueta ?> general 
				    				</h3>
				    				<div class="card-tools">
					                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
					                    <i class="fas fa-expand"></i>
					                  </button>
					                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
					                    <i class="fas fa-minus"></i>
					                  </button>
					                  <button type="button" class="btn btn-tool" data-card-widget="remove">
					                    <i class="fas fa-times"></i>
					                  </button>
					                </div>
				    			</div>
				    			<div class="card-body">
									<canvas id="<?= $campo['campo'] ?>Chart" style="width: 100%;" data-values="<?= implode(',', $data) ?>" data-labels="<?= implode(',', $labels) ?>" data-unit="<?= $unidad ?>"></canvas>
				    			</div>
				    		</div>
				    	</div>
			    	<?
			    	}
			    }
			    ?>

		    </div>
		    <!-- /.Gráficos -->

			<!-- Etiquetados -->
			<div class="row">

				<!-- Opciones de etiquetado -->
				<div class="col-12">
					<div class="card card-danger">
				        <div class="card-header">
				          <h3 class="card-title">
				            <i class="fas fa-tags"></i>
				            Etiquetados
				          </h3>
				        </div>
				        <!-- /.card-header -->
				        <div class="card-body">
				        	<div class="row">

				        		<div class="col-xs-12 col-md-6 col-lg-4">
						        	<fieldset>
						        		<legend>LATAM</legend>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Chile</p>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Ecuador</p>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> México</p>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Perú</p>
						        	</fieldset>
				        		</div>

				        		<div class="col-xs-12 col-md-6 col-lg-4">
						        	<fieldset>
						        		<legend>EUROPA</legend>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Francia (NutriScore)</p>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Reino Unido (MTLL)</p>
						        	</fieldset>
				        		</div>

				        		<div class="col-xs-12 col-md-6 col-lg-4">
						        	<fieldset>
						        		<legend>INDICES</legend>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> NRF 9.3</p>
						        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> SAIN-LIM</p>
						        	</fieldset>
				        		</div>

							</div>
				        </div>
				    </div>
				</div>
				<!-- /.Opciones de etiquetado -->

				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/chile.jpg') ?>" style="width: 40px;">
					    		Chile 
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="remove">
			                    <i class="fas fa-times"></i>
			                  </button>
			                </div>
					    </div>
					    <div class="card-body">
							<fieldset>
								<legend>Promedios</legend>
								<table class="table table-bordered table-striped">
									<thead>
										<tr class="txt-centrado bg-black">
											<th>Energía</th>
											<th>Sodio</th>
											<th>Azúcares</th>
											<th>Grasas Sat</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = $prom_sodio = $prom_azucar = $prom_grasas_sat = 0;
										if ($campos!=false) {
											/*$prom_energia = $campos['Energía']['media'];
											$prom_sodio = $campos['Sodio']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];*/
											$prom_energia = 350;
											$prom_sodio = 0.5;
											$prom_azucar = 15;
											$prom_grasas_sat = 8;
										}
										$chileLabel = new Etiquetado_chile($prom_energia, $prom_sodio, $prom_azucar, $prom_grasas_sat, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> kcal</th>
											<th><?= $prom_sodio ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td>
												<?
												if ($chileLabel->getEnergia()==1) {
													?>
													<img src="<?= base_url('uploads/labels-chile/calorias.png') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td>
												<?
												if ($chileLabel->getSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-chile/sodio.png') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td>
												<?
												if ($chileLabel->getAzucar()==1) {
													?>
													<img src="<?= base_url('uploads/labels-chile/azucares.png') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td>
												<?
												if ($chileLabel->getGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-chile/grasas.png') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
										</tr>
										<?
										unset($chileLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
			</div>
			<!-- /.Etiquetados -->

		</div>
		<!-- /.Tabla estadística, graficas y etiquetados -->

	</div>

</section>
<!-- /.content -->