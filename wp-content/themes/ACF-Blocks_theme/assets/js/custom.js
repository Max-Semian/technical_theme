jQuery(document).ready(function($) {
    jQuery('.element_faq_item').on('click', function(e) {
      if (!jQuery(e.target).hasClass('element_faq_item--text')) {
        jQuery(this).toggleClass('faq-active');
      }
    });
    $(document).ready(function() {
      // Находим нужные элементы
      const $useBtn = $('.element_coupon .btn__violet');
      const $copyBtn = $('.clickboard');
    
      // Функция для копирования текста в буфер обмена
      function copyToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("Copy");
        textArea.remove();
        console.log('Промокод скопирован в буфер обмена:', text);
        jQuery($useBtn).show();
    
        // Добавляем класс 'succesed-copy' на 5 секунд
        const $successedCopy = jQuery('.successed-copy');
        $successedCopy.addClass('show');
        setTimeout(function() {
          $successedCopy.removeClass('show');
        }, 5000);
      }
    
      $copyBtn.on('click', function() {
        const couponCode = $(this).closest('.element_coupon').find('.element_coupon-code').data('coupon');
        copyToClipboard(couponCode);
      });
    });  
	jQuery('.clickboard').on('click', function(){
		$('.element_coupon .btn.btn__violet').addClass('show-btn');
	});
		jQuery('.close-block').on('click', function(){
		$('.game-now-block').remove();
	});
	
	jQuery('.btn-mob-menu').on('click', function(){
  jQuery('body').addClass('mobile-menu-acitve');
  jQuery('#bottom-header').show();
  });
  
  jQuery('.btn-mob-menu-close').on('click', function(){
    jQuery('body').removeClass('mobile-menu-acitve');
    jQuery('#bottom-header').hide();
    });
    $(document).ready(function() {
      $('a[href^="#"]').on('click', function(event) {
        event.preventDefault();
    
        var target = $(this.getAttribute('href')); 
        
        $('html, body').animate({
          scrollTop: target.offset().top 
        }, 400); 
      });
    });

	
$(document).ready(function() {
  // Получаем элементы для работы
  var $overflowWrapper = $('.overflow-wrapper');
  var $customScrollbar = $('.custom-scrollbar');
  var $scrollbarTrack = $('.scrollbar-track');

  // Коэффициент для замедления свайпа
  var swipeSlowdownCoefficient = 1.5;

  // Обработчик начала свайпа по прогресс-бару
  $customScrollbar.on('mousedown touchstart', function(event) {
    console.log('Swipe start event:', event);
    var startX = event.pageX || event.touches[0].pageX;
    var startScrollLeft = $overflowWrapper.scrollLeft();
    var customScrollbarWidth = $customScrollbar.width();

    // Обработчик движения свайпа по прогресс-бару
    $(document).on('mousemove touchmove', function(moveEvent) {
      console.log('Swipe move event:', moveEvent);
      var deltaX = (moveEvent.pageX || moveEvent.touches[0].pageX) - startX;
      var newScrollPosition = startScrollLeft + ($overflowWrapper[0].scrollWidth - $overflowWrapper.width()) * (deltaX / (customScrollbarWidth * swipeSlowdownCoefficient));
      newScrollPosition = Math.max(0, Math.min(newScrollPosition, $overflowWrapper[0].scrollWidth - $overflowWrapper.width()));

      $overflowWrapper.scrollLeft(newScrollPosition);
      var newPosition = (newScrollPosition / ($overflowWrapper[0].scrollWidth - $overflowWrapper.width())) * 100;
      newPosition = Math.max(0, Math.min(newPosition, 100));
      $scrollbarTrack.css('width', newPosition + '%');
    });

    // Обработчик окончания свайпа по прогресс-бару
    $(document).on('mouseup touchend', function(endEvent) {
      console.log('Swipe end event:', endEvent);
      $(document).off('mousemove touchmove');
      $(document).off('mouseup touchend');
    });
  });

  // Обработчик начала свайпа по таблице
  $overflowWrapper.on('mousedown touchstart', function(event) {
    console.log('Swipe start event:', event);
    var startX = event.pageX || event.touches[0].pageX;
    var startScrollLeft = $overflowWrapper.scrollLeft();

    // Обработчик движения свайпа по таблице
    $(document).on('mousemove touchmove', function(moveEvent) {
      console.log('Swipe move event:', moveEvent);
      var deltaX = (moveEvent.pageX || moveEvent.touches[0].pageX) - startX;
      var newScrollPosition = startScrollLeft + ($overflowWrapper[0].scrollWidth - $overflowWrapper.width()) * (deltaX / (customScrollbarWidth * swipeSlowdownCoefficient));
      newScrollPosition = Math.max(0, Math.min(newScrollPosition, $overflowWrapper[0].scrollWidth - $overflowWrapper.width()));

      $overflowWrapper.scrollLeft(newScrollPosition);
      var newPosition = (newScrollPosition / ($overflowWrapper[0].scrollWidth - $overflowWrapper.width())) * 100;
      newPosition = Math.max(0, Math.min(newPosition, 100));
      $scrollbarTrack.css('width', newPosition + '%');
    });

    // Обработчик окончания свайпа по таблице
    $(document).on('mouseup touchend', function(endEvent) {
      console.log('Swipe end event:', endEvent);
      $(document).off('mousemove touchmove');
      $(document).off('mouseup touchend');
    });
  });

  // Обработчик изменения скроллбара
  $overflowWrapper.scroll(function() {
    console.log('Scroll event triggered');
    var newPosition = ($overflowWrapper.scrollLeft() / ($overflowWrapper[0].scrollWidth - $overflowWrapper.width())) * 100;
    newPosition = Math.max(0, Math.min(newPosition, 100));
    $scrollbarTrack.css('width', newPosition + '%');
  });
});
$(document).ready(function() {
    // Переменная для отслеживания состояния нажатия
    let isSubmenuOpen = false;

    $('.menu-item-has-children a').on('click', function(e) {
        e.preventDefault(); // Отменяем стандартное поведение ссылки

        const $parentMenuItem = $(this).parent();

        // Проверяем, если подменю уже открыто
        if (isSubmenuOpen) {
            // Если подменю открыто, переходим по ссылке
            window.location.href = $(this).attr('href');
        } else {
            // Если подменю закрыто, открываем его
            $parentMenuItem.toggleClass('menu-active');

            // Закрываем все другие подменю
            $('.menu-item-has-children a').not(this).parent().removeClass('menu-active');

            // Обновляем состояние
            isSubmenuOpen = true;
        }
    });

    // Сбрасываем состояние при щелчке вне меню
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.menu-item').length) {
            $('.menu-item-has-children a').parent().removeClass('menu-active');
            isSubmenuOpen = false; // Сбрасываем состояние
        }
    });
});
	
$(window).on('scroll', function() {
  var windowHeight = $(window).height();
  var scrollTop = $(window).scrollTop();
  var footerTop = $('footer').offset().top;

  if (scrollTop + windowHeight >= footerTop) {
    $('.game-now-block').hide();
  } else {
    $('.game-now-block').show();
  }
});
$(document).ready(function() {
  var $scrollToTopBtn = $('.scroll-to-top-btn');
  var $promoBlock = $('.promo-block');
  var $footer = $('footer');

  $scrollToTopBtn.css('display', 'none');

  $(window).on('scroll', function() {
    var windowHeight = $(window).height();
    var scrollTop = $(window).scrollTop();
    var promoBlockTop = $promoBlock.offset().top;
    var promoBlockBottom = promoBlockTop + $promoBlock.outerHeight();
    var footerTop = $footer.offset().top;

 
    if (scrollTop >= promoBlockBottom) {
      $scrollToTopBtn.css('display', 'flex');
    } else if (scrollTop < promoBlockTop) {
   
      $scrollToTopBtn.css('display', 'none');
    }



  });
});
});


  