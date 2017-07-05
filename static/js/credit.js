$(function(){
	$('#choose_address').change(function(){
		var val = $(this).val();

		if(!isNaN(parseInt(val))) {
			$('input[name=address]').val(val);
			$('.submit-button').removeClass('disabled');
		}
	});

	$('#choose_address').change();
});
