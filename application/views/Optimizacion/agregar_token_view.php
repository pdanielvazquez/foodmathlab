<!-- Main content -->
<section class="content">

    <form role="form" method="post" action="guardar_token">
		<div class="card card-danger">
			<div class="card-header">
				<h4 class="card-title">
					<i class="fas fa-plus-circle"></i>
					Agregar producto
				</h4>
			</div>
			<div class="card-body">
			  <input type="hidden" name="metodo" value="add">
			  <div class="col-sm-12">
			    <ul class="nav nav-tabs bar_tabs desktop" id="myTab" role="tablist">
			      <li class="nav-item">
			        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">INFORMACIÓN GÉNERAL</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" id="max-tab" data-toggle="tab" href="#max" role="tab" aria-controls="max" aria-selected="false">VALORES MAXIMOS</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" id="min-tab" data-toggle="tab" href="#min" role="tab" aria-controls="min" aria-selected="false">VALORES MINIMOS</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" id="lock-tab" data-toggle="tab" href="#lock" role="tab" aria-controls="lock" aria-selected="false">VALORES BLOQUEADOS</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" id="params-tab" data-toggle="tab" href="#params" role="tab" aria-controls="params" aria-selected="false">PARAMETROS</a>
			      </li>
			    </ul>
			    <div class="nav nav-tabs flex-column bar_tabs mobile" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="display: none;">
			      <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">INFORMACIÓN GÉNERAL</a>
			      <a class="nav-link" id="max-tab" data-toggle="tab" href="#max" role="tab" aria-controls="max" aria-selected="false">VALORES MAXIMOS</a>
			      <a class="nav-link" id="min-tab" data-toggle="tab" href="#min" role="tab" aria-controls="min" aria-selected="false">VALORES MINIMOS</a>
			      <a class="nav-link" id="lock-tab" data-toggle="tab" href="#lock" role="tab" aria-controls="lock" aria-selected="false">VALORES BLOQUEADOS</a>
			      <a class="nav-link" id="params-tab" data-toggle="tab" href="#params" role="tab" aria-controls="params" aria-selected="false">PARAMETROS</a>
			    </div>
			  </div>
			  <div class="col-sm-12">
			    <div class="tab-content" id="myTabContent">
			      <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
			        <div class="row section_form">
			          <div class="col-sm-8">
						<label for="product" class="control-label">NOMBRE</label>
			            <input type="text" class="form-control" id="product" name="product" required>
						</div>
			          <div class="col-sm-4">
			            <label for="porcion" class="control-label">TAMAÑO DE LA PORCIÓN</label>
			            <input type="text" class="form-control int" id="porcion" name="porcion" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="energy" class="control-label">ENERGIA</label>
			            <input type="text" class="form-control dec" id="energy" name="energy" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="carbs" class="control-label">CARBOHIDRATOS</label>
			            <input type="text" class="form-control dec" id="carbs" name="carbs" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="sugar" class="control-label">AZÚCAR</label>
			            <input type="text" class="form-control dec" id="sugar" name="sugar" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="totalFat" class="control-label">GRASAS TOTALES</label>
			            <input type="text" class="form-control dec" id="totalFat" name="totalFat" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="satFat" class="control-label">GRASAS SATURADAS</label>
			            <input type="text" class="form-control dec" id="satFat" name="satFat" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="sodium" class="control-label">SODIO</label>
			            <input type="text" class="form-control dec" id="sodium" name="sodium" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="fv" class="control-label">F&V</label>
			            <input type="text" class="form-control dec" id="fv" name="fv" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="fiber" class="control-label">FIBRA</label>
			            <input type="text" class="form-control dec" id="fiber" name="fiber" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="protein" class="control-label">PROTEINA</label>
			            <input type="text" class="form-control dec" id="protein" name="protein" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="cheese" class="control-label">QUESO</label>
						<select class="form-control" id="cheese" name="cheese">
						  <option value="0">FALSE</option>
						  <option value="1">VERDADERO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="drink" class="control-label">BEBIDA</label>
						<select class="form-control" id="drink" name="drink">
						  <option value="0">FALSE</option>
						  <option value="1">VERDADERO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="method" class="control-label">MÉTODO DE OBTENCIÓN DE FIBRA</label>
						<select class="form-control" id="method" name="method">
						  <option value="NSP">NSP</option>
						  <option value="AOAC">AOAC</option>
						</select>
			          </div>
			        </div>
			      </div>
			      <div class="tab-pane fade" id="max" role="tabpanel" aria-labelledby="max-tab">
			        <div class="row section_form">
			          <div class="col-sm-4">
			            <label for="max_sugar" class="control-label">AZÚCAR</label>
			            <input type="text" class="form-control dec" id="max_sugar" name="max_sugar">
			          </div>
			          <div class="col-sm-4">
			            <label for="max_satFat" class="control-label">GRASAS SATURADAS</label>
			            <input type="text" class="form-control dec" id="max_satFat" name="max_satFat">
			          </div>
			          <div class="col-sm-4">
			            <label for="max_sodium" class="control-label">SODIO</label>
			            <input type="text" class="form-control dec" id="max_sodium" name="max_sodium">
			          </div>
			          <div class="col-sm-4">
			            <label for="max_fv" class="control-label">F&V</label>
			            <input type="text" class="form-control dec" id="max_fv" name="max_fv">
			          </div>
			          <div class="col-sm-4">
			            <label for="max_fiber" class="control-label">FIBRA</label>
			            <input type="text" class="form-control dec" id="max_fiber" name="max_fiber">
			          </div>
			          <div class="col-sm-4">
			            <label for="max_protein" class="control-label">PROTEINA</label>
			            <input type="text" class="form-control dec" id="max_protein" name="max_protein">
			          </div>
			        </div>
			      </div>
			      <div class="tab-pane fade" id="min" role="tabpanel" aria-labelledby="min-tab">
			        <div class="row section_form">
			          <div class="col-sm-4">
			            <label for="min_sugar" class="control-label">AZÚCAR</label>
			            <input type="text" class="form-control dec" id="min_sugar" name="min_sugar">
			          </div>
			          <div class="col-sm-4">
			            <label for="min_satFat" class="control-label">GRASAS SATURADAS</label>
			            <input type="text" class="form-control dec" id="min_satFat" name="min_satFat">
			          </div>
			          <div class="col-sm-4">
			            <label for="min_sodium" class="control-label">SODIO</label>
			            <input type="text" class="form-control dec" id="min_sodium" name="min_sodium">
			          </div>
			          <div class="col-sm-4">
			            <label for="min_fv" class="control-label">F&V</label>
			            <input type="text" class="form-control dec" id="min_fv" name="min_fv">
			          </div>
			          <div class="col-sm-4">
			            <label for="min_fiber" class="control-label">FIBRA</label>
			            <input type="text" class="form-control dec" id="min_fiber" name="min_fiber">
			          </div>
			          <div class="col-sm-4">
			            <label for="min_protein" class="control-label">PROTEINA</label>
			            <input type="text" class="form-control dec" id="min_protein" name="min_protein">
			          </div>
			        </div>
			      </div>
			      <div class="tab-pane fade" id="lock" role="tabpanel" aria-labelledby="lock-tab">
			        <div class="row section_form">
			          <div class="col-sm-4">
			            <label for="lock_sugar" class="control-label">AZÚCAR</label>
						<select class="form-control" id="lock_sugar" name="lock_sugar">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="lock_satFat" class="control-label">GRASAS SATURADAS</label>
						<select class="form-control" id="lock_satFat" name="lock_satFat">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="lock_sodium" class="control-label">SODIO</label>
						<select class="form-control" id="lock_sodium" name="lock_sodium">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="lock_fv" class="control-label">F&V</label>
						<select class="form-control" id="lock_fv" name="lock_fv">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="lock_fiber" class="control-label">FIBRA</label>
						<select class="form-control" id="lock_fiber" name="lock_fiber">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="lock_protein" class="control-label">PROTEINA</label>
						<select class="form-control" id="lock_protein" name="lock_protein">
						  <option value="0">NO BLOQUEADO</option>
						  <option value="1">BLOQUEADO</option>
						</select>
			          </div>
			          <div class="col-sm-4">
			            <label for="forceLetter" class="control-label">FORZAR A LA LETRA</label>
						<select class="form-control" id="forceLetter" name="forceLetter">
						  <option value="">SIN LETRA</option>
						  <option value="A">A</option>
						  <option value="B">B</option>
						  <option value="C">C</option>
						  <option value="D">D</option>
						</select>
			          </div>
			        </div>
			      </div>
			      <div class="tab-pane fade" id="params" role="tabpanel" aria-labelledby="params-tab">
			        <div class="row section_form">
			          <div class="col-sm-4">
			            <label for="weightNutriscore" class="control-label">PESO</label>
			            <input type="text" class="form-control dec" id="weightNutriscore" name="weightNutriscore" value="0.6" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="population" class="control-label">POBLACIÓN</label>
			            <input type="text" class="form-control int" id="population" name="population" value="200" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="replace" class="control-label">REEMPLAZO</label>
			            <input type="text" class="form-control dec" id="replace" name="replace" value="0.5" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="generations" class="control-label">GENERACIONES</label>
			            <input type="text" class="form-control int" id="generations" name="generations" value="10000" required>
			          </div>
			          <div class="col-sm-4">
			            <label for="seed" class="control-label">SEMILLA</label>
			            <input type="text" class="form-control int" id="seed" name="seed" value="0" required>
			          </div>          
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div class="card-footer">
		        <input class="btn btn-secondary btn-lg float-right" type="submit" name="submit" value="Guardar">  
			</div>
		</div>
    </form>

</section>
<!-- /.content -->