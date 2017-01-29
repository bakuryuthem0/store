function getRootUrl () {
  return $('.baseUrl').val();
}
function activeteStatus (inp,toHidden,toShow,toRemove,toAdd) {
	inp.prevAll(toHidden).addClass('hidden');
	inp.prevAll(toShow).removeClass('hidden');
	inp.parent().removeClass(toRemove);
	inp.parent().addClass(toAdd);
	inp.nextAll('.form-control-feedback').addClass('active');
}
function checkEmpty(inp) {
	if (inp.val() == "") {
		activeteStatus(inp,'.control-label','.label-control-danger','has-success','has-error');
		return 0;
	}else
	{
		activeteStatus(inp,'.control-label','.label-control-success','has-error','has-success');
		return 1;
	}
}
function addHtml (inp,toShow,msg) {
	inp.prevAll('.control-label').addClass('hidden');
	inp.prevAll(toShow).removeClass('hidden').children('p').html(msg)
}
function emptyMsg (inp) {
	var proceed = checkEmpty(inp);
	if (proceed == 0) {
		addHtml(inp,'.label-control-danger','El campo es obligatorio');
	}else
	{
		addHtml(inp,'.label-control-success','Valido');

	}
	return proceed;
}
function removeResponseAjax() {
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
			setTimeout(removeResponseAjax, 4000)
		}
		,error:function()
		{
			$('.miniLoader').removeClass('active');
			boton.removeClass('disabled').attr('disabled', false);
			setTimeout(removeResponseAjax, 4000)
		}
	});
}
function addValToElim (toAdd, esto) {
	esto.addClass('to-elim');
	$(toAdd).val(esto.val())
}
function closeModalElim (boton) {
	$('.to-elim').removeClass('to-elim');
	$(boton).removeClass('disabled').attr('disabled', false);
	removeResponseAjax();
}
function showAndHide (what,toShow,esto,toHide,x) {
	if(what == 'show'){
		$(toShow).removeClass('hidden');
		esto.addClass('to-show').addClass('hidden');
		$(toHide).addClass('hidden');
	}else
	{
		$('.to-show').removeClass('to-show').removeClass('hidden');
		
		$(toHide).addClass('hidden');
		$(toShow).removeClass('hidden');
		if (x = 1) {
			$('.department > option[value = ""]').attr('selected', 'selected');
			$('.department_assignment').parent().addClass('hidden');
			$('.optionResponse').remove();
		};
	}
}
function clonar(target, name_es, name_eng, input) {
	var toClone = $('.'+target);
	var cloned = toClone.clone();
	toClone.removeClass(target).addClass('active');
	toClone.children('div').children(input+'es').attr('name',name_es);
	if (toClone.children('div').children(input+'eng').length > 0) {
		toClone.children('div').children(input+'eng').attr('name',name_eng);
	}
	toClone.after(cloned);

}
function removeCloned(esto) {
	esto.parent().remove();
	if ($('.factura-item:not(.fac-to-clone)').length < 1) {
		$('.btn-process-fac').addClass('hidden');
	};
}
function insertIntoSelect (url, method, dataPost, thisOne, thatOne) {
	$.ajax({
		url: url,
		type: method,
		dataType: 'json',
		data: dataPost,
		beforeSend: function()
		{
			$(thisOne).addClass('disabled').attr('disabled', true);
			$(thatOne).addClass('disabled').attr('disabled', true);
			$(thatOne).next('.btnLoader').children('.btn').children('.miniLoader').addClass('active');
			$(thatOne).next('.btnLoader').children('.btn').children('.fa-close').addClass('hidden');

		},
		success:function(response)
		{
			$(thisOne).removeClass('disabled').attr('disabled', false);
			$(thatOne).removeClass('disabled').attr('disabled', false);
			$(thatOne).next('.btnLoader').children('.btn').children('.miniLoader').removeClass('active');
			if (response.type == 'danger') {
				$(thatOne).next('.btnLoader').children('.btn').children('.fa-close').removeClass('hidden');
			}else
			{
				$(thatOne).next('.btnLoader').children('.btn').children('.fa-check').removeClass('hidden');
				$('.optionResponse').remove();
				$.each(response.data, function(index, val) {
					 $(thatOne).append('<option value="'+val.id+'">'+val.description_es+'</option>');
				});
			}
		},
		error:function()
		{
			$(thisOne).removeClass('disabled').attr('disabled', false);
			$(thatOne).removeClass('disabled').attr('disabled', false);
			$(thatOne).next('.btnLoader').children('.btn').children('.miniLoader').removeClass('active');
			$(thatOne).next('.btnLoader').children('.btn').children('.fa-close').removeClass('hidden');
		}
	})	
}
function checkMenuCat(check, length, max_text, url, amount)
{
	if (amount > length) {
		$('.responseAjax').addClass('alert-danger').addClass('active').children('p').html('Maximo '+max_text+' en el menu');
		 $('html, body').animate({
            scrollTop: $(".responseAjax").offset().top
        }, 500);
		setTimeout(removeResponseAjax, 3000);
		check.attr('checked', false);

	}else
	{
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			data: {id: check.val()},
			beforeSend:function()
			{
				check.addClass('hidden').prev('.miniLoader').addClass('active');
			},
			success:function(response)
			{
				if (response.type == "danger") {
					$('.responseAjax').addClass('alert-danger').children('p').html(response.msg);
					$('html, body').animate({
			            scrollTop: $(".responseAjax").offset().top
			        }, 500);
				}
				if (response.status == 1) {
					check.attr('checked', true);	
				}else
				{
					check.attr('checked', false);
				}
				check.removeClass('hidden').prev('.miniLoader').removeClass('active');
				setTimeout(removeResponseAjax, 3000);
			},
			error:function()
			{
				$('.responseAjax').addClass('alert-danger').children('p').html('Error 500, intente de nuevo o contacte al administrador del sitio');
				$('html, body').animate({
			            scrollTop: $(".responseAjax").offset().top
			        }, 500);
				check.attr('checked', false).removeClass('hidden').prev('.miniLoader').removeClass('active');
				setTimeout(removeResponseAjax, 3000);
			}
		})
	}
}
jQuery(document).ready(function($) {
	var baseUrl = $('.baseUrl').val();
	$('.form-control').on('blur', function(event) {
		checkEmpty($(this));
	});
	$('.logMeIn').on('click', function(event) {
		var proceed = 1;
		if (checkEmpty($('.email')) == 0) {
			proceed = 0;
			
		};
		if (checkEmpty($('.password')) == 0) {
			proceed = 0;
		};

		if (proceed == 1) {
			removeResponseAjax();
			var boton = $(this);
			var dataPost = {
				'email'    : $('.email').val(),
				'password' : $('.password').val(),
			}
			$('.miniLoader').addClass('active');
			boton.addClass('disabled').prop('disabled',true);
			$.ajax({
				headers: {'csrftoken': $('input[name = _token]').val()},
				url: baseUrl+'/administrador/login/enviar',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(response){
					$('.miniLoader').removeClass('active');
					$('.responseAjax').children('p').html(response.msg);
					$('.responseAjax').addClass('alert-'+response.type).addClass('active')

					if (response.type == 'danger') {
						boton.removeClass('disabled').prop('disabled',false);
					}else
					{
						setTimeout(function() {
							window.location.reload();	
						},2000);
					}
				},
				error: function() {
					$('.responseAjax').children('p').html('Ups, ha habido un error.');
					$('.responseAjax').addClass('alert-danger').addClass('active')
					$('.miniLoader').removeClass('active');
					boton.removeClass('disabled').prop('disabled',false);
				}
			})
			
		};
	});
	$('.new-user-control').on('blur', function(event) {
		emptyMsg($(this));
	});
	$('.btn-new-user').on('click', function(event) {
		var proceed = 1;
		$('.new-user-control').each(function(index, el) {
			if (checkEmpty($(el)) == 0) {
				emptyMsg($(el));
				proceed = 0;
			};
		});
		if (proceed == 1) {
			$('.new-user-form').submit();
		};
	});
	$('.change-pass-control').on('blur', function(event) {
		emptyMsg($(this));
		if ($(this).hasClass('password_confirmation')) {
			if ($(this).val() != $('.password').val()) {
				activeteStatus($(this),'.control-label','.label-control-danger','has-success','has-error');
				addHtml($(this),'.label-control-danger','Las contraseñas no coinciden.');
			};
		};
	});
	$('.btn-change-pass').on('click', function(event) {
		$('.send-change-pass').val($(this).val());
	});
	

	$('.send-change-pass').on('click', function(event) {
		$('.listErrors').remove();
		var boton = $(this);
		var proceed = 1;
		$('.change-pass-control').each(function(index, el) {
			if (!checkEmpty($(el))) {
				proceed = 0;
			}
		});
		if ($('.password_confirmation').val() != $('.password').val()) {
			activeteStatus($('.password_confirmation'),'.control-label','.label-control-danger','has-success','has-error');
			addHtml($('.password_confirmation'),'.label-control-danger','Las contraseñas no coinciden.');
			proceed = 0;
		};
		if (proceed == 1) {
			var base = getRootUrl();
			$.ajax({
				url: base+'/administrador/cambiar-password',
				type: 'POST',
				dataType: 'json',
				data: {
					user_id : boton.val(),
					password: $('.password').val(),
					password_confirmation: $('.password_confirmation').val(),
				},
				beforeSend:function() {
					$('.miniLoader').addClass('active');
					boton.addClass('disabled').attr('disabled', true);
				},
				success:function (response) {
					$('.miniLoader').removeClass('active');
					$('.responseAjax').addClass('alert-'+response.type).addClass('active');
					if (response.type == 'danger') {
						boton.removeClass('disabled').attr('disabled', 'flase');
						$('.responseAjax').children('p').html('<ul class="listErrors"></ul>');
						for(var i = 0; i < response.data.length;i++){
							$('.listErrors').append('<li>'+response.data[i]+'</li>');
						}
					}else
					{
						$('.change-pass-control').val('');
						$('.responseAjax').children('p').html(response.msg);
					}

				}
			});
		};
	});
	/****************************************************************/
	/*																*/
	/*																*/
	/* 				   Categoria menu        						*/	
	/*																*/
	/*																*/
	/*																*/
	/****************************************************************/
	
	/****************************************************************/
	/*																*/
	/*																*/
	/* 							clonar       						*/	
	/*																*/
	/*																*/
	/*																*/
	/****************************************************************/
	$('.btn-clone').on('click', function(event) {
		var btn    		= $(this);
		var target 		= btn.data('target');
		var input   	= btn.data('input');
		var name_es		= btn.data('name-es');
		var name_eng	= btn.data('name-eng');
		clonar(target, name_es, name_eng, '.'+input);
	});
	$(document).on('click','.dimiss-cloned', function(event) {
		removeCloned($(this));
	});
	
	$('.btn-refresh').on('click', function(event) {
		var boton = $(this);
		var qty = $('.qty_'+boton.val());
		if (qty.val() > 0) {
			var dataPost = {
				rowid : boton.val(),
				qty   : qty.val()
			}
			var base = getRootUrl();
			$.ajax({
				url: base+'/administrador/factura/actualizar',
				type: 'GET',
				dataType: 'json',
				data: dataPost,
				beforeSend:function()
				{
					boton.prevAll('.miniLoader').addClass('active');
					boton.addClass('hidden');
				},
				success:function(response)
				{
					boton.prevAll('.miniLoader').removeClass('active');
					boton.removeClass('hidden');
					$('.responseAjaxSecond').addClass('alert-'+response.type).children('p').html(response.msg);
					$('.responseAjaxSecond').addClass('active');
					if (response.type == 'success') {
						$('.subtotal_'+boton.val()).html(response.sub);
					}
					$('.qty_side_'+boton.val()).html(qty.val());
					$('.qtys_'+boton.val()).val(qty.val());

					setTimeout(function() {
						$('.responseAjaxSecond').removeClass('alert-success');
						$('.responseAjaxSecond').removeClass('alert-danger');
						$('.responseAjaxSecond').removeClass('active');
					},5000)
				}
			})
			
			
		}else
		{
			$('.qty_'+boton.val()).val(1);
			alert('El valor minimo es 1, para eliminar presione el botón eliminar.');
		}
	});
	$('.currency').on('change', function(event) {
		var esto = $(this);
		if (esto.val() == 'USD') {
			$('.price-dollar').removeClass('hidden');
		}else
		{
			$('.price-dollar').addClass('hidden');
		}
	});
	$('.show-item-info').on('click', function(event) {
		var btn = $(this);
		$('.responseLi').remove();
		$.ajax({
			url: getRootUrl()+'/administrador/producto/cargar-detalles',
			type: 'GET',
			dataType: 'json',
			data: {id: btn.val()},
			beforeSend:function()
			{
				$('#showItemInfo .modal-footer .btn').addClass('disabled').attr('disabled', true);
			},
			success:function(response)
			{
				$('#showItemInfo .modal-footer .btn').removeClass('disabled').attr('disabled', false);
				console.log(response);
				$('.title.es').html(response.data.title_es);
				$('.title.eng').html(response.data.title_eng);
				$('.cat.es').html(response.data.categoria.description_es);
				$('.cat.eng').html(response.data.categoria.description_eng);
				$('.subcat.es').html(response.data.subcategoria.description_es);
				$('.subcat.eng').html(response.data.subcategoria.description_eng);
				$('.description.es').html(response.data.description_es);
				$('.description.eng').html(response.data.description_eng);
				if (response.store_type == 1) {
					$.each(response.data.tallas, function(index, val) {
						$('.size.es').append('<li class="responseLi">'+val.description_es+'</li>');
						$('.size.eng').append('<li class="responseLi">'+val.description_eng+'</li>');

					});
					$.each(response.data.colores, function(index, val) {
						$('.color.es').append('<li class="responseLi">'+val.description_es+'</li>');
						$('.color.eng').append('<li class="responseLi">'+val.description_eng+'</li>');

					});
					$.each(response.data.materiales, function(index, val) {
						$('.fabric.es').append('<li class="responseLi">'+val.description_es+'</li>');
						$('.fabric.eng').append('<li class="responseLi">'+val.description_eng+'</li>');
					});
				}
				$('#showItemInfo .loader').addClass('hidden');
				$('#showItemInfo .content-modal').removeClass('hidden');
			},
			error: function()
			{
				$('#showItemInfo responseAjax').addClass('active').addClass('alert-danger').children('p').html('Error 500, intente de nuevo.');
			}
		})
	});
	$('#showItemInfo').on('hide.bs.modal', function(event) {
		$('#showItemInfo .loader').removeClass('hidden');
		$('#showItemInfo .responseAjax').removeClass('active').removeClass('alert-success').removeClass('alert-danger');
		$('#showItemInfo .content-modal').addClass('hidden');
	});
	$('.details-change-lang').on('click', function(event) {
		var btn = $(this);
		$('#showItemInfo .'+btn.data('value')).addClass('hidden');
		$('#showItemInfo .'+btn.val()).removeClass('hidden');
	});
	$('.category').on('change', function(event) {
		var select = $(this);
		var url 	 = getRootUrl()+'/administrador/buscar-sub-categorias';
		var dataPost = {
			cat_id : select.val()
		} 
		insertIntoSelect (url, 'GET', dataPost, '.category', '.subCategory');
	});
	$('.pursache-details').on('click', function(event) {
		$('li.item-detail').remove();
		var fact = $(this).data('value');
		var store_type = $('.store_type').val();
		var total = 0;
		$.each(fact.compras, function(index, val) {
			$('.modal-items').append('<li class="item-detail">'+val.items.title_es+'</li>');
			$('.modal-qty').append('<li class="item-detail">'+val.qty+'</li>');
			$('.modal-price').append('<li class="item-detail">'+val.items.price+'</li>');
			$('.modal-subtotal').append('<li class="item-detail">'+(val.qty*val.items.price)+'</li>');
			total = total+(val.qty*val.items.price);
			if (val.tallas.length > 1) {
				$.each(val.tallas, function(index, val) {
					 $('.modal-size').append('<li class="item-detail">'+val.description_es+'</li>')
				});
			}else
			{
				$('.modal-size').append('<li class="item-detail">'+val.tallas.description_es+'</li>')
			}
			if (val.colores.length > 1) {
				$.each(val.colores, function(index, val) {
					 $('.modal-color').append('<li class="item-detail">'+val.description_es+'</li>')
				});
			}else
			{
				$('.modal-color').append('<li class="item-detail">'+val.colores.description_es+'</li>')
			}
			if (val.materiales.length > 1) {
				$.each(val.materiales, function(index, val) {
					$('.modal-fabric').append('<li class="item-detail">'+val.description_es+'</li>')
				});
			}else
			{
				$('.modal-fabric').append('<li class="item-detail">'+val.materiales.description_es+'</li>')
			}
		});
		$('.modal-total').html(total)
	});
	$('.payment-details').on('click', function(event) {
		var payment = $(this).data('value');
		if (payment.transaction_method == 'transferencia') {
			$('.method-transfer').removeClass('hidden');
			$('.user_bank-modal').html(payment.user_bank);
		}
		$('.transaction_method-modal').html(payment.transaction_method);
		$('.shop_bank-modal').html(payment.banks.name);
		$('.reference_number-modal').html(payment.reference_number);
		$('.transaction_date-modal').html(payment.transaction_date);
	});
	$('#paymentInfo').on('hide.bs.modal', function(event) {
		$('.method-transfer').addClass('hidden');
	});
	$('.btn-aprove').on('click', function(event) {
		addValToElim('.btn-modal-aprove-pursache', $(this));
	});
	//
	$('.btn-reject').on('click', function(event) {
		addValToElim('.btn-modal-reject-pursache', $(this));
	});
	$('.btn-modal-reject-pursache').on('click', function(event) {
		var boton = $(this);
		var base = getRootUrl();
		var url = base+'/administrador/rechazar-pago';
		var dataPost = {
			id : boton.val(),
			motivo : $('.modal-motivo').val()
		};
		elimAjax(url, dataPost, boton, 'POST');
	});
	$('.btn-modal-aprove-pursache').on('click', function(event) {
		var boton = $(this);
		var base = getRootUrl();
		var url = base+'/administrador/aprobar-pago';
		var dataPost = {
			id : boton.val(),
		};
		elimAjax(url, dataPost, boton, 'POST');
	});
	$('#aprovePursache').on('hide.bs.modal', function(event) {
		closeModalElim($('.btn-modal-aprove-pursache'));
	});
	$('#rejectPayment').on('hide.bs.modal', function(event) {
		$('.modal-motivo').val('');
		closeModalElim($('.btn-modal-reject-pursache'));
	});
	
	
	/****************************************************************/
	/*																*/
	/*																*/
	/* 							eliminar cosas 						*/	
	/*																*/
	/*																*/
	/*																*/
	/****************************************************************/
	
	$('.btn-elim-usuario').on('click', function(event) {
		addValToElim('.btn-elim-users', $(this));
	});
	$('.btn-elim-users').on('click', function(event) {
		var boton = $(this);
		var base = getRootUrl();
		var url = base+'/administrador/eliminar-usuario';
		var dataPost = {
			user_id : boton.val(),
		};
		elimAjax(url, dataPost, boton, 'POST');
	});
	$('.btn-elim-cat').on('click', function(event) {
		addValToElim('.btn-elim-cat-modal', $(this));
	});
	$('.btn-elim-cat-modal').on('click', function(event) {
		var boton = $(this);
		var base = getRootUrl();
		var url = base+'/administrador/categorias/eliminar';
		var dataPost = {
			cat_id : boton.val(),
		};
		elimAjax(url, dataPost, boton, 'POST');
	});
	$('.btn-elim-sub-cat').on('click', function(event) {
		addValToElim('.btn-elim-sub-cat-modal',$(this));
	});
	$('.btn-elim-sub-cat-modal').on('click', function(event) {
		var boton = $(this);
		var base = getRootUrl();
		var url = base+'/administrador/sub-categorias/eliminar';
		var dataPost = {
			cat_id : boton.val(),
		};
		elimAjax(url, dataPost, boton, 'POST');
	});
	$('.btn-elim-item').on('click', function(event) {
		var btn = $(this);
		btn.addClass('to-elim');
		$('.btn-modal-elim-item').val(btn.val());
	});
	$('.btn-modal-elim-item').on('click', function(event) {
		var url = getRootUrl()+'/administrador/ver-productos/eliminar',
		btn = $(this),
		dataPost = {
			'id' : btn.val()
		};
		elimAjax(url, dataPost, btn, 'POST');
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
			'id' : btn.val()
		};
		var url = btn.data('url');
		elimAjax(url, dataPost, btn, 'POST');
	});
	$('.btn-elim-brand').on('click', function(event) {
		var btn = $(this);
		btn.addClass('to-elim');
		$('.btn-modal-elim-marca').val(btn.val());
	});
	$('.btn-modal-elim-marca').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			'id' : btn.val()
		};
		var url = btn.data('url');
		elimAjax(url, dataPost, btn, 'POST');
	});
	//esconder modal
	$('#changePass').on('hide.bs.modal', function(event) {
		$('.send-change-pass').removeClass('disabled').attr('disabled', false);
		removeResponseAjax();
	});
	$('#elimUser').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-users');
	});
	$('#removeUser').on('hide.bs.modal	', function(event) {
		closeModalElim('.btn-remove-user');
	});
	$('#elimCat').on('hide.bs.modal	', function(event) {
		closeModalElim('.btn-elim-cat-modal');
	});
	$('#elimCon').on('hide.bs.modal	', function(event) {
		closeModalElim('.btn-elim-con-modal');
	});
	$('#elimItems').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-modal-elim-item')
	});
	$('#elimOffert').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim-thing-modal')
	});
});