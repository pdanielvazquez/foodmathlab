<!-- Main content -->
<?
	$permisos_e = ($permisos_etiquetados!=false)? $permisos_etiquetados->result(): false;
?>
<style>
  .flag-1{
    width: 50px;
  }
  .flag-2{
    width: 30px;
  }
  .estatico{
  	/*position: fixed;*/
  }
</style>
<section class="content">
  	<div class="row">
    	<div class="col-12">

			<div class="card">
              <div class="card-header d-flex p-0 bg-danger">
                <h3 class="card-title p-3 text-white">
                	<i class="fas fa-poll"></i>
                	Labs
                </h3>
                <ul class="nav nav-pills ml-auto p-2">
                	<?
                	if ($grupos!=false) {
                		$conta=0;
                		foreach ($grupos->result() as $grupo) {
                			if ($grupo->nombre!='Trash') {
												$no_prods=0;
                				/*Verificar el numero de productos por Laboratorio*/
                				if ($productos!=false) {
                					foreach ($productos->result() as $producto) {
                						if ($producto->id_grupo == $grupo->id_grupo) {
	             								$no_prods++;
                						}
                					}
                				}
	                			$active = ($conta == 0) ? 'active' : '';
	                			?>
	                			<li class="nav-item">
	                				<a class="nav-link <?= $active ?> btn-tab" href="#tab_<?= ++$conta ?>" data-toggle="tab">
	                					<span class="lab"><?= $grupo->nombre ?></span>
	                					<span class="badge badge-primary" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $no_prods ?></span>
	                				</a>
	                			</li>
	                			<?
                			}
                		}
                	}
                	?>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
              	<!-- <input type="text" name="columnas" id="columnas">
              	<input type="text" name="ancho" id="ancho">
              	<input type="text" name="posicion" id="posicion"> -->
              	<h2 style="display: inline;" id="nombre_lab">Nombre del Lab</h2>
              	<button class="btn btn-warning float-right mb-1" id="btn-scroll-right">
              		<i class="fas fa-chevron-right"></i>
              	</button>
              	<button class="btn btn-warning float-right mr-2 mb-1" id="btn-scroll-left">
              		<i class="fas fa-chevron-left"></i>
              	</button>
                <div class="tab-content table-responsive" id="contenido">
                	<?
                	if ($grupos!=false) {
                		$conta = 0;
                		foreach ($grupos->result() as $grupo) {
                			$active = ($conta == 0) ? 'active' : '';
                			?>
                			<div class="tab-pane <?= $active ?>" id="tab_<?= ++$conta ?>">
                				<table class="table table-bordered table-hover table-striped text-nowrap" id="tabla">
                					<thead>
                						<tr class="bg-secondary">
                							<th class="bg-secondary txt-centrado" style="width: 150px;">
	                								Promedio del Laboratorio
	                						</th>
                							<?
                							if ($productos!=false) {
                								$conta_prod = 1;
                								foreach ($productos->result() as $producto) {
                									if ($producto->id_grupo == $grupo->id_grupo) {
	                									?>
	                									<th class="bg-secondary txt-centrado" style="width: 150px;">
	                										<?= $conta_prod++.". ".$producto->nombre ?>
	                										<a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" data-lab="<?= $grupo->id_grupo ?>" class="btn-descripcion-lab">
	                											<span class="badge bg-warning">
	                												<i class="fas fa-chart-bar"></i>
	                											</span>
	                										</a>
	                									</th>
	                									<?
                									}
                								}
                							}
                							?>
                						</tr>
                					</thead>
                					<tbody>
                						<?
                						if ($campos!=false) {
                							foreach ($campos as $indice => $valor) {
                								$unidad = 'g';
                								if ($indice=='energia') 
                									$unidad = 'kcal';
                								else if ($indice=='sodio') {
                									$unidad = 'mg';
                								}
                								?>
		                						<tr>
		                							<td>
		                								<h6>
			                								<span class="ml-2">
			                									<?= $valor['etiqueta'] ?>
			                								</span>
			                								<span class="float-right mr-2">
			                									<?= number_format($promedios[$grupo->id_grupo][$indice], 2).' '.$unidad ?>
			                								</span>
			                							</h6>
		                							</td>
		                							<?
		                							if ($productos!=false) {
		                								foreach ($productos->result() as $producto) {
		                									if ($producto->id_grupo == $grupo->id_grupo) {
			                									?>
			                									<td>
			                										<h6>
			                											<span class="ml-2">
			                												<?= $valor['etiqueta'] ?>
			                											</span>
			                											<span class="float-right mr-2">
			                												<?= number_format($producto->$indice, 1).' '.$unidad ?>
			                											</span>
			                										</h6>
			                									</td>
			                									<?
		                									}
		                								}
		                							}
		                							?>
		                						</tr>
                								<?
                							}
                						}
                						?>
                						<?
                						if ($productos!=false) {
                							?>
	                						<tr>
	                							
	                							<th class="bg-secondary txt-centrado" style="width: 150px;">
	                								Promedio del Laboratorio
	                							</th>
	                							<?
	                							if ($productos!=false) {
	                								$conta_prod = 1;
	                								foreach ($productos->result() as $producto) {
	                									if ($producto->id_grupo == $grupo->id_grupo) {
		                									?>
		                									<th class="bg-secondary txt-centrado" style="width: 150px;">
		                										<?= $conta_prod++.". ".$producto->nombre ?>
		                										<a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" data-lab="<?= $grupo->id_grupo ?>" class="btn-descripcion-lab">
		                											<span class="badge bg-warning">
		                												<i class="fas fa-chart-bar"></i>
		                											</span>
		                										</a>
		                									</th>
		                									<?
	                									}
	                								}
	                							}
	                							?>
	                						</tr>

                							<? 
                							if (search_value($permisos_e, 'chi')==true) {
                								?>
                								<!-- Etiquetado de Chile -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/chile.jpg') ?>" class="flag-1">
	                										<strong> Chile</strong>
	                									</h6>
	                										<?
					                								$chileLabel = new Etiquetado_chile($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $grupo->tipo);
						                						
																					if ($chileLabel->getEnergia()==1) {
																						?>
																						<img src="<?= base_url('uploads/labels-chile/calorias.png') ?>" style="width: 75px;">
																						<?
																					}

																					if ($chileLabel->getSodio()==1) {
																						?>
																						<img src="<?= base_url('uploads/labels-chile/sodio.png') ?>" style="width: 75px;">
																						<?
																					}
																					
																					if ($chileLabel->getAzucar()==1) {
																						?>
																						<img src="<?= base_url('uploads/labels-chile/azucares.png') ?>" style="width: 75px;">
																						<?
																					}
																					
																					if ($chileLabel->getGrasasSat()==1) {
																						?>
																						<img src="<?= base_url('uploads/labels-chile/grasas.png') ?>" style="width: 75px;">
																						<?
																					}
																					
						                							unset($chileLabel);
			                								?>
	                								</td>
		                								<?
		                								foreach ($productos->result() as $producto) {
				                							if ($producto->id_grupo == $grupo->id_grupo) {
				                								$chileLabel = new Etiquetado_chile($producto->energia, $producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
					                							?>
					                							<td class="txt-centrado">
					                								<h6>
				                										<img src="<?= base_url('uploads/flags/chile.jpg') ?>" class="flag-1">
				                										<strong> Chile</strong>
				                									</h6>
					                								<?
																				if ($chileLabel->getEnergia()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-chile/calorias.png') ?>" style="width: 75px;">
																					<?
																				}

																				if ($chileLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-chile/sodio.png') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($chileLabel->getAzucar()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-chile/azucares.png') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($chileLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-chile/grasas.png') ?>" style="width: 75px;">
																					<?
																				}
																				
																				?>
					                							</td>
					                							<?
					                							unset($chileLabel);
				                							}
				                						}
		                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Chile -->
                								<?
                							}
	                						?>
                							
	                						<? 
                							if (search_value($permisos_e, 'ecu')==true) {
                								?>
	                							<!-- Etiquetado de Ecuador -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/ecuador.jpg') ?>" class="flag-1">
	                										<strong> Ecuador</strong>
	                									</h6>
	                										<label>Grasa Total</label>
				                								<?
				                								$ecuadorLabel = new Etiquetado_ecuador($promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $grupo->tipo);
																				switch($ecuadorLabel->getGrasaTotal()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				?>
																				<br>
																				<label>Azucar</label>
								                								<?
																				switch($ecuadorLabel->getAzucar()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				?>
																				<br>
																				<label>Sodio</label>
								                								<?
																				switch($ecuadorLabel->getSodio()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				unset($ecuadorLabel);
																				?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ecuadorLabel = new Etiquetado_ecuador($producto->lipidos, $producto->azucaresa, $producto->sodio, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/ecuador.jpg') ?>" class="flag-1">
			                										<strong> Ecuador</strong>
			                									</h6>
				                								<label>Grasa Total</label>
				                								<?
																				switch($ecuadorLabel->getGrasaTotal()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				?>
																				<br>
																				<label>Azucar</label>
								                								<?
																				switch($ecuadorLabel->getAzucar()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				?>
																				<br>
																				<label>Sodio</label>
								                								<?
																				switch($ecuadorLabel->getSodio()){
																					case 0:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 1:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
																						<?
																						break;
																					case 2:
																						?>
																						<img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
																						<?
																						break;
																				}
																				?>
				                							</td>
				                							<?
				                							unset($ecuadorLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Ecuador -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'mex')==true) {
                								?>
	                							<!-- Etiquetado de México -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/mexico.jpg') ?>" class="flag-1">
	                										<strong> México</strong>
	                									</h6>
	                									<?
	                										$MexLabel = new Etiquetado_mexico($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['acidostrans'], $promedios[$grupo->id_grupo]['sodio'], $grupo->tipo);

																				if ($MexLabel->getExcesoCalorias()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-calorias.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($MexLabel->getExcesoAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($MexLabel->getExcesoGrasasTrans()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-trans.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($MexLabel->getExcesoGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-sat.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($MexLabel->getExcesoSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
				                							unset($MexLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$MexLabel = new Etiquetado_mexico($producto->energia, $producto->azucaresa, $producto->acidosgs, $producto->acidostrans, $producto->sodio, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/mexico.jpg') ?>" class="flag-1">
			                										<strong> México</strong>
			                									</h6>
				                								<?
																				if ($MexLabel->getExcesoCalorias()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-calorias.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($MexLabel->getExcesoAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($MexLabel->getExcesoGrasasTrans()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-trans.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($MexLabel->getExcesoGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-grasas-sat.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($MexLabel->getExcesoSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-mexico/exceso-sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				?>
				                							</td>
				                							<?
				                							unset($MexLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de México -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'col')==true) {
                								?>
	                							<!-- Etiquetado de Colombia -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/colombia.jpg') ?>" class="flag-1">
	                										<strong> Colombia</strong>
	                									</h6>
	                									<? 
	                									$ColombiaLabel = new Etiquetado_colombia($promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $grupo->tipo);

																				if ($ColombiaLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($ColombiaLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($ColombiaLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/grasas-sat.jpg') ?>" style="width: 75px;">
																					<?
																				}

				                							unset($ColombiaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ColombiaLabel = new Etiquetado_colombia($producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/colombia.jpg') ?>" class="flag-1">
			                										<strong> Colombia</strong>
			                									</h6>
				                								<?
																				if ($ColombiaLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($ColombiaLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($ColombiaLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-colombia/grasas-sat.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				?>
				                							</td>
				                							<?
				                							unset($ColombiaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Colombia -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'uru')==true) {
                								?>
	                							<!-- Etiquetado de Uruguay -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/uruguay.jpg') ?>" class="flag-1">
	                										<strong> Uruguay</strong>
	                									</h6>
	                									<?
	                									$UruguayLabel = new Etiquetado_uruguay($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['azucaresa'], $grupo->tipo);

																				if ($UruguayLabel->getGrasaTot()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/grasas_tot.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($UruguayLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/grasas_sat.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($UruguayLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($UruguayLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}

				                							unset($UruguayLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$UruguayLabel = new Etiquetado_uruguay($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->sodio, $producto->azucaresa, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/uruguay.jpg') ?>" class="flag-1">
			                										<strong> Uruguay</strong>
			                									</h6>
				                								<?
																				if ($UruguayLabel->getGrasaTot()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/grasas_tot.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($UruguayLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/grasas_sat.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($UruguayLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($UruguayLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-uruguay/azucares.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				?>
				                							</td>
				                							<?
				                							unset($UruguayLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Uruguay -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'per')==true) {
                								?>
	                							<!-- Etiquetado de Perú -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
	                										<img src="<?= base_url('uploads/flags/peru.jpg') ?>" class="flag-1">
	                										<strong> Perú</strong>
	                									</h6>
	                									<?
	                										if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
																				$peruLabel = new Etiquetado_peru_2a_fase($promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['acidostrans'], $grupo->tipo);
																			}
																			else{
																				$peruLabel = new Etiquetado_peru_1a_fase($promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['acidostrans'], $grupo->tipo);
																			}
																				if ($peruLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/azucar.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($peruLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($peruLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/grasas_sat.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($peruLabel->getGrasasTrans('otros')==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/grasas_trans.jpg') ?>" style="width: 75px;">
																					<?
																				}
				                							unset($peruLabel);
				                							?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
																				$peruLabel = new Etiquetado_peru_2a_fase($producto->azucaresa, $producto->sodio, $producto->acidosgs, $producto->acidostrans, $producto->tipo);
																			}
																			else{
																				$peruLabel = new Etiquetado_peru_1a_fase($producto->azucaresa, $producto->sodio, $producto->acidosgs, $producto->acidostrans, $producto->tipo);
																			}
								                							?>
								                			<td class="txt-centrado">
								                				<h6>
			                										<img src="<?= base_url('uploads/flags/peru.jpg') ?>" class="flag-1">
			                										<strong> Perú</strong>
			                									</h6>
								                				<?
																				if ($peruLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/azucar.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($peruLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/sodio.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				if ($peruLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/grasas_sat.jpg') ?>" style="width: 75px;">
																					<?
																				}

																				if ($peruLabel->getGrasasTrans('otros')==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-peru-1a/grasas_trans.jpg') ?>" style="width: 75px;">
																					<?
																				}
																				
																				?>
				                							</td>
				                							<?
				                							unset($peruLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Perú -->
	                						<?
	                						}
	                						?>

                							<tr>
	                							<th class="bg-secondary txt-centrado" style="width: 150px;">
	                								Promedio del Laboratorio
	                							</th>
	                							<?
	                							if ($productos!=false) {
	                								$conta_prod = 1;
	                								foreach ($productos->result() as $producto) {
	                									if ($producto->id_grupo == $grupo->id_grupo) {
		                									?>
		                									<th class="bg-secondary txt-centrado" style="width: 150px;">
		                										<?= $conta_prod++.". ".$producto->nombre ?>
		                										<a href="" data-id="<?= $producto->id_prod ?>" data-toggle="modal" data-target="#descripcion" data-lab="<?= $grupo->id_grupo ?>" class="btn-descripcion-lab">
		                											<span class="badge bg-warning">
		                												<i class="fas fa-chart-bar"></i>
		                											</span>
		                										</a>
		                									</th>
		                									<?
	                									}
	                								}
	                							}
	                							?>
	                						</tr>

	                						<? 
                							if (search_value($permisos_e, 'run')==true) {
                								?>
		                						<!-- Etiquetado de Reino Unido -->
		                						<?
		                						foreach ($vnrs as $cve => $val) {
		                							?>
		                							<tr>
		                								<td class="txt-centrado">
		                									<h6>
		                										<img src="<?= base_url('uploads/flags/uk.jpg') ?>" class="flag-1">
		                										<strong> Reino Unido - VNR <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag-2"></strong>
		                									</h6>
		                									<?
		                										$UkLabel = new Etiquetado_UK($promedios[$grupo->id_grupo]['sodio']/1000, $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['lipidos'], $grupo->tipo, $vnrs[$cve][2]);

																					$color = 'gray';
																					$txt = 'ENERGÍA';
																					?>
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Calorías
																							<span class="label_UK_value_small">
																								<?= number_format($promedios[$grupo->id_grupo]['energia'], 1) ?> kcal
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format(($promedios[$grupo->id_grupo]['energia'] * 100)/2000, 1) ?>%</p>
																					</div>
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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Grasa
																							<span class="label_UK_value_small">
																								<?= number_format($promedios[$grupo->id_grupo]['lipidos'], 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasaTotalPtc(), 1) ?>%</p>
																					</div>
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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Grasa Sat
																							<span class="label_UK_value_small">
																								<?= number_format($promedios[$grupo->id_grupo]['acidosgs'], 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasasSatPtc(), 1) ?>%</p>
																					</div>

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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Azúcar
																							<span class="label_UK_value_small">
																								<?= number_format($promedios[$grupo->id_grupo]['azucaresa'], 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getAzucaresPtc(), 1) ?>%</p>
																					</div>

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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Sodio
																							<span class="label_UK_value_small">
																								<?= number_format($promedios[$grupo->id_grupo]['sodio']/1000, 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getSodioPtc(), 1) ?>%</p>
																					</div>
					                							<?
					                							unset($UkLabel);
		                									?>
		                								</td>
		                								<?
		                								foreach ($productos->result() as $producto) {
				                							if ($producto->id_grupo == $grupo->id_grupo) {
				                								$UkLabel = new Etiquetado_UK($producto->sodio/1000, $producto->azucaresa, $producto->acidosgs, $producto->lipidos, $producto->tipo, $vnrs[$cve][2]);
					                							?>
					                							<td class="txt-centrado">
					                								<h6>
				                										<img src="<?= base_url('uploads/flags/uk.jpg') ?>" class="flag-1">
				                										<strong> Reino Unido - VNR <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag-2"></strong>
				                									</h6>
					                								<?
																					$color = 'gray';
																					$txt = 'ENERGÍA';
																					?>
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Calorías
																							<span class="label_UK_value_small">
																								<?= number_format($producto->energia, 1) ?> kcal
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format(($producto->energia * 100)/2000, 1) ?>%</p>
																					</div>
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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Grasa
																							<span class="label_UK_value_small">
																								<?= number_format($producto->lipidos, 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasaTotalPtc(), 1) ?>%</p>
																					</div>
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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Grasa Sat
																							<span class="label_UK_value_small">
																								<?= number_format($producto->acidosgs, 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasasSatPtc(), 1) ?>%</p>
																					</div>

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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Azúcar
																							<span class="label_UK_value_small">
																								<?= number_format($producto->azucaresa, 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getAzucaresPtc(), 1) ?>%</p>
																					</div>

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
																					<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
																						<p class="label_UK_title_small"><?= $txt ?></p>
																						<p class="label_UK_txt_small">
																							Sodio
																							<span class="label_UK_value_small">
																								<?= number_format($producto->sodio/1000, 1) ?> g
																							</span>
																						</p>
																						<p class="label_UK_ptc_small"><?= number_format($UkLabel->getSodioPtc(), 1) ?>%</p>
																					</div>
					                							</td>
					                							<?
					                							unset($UkLabel);
				                							}
				                						}
		                								?>
		                							</tr>
		                							<?
		                						}
		                						?>
	                							<!-- ./Etiquetado de Reino Unido -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'fra')==true) {
                								?>
	                							<!-- Etiquetado de Francia -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/francia.jpg') ?>" class="flag-1">
		                									<strong> Francia</strong>
		                								</h6>
	                									<?
	                										$NutriScoreLabel = new NutriScore($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['fruta'] + $promedios[$grupo->id_grupo]['verdura'], $promedios[$grupo->id_grupo]['fibra'], $promedios[$grupo->id_grupo]['proteina'], 0, $promedios[$grupo->id_grupo]['cantidad_porcion'], $grupo->tipo);

																				switch ($NutriScoreLabel->getClase()) {
																					case 'A':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-a.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'B':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-b.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'C':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-c.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'D':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-d.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'E':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-e.jpg') ?>" style="width:60%;">
																						<?
																						break;
																				}
				                							unset($NutriScoreLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$NutriScoreLabel = new NutriScore($producto->energia, $producto->azucaresa, $producto->acidosgs, $producto->lipidos, $producto->sodio, $producto->fruta + $producto->verdura, $producto->fibra, $producto->proteina, $producto->id_categoria, $producto->cantidad_porcion, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/francia.jpg') ?>" class="flag-1">
			                										<strong> Francia</strong>
			                									</h6>
				                								<?
																				switch ($NutriScoreLabel->getClase()) {
																					case 'A':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-a.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'B':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-b.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'C':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-c.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'D':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-d.jpg') ?>" style="width: 60%;">
																						<?
																						break;
																					case 'E':
																						?>
																						<img src="<?= base_url('uploads/labels-francia/nutri-score-e.jpg') ?>" style="width:60%;">
																						<?
																						break;
																				}
																				?>
				                							</td>
				                							<?
				                							unset($NutriScoreLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Francia -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'isr')==true) {
                								?>
	                							<!-- Etiquetado de Israel -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/israel.jpg') ?>" class="flag-1">
		                									<strong> Israel</strong>
		                								</h6>
	                									<?
	                										$IsraelLabel = new Etiquetado_israel($promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['acidosgs'], $grupo->tipo);
																			if ($IsraelLabel->getSodio()==1) {
																				?>
																				<img src="<?= base_url('uploads/labels-israel/sodio.jpg') ?>" style="width: 100px;">
																				<?
																			}

																			if ($IsraelLabel->getAzucares()==1) {
																				?>
																				<img src="<?= base_url('uploads/labels-israel/azucares.jpg') ?>" style="width: 100px;">
																				<?
																			}
																			
																			if ($IsraelLabel->getGrasasSat()==1) {
																				?>
																				<img src="<?= base_url('uploads/labels-israel/grasas-sat.jpg') ?>" style="width: 100px;">
																				<?
																			}
				                							unset($IsraelLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$IsraelLabel = new Etiquetado_israel($producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
			                										<img src="<?= base_url('uploads/flags/israel.jpg') ?>" class="flag-1">
			                										<strong> Israel</strong>
			                									</h6>
				                								<?
																				if ($IsraelLabel->getSodio()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-israel/sodio.jpg') ?>" style="width: 100px;">
																					<?
																				}

																				if ($IsraelLabel->getAzucares()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-israel/azucares.jpg') ?>" style="width: 100px;">
																					<?
																				}
																				
																				if ($IsraelLabel->getGrasasSat()==1) {
																					?>
																					<img src="<?= base_url('uploads/labels-israel/grasas-sat.jpg') ?>" style="width: 100px;">
																					<?
																				}
																			
																			?>
				                							</td>
				                							<?
				                							unset($IsraelLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Israel -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'ita')==true) {
                								?>
	                							<!-- Etiquetado de Italia - VNR Europa -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
		                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/europa.jpg') ?>" class="flag-2"></strong>
		                								</h6>
	                									<?
	                									$ItaliaLabel = new Etiquetado_italia($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $referencia_eu);
				                							?>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($ItaliaLabel->getEnergia()*4.184) ?> kJ</p>
																					<p><?= number_format($ItaliaLabel->getEnergia()) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							<?
				                							unset($ItaliaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ItaliaLabel = new Etiquetado_italia($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->azucaresa, $producto->sodio, $referencia_eu);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
				                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
				                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/europa.jpg') ?>" class="flag-2"></strong>
				                								</h6>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($producto->energia*4.184) ?> kJ</p>
																					<p><?= number_format($producto->energia) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							</td>
				                							<?
				                							unset($ItaliaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Italia - VNR Europa -->

	                							<!-- Etiquetado de Italia - VNR México -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
		                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/mexico.jpg') ?>" class="flag-2"></strong>
		                								</h6>
	                									<?
	                									$ItaliaLabel = new Etiquetado_italia($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $referencia_mx);
				                							?>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($ItaliaLabel->getEnergia()*4.184) ?> kJ</p>
																					<p><?= number_format($ItaliaLabel->getEnergia()) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							<?
				                							unset($ItaliaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ItaliaLabel = new Etiquetado_italia($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->azucaresa, $producto->sodio, $referencia_mx);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
				                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
				                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/mexico.jpg') ?>" class="flag-2"></strong>
				                								</h6>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($producto->energia*4.184) ?> kJ</p>
																					<p><?= number_format($producto->energia) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							</td>
				                							<?
				                							unset($ItaliaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Italia - VNR México -->

	                							<!-- Etiquetado de Italia - VNR Colombia -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
		                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/colombia.jpg') ?>" class="flag-2"></strong>
		                								</h6>
	                									<?
	                									$ItaliaLabel = new Etiquetado_italia($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $referencia_co);
				                							?>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($ItaliaLabel->getEnergia()*4.184) ?> kJ</p>
																					<p><?= number_format($ItaliaLabel->getEnergia()) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							<?
				                							unset($ItaliaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ItaliaLabel = new Etiquetado_italia($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->azucaresa, $producto->sodio, $referencia_co);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
				                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
				                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/colombia.jpg') ?>" class="flag-2"></strong>
				                								</h6>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($producto->energia*4.184) ?> kJ</p>
																					<p><?= number_format($producto->energia) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							</td>
				                							<?
				                							unset($ItaliaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Italia - VNR Colombia -->

	                							<!-- Etiquetado de Italia - VNR EE.UU. -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
		                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/usa.jpg') ?>" class="flag-2"></strong>
		                								</h6>
	                									<?
	                									$ItaliaLabel = new Etiquetado_italia($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['lipidos'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['sodio'], $referencia_eeuu);
				                							?>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($ItaliaLabel->getEnergia()*4.184) ?> kJ</p>
																					<p><?= number_format($ItaliaLabel->getEnergia()) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							<?
				                							unset($ItaliaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$ItaliaLabel = new Etiquetado_italia($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->azucaresa, $producto->sodio, $referencia_eeuu);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
				                									<img src="<?= base_url('uploads/flags/italia.jpg') ?>" class="flag-1">
				                									<strong> Italia - VNR <img src="<?= base_url('uploads/flags/usa.jpg') ?>" class="flag-2"></strong>
				                								</h6>
				                								<div class="battery-small">
					                								<div class="battery-title-1">
																					<p><strong>ENERGIA</strong></p>
																					<p><?= number_format($producto->energia*4.184) ?> kJ</p>
																					<p><?= number_format($producto->energia) ?> kcal</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getEnergia()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI</strong></p>
																					<p><?= number_format($producto->lipidos	, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasaTot()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>GRASSI<br>SATURI</strong></p>
																					<p><?= number_format($producto->acidosgs, 2) ?> g</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>ZUCCHERI</strong></p>
																					<p><?= number_format($producto->azucaresa, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getAzucares()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							                								</div>

							                								<div class="battery-small">
																				<div class="battery-title-2">
																					<p><strong>SALE</strong></p>
																					<p><?= number_format($producto->sodio, 2) ?> g</p>
																					<p>&nbsp;</p>
																				</div>
																				<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
																					<?= number_format($ItaliaLabel->getSodio()) ?>%
																				</div>
																				<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
				                								</div>
				                							</td>
				                							<?
				                							unset($ItaliaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Italia - VNR EE.UU. -->
	                						<?
	                						}
	                						?>

	                						<? 
                							if (search_value($permisos_e, 'aus')==true) {
                								?>
	                							<!-- Etiquetado de Australia & Nueva Zelanda -->
	                							<tr>
	                								<td class="txt-centrado">
	                									<h6>
		                									<img src="<?= base_url('uploads/flags/australia.jpg') ?>" class="flag-1">
		                									<strong> Australia & Nueva Zelanda</strong>
		                								</h6>
	                									<?
	                										$AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda($promedios[$grupo->id_grupo]['energia'], $promedios[$grupo->id_grupo]['acidosgs'], $promedios[$grupo->id_grupo]['sodio'], $promedios[$grupo->id_grupo]['azucaresa'], $promedios[$grupo->id_grupo]['calcio'], $promedios[$grupo->id_grupo]['verdura'], $promedios[$grupo->id_grupo]['proteina'], $promedios[$grupo->id_grupo]['fibra'], 0, $grupo->tipo);
				                							?>
				                								<img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
																				<div class="australia-value-small">
																					<p class="title">ENERGY</p>
																					<p class="val"><?= number_format($promedios[$grupo->id_grupo]['energia'] * 4.184, 1) ?> kJ</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SAT FAT</p>
																					<p class="val"><?= number_format($promedios[$grupo->id_grupo]['acidosgs'], 1) ?> g</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SUGARS</p>
																					<p class="val"><?= number_format($promedios[$grupo->id_grupo]['azucaresa'], 1) ?> g</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SODIUM</p>
																					<p class="val"><?= number_format($promedios[$grupo->id_grupo]['sodio'], 1) ?> g</p>
																				</div>
				                							<?
				                							unset($AustraliaLabel);
	                									?>
	                								</td>
	                								<?
	                								foreach ($productos->result() as $producto) {
			                							if ($producto->id_grupo == $grupo->id_grupo) {
			                								$AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda($producto->energia, $producto->acidosgs, $producto->sodio, $producto->azucaresa, $producto->calcio, $producto->verdura, $producto->proteina, $producto->fibra, $producto->id_categoria, $producto->tipo);
				                							?>
				                							<td class="txt-centrado">
				                								<h6>
				                									<img src="<?= base_url('uploads/flags/australia.jpg') ?>" class="flag-1">
				                									<strong> Australia & Nueva Zelanda</strong>
				                								</h6>
				                								<img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
																				<div class="australia-value-small">
																					<p class="title">ENERGY</p>
																					<p class="val"><?= number_format($producto->energia * 4.184, 1) ?> kJ</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SAT FAT</p>
																					<p class="val"><?= number_format($producto->acidosgs, 1) ?> g</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SUGARS</p>
																					<p class="val"><?= number_format($producto->azucaresa, 1) ?> g</p>
																				</div>
																				<div class="australia-value-small">
																					<p class="title">SODIUM</p>
																					<p class="val"><?= number_format($producto->sodio, 1) ?> g</p>
																				</div>
				                							</td>
				                							<?
				                							unset($AustraliaLabel);
			                							}
			                						}
	                								?>
	                							</tr>
	                							<!-- ./Etiquetado de Australia & Nueva Zelanda -->
	                						<?
	                						}
	                						?>

                							<?
                						}

                						?>
                					</tbody>
                				</table>
                			</div>
                			<!-- /.tab-pane -->
                			<?
                		}
                	}
                	?>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
    	</div>
   	</div>

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
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
              <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

</section>