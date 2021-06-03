<!-- Main content -->
<section class="content">

	<div class="card card-danger">
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
	</div>

	<div id="response"></div>

</section>
<!-- /.content -->