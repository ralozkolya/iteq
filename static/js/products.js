$(function() {

	$('.category-link, .subcategory-link').click(function(){

		var slug = $(this).attr('data-slug');

		$('input[name="category"]').val(slug);

		$('#filter-form').submit();

		return false;
	});

	$('select[name="sort"]').change(function(){
		$('#filter-form').submit();
	});

	$('.subcategory-link.active').closest('.sidebar > li').addClass('active');

});