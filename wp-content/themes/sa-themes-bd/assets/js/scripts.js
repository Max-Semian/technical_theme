jQuery(document).ready(function($) {
	/* Header меню */
	if ($(window).width() > 1280) {
	    $('.header-menu ul li.menu-item-has-children').on('mouseenter', function() {
			$('.header-menu ul li.menu-item-has-children').addClass('menuclose');
			$(this).addClass('menuopen').removeClass('menuclose');
			$(this).find('ul.sub-menu').slideDown('fast');
			$('.header-menu ul li.menuclose').find('ul.sub-menu').slideUp('fast');
			$('.header-menu ul li.menuclose').removeClass('menuclose');
		});
		$('.header-menu ul li.menu-item-has-children').on('mouseleave', function() {
			var timeout;
			$('.header-menu ul li.menu-item-has-children').on('mouseenter', function() {
				clearTimeout(timeout);
			});
			timeout = setTimeout(function() {
				$('.header-menu ul li.menu-item-has-children').find('ul.sub-menu').slideUp('fast');
				$('.header-menu ul li.menu-item-has-children').removeClass('menuopen');
			}, 100);
		});
	} else {
		$('.header-menu-mobile .nav-menu ul:not(.sub-menu) li').each(function() {
			if ($(this).hasClass('menu-item-has-children')) {
				$(this).append('<div class="slide-mobile-menu"></div>');
			}
		});
		$('.slide-mobile-menu').click(function() {
			if ($(this).hasClass('open')) {
				$(this).removeClass('open');
				$(this).parent().find('.sub-menu').slideUp('fast');
				$(this).parent().find('img').css('filter','grayscale(0)');
			} else {
				$('.slide-mobile-menu').removeClass('open');
				$('.slide-mobile-menu').parent().find('.sub-menu').slideUp('fast');
				$('.header-menu-mobile ul li img').parent().find('img').css('filter','grayscale(0)');
				$(this).addClass('open');
				$(this).parent().find('.sub-menu').slideDown('fast');
				$(this).parent().find('img').css('filter','grayscale(1)');
			}
		});
	}
	/* Слайдер */
	$('.info-block-slider').slick({
		dots: true,
		infinite: true,
		speed: 500,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 3000
	});
	$('.main-container-right.mobile-bonus .main-bonus-container-row').slick({
		dots: false,
		speed: 500,
		slidesToShow: 2,
		slidesToScroll: 2,
		infinite: false,
		arrows: false,
		variableWidth: true,
		swipeToSlide: true
	});
	$('.slider-content-image .slider-content-images').slick({
		dots: true,
		infinite: true,
		speed: 500,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		autoplaySpeed: 3000,
		prevArrow: '<div class="prew-slider-image"><svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18.5" r="18" fill="#E7370A"/><path d="M20.41 13.91L15.83 18.5L20.41 23.09L19 24.5L13 18.5L19 12.5L20.41 13.91Z" fill="white"/></svg></div>',
		nextArrow: '<div class="next-slider-image"><svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18.5" r="18" transform="rotate(-180 18 18.5)" fill="#E7370A"/><path d="M14.59 23.09L19.17 18.5L14.59 13.91L16 12.5L22 18.5L16 24.5L14.59 23.09Z" fill="white"/></svg></div>',
	});
	$('.operator-v2-slider').slick({
		dots: false,
		speed: 500,
		slidesToShow: 2.5,
		slidesToScroll: 1,
		infinite: false,
		arrows: false,
		variableWidth: true,
		swipeToSlide: true
	});
	if ($(window).width() < 1025) {
		$('.operator-maket-v2 .operator-right-tabs-buttons').slick({
			dots: false,
			speed: 500,
			infinite: false,
			arrows: false,
			variableWidth: true,
			swipeToSlide: true
		});
	}
	/* Header меню бургер */
	$('.header-menu-burger').click(function(){
		if ($(this).hasClass('open')) {
			$(this).removeClass('open');
			//$('body, html').css('position','static');
			$('.header-menu-mobile').slideUp('fast');
		} else {
			$(this).addClass('open');
			//$('body, html').css('position','fixed');
			$('.header-menu-mobile').slideDown('fast');
			function mobileMenuHeightLi() {
				$('.header-menu-mobile .nav-menu ul:not(.sub-menu) li').each(function() {
					var height = $(this).height();
					$(this).find('.slide-mobile-menu').css('height', height);
				});
			} setTimeout(mobileMenuHeightLi, 1000);
		}
	});
	/* выставляем высоту относительно ширины в карточке */
	if ($(window).width() < 1025) {
		$('.main-block .cards-block .card-item').each(function() {
			var card_item_width = $(this).find('.card-item-image').width();
			$(this).find('.card-item-image').css('height',card_item_width+'px');
		});
		var operator_item_width = $('.info-operator-top .operator-top-image').width();
		$('.info-operator-top .operator-top-image').css('height',operator_item_width+'px');
	}
	/* Добавляем класс к заголовку в блоке подписки для мобильных устройств */
	if ($(window).width() < 1025) {
		$('.main-block .subscribe-block .subscribe-title').addClass('title');
	}
	
	// Авто расстановка заголовков в секции information-block
	var info_counter = 0;
	var first_title_info = $('.information-block .information-block-left').find('h2').first().text();
	$('.information-block .information-block-right .info-block-text-mobile').html(first_title_info);
	$('.information-block .information-block-left h2').each(function() {
		var title = $(this).text();
		$(this).attr('id','info-'+info_counter);
		$('.information-block .information-block-right').find('.info-block-lists').append('<a href="#info-'+info_counter+'" class="info-block-lists-item">'+title+'</a>');
		info_counter++;
	});
	
	// Авто расстанновка заголовков в блоке содержимого на странице оператора
	var operator_counter = 0;
	$('.operator-page-maket h2').each(function() {
		var title = $(this).text();
		$(this).attr('id','info-'+operator_counter);
		$('.operator-page-maket .right-info-block.operator-page-content').find('.info-block-lists').append('<a href="#info-'+operator_counter+'" class="info-block-lists-item">'+title+'</a>');
		operator_counter++;
	});
	
	/* Подсвечиваем пункт в блоке содержимого + скролл при нажатии на пункт */
	const section = $(".main-block .information-block h2");
    const nav = $(".main-block .information-block .info-block-lists");
	const section_operator = $(".operator-page-maket h2");
    const nav_operator = $(".operator-page-maket .right-info-block.operator-page-content .info-block-lists");
	var otstup = 100;
	if ($(window).width() < 1025) {
		otstup = 400;
	}
    $(window).on("scroll", () => {
        const position = $(this).scrollTop();
        section.each(function () {
            const top = $(this).offset().top - otstup,
                bottom = top + $(this).outerHeight();
            if (position >= top && position <= bottom) {
                nav.find('a').removeClass('active');
                var id_active = $(this).attr('id');
				if ($(window).width() < 1025) {
					var active_text = $(this).find('h2.title').text();
					$(this).parent().parent().find('.info-block-text-mobile').html(active_text);
				}
                nav.find('a[href="#'+id_active+'"]').addClass("active");
            }
        });
		section_operator.each(function () {
            const top = $(this).offset().top - otstup,
                bottom = top + $(this).outerHeight();
            if (position >= top && position <= bottom) {
                nav_operator.find('a').removeClass('active');
                var id_active_operator = $(this).attr('id');
				/*if ($(window).width() < 769) {
					var active_text = $(this).find('h2.title').text();
					$(this).parent().parent().find('.info-block-text-mobile').html(active_text);
				}*/
                nav_operator.find('a[href="#'+id_active_operator+'"]').addClass("active");
            }
        });
    });
    $('.info-block-lists').find("a").on("click", function (event) {
		event.preventDefault();
        const id = $(this).attr("href");
        $("html, body").animate({
            scrollTop: $(id).offset().top - otstup
        }, 487);
        return false;
    });
	/* Скрываем и показываем содержимое в информационном блоке на мобильном */
	if ($(window).width() < 1025) {
		$('.info-block-button-mobile').click(function() {
			if ($(this).hasClass('open')) {
				$(this).removeClass('open');
				$(this).parent().find('.info-block-text-mobile').slideDown('fast');
				$(this).parent().find('.right-info-block').slideUp('fast');
			} else {
				$(this).addClass('open');
				$(this).parent().find('.info-block-text-mobile').slideUp('fast');
				$(this).parent().find('.right-info-block').slideDown('fast');
			}
		});
		$('.right-info-block .info-block-lists-item').click(function() {
			$(this).parent().parent().parent().find('.info-block-button-mobile').removeClass('open');
			$(this).parent().parent().parent().find('.info-block-text-mobile').slideDown('fast');
			$(this).parent().parent().parent().find('.right-info-block').slideUp('fast');
		});
	}
	// Добавляем 0 к числу в начале
	function addLeadingZero(number) {
		return String(number).padStart(2, '0');
	}
	/* Определяем блок vypad-spisok */
	$('.vypad-spisok').each(function() {
		var vypad_spisok = 01;
		$(this).find('.spisok-toogle-item').each(function() {
			$(this).find('.spisok-toogle-head').prepend('<span class="toogle-number">'+addLeadingZero(vypad_spisok)+'</span>');
			$(this).find('.spisok-toogle-head').append('<div class="toogle-button"></div>');
			$(this).find('.spisok-toogle-text').css('display','none');
			vypad_spisok++;
		});
	});
	
	/* Скрыть раскрыть текст в блоке vypad-spisok */
	$('.vypad-spisok .toogle-button').click(function() {
		if ($(this).parent().parent().parent().hasClass('open')) {
			$(this).parent().parent().parent().removeClass('open');
			$(this).parent().parent().parent().find('.spisok-toogle-text').slideUp('fast');
		} else {
			$(this).parent().parent().parent().parent().parent().find('.spisok-toogle-item').removeClass('open');
			$(this).parent().parent().parent().parent().parent().find('.spisok-toogle-text').slideUp('fast');
			$(this).parent().parent().parent().addClass('open');
			$(this).parent().parent().parent().find('.spisok-toogle-text').slideDown('fast');
		}
	});
	
	/* Определяем блок text-inform */
	$('.toogle-spisok').each(function() {
		$(this).find('.toogle-spisok-item').each(function() {
			$(this).find('.toogle-spisok-item-head').append('<div class="toogle-spisok-item-button"></div>');
			$(this).addClass('open');
		});
	});
	
	/* Скрыть раскрыть текст в блоке toogle-spisok */
	$('.text-inform .toogle-spisok-item .toogle-spisok-item-head .toogle-spisok-item-button').click(function() {
		if ($(this).parent().parent().parent().hasClass('open')) {
			$(this).parent().parent().parent().removeClass('open');
			$(this).parent().parent().parent().find('.toogle-spisok-item-body').slideUp('fast');
		} else {
			$(this).parent().parent().parent().addClass('open');
			$(this).parent().parent().parent().find('.toogle-spisok-item-body').slideDown('fast');
		}
	});
	/* раскрываем и скрываем pay-info на странице оператора */
	$('.operator-texts .pay-system-table .pay-system-body-item').click(function() {
		var attr_id = $(this).attr('data-id');
		if ($(this).hasClass('open')) {
			$(this).removeClass('open');
			$(this).parent().parent().find('.pay-system-body-row.pay-info-row[data-id="'+attr_id+'"]').slideUp();
		} else {
			$(this).parent().parent().find('.pay-system-body-item').removeClass('open');
			$(this).parent().parent().find('.pay-system-body-row.pay-info-row').slideUp();
			$(this).addClass('open');
			$(this).parent().parent().find('.pay-system-body-row.pay-info-row[data-id="'+attr_id+'"]').slideDown();
		}
	});
	
	/* Подключаем fancybox для страницы рператора */
	Fancybox.bind('[data-fancybox="stats"]');
	Fancybox.bind('[data-fancybox="big-carousel"]');
	
	/* Работа вкладок на страние оператора v2 */
	$('.operator-maket-v2 .operator-right-tabs .operator-right-tabs-buttons .operator-right-tabs-button').click(function() {
		if ($(window).width() > 1024) {
			var kol_tabs = $(this).parent().children().length,
				this_id = $(this).attr('id'),
				sd = this_id.replace(/[^0-9]/gi, ''),
				number = parseInt(sd, 10);
			if (number == '1') {
				$(this).parent().parent().find('.operator-right-tabs-contents').css('border-radius','0 15px 15px 15px');
			} else if (number == kol_tabs) {
				$(this).parent().parent().find('.operator-right-tabs-contents').css('border-radius','15px 0 15px 15px');
			} else {
				$(this).parent().parent().find('.operator-right-tabs-contents').css('border-radius','15px');
			}
			$(this).parent().find('.operator-right-tabs-button').removeClass('active');
			$(this).addClass('active');
			$(this).parent().parent().find('.operator-right-tabs-content').removeClass('active');
			$(this).parent().parent().find('.operator-right-tabs-content[data-id="'+this_id+'"]').addClass('active');
		} else {
			var kol_tabs = $(this).parent().parent().parent().children().length,
				this_id = $(this).attr('id'),
				sd = this_id.replace(/[^0-9]/gi, ''),
				number = parseInt(sd, 10);
			$(this).parent().parent().parent().find('.operator-right-tabs-button').removeClass('active');
			$(this).addClass('active');
			$(this).parent().parent().parent().parent().parent().parent().find('.operator-right-tabs-content').removeClass('active');
			$(this).parent().parent().parent().parent().parent().parent().find('.operator-right-tabs-content[data-id="'+this_id+'"]').addClass('active');
		}
	});
	
	/* Переносим блок с кнопками на странице оператора для мобильного */
	if ($(window).width() < 1025) {
		$('.info-operator-top').after($('.info-operator-right-pk'));
	}
	
	/* Работаем с таблицей pay */
	$('.custom-pay-tab tbody tr').each(function() {
		var img = $(this).find('td').first().find('img');
		if (img.length == 0) {
			var text = $(this).find('td').first().text();
			$(this).find('td').first().html('<span>'+text+'</span>');
		}
	});
	
	/* Переформируем таблицу pay в мобильной версии */
	$('.custom-pay-tab').each(function() {
		if ($(window).width() < 1025) {
			if ($(this).find('thead').length) {
				var thead_pur = 1;
			} else {
				var thead_pur = 0;
			}
			if (thead_pur == 1) {
				var arr_head = new Array(),
				i = 0;
				$(this).find('thead tr th').each(function() {
					if (i != 0) {
						arr_head[i - 1] = $(this).html();
					}
					i++;
				});
			}
			var arr_first_td = new Array();
			i = 0;
			$(this).find('tbody tr').each(function() {
				arr_first_td[i] = $(this).find('td').first().html();
				i++;
			});
			$(this).after('<div class="custom-pay-tab-mob"><div class="custom-pay-tab-mob-burttons"></div><div class="custom-pay-tab-mob-contents"></div></div>');
			i = 0;
			var len = arr_first_td.length;
			for (i = 0; i < len; i = i + 1) {
				$(this).next('.custom-pay-tab-mob').find('.custom-pay-tab-mob-burttons').append('<div class="custom-pay-button-mob" data-id="'+i+'">'+arr_first_td[i]+'</div>');
			}
			var arr_body = new Array();
			i = 0;
			$(this).find('tbody tr').each(function() {
				arr_body[i] = new Array();
				var c = 0;
				$(this).find('td').each(function() {
					if (c != 0) {
						arr_body[i][c - 1] = $(this).html();
					}
					c++;
				});
				i++;
			});
			var c = 0;
			i = 0;
			len = arr_body.length;
			for (i = 0; i < len; i = i + 1) {
				$(this).next('.custom-pay-tab-mob').find('.custom-pay-tab-mob-contents').append('<div class="custom-pay-tab-mob-content" data-id="'+i+'"></div>');
				c = 0;
				var len_c = arr_body[i].length;
				for (c = 0; c < len_c; c = c + 1) {
					if (thead_pur == 1) {
						$(this).next('.custom-pay-tab-mob').find('.custom-pay-tab-mob-content[data-id="'+i+'"]').append('<div class="custom-pay-tab-mob-content-body"><div>'+arr_head[c]+'</div><div>'+arr_body[i][c]+'</div></div>');
					} else {
						$(this).next('.custom-pay-tab-mob').find('.custom-pay-tab-mob-content[data-id="'+i+'"]').append('<div class="custom-pay-tab-mob-content-body"><div>'+arr_body[i][c]+'</div></div>');
					}
				}
			}
		} else {
			if ($(this).find('thead').length) {
			} else {
				$(this).find('tbody tr').first().css('border-top', 'none');
			}
		}
	});
	$('.custom-pay-button-mob').click(function() {
		var this_id = $(this).attr('data-id');
		if ($(this).hasClass('open')) {
			$(this).removeClass('open');
			$(this).parent().parent().find('.custom-pay-tab-mob-content[data-id="'+this_id+'"]').slideUp('fast');
		} else {
			$(this).parent().parent().find('.custom-pay-button-mob').removeClass('open');
			$(this).addClass('open');
			$(this).parent().parent().find('.custom-pay-tab-mob-content').slideUp('fast');
			$(this).parent().parent().find('.custom-pay-tab-mob-content[data-id="'+this_id+'"]').slideDown('fast');
		}
	});
	
	// Подставляем значения ширины и высоты, если они имеются в блоке изображения в gutenberg
	jQuery(document).ready(function($) {
		function sa_edit_block_image_gutenberg_size() {
		$('.wp-block-image').each(function() {
			var width = $(this).attr('data-width'),
				height = $(this).attr('data-height');
			if (width) {
				$(this).find('img').attr('style', function(i,s) { return (s || '') + 'width: '+width+'px !important;' });
			}
			if (height) {
				$(this).find('img').attr('style', function(i,s) { return (s || '') + 'height: '+height+'px !important;' });
			}
			if (width && height) {
				$(this).find('img').attr('style', function(i,s) { return (s || '') + 'object-fit: unset;' });
			}
		});
		console.log('test');
		} setTimeout(sa_edit_block_image_gutenberg_size, 1000);
	});
	
	// Копирование промокода
	$('.card-item-buttons-promocode, .info-operator-right-buttons, .info-operator-buttons-copy').click(function(){
		var textToCopy = $(this).find('span.promocode').text();
		var $temp = $("<textarea>");
		$('body').append($temp);
		$temp.val(textToCopy).select();
		document.execCommand('copy');
		$temp.remove();
		$(this).addClass('copy-true');
		setTimeout(() => $('.copy-true').removeClass('copy-true'), 2000);
	});
});