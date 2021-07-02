<? 
$input = new Input(); 
$grupo = ($grupos!=false)? $grupos->row(0) : false ;
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-4">
      <form method="post" action="<?= base_url('productos_grupos_editar/'.encripta($grupo->id_grupo).'/1') ?>">
        <!-- Default box -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Editar un grupo
            </h3>
          </div>
          <div class="card-body">
              <!-- <input type="hidden" name="id_grupo" value="<?= $grupo->id_grupo ?>"> -->
                <div class="form-group">
                  <label>Nombre del grupo</label>
                  <?= $input->Text(array(
                    'name'=>'grupo_nombre', 
                    'id'=>'grupo_nombre', 
                    'class'=>'form-control',
                    'placeholder'=>'Escriba aquí',  
                    'required'=>'required',
                    'value'=>$grupo->nombre,
                  ), 'text') ?>
                </div>
                <div class="form-group">
                  <label>Tipo de alimentos</label>
                  <select class="form-control" name="grupo_tipo" id="grupo_tipo">
                    <option <?= ($grupo->tipo=='solido')? 'selected="selected"' : '' ?> value="solido">Sólidos</option>
                    <option <?= ($grupo->tipo=='liquido')? 'selected="selected"' : '' ?> value="liquido">Líquidos</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Descripción del grupo</label>
                  <?= $input->Textarea(array(
                    'name'=>'grupo_descripcion', 
                    'id'=>'grupo_descripcion', 
                    'class'=>'form-control',
                    'placeholder'=>'Escriba aquí',  
                    'required'=>'required',
                    'rows'=>5
                  ), $grupo->descripcion) ?>
                </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <a href="<?= base_url('productos_grupos') ?>" class="btn btn-secondary justify-content-between">Regresar</a>
            <button class="btn btn-lg btn-danger float-right" name="aceptar">Aceptar</button>
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </form>
    </div>
  </div>
</section>
<!-- /.content -->