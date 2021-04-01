<script>
	$(function(){

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

	})
</script>