<? $input = new Input(); ?>

<!-- Main content -->
<section class="content">
  <form method="post" action="<?= base_url('registrar_producto') ?>">
    <!-- Default box -->
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-plus-circle"></i>
          Registrar un nuevo producto <small>Tamaño de porción: 100g.</small>
        </h3>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Nombre</label>
              <?= $input->Text(array(
                'name'=>'producto_nombre', 
                'id'=>'producto_nombre', 
                'class'=>'form-control',
                'placeholder'=>'Escriba aquí',  
                'required'=>'required',
              ), 'text') ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Categoria</label>
              <?= $input->Select(array(
                'name'=>'producto_categoria', 
                'id'=>'producto_categoria', 
                'class'=>'form-control',
                'required'=>'required',
              ), $categorias, 'id_categoria', 'categoria', 0) ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Marca</label>
              <?= $input->Select(array(
                'name'=>'producto_marca', 
                'id'=>'producto_marca', 
                'class'=>'form-control',
                'required'=>'required',
              ), $marcas, 'id_marca', 'marca', 0) ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Precio</label>
              <?= $input->Text(array(
                'name'=>'producto_precio', 
                'id'=>'producto_precio', 
                'class'=>'form-control',
                'placeholder'=>'0',  
                'min'=>1
              ), 'number') ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <fieldset>
              <legend>Información nutrimental</legend>
              <div class="row">
                <?
                foreach ($campos as $etiqueta=>$nombre) {
                  ?>
                  <div class="col-xs-12 col-md-4 col-lg-2">
                    <div class="form-group">
                      <label><?= $etiqueta ?></label>
                      <div class="input-group">
                        <?= $input->Text(array(
                          'name'=>$nombre, 
                          'id'=>$nombre, 
                          'class'=>'form-control valor-ingrediente',
                          'placeholder'=>'0',
                          'step'=>'0.01',
                          'style'=>'text-align:center',
                        ), 'number') ?>
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <select name="um_<?= $nombre ?>" id="um_<?= $nombre ?>" >
                              <option value="">-</option>
                              <option>g</option>
                              <option>mg</option>
                              <option>mcg</option>
                              <option>%</option>
                            </select>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?
                }
                ?>
              </div>
            </fieldset>
          </div>
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button class="btn btn-lg btn-secondary float-right">Aceptar</button>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </form>
</section>
<!-- /.content -->