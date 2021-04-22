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

				<!-- Etiquetado Chile -->
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
				<!-- /.Etiquetado Chile -->

				<!-- Etiquetado Ecuador -->
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/ecuador.jpg') ?>" style="width: 40px;">
					    		Ecuador 
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
											<th>Grasas Totales</th>
											<th>Azucares</th>
											<th>Sodio</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_grasas_tot = $prom_azucar = $prom_sodio = 0;
										if ($campos!=false) {
											$prom_grasas_tot = $campos['Grasa total']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
											/*$prom_energia = 350;
											$prom_sodio = 0.5;
											$prom_azucar = 15;
											$prom_grasas_sat = 8;*/
										}
										$ecuadorLabel = new Etiquetado_ecuador($prom_grasas_tot, $prom_azucar, $prom_sodio, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_grasas_tot ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td>
												<?
												switch($ecuadorLabel->getGrasaTotal()){
													case 0:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 150px;">
														<?
														break;
													case 1:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 150px;">
														<?
														break;
													case 2:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 150px;">
														<?
														break;
												}
												?>
											</td>
											<td>
												<?
												switch($ecuadorLabel->getAzucar()){
													case 0:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 150px;">
														<?
														break;
													case 1:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 150px;">
														<?
														break;
													case 2:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 150px;">
														<?
														break;
												}
												?>
											</td>
											<td>
												<?
												switch($ecuadorLabel->getSodio()){
													case 0:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 150px;">
														<?
														break;
													case 1:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 150px;">
														<?
														break;
													case 2:
														?>
														<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 150px;">
														<?
														break;
												}
												?>
											</td>
										</tr>
										<?
										unset($ecuadorLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Ecuador -->

				<!-- Etiquetado Perú -->
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/peru.jpg') ?>" style="width: 40px;">
					    		Perú <small> (<?= (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")) ? "Segunda fase": "Primera fase" ?>)</small>
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
											<th>Azucar</th>
											<th>Sodio</th>
											<th>Grasas Saturadas</th>
											<th>Grasas Trans</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_grasas_sat = $prom_grasas_trans = $prom_azucar = $prom_sodio = 0;
										if ($campos!=false) {
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_grasas_trans = $campos['Grasa total']['media'];
										}

										if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
											$peruLabel = new Etiquetado_peru_2a_fase($prom_azucar, $prom_sodio, $prom_grasas_sat, $prom_grasas_trans, 'solido');
										}
										else{
											$peruLabel = new Etiquetado_peru_1a_fase($prom_azucar, $prom_sodio, $prom_grasas_sat, $prom_grasas_trans, 'solido');
										}

										?>										
										<tr class="txt-centrado">
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_grasas_trans ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td>
												<?
												if ($peruLabel->getAzucares()==1) {
													?>
													<img src="<?= base_url('uploads/labels-peru-1a/azucar.jpg') ?>" style="width: 100px;">
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
												if ($peruLabel->getSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-peru-1a/sodio.jpg') ?>" style="width: 100px;">
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
												if ($peruLabel->getGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-peru-1a/grasas_sat.jpg') ?>" style="width: 100px;">
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
												if ($peruLabel->getGrasasTrans('otros')==1) {
													?>
													<img src="<?= base_url('uploads/labels-peru-1a/grasas_trans.jpg') ?>" style="width: 100px;">
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
										unset($peruLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Perú -->

				<!-- Etiquetado UK -->
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/uk.jpg') ?>" style="width: 40px;">
					    		Reino Unido
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
											<th>Grasas Totales</th>
											<th>Grasas Saturadas</th>
											<th>Azucares</th>
											<th>Sodio</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_grasas_sat = $prom_grasas_tot = $prom_azucar = $prom_sodio = $prom_energia = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_tot = $campos['Grasa total']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$UkLabel = new Etiquetado_UK($prom_sodio, $prom_azucar, $prom_grasas_sat, $prom_grasas_tot, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> g</th>
											<th><?= $prom_grasas_tot ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td>
												<?
												$color = '#EDEDED';
												$txt = 'ENERGÍA';
												?>
												<div class="label_UK" style="background-color: <?= $color ?>;">
													<p class="label_UK_title"><?= $txt ?></p>
													<p class="label_UK_txt">
														Calorías
														<span class="label_UK_value">
															<?= number_format($prom_energia, 1) ?> kcal
														</span>
													</p>
													<p class="label_UK_ptc">00%</p>
												</div>
											</td>
											<td>
												<?
												$color = '';
												$txt = '';
												switch($UkLabel->getGrasaTotal()) {
													case 2:
														$color = '#f65627';
														$txt = 'ALTO';
														break;
													case 1:
														$color = '#f9b03f';
														$txt = 'MEDIO';
														break;
													case 0:
														$color = '#78c758';
														$txt = 'BAJO';
														break;
												}
												?>
												<div class="label_UK" style="background-color: <?= $color ?>;">
													<p class="label_UK_title"><?= $txt ?></p>
													<p class="label_UK_txt">
														Grasa
														<span class="label_UK_value">
															<?= number_format($prom_grasas_tot, 1) ?> g
														</span>
													</p>
													<p class="label_UK_ptc">00%</p>
												</div>
											</td>
											<td>
												<?
												$color = '';
												$txt = '';
												switch($UkLabel->getGrasasSat()) {
													case 2:
														$color = '#f65627';
														$txt = 'ALTO';
														break;
													case 1:
														$color = '#f9b03f';
														$txt = 'MEDIO';
														break;
													case 0:
														$color = '#78c758';
														$txt = 'BAJO';
														break;
												}
												?>
												<div class="label_UK" style="background-color: <?= $color ?>;">
													<p class="label_UK_title"><?= $txt ?></p>
													<p class="label_UK_txt">
														Grasa Sat
														<span class="label_UK_value">
															<?= number_format($prom_grasas_sat, 1) ?> g
														</span>
													</p>
													<p class="label_UK_ptc">00%</p>
												</div>
											</td>
											<td>
												<?
												$color = '';
												$txt = '';
												switch($UkLabel->getAzucares()) {
													case 2:
														$color = '#f65627';
														$txt = 'ALTO';
														break;
													case 1:
														$color = '#f9b03f';
														$txt = 'MEDIO';
														break;
													case 0:
														$color = '#78c758';
														$txt = 'BAJO';
														break;
												}
												?>
												<div class="label_UK" style="background-color: <?= $color ?>;">
													<p class="label_UK_title"><?= $txt ?></p>
													<p class="label_UK_txt">
														Azúcar
														<span class="label_UK_value">
															<?= number_format($prom_azucar, 1) ?> g
														</span>
													</p>
													<p class="label_UK_ptc">00%</p>
												</div>
											</td>
											<td>
												<?
												$color = '';
												$txt = '';
												switch($UkLabel->getSodio()) {
													case 2:
														$color = '#f65627';
														$txt = 'ALTO';
														break;
													case 1:
														$color = '#f9b03f';
														$txt = 'MEDIO';
														break;
													case 0:
														$color = '#78c758';
														$txt = 'BAJO';
														break;
												}
												?>
												<div class="label_UK" style="background-color: <?= $color ?>;">
													<p class="label_UK_title"><?= $txt ?></p>
													<p class="label_UK_txt">
														Sodio
														<span class="label_UK_value">
															<?= number_format($prom_sodio, 1) ?> g
														</span>
													</p>
													<p class="label_UK_ptc">00%</p>
												</div>
											</td>
										</tr>
										<?
										unset($UkLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Uk -->

				<!-- Etiquetado Francia -->
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/francia.jpg') ?>" style="width: 40px;">
					    		Francia
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
								<table class="table table-bordered table-striped table-responsive">
									<thead>
										<tr class="txt-centrado bg-black">
											<th>Energía</th>
											<th>Grasas Totales</th>
											<th>Grasas Saturadas</th>
											<th>Azucares</th>
											<th>Sodio</th>
											<th>Fibra</th>
											<th>Proteina</th>
											<th>Frutas y Verduras</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = 
										$prom_grasas_tot = 
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 
										$prom_fibra = 
										$prom_proteina = 
										$prom_frut_ver = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_tot = $campos['Grasa total']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
											$prom_fibra = $campos['Fibra']['media'];
											$prom_proteina = $campos['Proteinas']['media'];
											$prom_frut_ver = ($campos['frutas']['media'] + $campos['verduras']['media'])/2;
										}
										$NutriScoreLabel = new NutriScore($prom_energia, $prom_azucar, $prom_grasas_sat, $prom_grasas_tot, $prom_sodio, $prom_frut_ver, $prom_fibra, $prom_proteina, 0, 100, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> g</th>
											<th><?= $prom_grasas_tot ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
											<th><?= $prom_fibra ?> g</th>
											<th><?= $prom_proteina ?> g</th>
											<th><?= $prom_frut_ver ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td colspan="8">
												<?
												switch ($NutriScoreLabel->getClase()) {
													case 'A':
														?>
														<img src="<?= base_url('uploads/labels-francia/nutri-score-a.jpg') ?>" style="width: 40%;">
														<?
														break;
													case 'B':
														?>
														<img src="<?= base_url('uploads/labels-francia/nutri-score-b.jpg') ?>" style="width: 40%;">
														<?
														break;
													case 'C':
														?>
														<img src="<?= base_url('uploads/labels-francia/nutri-score-c.jpg') ?>" style="width: 40%;">
														<?
														break;
													case 'D':
														?>
														<img src="<?= base_url('uploads/labels-francia/nutri-score-d.jpg') ?>" style="width: 40%;">
														<?
														break;
													case 'E':
														?>
														<img src="<?= base_url('uploads/labels-francia/nutri-score-e.jpg') ?>" style="width:40%;">
														<?
														break;
												}
												?>
											</td>
										</tr>
										<?
										unset($NutriScoreLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Francia -->

				

			</div>
			<!-- /.Etiquetados -->

		</div>
		<!-- /.Tabla estadística, graficas y etiquetados -->

	</div>

</section>
<!-- /.content -->