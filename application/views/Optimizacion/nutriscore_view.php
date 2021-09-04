<? $input = new Input(); ?>

<!-- Main content -->
<section class="content">

	<!-- Tabla de productos registrados -->
    <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Productos registrados
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Token</th>
                <th>Extras</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  $conta = 0;
                  foreach ($productos->result() as $producto) {
                    ?>
                    <tr>
                      <td><?= ++$conta ?></td>
                      <td><?= $producto->nombre ?></td>
                      <td>
                        <span id="token_<?= $producto->id_prod ?>">
                          <?
                          if ($tokens!=false) {
                            foreach ($tokens->result() as $token) {
                              if ($token->id_prod == $producto->id_prod ) {
                                ?>
                                <a href="recuperar_token/<?= $token->token ?>"><?= $token->token ?></a>
                                <?
                              }
                            }
                          }
                          ?>
                        </span>
                      </td>
                      <td>
                        <?
                          if ($tokens!=false) {
                            $existe = 0;
                            foreach ($tokens->result() as $token) {
                              if ($token->id_prod == $producto->id_prod ) {
                                $existe = 1;
                              }
                            }

                            if ($existe==1) {
                              ?>
                      	        <button type="button" class="btn btn-danger btn-borrar-optimizacion" data-id="<?= $producto->id_prod ?>" data-name="<?= $producto->nombre ?>">Eliminar optimización</button>
                              <?
                            }
                          }
                          
                              ?>
                                <button type="button" class="btn btn-primary btn-optimizar" data-toggle="modal" data-target="#info-extra" data-id="<?= $producto->id_prod ?>" data-name="<?= $producto->nombre ?>">Optimizar*</button>
                             <?
                          ?>
                      </td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Modal -->
      <div class="modal fade" id="info-extra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title" id="descripcionLabel">
                Optimización de <span></span>
                <small>Información extra</small>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="info-extra-body">
              <input type="hidden" name="id_prod" id="id_prod">
              <fieldset>
                <legend class="bg-warning" style="text-align:center;">
                  <small><i class="fas fa-arrow-circle-up"></i> Valores Máximos</small>
                </legend>
                <div class="row">
                  <?
                  foreach ($campos_max_values as $campo_max) {
                    ?>
                    <div class="col-xs-12 col-md-4 col-lg-2">
                      <div class="form-group">
                        <label><?= $campo_max['etiqueta'] ?></label>
                        <div class="input-group">
                          <?= $input->Text(array(
                            'name'=>$campo_max['atributo'], 
                            'id'=>$campo_max['atributo'], 
                            'class'=>'form-control valor-ingrediente',
                            'placeholder'=>'0',
                            'step'=>'0.01',
                            'style'=>'text-align:center',
                          ), 'number') ?>
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <select name="um_<?= $campo_max['atributo'] ?>" id="um_<?= $campo_max['atributo'] ?>" >
                                <option <?= ($campo_max['unidad']=='g') ? 'selected' :  '' ?> >g</option>
                                <option <?= ($campo_max['unidad']=='mg') ? 'selected' :  '' ?> >mg</option>
                                <option <?= ($campo_max['unidad']=='mcg') ? 'selected' :  '' ?> >mcg</option>
                                <option <?= ($campo_max['unidad']=='kcal') ? 'selected' :  '' ?> >kcal</option>
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

              <fieldset>
                <legend class="bg-warning" style="text-align:center;">
                  <small>
                    <i class="fas fa-arrow-circle-down"></i> Valores Mínimos
                  </small>
                </legend>
                <div class="row">
                  <?
                  foreach ($campos_min_values as $campo_min) {
                    ?>
                    <div class="col-xs-12 col-md-4 col-lg-2">
                      <div class="form-group">
                        <label><?= $campo_min['etiqueta'] ?></label>
                        <div class="input-group">
                          <?= $input->Text(array(
                            'name'=>$campo_min['atributo'], 
                            'id'=>$campo_min['atributo'], 
                            'class'=>'form-control valor-ingrediente',
                            'placeholder'=>'0',
                            'step'=>'0.01',
                            'style'=>'text-align:center',
                          ), 'number') ?>
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <select name="um_<?= $campo_min['atributo'] ?>" id="um_<?= $campo_min['atributo'] ?>" >
                                <option <?= ($campo_min['unidad']=='g') ? 'selected' :  '' ?> >g</option>
                                <option <?= ($campo_min['unidad']=='mg') ? 'selected' :  '' ?> >mg</option>
                                <option <?= ($campo_min['unidad']=='mcg') ? 'selected' :  '' ?> >mcg</option>
                                <option <?= ($campo_min['unidad']=='kcal') ? 'selected' :  '' ?> >kcal</option>
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

              <fieldset>
                <legend class="bg-warning" style="text-align:center;">
                  <small>
                    <i class="fas fa-ban"></i> Valores Bloqueados
                  </small>
                </legend>
                <div class="row">
                  <?
                  foreach ($campos_bloqueados as $campo_bloq) {
                    ?>
                    <div class="col-xs-12 col-md-4 col-lg-3">
                      <div class="form-group">
                        <label><?= $campo_bloq['etiqueta'] ?></label>
                          <select name="<?= $campo_bloq['atributo'] ?>" id="<?= $campo_bloq['atributo'] ?>" class="form-control">
                            <option>false</option>
                            <option>true</option>
                          </select>
                      </div>
                    </div>
                    <?
                  }
                  ?>
                  <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="form-group">
                      <label>Forzar a la letra</label>
                        <select name="forzar_letra" id="forzar_letra" class="form-control">
                          <option>false</option>
                          <option>A</option>
                          <option>B</option>
                          <option>C</option>
                          <option>D</option>
                        </select>
                    </div>
                  </div>
                </div>
              </fieldset>

              <fieldset>
                <legend class="bg-warning" style="text-align:center;">
                  <small>
                    <i class="fas fa-tachometer-alt"></i> Parámetros
                  </small>
                </legend>
                <div class="row">
                  <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="form-group">
                      <label>Método de obtención de fibras</label> 
                      <select name="producto_metodoF" id="producto_metodoF" class="form-control">
                        <option>NSP</option>
                        <option>AOAC</option>
                      </select>
                    </div>
                  </div>
                  <?
                  foreach ($parametros as $parametro) {
                    ?>
                    <div class="col-xs-12 col-md-4 col-lg-3">
                      <div class="form-group">
                        <label><?= $parametro['etiqueta'] ?></label>
                        <?= $input->Text(array(
                            'name'=>$parametro['atributo'], 
                            'id'=>$parametro['atributo'], 
                            'value'=>$parametro['valor'], 
                            'class'=>'form-control',
                            'placeholder'=>'0',
                            'step'=>'0.01',
                            'style'=>'text-align:center',
                          ), 'number') ?>
                      </div>
                    </div>
                    <?
                  }
                  ?>
                  
                </div>
              </fieldset>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger btn-lg btn-optimizar-aceptar">Continuar</button>
            </div>
          </div>
        </div>
      </div>

      <div id="variables"></div>

</section>
<!-- /.content -->