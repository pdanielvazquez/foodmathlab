<!-- Main content -->
<style>
  .flag{
    width: 30px;
  }
  .nutrimentos td:nth-child(1n+2){
    text-align: center;
  }
  .material-icons{
    position: relative;
    top: 4px;
  }
</style>
<section class="content">
  	<div class="row">
    	<div class="col-12">
			<div class="card">
        <div class="card-header d-flex p-0 bg-danger">
            <h3 class="card-title p-3">
        	  <i class="fas fa-archive"></i>
        	     Reformulación de un Producto
            </h3>
						
        </div><!-- /.card-header -->
				<?
				$conta = 0;
				foreach ($productos->result() as $producto) {
					?>
				<h2><?= $producto->nombre ?></h2>
				<?}?>
				<table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
             <tr class="bg-secondary" align="center">
               <th>Concepto</th>
						 <th>Original </th>   
						 <?foreach ($productos_reform->result() as $producto) {?>
                <th> Reformulación <?= ++$conta ?></th>
						 <?}?>
					   
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
    							<th><?= $valor['etiqueta'] ?></th>
    							<!--<td class="txt-centrado"><?= number_format($promedios[$grupo->id_grupo][$indice], 2).' '.$unidad ?></td>-->
    							<?
    							if ($productos!=false) {
    								foreach ($productos->result() as $producto) {
    									//if ($producto->id_grupo == $grupo->id_grupo) {
      									?>
      									<td class="txt-centrado"><?= number_format($producto->$indice, 1).' '.$unidad;  ?></td>
								<!--td> <?= $producto->id_prod ?></td>-->
      									<?
    									//}
    								}
    							}
    							?>
    						
				
    							
    							<?
    							if ($productos_reform!=false) {
    								foreach ($productos_reform->result() as $producto) {
    									//if ($producto->id_grupo == $grupo->id_grupo) {
      									?>
      									<td class="txt-centrado"><?= number_format($producto->$indice, 1).' '.$unidad ?></td>
								<!--<td> <?= $producto->id_prod ?></td>-->
      									<?
    									//}
    								}
    							}
    							?>
    						</tr>
								<?
							}
						}
						?>
            <!-- </tr>-->
					  
					  <?
					  if ($productos!=false) {
        			?>
          		<tr>
          		<th class="txt-centrado bg-secondary" colspan="<?= count($productos_reform->result()) + 2 ?>">Etiquetados LATAM</th>
          		</tr>
					  <?
						}
						?>
                	  <!-- Etiquetado de Chile -->
                		<tr>
                			<th>Chile</th>
                				
                		     		<?
						       		    foreach ($productos->result() as $producto) {
			                				//if ($producto->id_grupo == $grupo->id_grupo) {
			                				    $chileLabel = new Etiquetado_chile(explode(' ', $producto->energia)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
				                				?>
				                			<td class="txt-centrado">
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
	                                           foreach ($productos_reform->result() as $producto) {
			                				//if ($producto->id_grupo == $grupo->id_grupo) {
			                				    $chileLabel = new Etiquetado_chile(explode(' ', $producto->energia)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
				                				?>
				                			<td class="txt-centrado">
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
			                							
			                						}         ?>  								
									   
								
                		                 </tr>
                							<!-- ./Etiquetado de Chile -->
						                    <!-- Etiquetado de Ecuador -->
                							<tr>
                								<th>Ecuador</th>
                								        										
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$ecuadorLabel = new Etiquetado_ecuador(explode(' ', $producto->lipidos)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], $producto->tipo);
			                							?>
			                							<td>
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
                								
												
                								foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$ecuadorLabel = new Etiquetado_ecuador(explode(' ', $producto->lipidos)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], $producto->tipo);
			                							?> 
			                							<td>
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
                								?>
												
                							</tr>
                							<!-- ./Etiquetado de Ecuador -->
					                        <!-- Etiquetado de México -->
                							<tr>
                								<th>México</th>
                								
                									
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$MexLabel = new Etiquetado_mexico(explode(' ', $producto->energia)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], explode(' ', $producto->sodio)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								
												
                								foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$MexLabel = new Etiquetado_mexico(explode(' ', $producto->energia)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], explode(' ', $producto->sodio)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								?>
												
                							</tr>
                							<!-- ./Etiquetado de México -->
											<!-- Etiquetado de Colombia -->
                							<tr>
                								<th>Colombia</th>
                								
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$ColombiaLabel = new Etiquetado_colombia(explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								
												
                								foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$ColombiaLabel = new Etiquetado_colombia(explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								?>
												
												
												
                							</tr>
                							<!-- ./Etiquetado de Colombia -->
						<!-- Etiquetado de Uruguay -->
                							<tr>
                								<th>Uruguay</th>
                								
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$UruguayLabel = new Etiquetado_uruguay(explode(' ', $producto->energia)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
												
												foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$UruguayLabel = new Etiquetado_uruguay(explode(' ', $producto->energia)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								?>
											<!--./Etiquetado_uruguay-->										
											<!-- Etiquetado de Perú -->
                							<tr>
                								<th>Perú</th>
                								
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
																			$peruLabel = new Etiquetado_peru_2a_fase(explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], $producto->tipo);
																		}
																		else{
																			$peruLabel = new Etiquetado_peru_1a_fase(explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], $producto->tipo);
																		}
							                							?>
							                							<td class="txt-centrado">
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
                								
												
                								foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
																			$peruLabel = new Etiquetado_peru_2a_fase(explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], $producto->tipo);
																		}
																		else{
																			$peruLabel = new Etiquetado_peru_1a_fase(explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->acidostrans)[0], $producto->tipo);
																		}
							                							?>
							                							<td class="txt-centrado">
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
                								?>
												
                							</tr>
                							<!-- ./Etiquetado de Perú -->
										    <tr>
	                							<th class="txt-centrado bg-secondary" colspan="<?= count($productos_reform->result()) + 2 ?>">Etiquetados Europa-Asia</th>
	                						</tr>	

			<?
			foreach ($vnrs as $cve => $val) {
			?>											
				<!-- Etiquetado de Reino Unido -->
        <tr>
           	<th>Reino Unido<br>VNR - <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag"></th>
           	<td>
              <?
              foreach ($productos->result() as $producto) {
	            $UkLabel = new Etiquetado_UK(explode(' ', $producto->sodio)[0]/1000, explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->lipidos)[0], $producto->tipo, $vnrs[$cve][2]);
							$color = 'gray';
							$txt = 'ENERGÍA';
							?>
							<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
								<p class="label_UK_title_small"><?= $txt ?></p>
								<p class="label_UK_txt_small">
									Calorías
									<span class="label_UK_value_small">
										<?= number_format(explode(' ', $producto->energia)[0], 1) ?> kcal
									</span>
								</p>
								<p class="label_UK_ptc_small"><?= number_format((explode(' ', $producto->energia)[0] * 100)/2000, 1) ?>%</p>
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
										<?= number_format(explode(' ', $producto->lipidos)[0], 1) ?> g
									</span>
								</p>
								<p class="label_UK_ptc_small">
									<?= number_format($UkLabel->getGrasaTotalPtc(), 1) ?>%
								</p>
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
										<?= number_format(explode(' ', $producto->acidosgs)[0], 1) ?> g
									</span>
								</p>
								<p class="label_UK_ptc_small">
									<?= number_format($UkLabel->getGrasasSatPtc(), 1) ?>%
								</p>
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
										<?= number_format(explode(' ', $producto->azucaresa)[0], 1) ?> g
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
										<?= number_format(explode(' ', $producto->sodio)[0]/1000, 1) ?> g
									</span>
								</p>
								<p class="label_UK_ptc_small">
									<?= number_format($UkLabel->getSodioPtc(), 1) ?>%
								</p>
							</div>
						    <?
						    unset($UkLabel);
					    }?>
					</td>
													
					<?
					foreach ($productos_reform->result() as $producto) {
				        $UkLabel = new Etiquetado_UK(explode(' ', $producto->sodio)[0]/1000, explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->lipidos)[0], $producto->tipo, $vnrs[$cve][2]);
						$color = 'gray';
						$txt = 'ENERGÍA';
						?>
						<td>						
							<div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
								<p class="label_UK_title_small"><?= $txt ?></p>
								<p class="label_UK_txt_small">
									Calorías
									<span class="label_UK_value_small">
										<?= number_format(explode(' ', $producto->energia)[0], 1) ?> kcal
									</span>
								</p>
								<p class="label_UK_ptc_small">
									<?= number_format((explode(' ', $producto->energia)[0] * 100)/2000, 1) ?>%
								</p>
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
										<?= number_format(explode(' ', $producto->lipidos)[0], 1) ?> g
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
										<?= number_format(explode(' ', $producto->acidosgs)[0], 1) ?> g
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
										<?= number_format(explode(' ', $producto->azucaresa)[0], 1) ?> g
									</span>
								</p>
								<p class="label_UK_ptc_small">
									<?= number_format($UkLabel->getAzucaresPtc(), 1) ?>%
								</p>
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
										<?= number_format(explode(' ', $producto->sodio)[0]/1000, 1) ?> g
									</span>
								</p>
								<p class="label_UK_ptc_small"><?= number_format($UkLabel->getSodioPtc(), 1) ?>%</p>
							</div>
						    <?
						    unset($UkLabel);
						    }
				            ?>
						</td>
	            </tr>
	            <!-- ./Etiquetado de Reino Unido -->
	        <?
	    	}
	        ?>
											<!-- Etiquetado de Francia -->
                							<tr>
                								<th>Francia</th>
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$NutriScoreLabel = new NutriScore(explode(' ', $producto->energia)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->sodio)[0], $producto->fruta + $producto->verdura, $producto->fibra, $producto->proteina, $producto->id_categoria, $producto->cantidad_porcion, $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								
												foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$NutriScoreLabel = new NutriScore(explode(' ', $producto->energia)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->sodio)[0], $producto->fruta + $producto->verdura, $producto->fibra, $producto->proteina, $producto->id_categoria, $producto->cantidad_porcion, $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								?>
												
                							</tr>
                							<!-- ./Etiquetado de Francia -->
											<!-- Etiquetado de Israel -->
                							<tr>
                								<th>Israel</th>
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$IsraelLabel = new Etiquetado_israel(explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
                								
                								foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$IsraelLabel = new Etiquetado_israel(explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->acidosgs)[0], $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
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
		                							
		                						}?>
												
                							</tr>
                							<!-- ./Etiquetado de Israel -->
                						<?
										foreach ($vnrs as $cve => $val) {
										?>											
											<!-- Etiquetado de Italia-->
											<tr>
                								<th>Italia<br>VNR - <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag">
                								</th>
                								<td>
                									<?
			                						$ItaliaLabel = new Etiquetado_italia(explode(' ', $producto->energia)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], $vnrs[$cve][2]);	
														?>
			                								<div class="battery-small">
				                								<div class="battery-title-1">
																	<p><strong>ENERGIA</strong></p>
																	<p><?= number_format(explode(' ', $producto->energia)[0]*4.184) ?> kJ</p>
																	<p><?= number_format(explode(' ', $producto->energia)[0]) ?> kcal</p>
																</div>
																<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																	<?= number_format($ItaliaLabel->getEnergia()) ?>%
																</div>
																<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						                					</div>
						                					<div class="battery-small">
																<div class="battery-title-2">
																	<p><strong>GRASSI</strong></p>
																	<p><?= number_format(explode(' ', $producto->lipidos)[0]	, 2) ?> g</p>
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
																	<p><?= number_format(explode(' ', $producto->acidosgs)[0], 2) ?> g</p>
																</div>
																<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																	<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																</div>
																<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						                					</div>
						                					<div class="battery-small">
																<div class="battery-title-2">
																	<p><strong>ZUCCHERI</strong></p>
																	<p><?= number_format(explode(' ', $producto->azucaresa)[0], 2) ?> g</p>
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
																	<p><?= number_format(explode(' ', $producto->sodio)[0], 2) ?> g</p>
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
												   foreach ($productos_reform->result() as $producto) {?>
													<td>
		                							<?$ItaliaLabel = new Etiquetado_italia(explode(' ', $producto->energia)[0], explode(' ', $producto->lipidos)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->azucaresa)[0], explode(' ', $producto->sodio)[0], $vnrs[$cve][2]);
			                							?>
			                							
			                								<div class="battery-small">
				                								<div class="battery-title-1">
																				<p><strong>ENERGIA</strong></p>
																				<p><?= number_format(explode(' ', $producto->energia)[0]*4.184) ?> kJ</p>
																				<p><?= number_format(explode(' ', $producto->energia)[0]) ?> kcal</p>
																			</div>
																			<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
																				<?= number_format($ItaliaLabel->getEnergia()) ?>%
																			</div>
																			<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						                								</div>

						                								<div class="battery-small">
																			<div class="battery-title-2">
																				<p><strong>GRASSI</strong></p>
																				<p><?= number_format(explode(' ', $producto->lipidos)[0]	, 2) ?> g</p>
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
																				<p><?= number_format(explode(' ', $producto->acidosgs)[0], 2) ?> g</p>
																			</div>
																			<div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
																				<?= number_format($ItaliaLabel->getGrasasSat()) ?>%
																			</div>
																			<span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
						                								</div>

						                								<div class="battery-small">
																			<div class="battery-title-2">
																				<p><strong>ZUCCHERI</strong></p>
																				<p><?= number_format(explode(' ', $producto->azucaresa)[0], 2) ?> g</p>
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
																				<p><?= number_format(explode(' ', $producto->sodio)[0], 2) ?> g</p>
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
		                							
		                						}?>
												
											</tr>
                							<!-- ./Etiquetado de Italia -->
                						<?
                						}
                						?>
											
											<!-- Etiquetado de Australia & Nueva Zelanda -->
                							<tr>
                								<th>Australia & Nueva Zelanda</th>
                								
                								<?
                								foreach ($productos->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda(explode(' ', $producto->energia)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], $producto->calcio, $producto->verdura, $producto->proteina, $producto->fibra, $producto->id_categoria, $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
			                								<img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
																			<div class="australia-value-small">
																				<p class="title">ENERGY</p>
																				<p class="val"><?= number_format(explode(' ', $producto->energia)[0] * 4.184, 1) ?> kJ</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SAT FAT</p>
																				<p class="val"><?= number_format(explode(' ', $producto->acidosgs)[0], 1) ?> g</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SUGARS</p>
																				<p class="val"><?= number_format(explode(' ', $producto->azucaresa)[0], 1) ?> g</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SODIUM</p>
																				<p class="val"><?= number_format(explode(' ', $producto->sodio)[0], 1) ?> g</p>
																			</div>
			                							</td>
			                							<?
			                							unset($AustraliaLabel);
		                							
		                						}
                								
												foreach ($productos_reform->result() as $producto) {
		                							//if ($producto->id_grupo == $grupo->id_grupo) {
		                								$AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda(explode(' ', $producto->energia)[0], explode(' ', $producto->acidosgs)[0], explode(' ', $producto->sodio)[0], explode(' ', $producto->azucaresa)[0], $producto->calcio, $producto->verdura, $producto->proteina, $producto->fibra, $producto->id_categoria, $producto->tipo);
			                							?>
			                							<td class="txt-centrado">
			                								<img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
																			<div class="australia-value-small">
																				<p class="title">ENERGY</p>
																				<p class="val"><?= number_format(explode(' ', $producto->energia)[0] * 4.184, 1) ?> kJ</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SAT FAT</p>
																				<p class="val"><?= number_format(explode(' ', $producto->acidosgs)[0], 1) ?> g</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SUGARS</p>
																				<p class="val"><?= number_format(explode(' ', $producto->azucaresa)[0], 1) ?> g</p>
																			</div>
																			<div class="australia-value-small">
																				<p class="title">SODIUM</p>
																				<p class="val"><?= number_format(explode(' ', $producto->sodio)[0], 1) ?> g</p>
																			</div>
			                							</td>
			                							<?
			                							unset($AustraliaLabel);
		                							
		                						}
                								?>
												
                							</tr>
                							<!-- ./Etiquetado de Australia & Nueva Zelanda -->
                           		
											
                          
                    </tbody>
				</table>
				 <div class="card-footer">
                           <a href="<?= base_url('productos_reformulation') ?>" class="btn btn-lg btn-primary float-right">Regresar</a>
                             <!--<button class="btn btn-lg btn-primary float-right">Aceptar</button>-->
                           </div>
                				
    	    </div>
   	    </div>
    </div>
</section>