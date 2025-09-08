(function($) {
    'use strict';
    
    // Инициализация функций для блока бонусных карточек
    function initBonusCards() {
        $('.bonus-cards-block').each(function() {
            var $block = $(this);
            
            // Добавляем эффекты hover
            $block.find('.bonus-card-item').on('mouseenter', function() {
                $(this).addClass('hovered');
            }).on('mouseleave', function() {
                $(this).removeClass('hovered');
            });
            
            // Lazy loading для изображений
            $block.find('.bonus-card-image').each(function() {
                var $img = $(this);
                
                if ($img.attr('data-src')) {
                    $img.attr('src', $img.attr('data-src'));
                    $img.removeAttr('data-src');
                }
            });
            
            // Трекинг кликов (если нужна аналитика)
            $block.find('.bonus-card-link').on('click', function() {
                var bonusTitle = $(this).find('.bonus-card-title').text();
                var bonusStatus = $(this).find('.bonus-card-status').text();
                
                // Можно добавить Google Analytics или другую аналитику
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'bonus_card_click', {
                        'bonus_title': bonusTitle,
                        'bonus_status': bonusStatus
                    });
                }
            });
        });
    }
    
    // Инициализация при загрузке страницы
    $(document).ready(function() {
        initBonusCards();
    });
    
    // Реинициализация после AJAX загрузки (если используется)
    $(document).on('bonus-cards-loaded', function() {
        initBonusCards();
    });
    
})(jQuery);
