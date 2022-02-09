<? $input = new Input(); ?>
<style>
  .flag{
    width: 30px;
  }
  .nutrimentos td:nth-child(1n+2){
    text-align: center;
  }
  .card-title-chart{
    font-weight: bold;
    font-size: 1.5rem;
  }
  .material-icons{
    position: relative;
    top: 4px;
  }
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
              NRF 9.3 <span class="small">VNR</span> <img src="<?= base_url('uploads/flags/'.$vnrs[$vnr][1]) ?>" class="flag">
            </h3>
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
                  $nrf93 = new NRF93($valores, $vnrs[$vnr][2]);
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
          <canvas id="nrf93Chart"  data-nrf9="<?= implode(',', $nrf9) ?>" data-nrf3="<?= implode(',', $nrf3) ?>" data-labels="<?= implode(',', $label) ?>" data-title="NRF 9.3" data-color="<?= implode(',', $colors) ?>" height="400" class="chartCanvas"></canvas>

        </div>
      </div>
    </div>
    <!-- /.Linear -->
    <?
  }
  ?>


