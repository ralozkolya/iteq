$(function() {

	$('.delete').click(function(){
		return confirm(lang.areYouSure);
	});

	$('.navbar-toggle').click(function(){
		$('.nav-container').stop().slideToggle();
	});

	$('.nav-products').hover(function(){
		if($(window).innerWidth() >= 768) {
			$('.submenu', this).stop().slideDown();
		}
	}, function(){
		$('.submenu', this).stop().slideUp();
	});
});