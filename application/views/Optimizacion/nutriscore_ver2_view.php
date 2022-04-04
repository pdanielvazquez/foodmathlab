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

          <?
            $conta=0;
            if ($grupos!=false) {
              
              foreach ($grupos->result() as $grupo) {
                  $no_prods=0;
                  /*Verificar el numero de productos por Laboratorio*/
                  if ($productos!=false) {
                    foreach ($productos->result() as $producto) {
                      if ($producto->id_grupo == $grupo->id_grupo) {
                        $no_prods++;
                        $conta++;
                      }
                    }
                  }

                  $active = ($conta == 0) ? 'active' : '';
                  ?>
                    <a class="btn btn-default text-red float-right btn-filter" href="#" style="margin:2px" data="<?= $grupo->nombre ?>"><?= $grupo->nombre ?>
                    <span class="badge badge-warning" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $no_prods ?></span>
                    </a>
                  <?
              }
            }
            ?>
            <a class="btn btn-primary float-right btn-all" href="<?= base_url('nutriscore') ?>" style="margin:2px" >Ver todos
              <span class="badge badge-warning" style="position:relative; top:-0.5rem; right: 0.1rem;"><?= $conta ?></span>
            </a>
            
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Lab</th>
                <th>Optimizaciones</th>
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
                      <td>
                        <a href="<?= base_url('productos_informacion/'.encripta($producto->id_prod)) ?>" class="" data="<?= $conta ?>" title="Ver la información del producto" >
                        <?= $producto->producto ?>
                        </a>
                        <?
                        if ($imagenes!=false) {
                          $contaI = 0;
                          foreach ($imagenes->result() as $imagen) {
                            if ($producto->id_prod == $imagen->id_prod) {
                              ?>
                              <a href="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" title="<?= $producto->producto.'-'.++$contaI ?>" target="_blank" onclick="window.open(this.href, this.target, 'width=500, height=300, scrollbars=1'); return false;" >
                                <img src="<?= base_url('uploads/productos/').$imagen->nombre_archivo ?>" class="img-circle elevation-2" alt="Imagen del producto" style="width: 28px; height: 28px; margin: 0 0.2rem;">
                             </a>
                              <?
                            }
                          }
                        }
                        ?>
                      </td>
                      <td><?= $producto->grupo ?></td>
                      <td>-</td>
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
                      	        <a class="btn btn-danger btn-borrar-optimizacion" href="<?= base_url('borrar_token/'.$token->token) ?>" data-name="<?= $producto->nombre ?>">Eliminar optimización</button>
                              <?
                            }
                            else{
                              ?>
                                <button type="button" class="btn btn-primary btn-optimizar" data-toggle="modal" data-target="#info-extra" data-id="<?= $producto->id_prod ?>" data-name="<?= $producto->nombre ?>">Optimizar*</button>
                              <?
                            }
                          }
                          else{
                            ?>
                              <button type="button" class="btn btn-primary btn-optimizar" data-toggle="modal" data-target="#info-extra" data-id="<?= $producto->id_prod ?>" data-name="<?= $producto->nombre ?>">Optimizar*</button>
                            <?
                          }
                          
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
          <form method="post" action="<?= base_url('optimizar') ?>">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h5 class="modal-title" id="descripcionLabel">
                  Optimización <span></span>
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
                <button type="submit" class="btn btn-danger btn-lg">Continuar</button>
              </div>
            </div>
          </form>
          
        </div>
      </div>

      <div id="variables"></div>

</section>
<!-- /.content -->