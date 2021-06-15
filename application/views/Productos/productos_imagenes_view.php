<!-- Main content -->
<section class="content">

	<div class="row">

		<div class="col-xs-12 col-md-6 col-lg-4">
			<form action="<?=base_url('productos_imagenes/'. encripta($id_prod)).'/0' ?>" method="post" enctype="multipart/form-data">
				<div class="card card-danger">
					<div class="card-header">
						<h4 class="card-title">
							<i class="fas fa-plus-circle"></i>
							Agregar una imagen desde un archivo
						</h4>
					</div>
					<div class="card-body">
				        <!--El name del campo tiene que ser si o si "userfile"-->
				        <div class="form-group">
				        	<label>Busque el archivo</label>
				        	<input type="file" name="userfile" value="fichero" required="required" />
				        </div>									    
					</div>
					<div class="card-footer">
						<input type="submit" value="Subir archivo" class="btn btn-warning" name="subir_archivo" />
					</div>
				</div>
			</form>

			<form action="<?=base_url('productos_imagenes/'. encripta($id_prod)).'/0' ?>" method="post" enctype="multipart/form-data">
				<div class="card card-danger">
					<div class="card-header">
						<h4 class="card-title">
							<i class="fas fa-plus-circle"></i>
							Agregar una imagen desde URL
						</h4>
					</div>
					<div class="card-body">
				        <!--El name del campo tiene que ser si o si "userfile"-->
				        <div class="form-group">
				        	<label>URL</label>
				        	<input type="text" name="url" required="required" class="form-control" placeholder="https://dominio.com/foto1.jpg" />
				        </div>									    
					</div>
					<div class="card-footer">
						<input type="submit" value="Subir archivo" class="btn btn-warning" name="subir_archivo_url" />
					</div>
				</div>
			</form>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-8">
			<div class="card card-danger">
					<div class="card-header">
						<h4 class="card-title">
							<i class="fas fa-images"></i>
							Imagenes agregadas
						</h4>
					</div>
					<div class="card-body">
				        <?
			        	$producto = ($productos!=false) ? $productos->row(0): false;
				        if ($imagenes!=false) {
				        	$conta=0;
				        	foreach ($imagenes->result() as $imagen) {
				        		?>
				        		<a href="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" title="<?= $producto->nombre.'-'.++$conta ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=500, height=300, scrollbars=1'); return false;" >
			                        <img src="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" class="img-fluid mb-2" alt="Imagen del producto" style="width: 128px; height: 128px; border:2px solid #AAA; margin: 0 0.2rem;">
			                     </a>
			                     <a href="<?= base_url('eliminar_imagenes/').encripta($imagen->nombre_archivo).'/'.encripta($producto->id_prod) ?>" title="Quitar imagen" class="btn btn-danger btn-xs" style="position: relative; top: -60px; right: 20px;" >
			                        	<i class="fas fa-trash-alt" alt="Eliminar producto"></i>
			                     </a>
				        		<?
				        	}
				        }
				        else{
				        	?>
				        		<a href="<?= base_url('vendor/dist/img/default-150x150.png') ?>" data-title="Imagen por defecto" target="_blank" onclick="window.open(this.href, this.target, 'width=500, height=300, scrollbars=1'); return false;">
			                        <img src="<?= base_url('vendor/dist/img/default-150x150.png') ?>" class="img-fluid mb-2" alt="white sample" style="width: 128px; height: 128px;">
			                     </a>
				        		<?
				        }
				        ?>
					</div>
					<div class="card-footer">
						<a href="<?= base_url('productos_registrados') ?>" class="btn btn-secondary">Regresar al listado de productos</a>
					</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->