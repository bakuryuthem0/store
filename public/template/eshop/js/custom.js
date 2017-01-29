jQuery(document).ready(function($) {
	$('.register-input').on('click', function(event) {
		var $input = $(this);
		$input.parent('li').next('li').fadeOut('fast', function() {
			$(this).remove();
		});
	});
});