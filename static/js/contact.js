$(function(){

	$('.contact-form').submit(function(){

		$.post($(this).attr('action'), $(this).serialize());

		$('.submit-button').removeClass('btn-warning');
		$('.submit-button').addClass('btn-success');
		$('.submit-button').attr('disabled', 'disabled');
		$('.submit-button').val(lang.sent+'!');

		return false;
	});
});