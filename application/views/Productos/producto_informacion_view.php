<? 
  $input = new Input();
  $permisos_e = ($permisos_etiquetados!=false)? $permisos_etiquetados->result(): false;
  $permisos_i = ($permisos_indices!=false)? $permisos_indices->result(): false;
?>
<style>
  .flag{
    width: 30px;
  }
  .flag-1{
    width: 75px;
  }
  .nutrimentos td:nth-child(1n+2){
    text-align: center;
  }
  .card-title-chart{
    color: maroon;
    font-weight: bold;
    font-size: 1.5rem;
  }
  .material-icons{
    position: relative;
    top: 4px;
  }
  .btn-tool{
    color: #adb5bd !important;
  }
  .small{
    font-size: 0.7rem;
  }
</style>
<link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/foodmathlab_charts.css">

<!-- Main content -->
<section class="content">

  <div class="card card-danger">
    <div class="card-header">
      
      <ul class="nav nav-pills ml-auto">
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

    </div>
    <div class="card-body">
      <div class="tab-content">

        <div class="tab-pane active" id="prod_1">
          <div class="row">
            
            <?
            if ($producto!=false) {
              $cantidad_neta = explode(" ", $producto->cantidad_neta);
              $c_neta = array(
                'valor' =>  $cantidad_neta[0], 
                'unidad'=>  (count($cantidad_neta)>0) ? ($cantidad_neta[1]!='') ? $cantidad_neta[1]: 'g' : 'g',
              );

              $cantidad_porcion = explode(" ", $producto->cantidad_porcion);
              $c_porcion = array(
                'valor' =>  $cantidad_porcion[0],
                'unidad' =>  (count($cantidad_porcion)>0) ? ($cantidad_porcion[1]!='') ? $cantidad_porcion[1] : 'g' : 'g',
              );

              $energia_kj = explode(" ", $producto->energia_kj);
              $e_kj = array(
                'valor' =>  $energia_kj[0],
                'unidad' =>  (count($energia_kj)>0) ? ($energia_kj[1]!='') ? $energia_kj[1] : 'kJ' : 'kJ',
              );

              $energia_kcal = explode(" ", $producto->energia);
              $e_kcal = array(
                'valor' =>  $energia_kcal[0],
                'unidad' =>  (count($energia_kcal)>0) ? ($energia_kcal[1]!='') ? $energia_kcal[1]: 'kcal' : 'kcal',
              );

              $lipidos = explode(" ", $producto->lipidos);
              $lipids = array(
                'valor' =>  $lipidos[0],
                'unidad' =>  (count($lipidos)>0) ? ($lipidos[1]!='') ? $lipidos[1]: 'g' : 'g' ,
              );

              $sodio = explode(" ", $producto->sodio);
              $sodium = array(
                'valor' =>  $sodio[0],
                'unidad' =>  (count($sodio)>0) ? ($sodio[1]!='') ? $sodio[1]: 'mg' : 'mg' ,
              );

              $hidratos = explode(" ", $producto->hidratos);
              $carbo = array(
                'valor' =>  $hidratos[0],
                'unidad' =>  (count($hidratos)>0) ? ($hidratos[1]!='') ? $hidratos[1]: 'g' : 'g' ,
              );

              $fibra = explode(" ", $producto->fibra);
              $fiber = array(
                'valor' =>  $fibra[0],
                'unidad' =>  (count($fibra)>0) ? ($fibra[1]!='') ? $fibra[1]: 'g' : 'g' ,
              );

              $azucar = explode(" ", $producto->azucaresa);
              $sugar = array(
                'valor' =>  $azucar[0],
                'unidad' =>  (count($azucar)>0) ? ($azucar[1]!='') ? $azucar[1]: 'g' : 'g' ,
              );

              $proteinas = explode(" ", $producto->proteina);
              $protein = array(
                'valor' =>  $proteinas[0],
                'unidad' =>  (count($proteinas)>0) ? ($proteinas[1]!='') ? $proteinas[1]: 'g' : 'g' ,
              );

              ?>

              <div class="col-xs-12 col-md-6 col-lg-6" style="border: 1px solid #AAA; padding: 0.5rem;">
                <table id="tabla-nutrimental" border="1">
                  <tr>
                    <th colspan="5">DECLARACIÓN NUTRIMENTAL</th>
                  </tr>
                  <tr>
                    <td>Tamaño de envase</td>
                    <td colspan="4">
                      <strong>
                        <?= number_format($c_neta['valor'])." ".$c_neta['unidad'] ?>
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <td class="x3-borde">Contenido energético por envase</td>
                    <td colspan="4" class="x3-borde">
                      <strong>
                      <?= number_format(($c_neta['valor']/$c_porcion['valor'])*$e_kj['valor']) ?> kJ (<?= number_format(($c_neta['valor']/$c_porcion['valor'])*$e_kcal['valor']);
                      ?> kcal)
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <td>Porción</td>
                    <td colspan="4">
                      <strong><?= number_format($c_porcion['valor'])." ".$c_porcion['unidad'] ?></strong>
                    </td>
                  </tr>
                  <tr>
                    <td class="x6-borde">Contenido energético</td>
                    <td colspan="4" class="x6-borde"><strong><?= number_format($e_kj['valor']) ?> kJ (<?= number_format($e_kcal['valor']) ?> kcal)</strong></td>
                  </tr>
                  <tr class="txt-centrado">
                      <td>&nbsp;</td>
                      <td><img src="<?= base_url('uploads/flags/europa.jpg') ?>" class="flag"></td>
                      <td><img src="<?= base_url('uploads/flags/mexico.jpg') ?>" class="flag"></td>
                      <td><img src="<?= base_url('uploads/flags/colombia.jpg') ?>" class="flag"></td>
                      <td><img src="<?= base_url('uploads/flags/usa.jpg') ?>" class="flag"></td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Grasas totales: <strong><?= number_format($lipids['valor']*100, 3)." ".$lipids['unidad'] ?></strong></td>
                    <td><?= number_format(($lipids['valor']*100)/$referencia_eu['ref_grasas_tot']) ?>%</td>
                    <td><?= number_format(($lipids['valor']*100)/$referencia_mx['ref_grasas_tot']) ?>%</td>
                    <td><?= number_format(($lipids['valor']*100)/$referencia_co['ref_grasas_tot']) ?>%</td>
                    <td><?= number_format(($lipids['valor']*100)/$referencia_eeuu['ref_grasas_tot']) ?>%</td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Sodio: <strong><?= number_format($sodium['valor'], 3)." ".$sodium['unidad'] ?></strong></td>
                    <td><?= number_format((($sodium['valor']*100))/$referencia_eu['ref_sodio']) ?> %</td>
                    <td><?= number_format((($sodium['valor']*100))/$referencia_mx['ref_sodio']) ?> %</td>
                    <td><?= number_format((($sodium['valor']*100))/$referencia_co['ref_sodio']) ?> %</td>
                    <td><?= number_format((($sodium['valor']*100))/$referencia_eeuu['ref_sodio']) ?> %</td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Carbohidratos: <strong><?= number_format($carbo['valor'], 3)." ".$carbo['unidad'] ?></strong></td>
                    <td><?= number_format(($carbo['valor']*100)/$referencia_eu['ref_hidratos']) ?> %</td>
                    <td><?= number_format(($carbo['valor']*100)/$referencia_mx['ref_hidratos']) ?> %</td>
                    <td><?= number_format(($carbo['valor']*100)/$referencia_co['ref_hidratos']) ?> %</td>
                    <td><?= number_format(($carbo['valor']*100)/$referencia_eeuu['ref_hidratos']) ?> %</td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Fibra dietética: <strong><?= number_format($fiber['valor'], 3)." ".$fiber['unidad'] ?></strong></td>
                    <td><?= number_format(($fiber['valor']*100)/$referencia_eu['ref_fibra']) ?> %</td>
                    <td><?= number_format(($fiber['valor']*100)/$referencia_mx['ref_fibra']) ?> %</td>
                    <td><?= number_format(($fiber['valor']*100)/$referencia_co['ref_fibra']) ?> %</td>
                    <td><?= number_format(($fiber['valor']*100)/$referencia_eeuu['ref_fibra']) ?> %</td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Azúcares: <strong><?= number_format($sugar['valor'], 3)." ".$sugar['unidad'] ?></strong></td>
                    <td><?= number_format(($sugar['valor']*100)/$referencia_eu['ref_azucares']) ?> %</td>
                    <td><?= number_format(($sugar['valor']*100)/$referencia_mx['ref_azucares']) ?> %</td>
                    <td><?= number_format(($sugar['valor']*100)/$referencia_co['ref_azucares']) ?> %</td>
                    <td><?= number_format(($sugar['valor']*100)/$referencia_eeuu['ref_azucares']) ?> %</td>
                  </tr>
                  <tr class="nutrimentos">
                    <td>Proteinas: <strong><?= number_format($protein['valor'], 3)." ".$protein['unidad'] ?></strong></td>
                    <td><?= number_format(($protein['valor']*100)/$referencia_eu['ref_proteina']) ?> %</td>
                    <td><?= number_format(($protein['valor']*100)/$referencia_mx['ref_proteina']) ?> %</td>
                    <td><?= number_format(($protein['valor']*100)/$referencia_co['ref_proteina']) ?> %</td>
                    <td><?= number_format(($protein['valor']*100)/$referencia_eeuu['ref_proteina']) ?> %</td>
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
          <h4 style="margin-top: 1rem; width: 100%; padding: 3px;" class="bg-light txt-centrado">
            Gráficas <small class="text-gray">(Presione sobre los títulos)</small>
          </h4>
          <div class="row">
            <?
            if ($producto!=false) {

              // print_r($energias);
              
              /*if ($productos_energia!=false) {*/
              if (count($prods_nutrimentos)>0) {

                array_multisort($energias, SORT_ASC, $prods_nutrimentos);

                /*Graficando la energia del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $energias = array();
                /*foreach ($productos_energia->result() as $total) {
                  array_push($etiquetas, substr($total->nombre, 0, 20));
                  array_push($energias, explode(" ", $total->energia)[0]);
                  if ($total->id_prod == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }*/
                foreach ($prods_nutrimentos as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($energias, $value['energia']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Energía
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/bars/energia/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>

                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="energiaChart"  data-values="<?= implode(',', $energias) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Calorias (kcal)" data-title="Energía" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Energía
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/radar/energia/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>

                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="energiaRadar"  data-values="<?= implode(',', $energias) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Calorias (kcal)" data-title="Energía" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (count($prods_lipidos)>0) {

                /*print_r($prods_lipidos);
                echo "<hr>---------------";
                print_r($lipidos_arr);*/

                array_multisort($lipidos_arr, SORT_ASC, $prods_lipidos);

                /*Graficando la energia del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $lipidos = array();
                foreach ($prods_lipidos as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($lipidos, $value['lipidos']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <!-- Barras -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Grasas totales
                        </h3>
                      </button>
                      <div class="card-tools">

                        <a href="<?= base_url('producto_grafica_maximize/bars/lipidos/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="lipidosChart"  data-values="<?= implode(',', $lipidos) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Lípidos / Grasas totales" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Barras -->

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Grasas totales
                        </h3>
                      </button>
                      <div class="card-tools">
                        <a href="<?= base_url('producto_grafica_maximize/radar/lipidos/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="lipidosRadar"  data-values="<?= implode(',', $lipidos) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Lípidos / Grasas totales" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (count($prods_azucares)>0) {

                array_multisort($azucares_arr, SORT_ASC, $prods_azucares);

                /*Graficando los azucares del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $azucares = array();
                foreach ($prods_azucares as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($azucares, $value['azucaresa']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <!-- Barras -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Azúcares
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/bars/azucaresa/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="azucaresChart"  data-values="<?= implode(',', $azucares) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Azúcares" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Barras -->

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Azúcares
                        </h3>
                      </button>
                      <div class="card-tools">
                        <a href="<?= base_url('producto_grafica_maximize/radar/azucaresa/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="azucaresRadar"  data-values="<?= implode(',', $azucares) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Azúcares" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (count($prods_acidosgs)>0) {

                array_multisort($acidosgs_arr, SORT_ASC, $prods_acidosgs);

                /*Graficando los azucares del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $grasas = array();
                foreach ($prods_acidosgs as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($grasas, $value['acidosgs']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <!-- Barras -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Grasas Sat.
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/bars/acidosgs/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="grasasSatChart"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Saturadas" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Barras -->

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Grasas Sat.
                        </h3>
                      </button>
                      <div class="card-tools">
                        <a href="<?= base_url('producto_grafica_maximize/radar/acidosgs/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="grasasSatRadar"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Saturadas" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (count($prods_acidostrans)>0) {

                array_multisort($acidostrans_arr, SORT_ASC, $prods_acidostrans);

                /*Graficando las grasas trans del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $grasas = array();
                foreach ($prods_acidostrans as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($grasas, $value['acidostrans']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <!-- Barras -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Grasas Trans
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/bars/acidostrans/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="grasasTransChart"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Trans" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Barras -->

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Grasas Trans
                        </h3>
                      </button>
                      <div class="card-tools">
                        <a href="<?= base_url('producto_grafica_maximize/radar/acidostrans/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="grasasTransRadar"  data-values="<?= implode(',', $grasas) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Gramos (g.)" data-title="Grasas Trans" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (count($prods_sodio)>0) {

                array_multisort($sodio_arr, SORT_ASC, $prods_sodio);

                /*Graficando el del producto en comparacion a los otros productos*/
                $etiquetas = array();
                $colors = array();
                $sodio = array();
                foreach ($prods_sodio as $index=>$value) {
                  array_push($etiquetas, substr($value['nombre'], 0, 20));
                  array_push($sodio, $value['sodio']);
                  if ($value['id_prod'] == $producto->id_prod) {
                    array_push($colors, 1);
                  }
                  else{
                    array_push($colors, 0);
                  }
                }
                ?>
                <!-- Barras -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">equalizer</span>
                          Sodio 
                        </h3>
                      </button>
                      <div class="card-tools">
                        
                        <a href="<?= base_url('producto_grafica_maximize/bars/sodio/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="sodioChart"  data-values="<?= implode(',', $sodio) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Miligramos (mg.)" data-title="Sodio" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Barras -->

                <!-- Radar -->
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                    <div class="card-header">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                        <h3 class="card-title card-title-chart">
                          <span class="material-icons">radar</span>
                          Sodio 
                        </h3>
                      </button>
                      <div class="card-tools">
                        <a href="<?= base_url('producto_grafica_maximize/radar/sodio/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=800'); return false;">
                          <i class="fas fa-search"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="sodioRadar"  data-values="<?= implode(',', $sodio) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Miligramos (mg.)" data-title="Sodio" height="200" class="chartCanvas"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.Radar -->
                <?
              }

              if (search_index($permisos_i, 'nrf')==true) {
                $conta=1;
                foreach ($vnrs as $cve => $val) {
                  ?>
                    <div class="col-xs-12 col-md-4 col-lg-3">
                      <div class="card collapsed-card">
                          <div class="card-header">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                              <h3 class="card-title card-title-chart">
                                <span class="material-icons">scatter_plot</span>
                                NRF 9.3 <span class="small">VNR</span> <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag">
                              </h3>
                            </button>
                            <div class="card-tools">
                              
                              <a href="<?= base_url('producto_grafica_maximize_nrf/'.$cve.'/'.$producto->id_prod) ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=530'); return false;">
                                <i class="fas fa-search"></i>
                              </a>

                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                                <i class="fas fa-plus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
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
                                        $valores[$atributo] = number_format(explode(" ", $prod_nrf93->$atributo)[0], 2);
                                    }
                                    $nrf93 = new NRF93($valores, $vnrs[$cve][2]);
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
                            <canvas id="nrf93Chart<?= $conta++ ?>"  data-nrf9="<?= implode(',', $nrf9) ?>" data-nrf3="<?= implode(',', $nrf3) ?>" data-labels="<?= implode(',', $label) ?>" data-title="NRF 9.3" data-color="<?= implode(',', $colors) ?>" height="200" class="chartCanvas"></canvas>
                          </div>
                        </div>
                    </div>
                  <?
                }
              }
              ?>
              

              <?
              if (search_index($permisos_i, 'sai')==true) {
                ?>
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                      <div class="card-header">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <h3 class="card-title card-title-chart">
                            <span class="material-icons">scatter_plot</span>
                            SAIN-LIM
                          </h3>
                        </button>
                        <div class="card-tools">
                          
                          <a href="<?= base_url('producto_grafica_maximize_others/sain/'.$producto->id_prod) ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=530'); return false;">
                            <i class="fas fa-search"></i>
                          </a>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
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
                                    $valores[$atributo] = number_format(explode(" ", $prod_sainlim->$atributo)[0], 2);
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
                    </div>
                </div>
                <?
              }
              ?>

              <?
              if (search_index($permisos_i, 'fuf')==true) {
                ?>
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                      <div class="card-header">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <h3 class="card-title card-title-chart">
                            <span class="material-icons">equalizer</span>
                            <span class="h5">Fullness Factor</span>
                          </h3>
                        </button>
                        <div class="card-tools">
                          
                          <a href="<?= base_url('producto_grafica_maximize_others/ff/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=530'); return false;">
                            <i class="fas fa-search"></i>
                          </a>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <?
                        $ffs_arr = array();
                        $ffs_values = array();
                        $ffs = array();
                        $colors = array();
                        $labels = array();
                        if ($productos_indices!=false) {
                            foreach ($productos_indices->result() as $prod_ff) {
                                $valores = array();
                                foreach ($campos_productos_indices as $etiqueta => $campo) {
                                    $atributo = $campo['campo'];
                                    $valores[$atributo] = number_format(explode(" ", $prod_ff->$atributo)[0] , 2);
                                }
                                $ff = new FullnessFactor($valores);
                                array_push($ffs_arr, $ff->getFactor());
                                $ffs[] = array(
                                    'id_prod'   =>  $prod_ff->id_prod,
                                    'nombre'    =>  $prod_ff->nombre,
                                    'ff'        =>  $ff->getFactor(),
                                );
                                
                                unset($ff);
                            }
                        }

                        array_multisort($ffs_arr, SORT_ASC, $ffs);

                        foreach ($ffs as $index=>$value) {
                            array_push($labels, $value['nombre']);
                            array_push($ffs_values, $value['ff']);
                            if ($value['id_prod'] == $producto->id_prod) {
                                array_push($colors, 1);
                            }
                            else{
                                array_push($colors, 0);
                            }
                        }


                        ?>
                        <canvas id="ffChart"  data-values="<?= implode(',', $ffs_values) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="FF" data-title="Fullness Factor" height="200" class="chartCanvas"></canvas>
                      </div>
                    </div> 
                </div>
                <?
              }
              ?>

              <?
              if (search_index($permisos_i, 'mes')==true) {
                ?>
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                      <div class="card-header">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <h3 class="card-title card-title-chart">
                            <span class="material-icons">equalizer</span>
                            <span class="h5">Media Estandar</span>
                          </h3>
                        </button>
                        <div class="card-tools">
                          
                            <a href="<?= base_url('producto_grafica_maximize_others/mes/').$producto->id_prod ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=530'); return false;">
                                <i class="fas fa-search"></i>
                            </a>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <?
                        $mes_arr = array();
                        $mes_values = array();
                        $calidades = array();
                        $colors = array();
                        $labels = array();
                        if ($productos_indices!=false) {
                            foreach ($productos_indices->result() as $prod_quality) {
                                $valores = array();
                                foreach ($campos_productos_indices as $etiqueta => $campo) {
                                    $atributo = $campo['campo'];
                                    $valores[$atributo] = number_format(explode(" ", $prod_quality->$atributo)[0], 2);
                                    //echo "valor: ".$valores[$atributo]."<br>";
                                }
                                $calidad = new MediaEstandarizada($valores, $productos_indices);
                                array_push($mes_arr, $calidad->getME());
                                $calidades[] = array(
                                    'id_prod'   =>  $prod_quality->id_prod,
                                    'nombre'    =>  $prod_quality->nombre,
                                    'calidad'   =>  $calidad->getME(),
                                );
                                
                                unset($ff);
                            }
                        }

                        array_multisort($mes_arr, SORT_ASC, $calidades);

                        foreach ($calidades as $index=>$value) {
                            array_push($labels, $value['nombre']);
                            array_push($mes_values, $value['calidad']);
                            if ($value['id_prod'] == $producto->id_prod) {
                                array_push($colors, 1);
                            }
                            else{
                                array_push($colors, 0);
                            }
                        }

                        ?>
                        <canvas id="qualityChart"  data-values="<?= implode(',', $mes_values) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Media Estandarizada" data-title="Calidad de los Alimentos" height="200" class="chartCanvas"></canvas>
                      </div>
                    </div>
                </div>
                <?
              }
              ?>

              <?
              if (search_index($permisos_i, 'sen')==true) {
                ?>
                <div class="col-xs-12 col-md-4 col-lg-3">
                  <div class="card collapsed-card">
                      <div class="card-header">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                          <h3 class="card-title card-title-chart">
                            <span class="material-icons">area_chart</span>
                            SENS
                          </h3>
                        </button>
                        <div class="card-tools">
                          
                          <a href="<?= base_url('producto_grafica_maximize_others/sens/'.$producto->id_prod) ?>" target="_blank" class="btn btn-tool" title="Presiona para maximizar/minimizar la gráfica" onclick="window.open(this.href, this.target, 'width=650, height=530'); return false;">
                            <i class="fas fa-search"></i>
                          </a>

                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Presiona para ver/ocultar la gráfica">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
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
                                    $valores[$atributo] = number_format(explode(" ", $prod_sainlimsens->$atributo)[0], 2);
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
                    </div>
                </div>
                <?
              }?>

              
            <?
            } 
            ?>
          </div>
        </div>

        <div class="tab-pane" id="prod_2">

          <?
          if($producto!=false){
              $cantidad_neta = explode(" ", $producto->cantidad_neta);
              $c_neta = array(
                'valor' =>  $cantidad_neta[0], 
                'unidad'=>  (count($cantidad_neta)>0) ? $cantidad_neta[1]: 'g',
              );

              $cantidad_porcion = explode(" ", $producto->cantidad_porcion);
              $c_porcion = array(
                'valor' =>  $cantidad_porcion[0],
                'unidad' =>  (count($cantidad_porcion)>0) ? $cantidad_porcion[1]: 'g',
              );

              $energia_kj = explode(" ", $producto->energia_kj);
              $e_kj = array(
                'valor' =>  $energia_kj[0],
                'unidad' =>  (count($energia_kj)>0) ? $energia_kj[1]: 'kJ',
              );

              $energia_kcal = explode(" ", $producto->energia);
              $e_kcal = array(
                'valor' =>  $energia_kcal[0],
                'unidad' =>  (count($energia_kcal)>0) ? $energia_kcal[1]: 'kcal',
              );

              $lipidos = explode(" ", $producto->lipidos);
              $lipids = array(
                'valor' =>  $lipidos[0],
                'unidad' =>  (count($lipidos)>0) ? $lipidos[1] : 'g' ,
              );

              $sodio = explode(" ", $producto->sodio);
              $sodium = array(
                'valor' =>  $sodio[0],
                'unidad' =>  (count($sodio)>0) ? $sodio[1] : 'mg' ,
              );

              $hidratos = explode(" ", $producto->hidratos);
              $carbo = array(
                'valor' =>  $hidratos[0],
                'unidad' =>  (count($hidratos)>0) ? $hidratos[1] : 'g' ,
              );

              $fibra = explode(" ", $producto->fibra);
              $fiber = array(
                'valor' =>  $fibra[0],
                'unidad' =>  (count($fibra)>0) ? $fibra[1] : 'g' ,
              );

              $azucar = explode(" ", $producto->azucaresa);
              $sugar = array(
                'valor' =>  $azucar[0],
                'unidad' =>  (count($azucar)>0) ? $azucar[1] : 'g' ,
              );

              $proteinas = explode(" ", $producto->proteina);
              $protein = array(
                'valor' =>  $proteinas[0],
                'unidad' =>  (count($proteinas)>0) ? $proteinas[1] : 'g' ,
              );
              ?>

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
                        'value'=> number_format($c_neta['valor'], 1),
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
                        'value'=> number_format($c_porcion['valor'], 1),
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
                      $unidades = array('g', 'mg', 'mcg', '%', 'UI', 'l', 'ml');
                      foreach ($campos as $campo) {
                        $atributo = $campo['atributo'];
                        $meta = explode(" ", $producto->$atributo);
                        $valor = $meta[0];
                        $unidad = (count($meta)>0)? $meta[1] : $campo['unidad'];
                        ?>
                        <div class="col-xs-12 col-md-6 col-lg-3">
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
                                'value' => number_format($valor, 2),
                              ), 'number') ?>
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <select name="um_<?= $campo['atributo'] ?>" id="um_<?= $campo['atributo'] ?>" disabled="disabled" >
                                    <?
                                    foreach ($unidades as $uni) {
                                      ?>
                                        <option <?= ($unidad==$uni)? 'selected="selected"': '' ?> value="<?= $uni ?>" ><?= $uni ?></option>
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

              <?
          }
          else{
            echo "No hay información";
          }
          ?>

          
        </div>

        <div class="tab-pane" id="prod_3">
          <h5 style="margin-top: 1rem;">
            <i class="fas fa-tags"></i> Etiquetados del producto
          </h5>

          <?
          if ($producto!=false) {

            $cantidad_neta = explode(" ", $producto->cantidad_neta);
            $c_neta = array(
              'valor' =>  $cantidad_neta[0], 
              'unidad'=>  (count($cantidad_neta)>0) ? $cantidad_neta[1]: 'g',
            );

            $cantidad_porcion = explode(" ", $producto->cantidad_porcion);
            $c_porcion = array(
              'valor' =>  $cantidad_porcion[0],
              'unidad' =>  (count($cantidad_porcion)>0) ? $cantidad_porcion[1]: 'g',
            );

            $energia_kj = explode(" ", $producto->energia_kj);
            $e_kj = array(
              'valor' =>  $energia_kj[0],
              'unidad' =>  (count($energia_kj)>0) ? $energia_kj[1]: 'kJ',
            );

            $energia_kcal = explode(" ", $producto->energia);
            $e_kcal = array(
              'valor' =>  $energia_kcal[0],
              'unidad' =>  (count($energia_kcal)>0) ? $energia_kcal[1]: 'kcal',
            );

            $lipidos = explode(" ", $producto->lipidos);
            $lipids = array(
              'valor' =>  $lipidos[0],
              'unidad' =>  (count($lipidos)>0) ? $lipidos[1] : 'g' ,
            );

            $sodio = explode(" ", $producto->sodio);
            $sodium = array(
              'valor' =>  $sodio[0],
              'unidad' =>  (count($sodio)>0) ? $sodio[1] : 'mg' ,
            );

            $hidratos = explode(" ", $producto->hidratos);
            $carbo = array(
              'valor' =>  $hidratos[0],
              'unidad' =>  (count($hidratos)>0) ? $hidratos[1] : 'g' ,
            );

            $fibra = explode(" ", $producto->fibra);
            $fiber = array(
              'valor' =>  $fibra[0],
              'unidad' =>  (count($fibra)>0) ? $fibra[1] : 'g' ,
            );

            $azucar = explode(" ", $producto->azucaresa);
            $sugar = array(
              'valor' =>  $azucar[0],
              'unidad' =>  (count($azucar)>0) ? $azucar[1] : 'g' ,
            );

            $proteinas = explode(" ", $producto->proteinas);
            $protein = array(
              'valor' =>  $proteinas[0],
              'unidad' =>  (count($proteinas)>0) ? $proteinas[1] : 'g' ,
            );

            $acidosgs = explode(" ", $producto->acidosgs);
            $total_lipids = array(
              'valor' =>  $acidosgs[0],
              'unidad' =>  (count($acidosgs)>0) ? $acidosgs[1] : 'g' ,
            );

            $acidostrans = explode(" ", $producto->acidostrans);
            $trans = array(
              'valor' =>  $acidostrans[0],
              'unidad' =>  (count($acidostrans)>0) ? $acidostrans[1] : 'g' ,
            );

            $fruta = explode(" ", $producto->fruta);
            $fruit = array(
              'valor' =>  $fruta[0],
              'unidad' =>  (count($fruta)>0) ? $fruta[1] : 'g' ,
            );

            $verdura = explode(" ", $producto->verdura);
            $vegetable = array(
              'valor' =>  $verdura[0],
              'unidad' =>  (count($verdura)>0) ? $verdura[1] : 'g' ,
            );

            $calcio = explode(" ", $producto->calcio);
            $calcium = array(
              'valor' =>  $calcio[0],
              'unidad' =>  (count($calcio)>0) ? $calcio[1] : 'g' ,
            );

            ?>
              <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6">
                  <table class="table table-bordered table-hover table-striped">
                    <tr>
                      <th class="txt-centrado bg-secondary" colspan="2">Etiquetados LATAM</th>
                    </tr>

                    <? 
                    if (search_value($permisos_e, 'chi')==true) {
                      ?>
                      <!-- Etiquetado de Chile -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/chile.jpg') ?>" alt="bandera-chile" class="flag-1 mr-2">
                          Chile
                        </th>
                          <?
                            $chileLabel = new Etiquetado_chile($e_kcal['valor'], $sodium['valor'], $sugar['valor'], $total_lipids['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'ecu')==true) {
                      ?>
                      <!-- Etiquetado de Ecuador -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/ecuador.jpg') ?>" alt="bandera-ecuador" class="flag-1 mr-2">
                          Ecuador
                        </th>
                        <?
                            $ecuadorLabel = new Etiquetado_ecuador($lipids['valor'], $sugar['valor'], $sodium['valor'], $producto->tipo);
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
                        <label>Azúcar</label>
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'mex')==true) {
                      ?>
                      <!-- Etiquetado de México -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/mexico.jpg') ?>" alt="bandera-mexico" class="flag-1 mr-2">
                          México
                        </th>
                        <?
                            $MexLabel = new Etiquetado_mexico($e_kcal['valor'], $sugar['valor'], $total_lipids['valor'], $trans['valor'], $sodium['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'col')==true) {
                      ?>
                      <!-- Etiquetado de Colombia -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/colombia.jpg') ?>" alt="bandera-colombia" class="flag-1 mr-2">
                          Colombia
                        </th>
                        <?
                            $ColombiaLabel = new Etiquetado_colombia($sodium['valor'], $sugar['valor'], $total_lipids['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'uru')==true) {
                      ?>
                      <!-- Etiquetado de Uruguay -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/uruguay.jpg') ?>" alt="bandera-uruguay" class="flag-1 mr-2">
                          Uruguay
                        </th>
                        <?
                          $UruguayLabel = new Etiquetado_uruguay($e_kcal['valor'], $lipids['valor'], $total_lipids['valor'], $sodium['valor'], $sugar['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'per')==true) {
                      ?>
                      <!-- Etiquetado de Perú -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/peru.jpg') ?>" alt="bandera-peru" class="flag-1 mr-2">
                          Perú
                        </th>
                        <?
                            if (strtotime(date("Y-m-d")) >= strtotime("2021-10-27")){
                              $peruLabel = new Etiquetado_peru_2a_fase($sugar['valor'], $sodium['valor'], $total_lipids['valor'], $trans['valor'], $producto->tipo);
                            }
                            else{
                              $peruLabel = new Etiquetado_peru_1a_fase($sugar['valor'], $sodium['valor'], $total_lipids['valor'], $trans['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>
                  </table>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6">
                  <table class="table table-bordered table-hover table-striped">
                    <tr>
                      <th class="txt-centrado bg-secondary" colspan="2">Etiquetados Europa-Asia</th>
                    </tr>

                    <? 
                    if (search_value($permisos_e, 'run')==true) {
                      ?>
                      <!-- Etiquetado de Reino Unido -->
                      <?
                      foreach ($vnrs as $cve => $val) {
                        ?>
                        <tr>
                          <th>
                            <img src="<?= base_url('uploads/flags/uk.jpg') ?>" alt="bandera-uk" class="flag-1 mr-2">
                            Reino Unido<br>VNR - <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag"></th>
                            <?
                              $UkLabel = new Etiquetado_UK($sodium['valor']/1000, $sugar['valor'], $total_lipids['valor'], $lipids['valor'], $producto->tipo, $vnrs[$cve][2]);
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
                                  <?= number_format($e_kcal['valor'], 1) ?> kcal
                                </span>
                              </p>
                              <p class="label_UK_ptc_small"><?= number_format(($e_kcal['valor'] * 100)/2000, 1) ?>%</p>
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
                                  <?= number_format($lipids['valor'], 1) ?> g
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
                                  <?= number_format($total_lipids['valor'], 1) ?> g
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
                                  <?= number_format($sugar['valor'], 1) ?> g
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
                                  <?= number_format($sodium['valor'], 1) ?> g
                                </span>
                              </p>
                              <p class="label_UK_ptc_small"><?= number_format($UkLabel->getSodioPtc(), 1) ?>%</p>
                            </div>
                          </td>
                          <?
                          unset($UkLabel);
                          ?>
                        </tr>
                        <?
                      }
                      ?>
                      <!-- ./Etiquetado de Reino Unido -->
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'fra')==true) {
                      ?>
                      <!-- Etiquetado de Francia -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/francia.jpg') ?>" alt="bandera-francia" class="flag-1 mr-2">
                          Francia
                        </th>
                        <?
                          $NutriScoreLabel = new NutriScore($e_kcal['valor'], $sugar['valor'], $total_lipids['valor'], $lipids['valor'], $sodium['valor'], $fruit['valor'] + $vegetable['valor'], $fiber['valor'], $protein['valor'], $producto->id_categoria, $c_porcion['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'isr')==true) {
                      ?>
                      <!-- Etiquetado de Israel -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/israel.jpg') ?>" alt="bandera-israel" class="flag-1 mr-2">
                          Israel 
                        </th>
                        <?
                          $IsraelLabel = new Etiquetado_israel($sodium['valor'], $sugar['valor'], $total_lipids['valor'], $producto->tipo);
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
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'ita')==true) {
                      ?>
                      <!-- Etiquetado de Italia - VNR Europa -->
                      <?
                      foreach ($vnrs as $cve => $val) {
                        ?>
                        <tr>
                          <th>
                            <img src="<?= base_url('uploads/flags/italia.jpg') ?>" alt="bandera-italia" class="flag-1 mr-2">
                            Italia<br>VNR - <img src="<?= base_url('uploads/flags/'.$vnrs[$cve][1]) ?>" class="flag"></th>
                          <?
                              $ItaliaLabel = new Etiquetado_italia($e_kcal['valor'], $lipids['valor'], $total_lipids['valor'], $sugar['valor'], $sodium['valor'], $vnrs[$cve][2]);
                              ?>
                              <td>
                                <div class="battery-small">
                                  <div class="battery-title-1">
                            <p><strong>ENERGIA</strong></p>
                            <p><?= number_format($e_kcal['valor']*4.184) ?> kJ</p>
                            <p><?= number_format($e_kcal['valor']) ?> kcal</p>
                          </div>
                          <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getEnergia()) ?>% 100%">
                            <?= number_format($ItaliaLabel->getEnergia()) ?>%
                          </div>
                          <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </div>

                                <div class="battery-small">
                          <div class="battery-title-2">
                            <p><strong>GRASSI</strong></p>
                            <p><?= number_format($lipids['valor'] , 2) ?> g</p>
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
                            <p><?= number_format($total_lipids['valor'], 2) ?> g</p>
                          </div>
                          <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getGrasasSat()) ?>% 100%">
                            <?= number_format($ItaliaLabel->getGrasasSat()) ?>%
                          </div>
                          <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </div>

                                <div class="battery-small">
                          <div class="battery-title-2">
                            <p><strong>ZUCCHERI</strong></p>
                            <p><?= number_format($sugar['valor'], 2) ?> g</p>
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
                            <p><?= number_format($sodium['valor'], 2) ?> g</p>
                            <p>&nbsp;</p>
                          </div>
                          <div class="battery-body" style="background-size: <?= number_format($ItaliaLabel->getSodio()) ?>% 100%">
                            <?= number_format($ItaliaLabel->getSodio()) ?>%
                          </div>
                          <span class="battery-head">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                          </td>
                          <?
                          unset($ItaliaLabel);
                          ?>
                        </tr>
                        <?
                      }
                      ?>
                      <!-- ./Etiquetado de Italia - VNR Europa -->
                      <?
                    }
                    ?>

                    <? 
                    if (search_value($permisos_e, 'aus')==true) {
                      ?>
                      <!-- Etiquetado de Australia & Nueva Zelanda -->
                      <tr>
                        <th>
                          <img src="<?= base_url('uploads/flags/australia.jpg') ?>" alt="bandera-australia" class="flag-1 mr-2">
                          Australia & Nueva Zelanda</th>
                        <?
                          $AustraliaLabel = new Etiquetado_Australia_Nueva_Zelanda($e_kcal['valor'], $total_lipids['valor'], $sodium['valor'], $sugar['valor'], $calcium['valor'], $vegetable['valor'], $protein['valor'], $fiber['valor'], $producto->id_categoria, $producto->tipo);
                            ?>
                        <td class="txt-centrado">
                          <img src="<?= base_url("uploads/labels-australia/".$AustraliaLabel->getCategoria()."-estrellas.png") ?>" class="australia-img-small">
                          <div class="australia-value-small">
                            <p class="title">ENERGY</p>
                            <p class="val"><?= number_format($e_kcal['valor'] * 4.184, 1) ?> kJ</p>
                          </div>
                          <div class="australia-value-small">
                            <p class="title">SAT FAT</p>
                            <p class="val"><?= number_format($total_lipids['valor'], 1) ?> g</p>
                          </div>
                          <div class="australia-value-small">
                            <p class="title">SUGARS</p>
                            <p class="val"><?= number_format($sugar['valor'], 1) ?> g</p>
                          </div>
                          <div class="australia-value-small">
                            <p class="title">SODIUM</p>
                            <p class="val"><?= number_format($sodium['valor'], 1) ?> g</p>
                          </div>
                        </td>
                        <?
                        unset($AustraliaLabel);
                        ?>
                      </tr>
                      <!-- ./Etiquetado de Australia & Nueva Zelanda -->
                      <?
                    }
                    ?>
                    
                  </table>
                </div>

              </div>
            <?
          }
          else{
            echo "No hay información del producto";
          }
          ?>
          
          <div>
            
          </div>
        </div>

      </div>  

    </div>
    <div class="card-footer">
      <button class="btn btn-secondary btn-lg" onclick="history.back();">Regresar</button>
    </div>
</section>
<!-- /.content -->