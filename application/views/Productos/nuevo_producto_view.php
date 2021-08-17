<? $input = new Input(); ?>

<!-- Main content -->
<section class="content">
  <form method="post" action="<?= base_url('registrar_producto') ?>">
    <!-- Default box -->
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-plus-circle"></i>
          Registrar un nuevo producto
        </h3>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="form-group">
              <label>Nombre del producto</label>
              <?= $input->Text(array(
                'name'=>'producto_nombre', 
                'id'=>'producto_nombre', 
                'class'=>'form-control',
                'placeholder'=>'Escriba aquí',  
                'required'=>'required',
              ), 'text') ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="form-group">
              <label>UPC/SKU</label>
              <?= $input->Text(array(
                'name'=>'producto_upc', 
                'id'=>'producto_nombre', 
                'class'=>'form-control',
                'placeholder'=>'Escriba aquí',  
                'required'=>'required',
              ), 'text') ?>
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="form-group">
              <label>Grupo</label>
              <?= $input->Select(array(
                'name'=>'producto_grupo', 
                'id'=>'producto_grupo', 
                'class'=>'form-control',
                'required'=>'required',
              ), $grupos, 'id_grupo', 'nombre', 0) ?>
            </div>
          </div>
          
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Cantidad neta</label> 
              <a href="" data-toggle="modal" data-target="#cantidad_neta">
                <i class="fas fa-question-circle text-red"></i>
              </a>
              <div class="input-group">
                <?= $input->Text(array(
                  'name'=>'producto_cantidad_neta', 
                  'id'=>'producto_cantidad_neta', 
                  'class'=>'form-control',
                  'placeholder'=>'0',  
                  'required'=>'required',
                  'step'=>'0.1',
                  'min'=>'0',
                  'style'=>'text-align:center',
                ), 'number') ?>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <select name="um_neta" id="um_neta" >
                      <option>g</option>
                      <option>ml</option>
                      <option>kg</option>
                      <option>l</option>
                    </select>
                  </span>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Cantidad por porción</label> 
              <a href="" data-toggle="modal" data-target="#cantidad_porcion">
                <i class="fas fa-question-circle text-red"></i>
              </a>
              <div class="input-group">
                <?= $input->Text(array(
                  'name'=>'producto_cantidad_porcion', 
                  'id'=>'producto_cantidad_porcion', 
                  'class'=>'form-control',
                  'placeholder'=>'0',  
                  'required'=>'required',
                  'step'=>'0.1',
                  'min'=>'0',
                  'style'=>'text-align:center',
                ), 'number') ?>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <select name="um_porcion" id="um_porcion" >
                      <option>g</option>
                      <option>ml</option>
                      <option>kg</option>
                      <option>l</option>
                    </select>
                  </span>
                </div>
              </div>
              
            </div>
          </div>

          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Precio</label> 
              <div class="input-group">
                <div class="input-group-append">
                  
                </div>
                <?= $input->Text(array(
                  'name'=>'producto_precio', 
                  'id'=>'producto_precio', 
                  'class'=>'form-control',
                  'placeholder'=>'0',  
                  'required'=>'required',
                  'step'=>'0.01',
                  'min'=>'0',
                  'style'=>'text-align:center',
                ), 'number') ?>
                  <span class="input-group-text">
                    <select name="producto_moneda" id="producto_moneda" >
                      <option>MXN</option>
                      <option>USD</option>
                      <option>EUR</option>
                    </select>
                  </span>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-md-4 col-lg-3">
            <div class="form-group">
              <label>Queso</label>
              <select class="form-control" name="producto_categoria" id="producto_categoria">
                <option>no</option>
                <option>si</option>
              </select>
            </div>
          </div>

          <div class="col-xs-12 col-md-6 col-lg-4">
              <label>Ingredientes</label>
              <?= $input->Textarea(array(
                  'name'=>'producto_ingredientes', 
                  'id'=>'producto_ingredientes', 
                  'class'=>'form-control',
                  'placeholder'=>'Escriba aquí',  
                  'rows'=>4,
                ), '')
              ?>
          </div>

          <div class="col-xs-12 col-md-6 col-lg-4">
              <label>Comentarios</label>
              <?= $input->Textarea(array(
                  'name'=>'producto_comentarios', 
                  'id'=>'producto_comentarios', 
                  'class'=>'form-control',
                  'placeholder'=>'Escriba aquí',  
                  'rows'=>4,
                ), '')
              ?>
          </div>

          <div class="col-xs-12 col-md-6 col-lg-4">
              <label>Reclamaciones</label>
              <?= $input->Textarea(array(
                  'name'=>'producto_reclamaciones', 
                  'id'=>'producto_reclamaciones', 
                  'class'=>'form-control',
                  'placeholder'=>'Escriba aquí',  
                  'rows'=>4,
                ), '')
              ?>
          </div>
          
        </div>

        <div class="row" style="margin-top: 1rem;">
          <div class="col-12">
            <fieldset>
              <legend><i class="fas fa-info-circle"></i> Información nutrimental</legend>
              <div class="row">
                <?
                foreach ($campos as $campo) {
                  ?>
                  <div class="col-xs-12 col-md-4 col-lg-2">
                    <div class="form-group">
                      <label><?= $campo['etiqueta'] ?></label>
                      <div class="input-group">
                        <?= $input->Text(array(
                          'name'=>$campo['atributo'], 
                          'id'=>$campo['atributo'], 
                          'class'=>'form-control valor-ingrediente',
                          'placeholder'=>'0',
                          'step'=>'0.01',
                          'style'=>'text-align:center',
                        ), 'number') ?>
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <select name="um_<?= $campo['atributo'] ?>" id="um_<?= $campo['atributo'] ?>" >
                              <?foreach ($campo['unidad'] as $unidad) {
                                ?>
                                <option value="<?= $unidad ?>" ><?= $unidad ?></option>
                                <?
                              }
                              ?>
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