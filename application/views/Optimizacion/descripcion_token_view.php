<? 
    $input = new Input(); 
    $producto = ($productos!=false) ? $productos->row(0) : false;
?> 
<style>
.nav-link.active{
  background-color: #EDEDED !important;
}
</style>

<!-- Main content -->
<section class="content">
    <div class="card card-danger">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">
                <i class="fas fa-table"></i>
                <?= $producto->nombre ?>
            </h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item">
                    <a class="nav-link active" href="#tab_1" data-toggle="tab">Información general</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab_2" data-toggle="tab">Matriz de optimización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab_3" data-toggle="tab">JSON</a>
                </li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <!-- Datos personales -->
                <div class="tab-pane active" id="tab_1">
                    <h3 style="margin:0 0 1rem 0;">Información general</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <fieldset>
                                <legend class="bg-warning" style="text-align:center;">
                                  <small><i class="fas fa-info-circle"></i> Propiedades</small>
                                </legend>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Porción</label>
                                            <div class="input-group">
                                              <?= $input->Text(array(
                                                'class'     =>'form-control valor-ingrediente',
                                                'placeholder'=>'0',
                                                'style'     =>  'text-align:center',
                                                'readonly'  =>  'readonly',
                                                'value'     =>  number_format($producto->cantidad_porcion, 3),
                                              ), 'number') ?>
                                              <div class="input-group-append">
                                                <span class="input-group-text">
                                                  <select disabled="disabled" >
                                                    <option >g</option>
                                                  </select>
                                                </span>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Queso</label>
                                            <?= $input->Text(array(
                                                'class'     =>'form-control valor-ingrediente',
                                                'placeholder'=>'0',
                                                'style'     =>  'text-align:center',
                                                'readonly'  =>  'readonly',
                                                'value'     =>  ($producto->id_categoria==49)? 'true': 'false',
                                            ), 'text') ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Bebida</label>
                                              <?= $input->Text(array(
                                                'class'     =>'form-control valor-ingrediente',
                                                'placeholder'=>'0',
                                                'style'     =>  'text-align:center',
                                                'readonly'  =>  'readonly',
                                                'value'     =>  ($producto->tipo=='liquido')? 'true': 'false',
                                              ), 'text') ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

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
                                            'name'      =>$campo_max['atributo'], 
                                            'id'        =>$campo_max['atributo'], 
                                            'class'     =>'form-control valor-ingrediente',
                                            'placeholder'=>'0',
                                            'style'     =>  'text-align:center',
                                            'readonly'  =>  'readonly',
                                            'value'     =>  $campo_max['valor'],
                                          ), 'number') ?>
                                          <div class="input-group-append">
                                            <span class="input-group-text">
                                              <select name="um_<?= $campo_max['atributo'] ?>" id="um_<?= $campo_max['atributo'] ?>" disabled="disabled" >
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
                                            'style'=>'text-align:center',
                                            'readonly'  =>  'readonly',
                                            'value'     =>  $campo_min['valor'],
                                          ), 'number') ?>
                                          <div class="input-group-append">
                                            <span class="input-group-text">
                                              <select name="um_<?= $campo_min['atributo'] ?>" id="um_<?= $campo_min['atributo'] ?>" disabled="disabled">
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
                                          <select name="<?= $campo_bloq['atributo'] ?>" id="<?= $campo_bloq['atributo'] ?>" class="form-control" disabled="disabled">
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
                                        <select name="forzar_letra" id="forzar_letra" class="form-control" disabled="disabled">
                                          <option <?= ($forceLetter=='false')? 'selected="selected"' : '' ?> >false</option>
                                          <option <?= ($forceLetter=='A')? 'selected="selected"' : '' ?> >A</option>
                                          <option <?= ($forceLetter=='B')? 'selected="selected"' : '' ?> >B</option>
                                          <option <?= ($forceLetter=='C')? 'selected="selected"' : '' ?> >C</option>
                                          <option <?= ($forceLetter=='D')? 'selected="selected"' : '' ?> >D</option>
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
                                      <select name="producto_metodoF" id="producto_metodoF" class="form-control" disabled="disabled">
                                        <option <?= ($method=='NSP')? 'selected="selected"' : '' ?> >NSP</option>
                                        <option <?= ($method=='AOAC')? 'selected="selected"' : '' ?> >AOAC</option>
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
                                            'readonly'  =>  'readonly',
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
                    </div>
                </div>
                <!-- /.Datos personales -->
                <!-- Datos laborales -->
                <div class="tab-pane" id="tab_2">
                    <h3 style="margin:0 0 1rem 0;">Matriz de optimización</h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Energía</th>
                                        <th>Carbohidratos</th>
                                        <th>Azucar</th>
                                        <th>Grasas Totales</th>
                                        <th>Grasas Saturadas</th>
                                        <th>Sodio</th>
                                        <th>Frutas & Verduras</th>
                                        <th>Fibra</th>
                                        <th>Proteina</th>
                                        <th>Nutriscore</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    for ($i=0; $i < count($topFitness) ; $i++) { 
                                        $datos = (array)$topFitness[$i];
                                        $food = (array)$datos["food"];
                                        ?>
                                        <tr class="txt-centrado">
                                            <td><?= $datos["letter"] ?></td>
                                            <td><?= $food["energy"] ?></td> 
                                            <td><?= $food["carbs"] ?></td> 
                                            <td><?= $food["sugar"] ?></td> 
                                            <td><?= $food["totalFat"] ?></td> 
                                            <td><?= $food["satFat"] ?></td> 
                                            <td><?= $food["sodium"] ?></td> 
                                            <td><?= $food["f&v"] ?></td> 
                                            <td><?= $food["fiber"] ?></td> 
                                            <td><?= $food["protein"] ?></td> 
                                            <td><?= $datos["score"] ?></td> 
                                        </tr>
                                        <?
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.Datos laborales -->
                <!-- Datos escolares -->
                <div class="tab-pane" id="tab_3">
                    <h3 style="margin:0 0 1rem 0;">JSON</h3>
                    <div class="row">
                        <div class="col-12">
                            
                                <?= json_encode((array)$json) ?>
                            
                        </div>
                    </div>
                </div>
                <!-- /.Datos escolares -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
        <div class="card-footer">
            <a class="btn btn-secondary" href="<?= base_url('nutriscore') ?>">Regresar</a> 
        </div>
    </div>
</section>
<!-- /.content -->