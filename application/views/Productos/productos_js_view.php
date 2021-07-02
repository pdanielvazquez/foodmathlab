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
			var identificador = $(this).attr('data');
			var nombre = $(this).attr('data-nombre');
			if (confirm('Esta por eliminar el grupo '+ nombre +', los productos de este grupo se guardar\u00E1n en el grupo "Trash" \u00BFDesea continuar?')) {
				return true;
			}
			else{
				return false;
			}
		});

		$('.btn-quitar-producto').on('click', function(){
			var identificador = $(this).attr('data');
			if (confirm('\u00BFDesea borrar el producto No. '+identificador+'?')) {
				return true;
			}
			else{
				return false;
			}
		});

	})

</script>