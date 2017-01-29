function ajaxElim (url,dataPost, btn) {
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data: dataPost,
		beforeSend:function(){
			$('.miniLoader').addClass('active');
			btn.addClass('disabled').attr('disabled',true);
		},
		success:function(response)
		{
			$('.miniLoader').removeClass('active');
			$('.responseAjax').addClass('alert-'+response.type).addClass('active').children('p').html(response.msg);
			if (response.type == 'danger') {
				btn.removeClass('disabled').attr('disabled',false);
			}else if(response.type == 'success')
			{
				$('.to-elim').parent().parent().remove();
			}
		}
	});
}
function hideResponseAjax () {
	$('.responseAjax').removeClass('active');
	$('.responseAjax').removeClass('alert-success');
	$('.responseAjax').removeClass('alert-danger');

}
function clonar(target, name) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active').children('input').attr('name',name);
	toClone.after(cloned);

}
function removeCloned(esto) {
	esto.parent().remove();
}
jQuery(document).ready(function($) {
	var base = $('.baseUrl').val();
	//modal events
	$('.modal').on('hide.bs.modal', function(event) {
		$('.to-elim').removeClass('to-elim');
		$('.modal .btn').removeClass('disabled').attr('disabled', false);
		hideResponseAjax();
	});

	$('.btn-elim-cat').on('click', function(event) {
		var btn = $(this);
		btn.addClass('to-elim');
		$('.btn-modal-elim-cat').val(btn.val());
	});
	$('.btn-modal-elim-cat').on('click', function(event) {
		var url = base+'/administrador/mostrar-categorias/eliminar',
		btn = $(this),
		dataPost = {
			'cat_id' : btn.val()
		};
		ajaxElim(url, dataPost, btn);
	});
	$('.btn-elim-item').on('click', function(event) {
		var btn = $(this);
		btn.addClass('to-elim');
		$('.btn-modal-elim-item').val(btn.val());
	});
	$('.btn-modal-elim-item').on('click', function(event) {
		var url = base+'/administrador/ver-productos/eliminar',
		btn = $(this),
		dataPost = {
			'item_id' : btn.val()
		};
		ajaxElim(url, dataPost, btn);
	});
	$('.btn-elim-thing').on('click', function(event) {
		var btn = $(this);
		var name    = btn.data('what-to-elim');
		var url 	= btn.data('url');
		btn.addClass('to-elim');
		$('.what-to-elim').html(name);
		$('.btn-elim-thing-modal').val(btn.data('id')).attr('data-url',url);
	});
	$('.btn-elim-thing-modal').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			'img_id' : btn.val()
		};
		var url = $(this).data('url');
		ajaxElim(url, dataPost, btn);
	});
	$('.btn-clone').on('click', function(event) {
		var btn    = $(this);
		var target = btn.data('target');
		var name   = btn.data('name');
		clonar(target, name);
	});
	$(document).on('click','.dimiss-cloned', function(event) {
		removeCloned($(this));
	});
});