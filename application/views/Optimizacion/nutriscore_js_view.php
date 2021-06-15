<script>
	$(function(){

		$('.btn-optimizar').on('click', function(){
			var id = $(this).attr('data-id');
			var name = $(this).attr('data-name');
			$('#id_optimizar').val(id);
			$('#descripcionLabel span').html(name);
		})

		$('.btn-optimizar-aceptar').on('click', function(){
			var id = $('#id_optimizar').val();
			var metodoFibra = $('#producto_metodoF').val();
			var forzarLetra = $('#forzar_letra').val();
			var bloqueados = '';
			var maximos = '';
			var minimos = '';
			var parametros = '';
			
			$('select').each(function(){
				if ($(this).attr('name').split("_")[1]=="bloq" ) {
					bloqueados += "&" + $(this).attr('name') + "=" + $(this).val();
				}
			})

			$('input[type=number]').each(function(){
				if ($(this).attr('name').split("_")[1]=="max" ) {
					maximos += "&" + $(this).attr('name') + "=" + $(this).val();
				}
				if ($(this).attr('name').split("_")[1]=="min" ) {
					minimos += "&" + $(this).attr('name') + "=" + $(this).val();
				}
				if ($(this).attr('name').split("_")[0]=="param" ) {
					parametros += "&" + $(this).attr('name') + "=" + $(this).val();
				}
			})

			var datos = 'id=' + id + '&forzarLetra=' + forzarLetra + '&metodo=' + metodoFibra + bloqueados + maximos + minimos + parametros;

			$('#info-extra').modal('hide');
			$('#token_' + id).html("<img src=\""+ "<?= base_url('vendor/dist/img/loader64.gif') ?>" +"\" style=\"width:28px;\" >");
			$.ajax({
				type: 'POST',
				url	: 'crear_token',
				data: datos,
				success: function(response){
					$('#token_' + id).html(response);
					alert('Proceso completado');
					window.location = 'nutriscore';
				}
			})
		})

		$('.close-respuesta').on('click', function(){
			$('#respuesta').hide(300);
			$('#respuesta').attr('class', 'modal fade');
		})

		$('.btn-borrar-optimizacion').on('click', function(){
			var name = $(this).attr('data-name');
			var id = $(this).attr('data-id');
			if (confirm("\u00BFDesea eliminar la optimizaci\u00F3n de " + name + "?")) {
				alert("Continua");
			}
			else{
				alert("Acción cancelada");
			}
		})
	})

</script>