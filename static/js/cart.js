$(function(){
	$('.amount').change(function(){
		if($(this).val() > 0) {
			location.assign(url.baseUrl + 'add_to_cart/' +
				$(this).attr('name') + '/' +
				$(this).val());
		}
	})
});