<script>
	$(function(){

		$('#um_energia').html('<option>kcal</option>');

		$(document).on('click', '.btn-descripcion', function(){
			var id = $(this).attr('data-id');
			/*var datos = 'id=' + id;*/
			var datos = {
				'id' : id,
			}
			$.ajax({
				type: 'POST',
				url	: 'producto_descripcion',
				data: datos,
				success: function(data){
					$('#descripcion').html(data);
				}
			})
		});

		$('.btn-quitar-grupo').on('click', function(){
			var identificador = $(this).attr(data);
			if (!confirm('\u00BFDesea borrar el grupo No. '+identificador+'?')) {
				return false;
			}
		});

	})

</script>