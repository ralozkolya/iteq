$(function() {

	$('.thumb').click(function(){
		var url = $(this).attr('data-large');
		$('#zoom > img').attr('src', url);
	});

	if($('.thumb').length) {
		$('.thumb').get(0).click();
	}
	
	$('#zoom').zoom({magnify: 2});
});