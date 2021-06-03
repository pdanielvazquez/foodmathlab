<script>
	$(function(){

		$('.btn-quitar').on('click', function(){
			var tipo 	= $(this).attr('data');
			var CHO 	= $('#CHO').val();
			var A 		= $('#A').val();
			var GT 		= $('#GT').val();
			var GSAT 	= $('#GSAT').val();
			var GTRANS 	= $('#GTRANS').val();
			var sodio 	= $('#sodio').val();
			var P 		= $('#P').val();
			var F 		= $('#F').val();
			var datos 	= 	"tipo=" + tipo + "&CHO=" + CHO + "&A=" + A + "&GT=" + GT + "&GSAT=" + GSAT + "&GTRANS=" + GTRANS + "&sodio=" + sodio + "&P=" + P + "&F=" + F;
			$.ajax({
				type: 'POST',
				url	: 'sellos_formulas',
				data: datos,
				success: function(data){
					var alert = '<div class="alert alert-primary alert-dismissible col-xs-12 col-md-6 col-lg-6"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-info"></i>Resultado</h5><strong> '+data+'</strong></div>';
					$('#response').html(alert);
				}
			})
		})
	})

</script>