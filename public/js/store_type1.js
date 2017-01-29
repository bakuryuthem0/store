jQuery(document).ready(function($) {
	$('.btn-filtralo').on('click', function(event) {
		var url = getRootUrl();
		var btn = $(this);
		$(this).addClass('disabled').attr('disabled',true);
		var proceed = 0;
		if ($('.sort_by').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="sort_by" value="'+$('.sort_by').val()+'">');
		}
		if ($('.sort_type').val()) {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="sort_type" value="'+$('.sort_type').val()+'">');
		}
		if ($('.filter-size').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="filter-size" value="'+$('.filter-size').val()+'">');
		};
		if ($('.filter-color').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="filter-color" value="'+$('.filter-color').val()+'">');
		};
		if ($('.filter-fabric').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="filter-fabric" value="'+$('.filter-fabric').val()+'">');
		};
	
		if ($('.min').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="min" value="'+$('.min').val()+'">');
		};
		if ($('.max').val() != "") {
			proceed = 1;
			$('.form-filter').append('<input type="hidden" name="max" value="'+$('.max').val()+'">');
		};
		if (proceed == 1) {
			$('.form-filter').submit();
			
		}else
		{
			btn.removeClass('disabled').attr('disabled',false);
		}
	});
});

