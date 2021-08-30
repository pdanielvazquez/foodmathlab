<script>

	$(function(){
	    $('.btn-close').on('click', function(){
	      $('#descripcion').modal('hide');
	    });

		$('#desplazamiento').scroll(function(){
	        $('#contenido').scrollLeft($('#desplazamiento').scrollLeft());
	    });
	    $('#contenido').scroll(function(){
	        $('#desplazamiento').scrollLeft($('#contenido').scrollLeft());
	    });	    

	  })

</script>