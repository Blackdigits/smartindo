(function ( $ ) {
	var $keyCode = 0;
	// keycode '17' is CAPSLOCK
	$(document).keydown(function(event) {
		if ($keyCode != event.which) {
			$keyCode = event.which;
		}
	});

	$.fn.RowValue = function( row ) {
        return $(this).children('tbody').children('tr').eq(row);
 	}

	$.fn.TableSelection = function( options, callback ) {
 		var settings = $.extend({
 			sort : true,
            status: 'single',
        }, options );
        return this.each(function(){
        	var $row_nums = [];
			$(this).children('tbody').children('tr').click(function() {
				if ($keyCode == 17 || settings.status === 'multiple') {
					$(this).toggleClass('selected');
					var index = parseInt($(this).index());
					var arrIndex = $row_nums.indexOf(index);
					if(arrIndex > - 1) {
						$row_nums.splice(arrIndex, 1);
					} else {
						$row_nums.push(index);
					}
				} else {
					$(this).addClass('selected').siblings().removeClass('selected');
					var index = parseInt($(this).index());
					$row_nums = [];
					$row_nums.push(index);
				}
				if(settings.sort)
					$row_nums = $row_nums.sort();
				// call back function
				if($.isFunction(callback)) {
					callback.call(this, {rows: $row_nums});
				} else {
					console.log('Require callback function.');
				}
			});
        });
 	}
}( jQuery ));		
