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
              Registrar un grupo
            </h3>
          </div>
          <div class="card-body">
                <div class="form-group">
                  <label>Nombre del grupo</label>
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
            <i class="fas fa-plus-circle"></i>
            Registrar un grupo
          </h3>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover table-striped" >
            <thead style="width: 100%;">
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Grupo</th>
                <th>Tipo de alimento</th>
                <th>Descripción</th>
                <th>&nbsp;</th>
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
                      if ($grupo->tipo=='solido') 
                        echo 'Sólidos';
                      else
                        echo 'Líquidos';
                      ?>
                    </td>
                    <td><?= $grupo->descripcion ?></td>
                    <td><a href="<?= base_url('productos_grupos_quitar/'.encripta($grupo->id_grupo)) ?>" class="btn btn-warning btn-quitar-grupo" data="<?= $conta ?>">Quitar</a></td>
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