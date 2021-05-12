<!-- Main content -->
<section class="content">

	<div class="row">

		<!-- Opciones de etiquetado -->
		<div class="col-xs-12 col-md-4 col-lg-3">
			<div class="card card-danger">
		        <div class="card-header">
		          <h3 class="card-title">
		            <i class="fas fa-tags"></i>
		            Etiquetados
		          </h3>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body table-responsive" style="height: 300px;">
		        	<fieldset>
		        		<legend>LATAM</legend>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-chile" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Chile
				       	</p>
		        		<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-ecuador" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Ecuador
				       	</p>
			        	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-mexico" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		México
				       	</p>
			        	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-peru" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Perú
				       	</p>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-colombia" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Colombia
				       	</p>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-uruguay" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Uruguay
				       	</p>
				    </fieldset>

		        	<fieldset>
				        <legend>EUROPA-ASIA</legend>
				   		<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-francia" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Francia
				       	</p>
			     		<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-uk" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Reino Unido
				       	</p>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-italia" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Italia
				       	</p>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-australia" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Australia & Nueva Zelanda
				       	</p>
				       	<p style="margin: 0;">
				       		<a href="" title="Ver etiquetado" data="summary-israel" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		Israel
				       	</p>
		        	</fieldset>

				    <fieldset>
			    		<legend>INDICES</legend>
		        		<p style="margin: 0;">
				       		<a href="" title="Ver Indice" data="index-nrf93" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		NRF9.3
				       	</p><p style="margin: 0;">
				       		<a href="" title="Ver Indice" data="index-sain-lim" class="btn-summary">
				       			<i class="fas fa-tag"></i>
				       		</a>
				       		SAIN-LIM
				       	</p>
		        	</fieldset>

		        </div>
		    </div>
		</div>
		<!-- /.Opciones de etiquetado -->
		
		<!-- Tabla estadística, graficas y etiquetados -->
		<div class="col-xs-12 col-md-8 col-lg-9">
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
		        <div class="card-body table-responsive" style="height: 300px;">
		        	<table class="table table-bordered table-hover table-striped" >
		        		<thead style="width: 100%;">
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
			        					<td>
			        						<a href="" title="Ver gráfica de <?= $etiqueta ?>" data="graph-<?= $campo['campo'] ?>" class="btn-graph" style="margin-right: 5px;">
			        							<i class="fas fa-chart-area"></i>
			        						</a>
			        						<?= $etiqueta ?>
			        					</td>
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

		</div>
		<!-- /.Tabla estadística, graficas y etiquetados -->

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
				    	<div class="col-xs-12 col-md-6 col-lg-4" id="graph-<?= $campo['campo'] ?>" style="display: none;">
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
					                  <button type="button" class="btn btn-tool btn-remove">
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

				<!-- Etiquetado Chile -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-chile" style="display: none;">
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
			                  <button type="button" class="btn btn-tool btn-remove">
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
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-ecuador" style="display: none;">
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
			                  <button type="button" class="btn btn-tool btn-remove">
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
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-peru" style="display: none;">
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
			                  <button type="button" class="btn btn-tool btn-remove">
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
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-uk" style="display: none;">
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
			                  <button type="button" class="btn btn-tool btn-remove">
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
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-francia" style="display: none;">
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
			                  <button type="button" class="btn btn-tool btn-remove">
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

				<!-- Etiquetado México -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-mexico" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/mexico.jpg') ?>" style="width: 40px;">
					    		México
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th>Azucares</th>
											<th>Grasas Saturadas</th>
											<th>Grasas Trans</th>
											<th>Sodio</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = 
										$prom_grasas_trans = 
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_trans = $campos['Grasas trans']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$MexLabel = new Etiquetado_mexico($prom_energia, $prom_azucar, $prom_grasas_sat, $prom_grasas_trans, $prom_sodio, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_grasas_trans ?> g</th>
											<th><?= $prom_sodio ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td class="txt-centrado">
												<?
												if ($MexLabel->getExcesoCalorias()==1) {
													?>
													<img src="<?= base_url('uploads/labels-mexico/exceso-calorias.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($MexLabel->getExcesoAzucares()==1) {
													?>
													<img src="<?= base_url('uploads/labels-mexico/exceso-azucares.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($MexLabel->getExcesoGrasasTrans()==1) {
													?>
													<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-trans.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($MexLabel->getExcesoGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-sat.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($MexLabel->getExcesoSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-mexico/exceso-sodio.jpg') ?>" style="width: 100px;">
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
										unset($MexLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado México -->

				<!-- Etiquetado Colombia -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-colombia" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/colombia.jpg') ?>" style="width: 40px;">
					    		Colombia
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th>Sodio</th>
											<th>Azucares</th>
											<th>Grasas Saturadas</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 0;
										if ($campos!=false) {
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$ColombiaLabel = new Etiquetado_colombia($prom_sodio, $prom_azucar, $prom_grasas_sat, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_sodio ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td class="txt-centrado">
												<?
												if ($ColombiaLabel->getSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/sodio.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($ColombiaLabel->getAzucares()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/azucares.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($ColombiaLabel->getGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/grasas-sat.jpg') ?>" style="width: 100px;">
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
										unset($ColombiaLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Colombia -->

				<!-- Etiquetado Israel -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-israel" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/israel.jpg') ?>" style="width: 40px;">
					    		Israel
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th>Sodio</th>
											<th>Azucares</th>
											<th>Grasas Saturadas</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 0;
										if ($campos!=false) {
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$IsraelLabel = new Etiquetado_israel($prom_sodio, $prom_azucar, $prom_grasas_sat, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_sodio ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td class="txt-centrado">
												<?
												if ($IsraelLabel->getSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/sodio.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($IsraelLabel->getAzucares()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/azucares.jpg') ?>" style="width: 100px;">
													<?
												}
												else{
													?>
													<img src="<?= base_url('uploads/labels/empty.jpg') ?>" style="width: 100px;">
													<?
												}
												?>
											</td>
											<td class="txt-centrado">
												<?
												if ($IsraelLabel->getGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-colombia/grasas-sat.jpg') ?>" style="width: 100px;">
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
										unset($IsraelLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Israel -->

				<!-- Etiquetado Italia -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-italia" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/italia.jpg') ?>" style="width: 40px;">
					    		Italia
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th style="width: 20%;">Energia</th>
											<th style="width: 20%;">Grasa total</th>
											<th style="width: 20%;">Grasas Saturadas</th>
											<th style="width: 20%;">Azucares</th>
											<th style="width: 20%;">Sodio</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = 
										$prom_grasas_tot = 
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_tot = $campos['Grasa total']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$ItaliaLabel = new Etiquetado_italia($prom_energia, $prom_grasas_tot, $prom_grasas_sat, $prom_azucar, $prom_sodio);
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> kcal</th>
											<th><?= $prom_grasas_tot ?> g</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td class="txt-centrado">
												<div class="battery-title-1">
													<p><strong>ENERGIA</strong></p>
													<p><?= number_format($prom_energia*4.184) ?> kJ</p>
													<p><?= number_format($prom_energia) ?> kcal</p>
												</div>
												<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
													<?= number_format($ItaliaLabel->getEnergia()) ?>%
												</div>
												<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
											</td>
											<td class="txt-centrado">
												<div class="battery-title-2">
													<p><strong>GRASSI</strong></p>
													<p><?= number_format($prom_grasas_tot, 2) ?> g</p>
													<p>&nbsp;</p>
												</div>
												<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
													<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
												</div>
												<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
											</td>
											<td class="txt-centrado">
												<div class="battery-title-2">
													<p><strong>GRASSI<br>SATURI</strong></p>
													<p><?= number_format($prom_grasas_sat, 2) ?> g</p>
												</div>
												<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
													<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
												</div>
												<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
											</td>
											<td class="txt-centrado">
												<div class="battery-title-2">
													<p><strong>ZUCCHERI</strong></p>
													<p><?= number_format($prom_azucar, 2) ?> g</p>
													<p>&nbsp;</p>
												</div>
												<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
													<?= number_format($ItaliaLabel->getAzucares()) ?>%
												</div>
												<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
											</td>
											<td class="txt-centrado">
												<div class="battery-title-2">
													<p><strong>SALE</strong></p>
													<p><?= number_format($prom_sodio, 2) ?> g</p>
													<p>&nbsp;</p>
												</div>
												<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
													<?= number_format($ItaliaLabel->getSodio()) ?>%
												</div>
												<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
											</td>
										</tr>
										<?
										unset($ItaliaLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Italia -->

				<!-- Etiquetado Australia -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-australia" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/australia.jpg') ?>" style="width: 40px;">
					    		Australia <img src="<?= base_url('uploads/flags/nueva-zelanda.jpg') ?>" style="width: 40px;"> Nueva Zelanda
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th style="width: 12%;">Energia</th>
											<th style="width: 12%;">Grasas Saturadas</th>
											<th style="width: 12%;">Azucares</th>
											<th style="width: 12%;">Sodio</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = 
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio =
										$prom_calcio =
										$prom_verduras =
										$prom_proteinas =
										$prom_fibra = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
											$prom_calcio = $campos['Calcio']['media'];
											$prom_verduras = $campos['Verdura']['media'] + $campos['Fruta']['media'];
											$prom_proteinas = $campos['Proteinas']['media'];
											$prom_fibra = $campos['Fibra']['media'];
										}
										$AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda($prom_energia, $prom_grasas_sat, $prom_sodio, $prom_azucar, $prom_calcio, $prom_verduras, $prom_proteinas, $prom_fibra, 0, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= $prom_energia ?> kcal</th>
											<th><?= $prom_grasas_sat ?> g</th>
											<th><?= $prom_azucar ?> g</th>
											<th><?= $prom_sodio ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td class="txt-centrado" colspan="4">
												
												<img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img">
												<div class="australia-value">
													<p class="title">ENERGY</p>
													<p class="val"><?= number_format($prom_energia * 4.184, 1) ?> kJ</p>
												</div>
												<div class="australia-value">
													<p class="title">SAT FAT</p>
													<p class="val"><?= number_format($prom_grasas_sat, 1) ?> g</p>
												</div>
												<div class="australia-value">
													<p class="title">SUGARS</p>
													<p class="val"><?= number_format($prom_azucar, 1) ?> g</p>
												</div>
												<div class="australia-value">
													<p class="title">SODIUM</p>
													<p class="val"><?= number_format($prom_sodio, 1) ?> g</p>
												</div>
											</td>
										</tr>
										<?
										unset($AustraliaLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Australia -->

				<!-- Etiquetado Uruguay -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="summary-uruguay" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		<img src="<?= base_url('uploads/flags/uruguay.jpg') ?>" style="width: 40px;">
					    		Uruguay
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
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
											<th style="width: 20%;">Grasas</th>
											<th style="width: 20%;">Grasas Sat</th>
											<th style="width: 20%;">Sodio</th>
											<th style="width: 20%;">Azucares</th>
										</tr>
									</thead>
									<tbody>
										<?
										$prom_energia = 
										$prom_grasas_tot = 
										$prom_grasas_sat = 
										$prom_azucar = 
										$prom_sodio = 0;
										if ($campos!=false) {
											$prom_energia = $campos['Energía']['media'];
											$prom_grasas_tot = $campos['Grasa total']['media'];
											$prom_grasas_sat = $campos['Grasas saturadas']['media'];
											$prom_azucar = $campos['Azucares']['media'];
											$prom_sodio = $campos['Sodio']['media'];
										}
										$UruguayLabel = new Etiquetado_uruguay($prom_energia, $prom_grasas_tot, $prom_grasas_sat, $prom_sodio, $prom_azucar, 'solido');
										?>										
										<tr class="txt-centrado">
											<th><?= number_format($prom_grasas_tot, 1) ?> g</th>
											<th><?= number_format($prom_grasas_sat, 1) ?> g</th>
											<th><?= number_format($prom_sodio, 1) ?> g</th>
											<th><?= number_format($prom_azucar, 1) ?> g</th>
										</tr>
										<tr class="txt-centrado">
											<td>
												<?
												if ($UruguayLabel->getGrasaTot()==1) {
													?>
													<img src="<?= base_url('uploads/labels-uruguay/grasas_tot.jpg') ?>" style="width: 100px;">
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
												if ($UruguayLabel->getGrasasSat()==1) {
													?>
													<img src="<?= base_url('uploads/labels-uruguay/grasas_sat.jpg') ?>" style="width: 100px;">
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
												if ($UruguayLabel->getSodio()==1) {
													?>
													<img src="<?= base_url('uploads/labels-uruguay/sodio.jpg') ?>" style="width: 100px;">
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
												if ($UruguayLabel->getAzucares()==1) {
													?>
													<img src="<?= base_url('uploads/labels-uruguay/azucares.jpg') ?>" style="width: 100px;">
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
										unset($UruguayLabel);
										?>
									</tbody>
								</table>
							</fieldset>
					    </div>
					</div>
				</div>
				<!-- /.Etiquetado Uruguay -->

			</div>
			<!-- /.Etiquetados -->

			<!-- Indices -->
			<div class="row">

				<!-- Indice NRF 9.3 -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="index-nrf93" style="display: block;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		NRF 9.3
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
			                    <i class="fas fa-times"></i>
			                  </button>
			                </div>
					    </div>
					    <div class="card-body">
							<?
							$dataX = array();
							$dataY = array();
							$label = array();
						    if ($productos!=false) {
						    	foreach ($productos->result() as $producto) {
						    		$valores = array();
						    		foreach ($indices as $etiqueta => $campo) {
						    			$atributo = $campo['campo'];
						    			$valores[$atributo] = number_format($producto->$atributo, 2);
						    		}
						    		$nrf93 = new NRF93($valores);
						    		array_push($dataX, number_format($nrf93->getNRF9(), 1));
						    		array_push($dataY, number_format($nrf93->getNRF3(), 1));
						    		array_push($label, $producto->nombre);
						    		unset($nrf93);
						    	}
						    }
						    ?>

						    <canvas id="nrf93Chart" style="width: 100%;" data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-unit="<?= $unidad ?>"></canvas>
					    </div>
					</div>
				</div>
				<!-- /.Indice NRF 9.3 -->

				<!-- Indice Sain-Lim -->
				<div class="col-xs-12 col-md-6 col-lg-6" id="index-sain-lim" style="display: none;">
					<div class="card card-secondary">
					    <div class="card-header">
					    	<h3 class="card-title">
					    		SAIN-LIM
					    	</h3>
					    	<div class="card-tools">
			                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
			                    <i class="fas fa-expand"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                    <i class="fas fa-minus"></i>
			                  </button>
			                  <button type="button" class="btn btn-tool btn-remove">
			                    <i class="fas fa-times"></i>
			                  </button>
			                </div>
					    </div>
					    <div class="card-body">
							<?
							$dataX = array();
							$dataY = array();
							$label = array();
						    if ($productos!=false) {
						    	foreach ($productos->result() as $producto) {
						    		$valores = array();
						    		foreach ($indices as $etiqueta => $campo) {
						    			$atributo = $campo['campo'];
						    			$valores[$atributo] = number_format($producto->$atributo, 2);
						    		}
						    		$sainlim = new SainLim($valores);
						    		array_push($dataX, number_format($sainlim->getSain(), 1));
						    		array_push($dataY, number_format($sainlim->getLim(), 1));
						    		array_push($label, $producto->nombre);
						    		unset($sainlim);
						    	}
						    }
						    ?>

						    <canvas id="saimlimChart" style="width: 100%;" data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-unit="<?= $unidad ?>"></canvas>
					    </div>
					</div>
				</div>
				<!-- /.Indice Sain-Lim -->

			</div>
			<!-- /.Indices -->

</section>
<!-- /.content -->