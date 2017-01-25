$(function(){
	$('#choose_address').change(function(){
		var val = $(this).val();

		if(!isNaN(parseInt(val))) {
			$('.submit-order').attr('href', url.localeUrl + '/order/' + val).removeClass('disabled');

		}
	});

	$('#choose_address').change();
});