	
	jQuery(function() {
;

		// show a simple loading indicator
		/*var loader = jQuery('<div id="loader"><img src="images/loading.gif" alt="loading..."></div>')
			.css({
				position: "relative",
				top: "1em",
				left: "25em",
				display: "inline"
			});
			//.appendTo("body")
			//.hide();
			*/
		jQuery().ajaxStart(function() {
			loader.show();
		}).ajaxStop(function() {
			loader.hide();
		}).ajaxError(function(a, b, e) {
			throw e;
		});

		var v = jQuery("#swiss").validate({
			submitHandler: function(form) {
				jQuery(form).ajaxSubmit({
					target: "#swiss"
				});
			}
		});
		jQuery(document).on('click','#addphone',function(){
		var $tr=jQuery('.fields>div.field:last-child').last();
		console.log($tr);
		var $clone = $tr.clone();
		$clone.find('input[type="text"],input[type="hidden"]').val('');
		jQuery('.fields').append($clone);
		})	
	});
