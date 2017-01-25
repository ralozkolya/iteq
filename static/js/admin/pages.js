$(function(){

	$('#choose_page').change(function(){
		location.assign(url.baseUrl + 'admin/page/' + $(this).val());
	});
});