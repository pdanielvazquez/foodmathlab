<? $input = new Input(); ?>
<?
  $permisos_e = ($permisos_etiquetados!=false)? $permisos_etiquetados->result(): false;
  $permisos_i = ($permisos_indices!=false)? $permisos_indices->result(): false;
?>
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

<div class="row">
  <?
  if ($producto!=false) {
    
    // if ($productos_nutriente!=false) {
    if (count($prods_nutrimentos)>0) {
      /*print_r($prods_nutrimentos);
      print_r($nutrientes_arr);*/
      array_multisort($nutrientes_arr, SORT_ASC, $prods_nutrimentos);

      // print_r($productos_nutriente->result());

      /*Graficando los nutriente del producto en comparacion a los otros productos*/
      $etiquetas = array();
      $colors = array();
      $nutrientes = array();
      foreach ($prods_nutrimentos as $index=>$value) {
        array_push($etiquetas, substr($value['nombre'], 0, 20));
        array_push($nutrientes, $value['nutriente']);
        if ($value['id_prod'] == $producto->id_prod) {
          array_push($colors, 1);
        }
        else{
          array_push($colors, 0);
        }
      }

      $nutriente_label = '';
      $unidad_label = '';
      switch ($nutriente) {
        case 'energia':
          $nutriente_label = 'Energía';
          $unidad_label = 'Calorias (kcal)';
          break;
        case 'lipidos':
          $nutriente_label = 'Grasas Totales';
          $unidad_label = 'Gramos (g)';
          break;
        case 'azucaresa':
          $nutriente_label = 'Azúcares';
          $unidad_label = 'Gramos (g)';
          break;
        case 'acidosgs':
          $nutriente_label = 'Grasas Saturadas';
          $unidad_label = 'Gramos (g)';
          break;
        case 'acidostrans':
          $nutriente_label = 'Grasas Trans';
          $unidad_label = 'Gramos (g)';
          break;
        case 'sodio':
          $nutriente_label = 'Sodio';
          $unidad_label = 'Miligramos (mg)';
          break;
      }

      ?>

      <!-- Radar -->
      <div class="col-12">
        <div class="card card-danger">
          <div class="card-header">
              <h3 class="card-title card-title-chart">
                <?= $nutriente_label ?>
              </h3>
          </div>
          <div class="card-body">
            <canvas id="canvaChart"  data-values="<?= implode(',', $nutrientes) ?>" data-labels="<?= implode(',', $etiquetas) ?>" data-color="<?= implode(',', $colors) ?>" data-unit="<?= $unidad_label ?>" data-title="<?= $nutriente_label ?>" height="500" class="chartCanvas"></canvas>
          </div>
        </div>
      </div>
      <!-- /.Radar -->
      <?
    }

  } 
  ?>
</div>


