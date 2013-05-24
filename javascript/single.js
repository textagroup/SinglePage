(function($) {
	$.entwine('ss.tree', function($){
			$('#pageBlock').draggable({ revert: "valid" });
			$('#blockTop, #blockLeft, #blockMiddle, #blockRight, #blockBottom').droppable({
				drop: function(e, ui) {
					var blockID = $(this).data("id");
					var pageID = $('#pageBlock').val();
					var pageText = $('#pageBlock').text();
					$(this).text(pageText);
					jQuery.ajax({
						'url': 'Single_Controller/singlePageUpdate',
						'method': 'post', 
						'data': {ajax: 1, 'blockID': blockID, 'pageID' : pageID },
						'success': function(response){
						},
						'error': function(response) {
							console.log('Error');
						}
					});
				}
			});

			$('#Pages').entwine({
				onchange: function(e) {
					var id = $('[name^=Pages]').val();
					var page = $("span.treedropdownfield-title").text();
					$('#pageBlock').text(page);
					$('#pageBlock').attr('value', id);
				}
			});
	});
}(jQuery));
