<script>
	$(function(){

		$(document).on('click', '.check-opcion', function(){
			var id_user = $(this).attr('data-user');
			var id_opcion = $(this).attr('data-option');
			var estado = 0;
			if( $(this).is(':checked') ) {
			    estado = 1;
			}
			var datos = 'id_usuario=' + id_user + '&id_opcion=' + id_opcion+ '&estado=' + estado;
			$.ajax({
				type:"POST",
		        url: "<?= base_url("permisos_usuarios") ?>",
		        data: datos,
		        success: function(data) {
		            alert('Permiso ' + data);
		            window.location = '<?= base_url('usuarios') ?>';
		        }
			})
		});

		$('.btn-quitar-usuario').on('click', function(){
			var no = $(this).attr('data');
			if (confirm("Esta a punto de eliminar al usuario no. " + no + "\u00BFDesea continuar?")) {
				return true;
			}
			else{
				return false;
			}
		});

		$('#password1').on('change', function(){
			var pass1 = $(this).val();
			if (pass1!='') {
				$(this).attr('required', 'required');
			}
			else{
				$(this).removeAttr('required');	
			}
		})

	})
</script>

<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      showConfirmButton: false,
      timer: 6000
    });

    var mensaje = <?= $mensaje ?>;
    if (mensaje==1){
      Toast.fire({
        icon: 'success',
        title: 'Usuario borrado',
      })  
    }
    if (mensaje==2){
      Toast.fire({
        icon: 'success',
        title: 'Datos editados',
      })  
    }
})
</script>