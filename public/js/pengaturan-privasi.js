	$(function () {
		$("#upload_link").on('click', function (e) {
			e.preventDefault();
			$("#upload:hidden").trigger('click');
		});
	});

	window.setTimeout(function () {
		$(".alert").fadeTo(500, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 2000);

	$(window).resize(function () {
		if ($(window).width() < 992) {
			$('.desa-col').removeClass('col');
			$('.desa-col').addClass('col-12');
			$('.box-size').css('width', '300px');
			$('.box-size').css('margin-bottom', '5px');
			$('#container_search').css('width', '100%');
			$('.box-search').css('padding-right', '0');
			$('.box-search').css('padding-left', '0');
		} else {
			$('.desa-col').removeClass('col-12');
			$('.desa-col').addClass('col');
			$('.box-size').css('width', '850px');
			$('.box-size').css('margin-bottom', '');
			$('#container_search').css('width', '');
			$('.box-search').css('padding-right', '15px');
			$('.box-search').css('padding-left', '15px');
		}
	});

	$(document).ready(function () {
		if ($(window).width() < 992) {
			$('.desa-col').removeClass('col');
			$('.desa-col').addClass('col-12');
			$('.box-size').css('width', '300px');
			$('.box-size').css('margin-bottom', '5px');
			$('#container_search').css('width', '100%');
			$('.box-search').css('padding-right', '0');
			$('.box-search').css('padding-left', '0');
		} else {
			$('.desa-col').removeClass('col-12');
			$('.desa-col').addClass('col');
			$('.box-size').css('width', '850px');
			$('.box-size').css('margin-bottom', '');
			$('#container_search').css('width', '');
			$('.box-search').css('padding-right', '15px');
			$('.box-search').css('padding-left', '15px');
		}
	});