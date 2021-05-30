  <!-- Main content -->
<section class="content">

    <div class="row">

      <?
      if ($menu!=false) {
         foreach ($menu->result() as $opcion) {
           ?>
            <div class="col-xs-12 col-md-4 col-lg-4">
              <div class="small-box bg-danger">
                    <div class="inner">
                      <h3><?= $opcion->opcion ?></h3>
                      <p><?= $opcion->descripcion ?></p>
                    </div>
                    <div class="icon">
                      <i class="<?= $opcion->icono ?>"></i>
                    </div>
                    <a href="<?= $opcion->opcion ?>" class="small-box-footer">
                      Ir a <?= $opcion->opcion ?> <i class="fas fa-arrow-circle-right"></i>
                    </a>
              </div>
            </div>
           <?
         }
       } 
      ?>

    </div>

</section>
<!-- /.content -->