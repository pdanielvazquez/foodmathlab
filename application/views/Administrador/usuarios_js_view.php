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
		        }
			})
		});

	})
</script>