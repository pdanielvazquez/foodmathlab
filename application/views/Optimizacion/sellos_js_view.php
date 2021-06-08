<script>
	$(function(){

		$('.btn-quitar').on('click', function(){
			var tipo 	= $(this).attr('data');
			var valores = $(this).attr('data-info').split(',');
			var CHO 	= valores[0];
			var A 		= valores[1];
			var GT 		= valores[2];
			var GSAT 	= valores[3];
			var GTRANS 	= valores[4];
			var sodio 	= valores[5];
			var P 		= valores[6];
			var F 		= valores[7];
			var datos 	= 	"tipo=" + tipo + "&CHO=" + CHO + "&A=" + A + "&GT=" + GT + "&GSAT=" + GSAT + "&GTRANS=" + GTRANS + "&sodio=" + sodio + "&P=" + P + "&F=" + F;
			$.ajax({
				type: 'POST',
				url	: 'nom051_formulas',
				data: datos,
				success: function(data){
					var alert = '<div class="alert alert-warning alert-dismissible col-xs-12 col-md-12 col-lg-12"><strong> '+data+'</strong></div>';
					$('#response').html(alert);
					$('#respuesta').show(300);
					$('#respuesta').attr('class', 'modal fade show');
				}
			})
		})

		$('.close-respuesta').on('click', function(){
			$('#respuesta').hide(300);
			$('#respuesta').attr('class', 'modal fade');
		})
	})

</script>