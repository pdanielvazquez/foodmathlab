<? $input = new Input(); ?>
<link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/foodmathlab_charts.css">

<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    <div class="modal-header bg-danger d-flex p-0">
      <h5 class="modal-title" id="descripcionLabel" style="margin: 1rem 0 0 1rem;"><?= $producto->nombre ?> </h5>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item">
            <a class="nav-link active btn-tab" href="#prod_1" data-toggle="tab">Información general</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-tab" href="#prod_2" data-toggle="tab">Información completa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-tab" href="#prod_3" data-toggle="tab">Etiquetado</a>
          </li>
        </ul>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 0.4rem 0 0 0;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" id="descripcionBody">
      <div class="tab-content">

        <div class="tab-pane active" id="prod_1">
          <div class="row">
            
            <?
            if ($producto!=false) {
            ?>
              <div class="col-xs-12 col-md-6 col-lg-6" style="border: 1px solid #AAA; padding: 0.5rem;">
                <table id="tabla-nutrimental">
                  <tr>
                    <th colspan="2">DECLARACIÓN NUTRIMENTAL</th>
                  </tr>
                  <tr>
                    <td>Tamaño de envase</td>
                    <td><?= number_format($producto->cantidad_neta) ?> g</strong></td>
                  </tr>
                  <tr>
                    <td class="x3-borde">Contenido energético por envase</td>
                    <td class="x3-borde"><?= number_format(($producto->cantidad_neta/$producto->cantidad_porcion)*$producto->energia_kj) ?> kJ (<?= number_format(($producto->cantidad_neta/$producto->cantidad_porcion)*$producto->energia) ?> kcal) </td>
                  </tr>
                  <tr>
                    <td>Porción</td>
                    <td><strong><?= number_format($producto->cantidad_porcion) ?> g</strong></td>
                  </tr>
                  <tr>
                    <td class="x6-borde">Contenido energético</td>
                    <td class="x6-borde"><strong><?= number_format($producto->energia_kj) ?> kJ (<?= number_format($producto->energia) ?> kcal)</strong></td>
                  </tr>
                  <tr>
                    <td>Grasas totales: <?= number_format($producto->lipidos*100) ?> g</td>
                    <td><?= number_format(($producto->lipidos*100)/$referencia['ref_grasas_tot']) ?>%</td>
                  </tr>
                  <tr>
                    <td>Sodio: <?= number_format($producto->sodio) ?> mg</td>
                    <td><?= number_format((($producto->sodio*1000)*100)/$referencia['ref_sodio']) ?> %</td>
                  </tr>
                  <tr>
                    <td>Carbohidratos: <?= number_format($producto->hidratos) ?> g</td>
                    <td><?= number_format(($producto->hidratos*100)/$referencia['ref_hidratos']) ?> %</td>
                  </tr>
                  <tr>
                    <td>Fibra dietética: <?= number_format($producto->fibra) ?> g</td>
                    <td><?= number_format(($producto->fibra*100)/$referencia['ref_fibra']) ?> %</td>
                  </tr>
                  <tr>
                    <td>Azucares: <?= number_format($producto->azucaresa) ?> g</td>
                    <td><?= number_format(($producto->azucaresa*100)/$referencia['ref_azucares']) ?> %</td>
                  </tr>
                  <tr>
                    <td>Proteinas: <?= number_format($producto->proteina) ?> g</td>
                    <td><?= number_format(($producto->proteina*100)/$referencia['ref_proteina']) ?> %</td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6" >
                <div style="border: 1px solid #AAA; padding: 0.5rem;" id="etiqueta-nutrimental">
                  <p><strong>Ingredientes: </strong> <?= ($producto->ingredientes!='')? $producto->ingredientes : '-No hay ingredientes-' ?></p>
                  <p><strong>Comentarios: </strong> <?= ($producto->comentarios!='')? $producto->comentarios : '-No hay comentarios-' ?></p>
                  <p><strong>Reclamaciones: </strong> <?= ($producto->reclamaciones!='')? $producto->reclamaciones : '-No hay reclamaciones-' ?></p>
                </div>
              </div>
            <? 
            }
            else{
              ?>
              <p>No hay información</p>
              <?
            } 
            ?>
          </div>
          <h5 style="margin-top: 1rem;">
            <i class="fas fa-poll"></i> Resumen
          </h5>
          <div class="row">
            <?
            if ($producto!=false) {
              
              if ($productos_energia!=false) {

                /*Graficando la energia del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $energias = array();
                foreach ($productos_energia->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($energias, $total->energia);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="energiaChart"  data-values="<?= implode(',', $energias) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Calorias (kcal)" data-title="Energía" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              if ($productos_lipidos!=false) {

                /*Graficando la energia del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $lipidos = array();
                foreach ($productos_lipidos->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($lipidos, $total->lipidos);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="lipidosChart"  data-values="<?= implode(',', $lipidos) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Lípidos / Grasas totales" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              if ($productos_azucares!=false) {

                /*Graficando los azucares del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $azucares = array();
                foreach ($productos_azucares->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($azucares, $total->azucaresa);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="azucaresChart"  data-values="<?= implode(',', $azucares) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Azucares" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              if ($productos_grasasSat!=false) {

                /*Graficando los azucares del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $grasas = array();
                foreach ($productos_grasasSat->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($grasas, $total->acidosgs);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="grasasSatChart"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Saturadas" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              if ($productos_grasasTrans!=false) {

                /*Graficando las grasas trans del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $grasas = array();
                foreach ($productos_grasasTrans->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($grasas, $total->acidostrans);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="grasasTransChart"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Trans" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              if ($productos_sodio!=false) {

                /*Graficando el del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $sodio = array();
                foreach ($productos_sodio->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($sodio, $total->sodio * 1000);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                  <canvas id="sodioChart"  data-values="<?= implode(',', $sodio) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Miligramos (mg.)" data-title="Sodio" height="200" class="chartCanvas"></canvas>
                </div>
                <?
              }

              ?>
              <div class="col-xs-12 col-md-6 col-lg-4">
                <!-- Indice NRF 9.3 -->
                <?
                $nrf9 = array();
                $nrf3 = array();
                $colors = array();
                $label = array();
                if ($productos_indices!=false) {
                    foreach ($productos_indices->result() as $prod_nrf93) {
                        $valores = array();
                        foreach ($campos_productos_indices as $etiqueta => $campo) {
                            $atributo = $campo['campo'];
                            $valores[$atributo] = number_format($prod_nrf93->$atributo, 2);
                        }
                        $nrf93 = new NRF93($valores);
                        array_push($nrf9, $nrf93->getNRF9());
                        array_push($nrf3, $nrf93->getNRF3());
                        array_push($label, substr($prod_nrf93->nombre, 0, 15) );
                        if ($prod_nrf93->id_prod == $producto->id_prod) {
                          array_push($colors, 1);
                        }
                        else{
                          array_push($colors, 0);
                        }
                        unset($nrf93);
                    }
                }
                ?>
                <canvas id="nrf93Chart"  data-nrf9="<?= implode(',', $nrf9) ?>" data-nrf3="<?= implode(',', $nrf3) ?>" data-labels="<?= implode(',', $label) ?>" data-title="NRF 9.3" data-color="<?= implode(',', $colors) ?>" height="200" class="chartCanvas"></canvas>
              </div>

              <div class="col-xs-12 col-md-6 col-lg-4">
                <?
                $dataX = array();
                $dataY = array();
                $colors = array();
                $labels = array();
                if ($productos_indices!=false) {
                    foreach ($productos_indices->result() as $prod_sainlim) {
                        $valores = array();
                        foreach ($campos_productos_indices as $etiqueta => $campo) {
                            $atributo = $campo['campo'];
                            $valores[$atributo] = number_format($prod_sainlim->$atributo, 2);
                        }
                        $sainlim = new SainLim($valores);
                        array_push($dataX, $sainlim->getSain());
                        array_push($dataY, $sainlim->getLim());
                        array_push($labels, substr($prod_sainlim->nombre, 0, 15));
                        if ($prod_sainlim->id_prod == $producto->id_prod) {
                          array_push($colors, 1);
                        }
                        else{
                          array_push($colors, 0);
                        }
                        unset($sainlim);
                    }
                }
                ?>
                <canvas id="saimlimChart"  data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-title="SAIN-LIM" data-color="<?= implode(',', $colors) ?>" height="200" class="chartCanvas"></canvas>
              </div>

              <div class="col-xs-12 col-md-6 col-lg-4">
                <?
                $ffs = array();
                $colors = array();
                $labels = array();
                if ($productos_indices!=false) {
                    foreach ($productos_indices->result() as $prod_ff) {
                        $valores = array();
                        foreach ($campos_productos_indices as $etiqueta => $campo) {
                            $atributo = $campo['campo'];
                            $valores[$atributo] = number_format($prod_ff->$atributo, 2);
                        }
                        $ff = new FullnessFactor($valores);
                        array_push($ffs, $ff->getFactor());
                        array_push($labels, substr($prod_ff->nombre, 0, 15));
                        if ($prod_ff->id_prod == $producto->id_prod) {
                          array_push($colors, 1);
                        }
                        else{
                          array_push($colors, 0);
                        }
                        unset($ff);
                    }
                }
                ?>
                <canvas id="ffChart"  data-values="<?= implode(',', $ffs) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="FF" data-title="Fullness Factor" height="200" class="chartCanvas"></canvas>
              </div>

              <div class="col-xs-12 col-md-6 col-lg-4">
                <?
                $calidades = array();
                $colors = array();
                $labels = array();
                if ($productos_indices!=false) {
                    foreach ($productos_indices->result() as $prod_quality) {
                        $valores = array();
                        foreach ($campos_productos_indices as $etiqueta => $campo) {
                            $atributo = $campo['campo'];
                            $valores[$atributo] = number_format($prod_quality->$atributo, 2);
                            //echo "valor: ".$valores[$atributo]."<br>";
                        }
                        $calidad = new MediaEstandarizada($valores, $productos_indices);
                        array_push($calidades, $calidad->getME());
                        array_push($labels, substr($prod_quality->nombre, 0, 15));
                        if ($prod_quality->id_prod == $producto->id_prod) {
                          array_push($colors, 1);
                        }
                        else{
                          array_push($colors, 0);
                        }
                        unset($ff);
                    }
                }
                ?>
                <canvas id="qualityChart"  data-values="<?= implode(',', $calidades) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Media Estandarizada" data-title="Calidad de los Alimentos" height="200" class="chartCanvas"></canvas>
              </div>

              <div class="col-xs-12 col-md-6 col-lg-4">
                <?
                $dataX = array();
                $dataY = array();
                $colors = array();
                $labels = array();
                if ($productos_indices!=false) {
                    foreach ($productos_indices->result() as $prod_sainlimsens) {
                        $valores = array();
                        foreach ($campos_productos_indices as $etiqueta => $campo) {
                            $atributo = $campo['campo'];
                            $valores[$atributo] = number_format($prod_sainlimsens->$atributo, 2);
                        }
                        $sainlimsens = new SainLimSens($valores);
                        array_push($dataX, $sainlimsens->getSainSens($prod_sainlimsens->categoria));
                        array_push($dataY, $sainlimsens->getLimSens());
                        array_push($labels, substr($prod_sainlimsens->nombre, 0, 15));
                        if ($prod_sainlimsens->id_prod == $producto->id_prod) {
                          array_push($colors, 1);
                        }
                        else{
                          array_push($colors, 0);
                        }
                        unset($sainlimsens);
                    }
                }
                ?>
                <canvas id="sensChart" data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-title="SENS" data-color="<?= implode(',', $colors) ?>" height="200" class="chartCanvas"></canvas>
              </div>

              
            <?
            } 
            ?>
          </div>
        </div>

        <div class="tab-pane" id="prod_2">

          <div class="row">
            <div class="col-xs-12 col-md-4 col-lg-4">
              <div class="form-group">
                <label>Nombre del producto</label>
                <?= $input->Text(array(
                  'name'=>'producto_nombre', 
                  'id'=>'producto_nombre', 
                  'class'=>'form-control',
                  'placeholder'=>'Escriba aquí',  
                  'readonly'=>'readonly',
                  'value'=>$producto->nombre,
                ), 'text') ?>
              </div>
            </div>
            <div class="col-xs-12 col-md-4 col-lg-4">
              <div class="form-group">
                <label>UPC/SKU</label>
                <?= $input->Text(array(
                  'name'=>'producto_upc', 
                  'id'=>'producto_upc', 
                  'class'=>'form-control',
                  'readonly'=>'readonly',
                  'value'=>$producto->upc,
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
                  'disabled'=>'disabled',
                ), $grupos, 'id_grupo', 'nombre', $producto->id_grupo) ?>
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
                    'readonly'=>'readonly',
                    'step'=>'0.1',
                    'min'=>'0',
                    'style'=>'text-align:center',
                    'value'=> number_format($producto->cantidad_neta, 1),
                  ), 'number') ?>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <select name="um_neta" id="um_neta" disabled="disabled" >
                        <option <?= ($producto->tipo=='solido')? 'selected="selected"' : '' ?> >g</option>
                        <option <?= ($producto->tipo=='liquido')? 'selected="selected"' : '' ?> >ml</option>
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
                    'readonly'=>'readonly',
                    'step'=>'0.1',
                    'min'=>'0',
                    'style'=>'text-align:center',
                    'value'=> number_format($producto->cantidad_porcion, 1),
                  ), 'number') ?>
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <select name="um_porcion" id="um_porcion" disabled="disabled" >
                        <option <?= ($producto->tipo=='solido')? 'selected="selected"' : '' ?> >g</option>
                        <option <?= ($producto->tipo=='liquido')? 'selected="selected"' : '' ?> >ml</option>
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
                    'readonly'=>'readonly',
                    'step'=>'0.1',
                    'min'=>'0',
                    'style'=>'text-align:center',
                    'value'=>number_format($producto->precio, 2), 
                  ), 'number') ?>
                  <span class="input-group-text">
                    <select name="producto_moneda" id="producto_moneda" disabled="disabled">
                      <option <?= ($producto->moneda=='MNX')? 'selected="selected"' : '' ?> >MXN</option>
                      <option <?= ($producto->moneda=='USD')? 'selected="selected"' : '' ?> >USD</option>
                      <option <?= ($producto->moneda=='EUR')? 'selected="selected"' : '' ?> >EUR</option>
                    </select>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-4 col-lg-3">
              <div class="form-group">
                <label>Queso</label>
                <select class="form-control" name="producto_categoria" id="producto_categoria" disabled="disabled">
                  <option <?= ($producto->id_categoria==49)? 'selected="selected"' : '' ?> >si</option>
                  <option <?= ($producto->id_categoria==0)? 'selected="selected"' : '' ?> >no</option>
                </select>
              </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <label>Ingredientes</label>
                <?= $input->Textarea(array(
                    'name'=>'producto_ingredientes', 
                    'id'=>'producto_ingredientes', 
                    'class'=>'form-control',
                    'readonly'=>'readonly',
                    'placeholder'=>'Escriba aquí',  
                    'rows'=>4,
                  ), $producto->ingredientes)
                ?>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <label>Comentarios</label>
                <?= $input->Textarea(array(
                    'name'=>'producto_comentarios', 
                    'id'=>'producto_comentarios', 
                    'class'=>'form-control',
                    'readonly'=>'readonly',
                    'placeholder'=>'Escriba aquí',  
                    'rows'=>4,
                  ), $producto->comentarios)
                ?>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-4">
                <label>Reclamaciones</label>
                <?= $input->Textarea(array(
                    'name'=>'producto_reclamaciones', 
                    'id'=>'producto_reclamaciones', 
                    'class'=>'form-control',
                    'readonly'=>'readonly',
                    'placeholder'=>'Escriba aquí',  
                    'rows'=>4,
                  ), $producto->reclamaciones)
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
                    $atributo = $campo['atributo'];
                    ?>
                    <div class="col-xs-12 col-md-4 col-lg-2">
                      <div class="form-group">
                        <label><?= $campo['etiqueta'] ?></label>
                        <div class="input-group">
                          <?= $input->Text(array(
                            'name'=>$campo['atributo'], 
                            'id'=>$campo['atributo'], 
                            'class'=>'form-control valor-ingrediente',
                            'readonly'=>'readonly',
                            'placeholder'=>'0',
                            'step'=>'0.01',
                            'style'=>'text-align:center',
                            // 'value'=> number_format($producto->$atributo, 2),
                            'value' => ($producto->$atributo>0) ? number_format(($campo['unidad']=='mg')? $producto->$atributo*1000 : $producto->$atributo, 2) : '' ,
                          ), 'number') ?>
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <select name="um_<?= $campo['atributo'] ?>" id="um_<?= $campo['atributo'] ?>" disabled="disabled" >
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

        <div class="tab-pane" id="prod_3">
          <h5 style="margin-top: 1rem;">
            <i class="fas fa-tags"></i> Etiquetados del producto
          </h5>
          <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6">
              <table class="table table-bordered table-hover table-striped">
                <tr>
                  <th class="txt-centrado bg-secondary" colspan="2">Etiquetados LATAM</th>
                </tr>
                <!-- Etiquetado de Chile -->
                <tr>
                  <th>Chile</th>
                    <?
                      $chileLabel = new Etiquetado_chile($producto->energia, $producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
                    ?>
                    <td class="txt-centrado">
                      <?
                    if ($chileLabel->getEnergia()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-chile/calorias.png') ?>" style="width: 75px;">
                      <?
                    }

                    if ($chileLabel->getSodio()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-chile/sodio.png') ?>" style="width: 75px;">
                      <?
                    }
                    
                    if ($chileLabel->getAzucar()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-chile/azucares.png') ?>" style="width: 75px;">
                      <?
                    }
                    
                    if ($chileLabel->getGrasasSat()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-chile/grasas.png') ?>" style="width: 75px;">
                      <?
                    }
                    
                    ?>
                    </td>
                    <?
                    unset($chileLabel);
                    ?>
                </tr>
                <!-- ./Etiquetado de Chile -->
                <!-- Etiquetado de Ecuador -->
                <tr>
                  <th>Ecuador</th>
                  <?
                      $ecuadorLabel = new Etiquetado_ecuador($producto->lipidos, $producto->azucaresa, $producto->sodio, $producto->tipo);
                      ?>
                      <td>
                        <label>Grasa Total</label>
                        <?
                  switch($ecuadorLabel->getGrasaTotal()){
                    case 0:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 1:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 2:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
                      <?
                      break;
                  }
                  ?>
                  <br>
                  <label>Azucar</label>
                          <?
                  switch($ecuadorLabel->getAzucar()){
                    case 0:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 1:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 2:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
                      <?
                      break;
                  }
                  ?>
                  <br>
                  <label>Sodio</label>
                          <?
                  switch($ecuadorLabel->getSodio()){
                    case 0:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/bajo.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 1:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/medio.png') ?>" style="width: 100px;">
                      <?
                      break;
                    case 2:
                      ?>
                      <img src="<?= base_url('uploads/labels-ecuador/alto.png') ?>" style="width: 100px;">
                      <?
                      break;
                  }
                  ?>
                      </td>
                      <?
                      unset($ecuadorLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Ecuador -->
                <!-- Etiquetado de México -->
                <tr>
                  <th>México</th>
                  <?
                      $MexLabel = new Etiquetado_mexico($producto->energia, $producto->azucaresa, $producto->acidosgs, $producto->acidostrans, $producto->sodio, $producto->tipo);
                      ?>
                      <td class="txt-centrado">
                        <?
                  if ($MexLabel->getExcesoCalorias()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-mexico/exceso-calorias.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($MexLabel->getExcesoAzucares()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-mexico/exceso-azucares.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  if ($MexLabel->getExcesoGrasasTrans()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-mexico/exceso-grasas-trans.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  if ($MexLabel->getExcesoGrasasSat()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-mexico/exceso-grasas-sat.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($MexLabel->getExcesoSodio()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-mexico/exceso-sodio.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  ?>
                  </td>
                  <?
                  unset($MexLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de México -->

                <!-- Etiquetado de Colombia -->
                <tr>
                  <th>Colombia</th>
                  <?
                      $ColombiaLabel = new Etiquetado_colombia($producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
                      ?>
                      <td class="txt-centrado">
                        <?
                  if ($ColombiaLabel->getSodio()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-colombia/sodio.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($ColombiaLabel->getAzucares()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-colombia/azucares.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  if ($ColombiaLabel->getGrasasSat()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-colombia/grasas-sat.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  ?>
                  </td>
                  <?
                  unset($ColombiaLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Colombia -->

                <!-- Etiquetado de Uruguay -->
                <tr>
                  <th>Uruguay</th>
                  <?
                    $UruguayLabel = new Etiquetado_uruguay($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->sodio, $producto->azucaresa, $producto->tipo);
                      ?>
                  <td class="txt-centrado">
                        <?
                  if ($UruguayLabel->getGrasaTot()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-uruguay/grasas_tot.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($UruguayLabel->getGrasasSat()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-uruguay/grasas_sat.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  if ($UruguayLabel->getSodio()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-uruguay/sodio.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($UruguayLabel->getAzucares()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-uruguay/azucares.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  ?>
                  </td>
                  <?
                  unset($UruguayLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Uruguay -->

                <!-- Etiquetado de Perú -->
                <tr>
                  <th>Perú</th>
                  <?
                      if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
                        $peruLabel = new Etiquetado_peru_2a_fase($producto->azucaresa, $producto->sodio, $producto->acidosgs, $producto->acidostrans, $producto->tipo);
                      }
                      else{
                        $peruLabel = new Etiquetado_peru_1a_fase($producto->azucaresa, $producto->sodio, $producto->acidosgs, $producto->acidostrans, $producto->tipo);
                      }
                  ?>
                  <td class="txt-centrado">
                        <?
                    if ($peruLabel->getAzucares()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-peru-1a/azucar.jpg') ?>" style="width: 75px;">
                      <?
                    }

                    if ($peruLabel->getSodio()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-peru-1a/sodio.jpg') ?>" style="width: 75px;">
                      <?
                    }
                    
                    if ($peruLabel->getGrasasSat()==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-peru-1a/grasas_sat.jpg') ?>" style="width: 75px;">
                      <?
                    }

                    if ($peruLabel->getGrasasTrans('otros')==1) {
                      ?>
                      <img src="<?= base_url('uploads/labels-peru-1a/grasas_trans.jpg') ?>" style="width: 75px;">
                      <?
                    }
                    
                    ?>
                  </td>
                  <?
                  unset($peruLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Perú -->
              </table>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">
              <table class="table table-bordered table-hover table-striped">
                <tr>
                  <th class="txt-centrado bg-secondary" colspan="2">Etiquetados Europa-Asia</th>
                </tr>

                <!-- Etiquetado de Reino Unido -->
                <tr>
                  <th>Reino Unido</th>
                    <?
                      $UkLabel = new Etiquetado_UK($producto->sodio/1000, $producto->azucaresa, $producto->acidosgs, $producto->lipidos, $producto->tipo);
                    ?>
                  <td>
                    <?
                    $color = 'gray';
                    $txt = 'ENERGÍA';
                    ?>
                    <div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
                      <p class="label_UK_title_small"><?= $txt ?></p>
                      <p class="label_UK_txt_small">
                        Calorías
                        <span class="label_UK_value_small">
                          <?= number_format($producto->energia, 1) ?> kcal
                        </span>
                      </p>
                      <p class="label_UK_ptc_small"><?= number_format(($producto->energia * 100)/2000, 1) ?>%</p>
                    </div>
                    <?
                    $color = '';
                    $txt = '';
                    switch($UkLabel->getGrasaTotal()) {
                      case 2:
                        $color = '#f65627';
                        $txt = 'ALTO';
                        break;
                      case 1:
                        $color = '#f9b03f';
                        $txt = 'MEDIO';
                        break;
                      case 0:
                        $color = '#78c758';
                        $txt = 'BAJO';
                        break;
                    }
                    ?>
                    <div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
                      <p class="label_UK_title_small"><?= $txt ?></p>
                      <p class="label_UK_txt_small">
                        Grasa
                        <span class="label_UK_value_small">
                          <?= number_format($producto->lipidos, 1) ?> g
                        </span>
                      </p>
                      <p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasaTotalPtc(), 1) ?>%</p>
                    </div>
                    <?
                    $color = '';
                    $txt = '';
                    switch($UkLabel->getGrasasSat()) {
                      case 2:
                        $color = '#f65627';
                        $txt = 'ALTO';
                        break;
                      case 1:
                        $color = '#f9b03f';
                        $txt = 'MEDIO';
                        break;
                      case 0:
                        $color = '#78c758';
                        $txt = 'BAJO';
                        break;
                    }
                    ?>
                    <div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
                      <p class="label_UK_title_small"><?= $txt ?></p>
                      <p class="label_UK_txt_small">
                        Grasa Sat
                        <span class="label_UK_value_small">
                          <?= number_format($producto->acidosgs, 1) ?> g
                        </span>
                      </p>
                      <p class="label_UK_ptc_small"><?= number_format($UkLabel->getGrasasSatPtc(), 1) ?>%</p>
                    </div>

                    <?
                    $color = '';
                    $txt = '';
                    switch($UkLabel->getAzucares()) {
                      case 2:
                        $color = '#f65627';
                        $txt = 'ALTO';
                        break;
                      case 1:
                        $color = '#f9b03f';
                        $txt = 'MEDIO';
                        break;
                      case 0:
                        $color = '#78c758';
                        $txt = 'BAJO';
                        break;
                    }
                    ?>
                    <div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
                      <p class="label_UK_title_small"><?= $txt ?></p>
                      <p class="label_UK_txt_small">
                        Azúcar
                        <span class="label_UK_value_small">
                          <?= number_format($producto->azucaresa, 1) ?> g
                        </span>
                      </p>
                      <p class="label_UK_ptc_small"><?= number_format($UkLabel->getAzucaresPtc(), 1) ?>%</p>
                    </div>

                    <?
                    $color = '';
                    $txt = '';
                    switch($UkLabel->getSodio()) {
                      case 2:
                        $color = '#f65627';
                        $txt = 'ALTO';
                        break;
                      case 1:
                        $color = '#f9b03f';
                        $txt = 'MEDIO';
                        break;
                      case 0:
                        $color = '#78c758';
                        $txt = 'BAJO';
                        break;
                    }
                    ?>
                    <div class="label_UK_small txt-centrado" style="background-color: <?= $color ?>;">
                      <p class="label_UK_title_small"><?= $txt ?></p>
                      <p class="label_UK_txt_small">
                        Sodio
                        <span class="label_UK_value_small">
                          <?= number_format($producto->sodio, 1) ?> g
                        </span>
                      </p>
                      <p class="label_UK_ptc_small"><?= number_format($UkLabel->getSodioPtc(), 1) ?>%</p>
                    </div>
                  </td>
                  <?
                  unset($UkLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Reino Unido -->

                <!-- Etiquetado de Francia -->
                <tr>
                  <th>Francia</th>
                  <?
                    $NutriScoreLabel = new NutriScore($producto->energia, $producto->azucaresa, $producto->acidosgs, $producto->lipidos, $producto->sodio, $producto->fruta + $producto->verdura, $producto->fibra, $producto->proteina, $producto->id_categoria, $producto->cantidad_porcion, $producto->tipo);
                  ?>
                  <td class="txt-centrado">
                        <?
                  switch ($NutriScoreLabel->getClase()) {
                    case 'A':
                      ?>
                      <img src="<?= base_url('uploads/labels-francia/nutri-score-a.jpg') ?>" style="width: 50%;">
                      <?
                      break;
                    case 'B':
                      ?>
                      <img src="<?= base_url('uploads/labels-francia/nutri-score-b.jpg') ?>" style="width: 50%;">
                      <?
                      break;
                    case 'C':
                      ?>
                      <img src="<?= base_url('uploads/labels-francia/nutri-score-c.jpg') ?>" style="width: 50%;">
                      <?
                      break;
                    case 'D':
                      ?>
                      <img src="<?= base_url('uploads/labels-francia/nutri-score-d.jpg') ?>" style="width: 50%;">
                      <?
                      break;
                    case 'E':
                      ?>
                      <img src="<?= base_url('uploads/labels-francia/nutri-score-e.jpg') ?>" style="width:50%;">
                      <?
                      break;
                  }
                  ?>
                  </td>
                  <?
                  unset($NutriScoreLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Francia -->

                <!-- Etiquetado de Israel -->
                <tr>
                  <th>Israel</th>
                  <?
                    $IsraelLabel = new Etiquetado_israel($producto->sodio, $producto->azucaresa, $producto->acidosgs, $producto->tipo);
                  ?>
                  <td class="txt-centrado">
                  <?
                  if ($IsraelLabel->getSodio()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-israel/sodio.jpg') ?>" style="width: 75px;">
                    <?
                  }

                  if ($IsraelLabel->getAzucares()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-israel/azucares.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  if ($IsraelLabel->getGrasasSat()==1) {
                    ?>
                    <img src="<?= base_url('uploads/labels-israel/grasas-sat.jpg') ?>" style="width: 75px;">
                    <?
                  }
                  
                  ?>
                  </td>
                  <?
                  unset($IsraelLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Israel -->

                <!-- Etiquetado de Italia -->
                <tr>
                  <th>Italia</th>
                  <?
                      $ItaliaLabel = new Etiquetado_italia($producto->energia, $producto->lipidos, $producto->acidosgs, $producto->azucaresa, $producto->sodio);
                      ?>
                      <td>
                        <div class="battery-small">
                          <div class="battery-title-1">
                    <p><strong>ENERGIA</strong></p>
                    <p><?= number_format($producto->energia*4.184) ?> kJ</p>
                    <p><?= number_format($producto->energia) ?> kcal</p>
                  </div>
                  <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
                    <?= number_format($ItaliaLabel->getEnergia()) ?>%
                  </div>
                  <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div>

                        <div class="battery-small">
                  <div class="battery-title-2">
                    <p><strong>GRASSI</strong></p>
                    <p><?= number_format($producto->lipidos , 2) ?> g</p>
                    <p>&nbsp;</p>
                  </div>
                  <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasaTot()) ?>% 100%">
                    <?= number_format($ItaliaLabel->getGrasaTot()) ?>%
                  </div>
                  <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div>

                        <div class="battery-small">
                  <div class="battery-title-2">
                    <p><strong>GRASSI<br>SATURI</strong></p>
                    <p><?= number_format($producto->acidosgs, 2) ?> g</p>
                  </div>
                  <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
                    <?= number_format($ItaliaLabel->getGrasasSat()) ?>%
                  </div>
                  <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div>

                        <div class="battery-small">
                  <div class="battery-title-2">
                    <p><strong>ZUCCHERI</strong></p>
                    <p><?= number_format($producto->azucaresa, 2) ?> g</p>
                    <p>&nbsp;</p>
                  </div>
                  <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getAzucares()) ?>% 100%">
                    <?= number_format($ItaliaLabel->getAzucares()) ?>%
                  </div>
                  <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </div>

                        <div class="battery-small">
                  <div class="battery-title-2">
                    <p><strong>SALE</strong></p>
                    <p><?= number_format($producto->sodio, 2) ?> g</p>
                    <p>&nbsp;</p>
                  </div>
                  <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
                    <?= number_format($ItaliaLabel->getSodio()) ?>%
                  </div>
                  <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                  </td>
                  <?
                  unset($UkLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Italia -->

                <!-- Etiquetado de Australia & Nueva Zelanda -->
                <tr>
                  <th>Australia & Nueva Zelanda</th>
                  <?
                    $AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda($producto->energia, $producto->acidosgs, $producto->sodio, $producto->azucaresa, $producto->calcio, $producto->verdura, $producto->proteina, $producto->fibra, $producto->id_categoria, $producto->tipo);
                      ?>
                  <td class="txt-centrado">
                    <img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
                    <div class="australia-value-small">
                      <p class="title">ENERGY</p>
                      <p class="val"><?= number_format($producto->energia * 4.184, 1) ?> kJ</p>
                    </div>
                    <div class="australia-value-small">
                      <p class="title">SAT FAT</p>
                      <p class="val"><?= number_format($producto->acidosgs, 1) ?> g</p>
                    </div>
                    <div class="australia-value-small">
                      <p class="title">SUGARS</p>
                      <p class="val"><?= number_format($producto->azucaresa, 1) ?> g</p>
                    </div>
                    <div class="australia-value-small">
                      <p class="title">SODIUM</p>
                      <p class="val"><?= number_format($producto->sodio, 1) ?> g</p>
                    </div>
                  </td>
                  <?
                  unset($AustraliaLabel);
                  ?>
                </tr>
                <!-- ./Etiquetado de Australia & Nueva Zelanda -->
                
              </table>
            </div>

          </div>
          <div>
            
          </div>
        </div>

      </div>  
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-close">Cerrar</button>
    </div>
  </div>
</div>

<script>
  $(function(){
    $('.btn-close').on('click', function(){
      $('#descripcion').modal('hide');
    });
  })
</script>