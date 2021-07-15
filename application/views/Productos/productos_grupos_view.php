<? $input = new Input(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-4">
      <form method="post" action="<?= base_url('productos_grupos_nuevo') ?>">
        <!-- Default box -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-plus-circle"></i>
              Registrar un laboratorio
            </h3>
          </div>
          <div class="card-body">
                <div class="form-group">
                  <label>Nombre del laboratorio</label>
                  <?= $input->Text(array(
                    'name'=>'grupo_nombre', 
                    'id'=>'grupo_nombre', 
                    'class'=>'form-control',
                    'placeholder'=>'Escriba aquí',  
                    'required'=>'required',
                  ), 'text') ?>
                </div>
                <div class="form-group">
                  <label>Tipo de alimentos</label>
                  <select class="form-control" name="grupo_tipo" id="grupo_tipo">
                    <option value="solido">Sólidos</option>
                    <option value="liquido">Líquidos</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Descripción del grupo</label>
                  <?= $input->Textarea(array(
                    'name'=>'grupo_descripcion', 
                    'id'=>'grupo_descripcion', 
                    'class'=>'form-control',
                    'placeholder'=>'Escriba aquí',  
                    'required'=>'required',
                    'rows'=>5
                  ), '') ?>
                </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-lg btn-secondary float-right" name="aceptar">Aceptar</button>
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </form>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-8">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-check-circle"></i>
            Laboratorios registrados
          </h3>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover table-striped" >
            <thead style="width: 100%;">
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Laboratorio</th>
                <th>Tipo de alimento</th>
                <th>Descripción</th>
                <th style="width:15%;">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?
              $conta = 0;
              if ($grupos!=false) {
                foreach ($grupos->result() as $grupo) {
                  ?>
                  <tr>
                    <td><?= ++$conta ?></td>
                    <td><?= $grupo->nombre ?></td>
                    <td>
                      <?
                      if ($grupo->nombre!="Trash") {
                        switch($grupo->tipo){
                          case "solido": echo "Sólidos"; break;
                          case "liquido": echo "Líquidos"; break;
                        }
                      }
                      else{
                        echo "-";
                      }
                      ?>
                    </td>
                    <td><?= $grupo->descripcion ?></td>
                    <td>
                      <?
                      if ($grupo->nombre!="Trash") {
                        ?>
                        <a href="<?= base_url('productos_grupos_editar/'.encripta($grupo->id_grupo).'/0') ?>" class="btn btn-success btn-editar-grupo" data="<?= $conta ?>" title="Editar el grupo"><i class="fas fa-edit" alt="Editar grupo"></i></a>

                        <a href="<?= base_url('productos_grupos_quitar/'.encripta($grupo->id_grupo)) ?>" class="btn btn-danger btn-quitar-grupo" data="<?= $conta ?>" data-nombre="<?= $grupo->nombre ?>" title="Eliminar grupo">
                          <i class="fas fa-trash"></i>
                        </a>
                        <?
                      }
                      else{
                        ?>
                        <button class="btn btn-success" disabled="disabled"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger " disabled="disabled"><i class="fas fa-trash"></i></button>
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
      </div>
    </div>
  </div>
</section>
<!-- /.content -->