<script>
	$(function(){

		$('.valor-ingrediente').on('change', function(){
			var name = $(this).attr('name');
			var value = $(this).val();
			var unit_name = '#um_' + name;
			if (value!='') {
				$(this).css('background-color', '#8fff87');
				$(unit_name).attr('required', 'required');
			}
			else{
				$(this).css('background-color', '#fff');	
				$(unit_name).removeAttr('required');
			}
		});

		$('#sal').on('change', function(){
			var value = $(this).val();
			$('#sodio').val(Number.parseFloat(value * 387.58).toFixed(2));
		})

		$('#sodio').on('change', function(){
			var value = $(this).val();
			$('#sal').val(Number.parseFloat(value / 387.58).toFixed(2));
		})

	})

</script>