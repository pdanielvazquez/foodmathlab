<!-- Main content -->
<section class="content">

	<div class="row">
		
		<!-- Opciones de etiquetado -->
		<div class="col-xs-12 col-md-2 col-lg-3">
			<div class="card card-danger">
		        <div class="card-header">
		          <h3 class="card-title">
		            <i class="fas fa-tags"></i>
		            Etiquetados
		          </h3>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		        	<fieldset>
		        		<legend>LATAM</legend>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Chile</p>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Ecuador</p>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> México</p>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Perú</p>
		        	</fieldset>

		        	<fieldset>
		        		<legend>EUROPA</legend>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Francia (NutriScore)</p>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> Reino Unido (MTLL)</p>
		        	</fieldset>

		        	<fieldset>
		        		<legend>INDICES</legend>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> NRF 9.3</p>
		        		<p style="margin: 0;"><input type="checkbox" name="et_chile" id="et_chile" value="1"> SAIN-LIM</p>
		        	</fieldset>

		        </div>
		    </div>
		</div>
		<!-- /.Opciones de etiquetado -->

		<!-- Tabla estadística y etiquetados -->
		<div class="col-xs-12 col-md-10 col-lg-9">
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
			        					<td><?= $campo['media'] ?></td>
			        					<td><?= $campo['de'] ?></td>
			        					<td><?= $campo['moda'] ?></td>
			        					<td><?= $campo['mediana'] ?></td>
			        					<td><?= $campo['minimo'] ?></td>
			        					<td><?= $campo['maximo'] ?></td>
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
		<!-- /.Tabla estadística y etiquetados -->

	</div>

</section>
<!-- /.content -->