jQuery(document).ready(function($) {
	
	// Кешируем размеры окна для оптимизации производительности
	var windowWidth = $(window).width();
	var isDesktop = windowWidth > 1024;
	var isMobile = windowWidth < 1025;
	
	// Обновляем при изменении размера окна
	$(window).on('resize', function() {
		windowWidth = $(window).width();
		isDesktop = windowWidth > 1024;
		isMobile = windowWidth < 1025;
	});
	
	/* Fix for menu links without href for SEO crawlability */
	$('a[href="#"][role="button"]').on('click keydown', function(e) {
		// Prevent default behavior for anchor links
		if (e.type === 'click' || e.which === 13 || e.which === 32) {
			e.preventDefault();
			
			// Toggle submenu if this is a parent menu item
			var $parent = $(this).closest('li.menu-item-has-children');
			if ($parent.length) {
				var $submenu = $parent.find('.sub-menu').first();
				var isExpanded = $(this).attr('aria-expanded') === 'true';
				
				// Update ARIA state
				$(this).attr('aria-expanded', !isExpanded);
				
				// Toggle submenu visibility
				if (isExpanded) {
					$submenu.slideUp('fast');
				} else {
					// Close other submenus first
					$parent.siblings('.menu-item-has-children').find('.sub-menu').slideUp('fast');
					$parent.siblings('.menu-item-has-children').find('a[role="button"]').attr('aria-expanded', 'false');
					$submenu.slideDown('fast');
				}
			}
		}
	});
	
	/* Header меню */
		
	if (isDesktop && windowWidth > 1280) {
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
				$(this).append('<div class="slide-mobile-menu" tabindex="0" role="button" aria-label="サブメニューを開く"></div>');
			}
		});
		$('.slide-mobile-menu').click(function() {
			if ($(this).hasClass('open')) {
				$(this).removeClass('open');
				$(this).attr('aria-label', 'サブメニューを開く');
				$(this).parent().find('.sub-menu').slideUp('fast');
				$(this).parent().find('img').css('filter','grayscale(0)');
			} else {
				$('.slide-mobile-menu').removeClass('open');
				$('.slide-mobile-menu').attr('aria-label', 'サブメニューを開く');
				$('.slide-mobile-menu').parent().find('.sub-menu').slideUp('fast');
				$('.header-menu-mobile ul li img').parent().find('img').css('filter','grayscale(0)');
				$(this).addClass('open');
				$(this).attr('aria-label', 'サブメニューを閉じる');
				$(this).parent().find('.sub-menu').slideDown('fast');
				$(this).parent().find('img').css('filter','grayscale(1)');
			}
		});
		
		/* Поддержка клавиатуры для мобильного меню */
		$('.slide-mobile-menu').keydown(function(e){
			if (e.which === 13 || e.which === 32) { // Enter или Space
				e.preventDefault();
				$(this).click();
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
	if (isMobile) {
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
			$('.header-menu-mobile').slideDown('fast', function() {
				function mobileMenuHeightLi() {
					var heights = [];
					// Сначала читаем все высоты
					$('.header-menu-mobile .nav-menu ul:not(.sub-menu) li').each(function() {
						heights.push($(this).height());
					});
					// Затем применяем их
					$('.header-menu-mobile .nav-menu ul:not(.sub-menu) li').each(function(i) {
						$(this).find('.slide-mobile-menu').css('height', heights[i]);
					});
				}
				mobileMenuHeightLi();
			});
		}
	});
	
	/* Header меню бургер - поддержка клавиатуры */
	$('.header-menu-burger').keydown(function(e){
		if (e.which === 13 || e.which === 32) { // Enter или Space
			e.preventDefault();
			$(this).click();
		}
	});
	/* выставляем высоту относительно ширины в карточке */
	if (isMobile) {
		// Сначала читаем все ширины
		var cardImageWidths = [];
		$('.main-block .cards-block .card-item').each(function() {
			cardImageWidths.push($(this).find('.card-item-image').width());
		});
		// Затем применяем высоты
		$('.main-block .cards-block .card-item').each(function(i) {
			$(this).find('.card-item-image').css('height', cardImageWidths[i] + 'px');
		});

		var operator_item_width = $('.info-operator-top .operator-top-image').width();
		$('.info-operator-top .operator-top-image').css('height', operator_item_width + 'px');
	}
	/* Добавляем класс к заголовку в блоке подписки для мобильных устройств */
	if (isMobile) {
		$('.main-block .subscribe-block .subscribe-title').addClass('title');
	}
	
	// Авто расстановка заголовков в секции information-block
	const section = $(".information-block-maket .left-info-block .info-block-item");
    const nav = $(".information-block-maket .right-info-block .info-block-lists");
	const section_operator = $(".operator-page-maket h2");
    const nav_operator = $(".operator-page-maket .right-info-block.operator-page-content .info-block-lists");
	var otstup = 100;
	
	let sectionData = [];
    let sectionOperatorData = [];

	function calculateSectionData() {
		otstup = isMobile ? 400 : 100;
        sectionData = [];
        section.each(function() {
            const el = $(this);
            const top = el.offset().top - otstup;
            const bottom = top + el.outerHeight();
            const id = el.attr('id');
            const activeText = el.find('h2.title').text();
            sectionData.push({ top, bottom, id, activeText, el });
        });

        sectionOperatorData = [];
        section_operator.each(function() {
			const el = $(this);
            const top = el.offset().top - otstup;
            const bottom = top + el.outerHeight();
            const id = el.attr('id');
            sectionOperatorData.push({ top, bottom, id });
        });
	}

	// Debounce function
	function debounce(func, wait) {
		let timeout;
		return function(...args) {
			const context = this;
			clearTimeout(timeout);
			timeout = setTimeout(() => func.apply(context, args), wait);
		};
	}

	// Recalculate on resize
    $(window).on('resize', debounce(calculateSectionData, 250));
	
	// Initial calculation
	calculateSectionData();


    function handleScroll() {
        const position = $(window).scrollTop();

        sectionData.forEach(function (data) {
            if (position >= data.top && position <= data.bottom) {
                nav.find('a').removeClass('active');
                if (isMobile) {
					data.el.parent().parent().find('.info-block-text-mobile').html(data.activeText);
				}
                nav.find('a[href="#'+data.id+'"]').addClass("active");
            }
        });

		sectionOperatorData.forEach(function (data) {
            if (position >= data.top && position <= data.bottom) {
                nav_operator.find('a').removeClass('active');
                nav_operator.find('a[href="#'+data.id+'"]').addClass("active");
            }
        });
    }

    let scrollTimeout;
    $(window).on("scroll", () => {
        clearTimeout(scrollTimeout);
        // Debounce scroll handler to prevent excessive reflows
        scrollTimeout = setTimeout(handleScroll, 10); 
    });

    $('.info-block-lists').find("a").on("click", function (event) {
		event.preventDefault();
        const id = $(this).attr("href");
        const top = $(id).offset().top - otstup;
        $('body,html').animate({
            scrollTop: top
        }, 1000);
    });
	/* Скрываем и показываем содержимое в информационном блоке на мобильном */
	if (isMobile) {
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
		var vypad_spisok = 1;
		$(this).find('.spisok-toogle-item').each(function() {
			$(this).find('.spisok-toogle-head').prepend('<span class="toogle-number">'+addLeadingZero(vypad_spisok)+'</span>');
			$(this).find('.spisok-toogle-head').append('<div class="toogle-button" tabindex="0" role="button" aria-label="詳細を表示" aria-expanded="false"></div>');
			$(this).find('.spisok-toogle-text').css('display','none');
			vypad_spisok++;
		});
	});
	
	/* Скрыть раскрыть текст в блоке vypad-spisok */
	$('.vypad-spisok .toogle-button').click(function() {
		if ($(this).parent().parent().parent().hasClass('open')) {
			$(this).parent().parent().parent().removeClass('open');
			$(this).parent().parent().parent().find('.spisok-toogle-text').slideUp('fast');
			$(this).attr('aria-expanded', 'false').attr('aria-label', '詳細を表示');
		} else {
			$(this).parent().parent().parent().parent().parent().find('.spisok-toogle-item').removeClass('open');
			$(this).parent().parent().parent().parent().parent().find('.spisok-toogle-text').slideUp('fast');
			$(this).parent().parent().parent().parent().parent().find('.toogle-button').attr('aria-expanded', 'false').attr('aria-label', '詳細を表示');
			$(this).parent().parent().parent().addClass('open');
			$(this).parent().parent().parent().find('.spisok-toogle-text').slideDown('fast');
			$(this).attr('aria-expanded', 'true').attr('aria-label', '詳細を隠す');
		}
	});
	
	/* Поддержка клавиатуры для vypad-spisok */
	$('.vypad-spisok .toogle-button').keydown(function(e){
		if (e.which === 13 || e.which === 32) { // Enter или Space
			e.preventDefault();
			$(this).click();
		}
	});
	
	/* Определяем блок text-inform */
	$('.toogle-spisok').each(function() {
		$(this).find('.toogle-spisok-item').each(function() {
			$(this).find('.toogle-spisok-item-head').append('<div class="toogle-spisok-item-button" tabindex="0" role="button" aria-label="詳細を隠す" aria-expanded="true"></div>');
			$(this).addClass('open');
		});
	});
	
	/* Скрыть раскрыть текст в блоке toogle-spisok */
	$('.text-inform .toogle-spisok-item .toogle-spisok-item-head .toogle-spisok-item-button').click(function() {
		if ($(this).parent().parent().parent().hasClass('open')) {
			$(this).parent().parent().parent().removeClass('open');
			$(this).parent().parent().parent().find('.toogle-spisok-item-body').slideUp('fast');
			$(this).attr('aria-expanded', 'false').attr('aria-label', '詳細を表示');
		} else {
			$(this).parent().parent().parent().addClass('open');
			$(this).parent().parent().parent().find('.toogle-spisok-item-body').slideDown('fast');
			$(this).attr('aria-expanded', 'true').attr('aria-label', '詳細を隠す');
		}
	});
	
	/* Поддержка клавиатуры для toogle-spisok */
	$('.text-inform .toogle-spisok-item .toogle-spisok-item-head .toogle-spisok-item-button').keydown(function(e){
		if (e.which === 13 || e.which === 32) { // Enter или Space
			e.preventDefault();
			$(this).click();
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
		if (isDesktop) {
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
	if (isMobile) {
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
		if (isMobile) {
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
				$(this).next('.custom-pay-tab-mob').find('.custom-pay-tab-mob-content').append('<div class="custom-pay-tab-mob-content" data-id="'+i+'"></div>');
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