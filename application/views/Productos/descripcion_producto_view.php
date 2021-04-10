<? $input = new Input(); ?>

<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    <div class="modal-header bg-danger">
      <h5 class="modal-title" id="descripcionLabel"><?= $producto->nombre ?> <small style="position: relative; right: 0;">Ingredientes del producto</small></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" id="descripcionBody">
      <div class="row">
        <?
        if ($producto!=false) {
          foreach ($campos as $etiqueta=>$nombre) {
            $bg = '';
            if ($producto->$nombre>0) {
              $bg = 'background-color: #8fff87; ';
            }
            ?>
            <div class="col-xs-12 col-md-4 col-lg-2">
              <div class="form-group">
                <label><?= $etiqueta ?></label>
                <div class="input-group">
                  <?= $input->Text(array(
                    'name'=>$nombre, 
                    'id'=>$nombre, 
                    'class'=>'form-control',
                    'placeholder'=>'0',
                    'step'=>'0.01',
                    'style'=>'text-align:center; '.$bg,
                    'value'=> ($producto->$nombre>0) ? (float)$producto->$nombre : '0',
                  ), 'number') ?>
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fab fa-goodreads-g" style="font-size: 12px;"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <?
          }
        }
        else{
          ?>
          <p>-No hay información del producto-</p>
          <?
        }

        ?>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>