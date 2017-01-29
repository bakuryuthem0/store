function getRootUrl () {
  return $('.baseUrl').val();
}
function clonar(target, name) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active');
	toClone.find('textarea').attr('name',name);
	toClone.after(cloned);
	return toClone;
}
function cloneComment (target) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active');
	toClone.after(cloned);
	return toClone;
}
function removeCloned(esto) {
	esto.parents('.to-clone').remove();
}
function hideResponseAjax () {
	$('.responseAjax').removeClass('alert-success');
	$('.responseAjax').removeClass('alert-danger');
	$('.responseAjax').removeClass('active');
}
function elimAjax (url, dataPost, boton, method) {
	$.ajax({
		url: url,
		type: method,
		dataType: 'json',
		data: dataPost,
		beforeSend:function() {
			$('.miniLoader').addClass('active');
			boton.addClass('disabled').attr('disabled', true);
		},
		success:function (response) {
			$('.miniLoader').removeClass('active');
			$('.responseAjax').addClass('alert-'+response.type).addClass('active');
			$('.responseAjax').children('p').html(response.msg);
			if (response.type == 'danger') {
				boton.removeClass('disabled').attr('disabled', false);
			}else
			{
				$('.to-elim').parent().parent().remove();
			}

		}
	});
}
function addFav (btn) {
	$.ajax({
		url: getRootUrl()+'/tienda/agregar-favorito',
		type: 'GET',
		dataType: 'json',
		data: {id: btn.data('value')},
		beforeSend: function()
		{
			btn.addClass('hidden').prev('.miniLoader').addClass('active');
		},
		success:function(response)
		{
			btn.removeClass('hidden').prev('.miniLoader').removeClass('active').parent().attr('title',response.msg).attr('data-original-title',response.msg);
			if (response.type == "success") {
				if (btn.hasClass('fa-heart')) {
					btn.removeClass('fa-heart').addClass('fa-heart-o');
				}else
				{
					btn.removeClass('fa-heart-o').addClass('fa-heart');
				}
			}
			btn.parent().tooltip('show');
			setTimeout(function(){
				btn.parent().tooltip('hide');
			}, 3000);
		},error: function()
		{
			btn.removeClass('hidden').prev('.miniLoader').removeClass('active').parent().attr('title',response.msg);
			btn.parent().tooltip('show');
			setTimeout(function(){
				btn.parent().tooltip('hide');
			}, 3000);
		}
	});
	
}
jQuery(document).ready(function($) {
	$('.btn-add-to-fav').on('click', function(event) {
		var btn = $(this);
		addFav(btn);
	});
	$('.btn-comment').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			comment: $('.comment-textarea').val(),
			item_id: btn.val()
		};
		$.ajax({
			url: getRootUrl()+'/tienda/comentario/enviar',
			type: 'GET',
			dataType: 'json',
			data: dataPost,
			beforeSend:function()
			{
				btn.addClass('disabled').attr('disabled', true).nextAll('.miniLoader').addClass('active');
				$('.comment-textarea').addClass('disabled').attr('disabled', true);
			},
			success:function(response)
			{
				btn.removeClass('disabled').attr('disabled', false).nextAll('.miniLoader').removeClass('active');
				$('.comment-textarea').removeClass('disabled').attr('disabled', false);
				$('.responseAjax').addClass('alert-'+response.type).addClass('active');
				if (response.type == 'success') {
					$('.comment-textarea').val('');
					var new_comment = cloneComment(btn.data('target'));
					$(new_comment.find('.avatar')).attr('src', response.avatar);
					$(new_comment.find('.username')).html(response.username);
					$(new_comment.find('.comment')).html(response.comment);
					$(new_comment.find('.created_at')).html(response.created_at);
					new_comment.removeClass('hidden');
					$('.responseAjax').children('p').html(response.msg)
				}else
				{
					$('.responseAjax').children('p').html(response.msg.comment);
				}

				setTimeout(hideResponseAjax, 4000)
			},
			error:function()
			{
				btn.removeClass('disabled').attr('disabled', false).nextAll('.miniLoader').removeClass('active');
				$('.comment-textarea').removeClass('disabled').attr('disabled', false);
			}
		});
	});
	
});