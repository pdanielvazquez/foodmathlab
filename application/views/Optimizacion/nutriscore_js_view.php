<script>
	$(function(){

		$('.btn-optimizar').on('click', function(){
			var id = $(this).attr('data-id');
			var name = $(this).attr('data-name');
			$('#id_prod').val(id);
			$('#descripcionLabel span').html(name);
		})

		$('.btn-optimizar-aceptar').on('click', function(){
			var id = $('#id_prod').val();
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

			var datos = 'id_prod=' + id + '&forzarLetra=' + forzarLetra + '&metodo=' + metodoFibra + bloqueados + maximos + minimos + parametros;
			//alert(datos);

			$('#info-extra').modal('hide');
			$('#token_' + id).html("<img src=\""+ "<?= base_url('vendor/dist/img/loader64.gif') ?>" +"\" style=\"width:28px;\" >");
			$.ajax({
				type: 'POST',
				url	: 'crear_token',
				data: datos,
				success: function(response){
					alert(response);
					window.location = '<?= base_url('nutriscore/1') ?>';
				}
			})
		})

		$('.close-respuesta').on('click', function(){
			$('#respuesta').hide(300);
			$('#respuesta').attr('class', 'modal fade');
		})

		$('.btn-borrar-optimizacion').on('click', function(){
			var name = $(this).attr('data-name');
			if (confirm("\u00BFDesea eliminar la optimizaci\u00F3n de " + name + "?")) {
				return true;
			}
			else{
				return false;
			}
		})

		var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      timerProgressBar: true,
	      showConfirmButton: false,
	      timer: 6000
	    });

	    var editar = <?= $edicion ?>;
	    if (editar>0) {
		    var mensaje = '';
		    switch(editar){
		    	case 1: mensaje = "Optimización creada exitosamente";
		    		break;
		    	case 2: mensaje = "Optimización eliminada exitosamente";
		    		break;
		    }
		    Toast.fire({
		        icon: 'success',
		        title: mensaje,
		    })  
	    }
	})

</script>