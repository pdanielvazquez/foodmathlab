<!-- Main content -->
<section class="content">

	<!-- Tabla de productos registrados -->
    <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-archive"></i> 
            Productos registrados
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Token</th>
                <th>Extras</th>
              </tr>
            </thead>
            <tbody>
              <?
                if ($productos) {
                  $conta = 0;
                  foreach ($productos->result() as $producto) {
                    ?>
                    <tr>
                      <td><?= ++$conta ?></td>
                      <td><?= $producto->nombre ?></td>
                      <td>-</td>
                      <td>
                      	<button type="button" class="btn btn-primary">Optimizar</button>
                      	<button type="button" class="btn btn-danger">Eliminar optimización</button>
                      </td>
                    </tr>
                    <?
                  }
                }
              ?>
            </tbody>
            <tfoot>
              <tr class="bg-secondary">
                <th>No.</th>
                <th>Nombre</th>
                <th>Token</th>
                <th>Extras</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->