<script>

	$(function(){

		$('#nombre_lab').html($('.nav-link.active.btn-tab').html());

		$('.nav-link.btn-tab').on('click', function(){
			var nombre = $(this).html()
			$('#nombre_lab').html(nombre);
		})

	    $(document).on('click', '.btn-close', function(){
	      $('#descripcion').modal('hide');
	    });

		$('#desplazamiento').scroll(function(){
	        $('#contenido').scrollLeft($('#desplazamiento').scrollLeft());
	    });
	    $('#contenido').scroll(function(){
	        $('#desplazamiento').scrollLeft($('#contenido').scrollLeft());
	    });

	    $('#btn-scroll-right').on('click', function(){
	    	$('html, body').animate({
	    		/*scrollTop: $("#contenido").offset().top*/
	    		scrollLeft: $('#contenido').scrollLeft($('#contenido').scrollLeft()+50),
	    	}, 500);
	    });

	    $('#btn-scroll-left').on('click', function(){
	    	$('html, body').animate({
	    		/*scrollTop: $("#contenido").offset().top*/
	    		scrollLeft: $('#contenido').scrollLeft($('#contenido').scrollLeft()-50),
	    	}, 500);
	    });

	    /*Calculos para el desplazamiento del contenido*/
		/*$('#columnas').val($("#tabla tr:last td").length+1);
		$('#ancho').val($('#contenido').width());
		$('')

		$('.nav-link.btn-tab').on('click', function(){
			$('#columnas').val(parseInt($(this).children().html())+2);
		});*/



	});

</script>