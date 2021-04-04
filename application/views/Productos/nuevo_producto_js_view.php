<script>
	$(function(){

		$('#um_energia').html('<option>kcal</option>');

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

	})

</script>