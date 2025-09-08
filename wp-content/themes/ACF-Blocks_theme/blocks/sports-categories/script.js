(function($) {
    'use strict';
    
    // Инициализация функций для блока спортивных категорий
    function initSportsCategories() {
        $('.sports-categories-block').each(function() {
            var $block = $(this);
            
            // Добавляем эффекты hover
            $block.find('.sport-category-item').on('mouseenter', function() {
                $(this).addClass('hovered');
            }).on('mouseleave', function() {
                $(this).removeClass('hovered');
            });
            
            // Lazy loading для иконок
            $block.find('.sport-category-icon').each(function() {
                var $icon = $(this);
                
                if ($icon.attr('data-src')) {
                    $icon.attr('src', $icon.attr('data-src'));
                    $icon.removeAttr('data-src');
                }
            });
            
            // Трекинг кликов (если нужна аналитика)
            $block.find('.sport-category-item').on('click', function() {
                var sportName = $(this).find('.sport-category-name').text();
                
                // Можно добавить Google Analytics или другую аналитику
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'sport_category_click', {
                        'sport_name': sportName
                    });
                }
            });
        });
    }
    
    // Инициализация при загрузке страницы
    $(document).ready(function() {
        initSportsCategories();
    });
    
    // Реинициализация после AJAX загрузки (если используется)
    $(document).on('sports-categories-loaded', function() {
        initSportsCategories();
    });
    
})(jQuery);
