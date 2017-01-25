$(function(){

	$('.clickable').click(function(){
		var url = $(this).attr('data-href');

		if(url)  {
			location.assign(url);
		}
	});

});