$(function() {

	$('.sortable-table > tbody').sortable({
		stop: function(event, ui) {

			var startPriority,
				result = Object.create(null),
				children = $(event.target).children();

			children.each(function(index) {
				
				element = $(this);

				if(!startPriority) startPriority = element.attr('data-priority');

				element.attr('data-priority', +startPriority + index);

				result[element.attr('data-id')] = element.attr('data-priority');
			});

			$.post(url.baseUrl + 'admin/update_priority', result);
		}
	});
});
