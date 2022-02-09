<? $input = new Input(); ?>
</style>
<link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/foodmathlab_charts.css">

  <?
  if ($producto!=false) {
  ?>
    <!-- Linear -->
    <div class="col-12">
      <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title card-title-chart">
              <?= $titulo ?>
            </h3>
        </div>
        <div class="card-body">

          <?

          switch ($tipo_chart) {
            case 'sain':
              
              /*Indice SAIN-LIIM*/
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
              <canvas id="saimlimChart"  data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-title="SAIN-LIM" data-color="<?= implode(',', $colors) ?>" height="400" class="chartCanvas"></canvas>
              <?
            break;

            case 'sens':
              
              /*Indice SENS*/

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
              <canvas id="sensChart" data-x="<?= implode(',', $dataX) ?>" data-y="<?= implode(',', $dataY) ?>" data-labels="<?= implode(',', $labels) ?>" data-title="SENS" data-color="<?= implode(',', $colors) ?>" height="390" class="chartCanvas"></canvas>
              <?
              break;

            case 'ff':
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
                <canvas id="ffChart"  data-values="<?= implode(',', $ffs_values) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="FF" data-title="Fullness Factor" height="400" class="chartCanvas"></canvas>
                <?
                break;

            case 'mes':
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
                <canvas id="qualityChart"  data-values="<?= implode(',', $mes_values) ?>" data-labels="<?= implode(',', $labels) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="Media Estandarizada" data-title="Calidad de los Alimentos" height="400" class="chartCanvas"></canvas>
                <?
                break;
          }

          ?>

        </div>
      </div>
    </div>
    <!-- /.Linear -->
    <?
  }
  ?>


