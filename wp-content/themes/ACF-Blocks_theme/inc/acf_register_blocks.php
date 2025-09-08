<?php 
if (function_exists('acf_register_block_type')) {
    acf_register_block_type(array(
        'name'              => 'site-blocks',
        'title'             => __('Гибкие блоки', 'your-theme-text-domain'),
        'description'       => __('Область для размещения гибких блоков', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/site-blocks.php',
        'category'          => 'custom-blocks',
        'icon'              => 'layout'
    ));  
  // Регистрация блоков
    acf_register_block_type(array(
        'name'              => 'promo-block',
        'title'             => __('Промо блок', 'your-theme-text-domain'),
        'description'       => __('Блок навигации', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/promo_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'menu',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // nav_block
    acf_register_block_type(array(
        'name'              => 'nav-block',
        'title'             => __('Навигационный блок', 'your-theme-text-domain'),
        'description'       => __('Блок навигации', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/nav_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'menu',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // game_block
    acf_register_block_type(array(
        'name'              => 'game-block',
        'title'             => __('Блок игр', 'your-theme-text-domain'),
        'description'       => __('Блок с играми', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/game_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'grid',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // advice_block
    acf_register_block_type(array(
        'name'              => 'advice-block',
        'title'             => __('Блок советов', 'your-theme-text-domain'),
        'description'       => __('Блок с советами', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/advice_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'grid',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // advice_block_white
    acf_register_block_type(array(
        'name'              => 'advice-block-white',
        'title'             => __('Блок белых советов', 'your-theme-text-domain'),
        'description'       => __('Блок с белыми советами', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/advice_block_white.php',
        'category'          => 'custom-blocks',
        'icon'              => 'grid',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // welcome_bonus
    acf_register_block_type(array(
        'name'              => 'welcome-bonus',
        'title'             => __('Блок приветственного бонуса', 'your-theme-text-domain'),
        'description'       => __('Блок с приветственным бонусом', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/welcome_bonus.php',
        'category'          => 'custom-blocks',
        'icon'              => 'awards',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    // faq_block
    acf_register_block_type(array(
        'name'              => 'faq-block',
        'title'             => __('Блок FAQ', 'your-theme-text-domain'),
        'description'       => __('Блок с частыми вопросами', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/faq_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'grid',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));

    acf_register_block_type(array(
        'name'              => 'game-now-block',
        'title'             => __('Блок "Играть сейчас"', 'your-theme-text-domain'),
        'description'       => __('Блок с призывом играть сейчас', 'your-theme-text-domain'),
        'render_template'   => 'template-parts/blocks/main-blocks/game_now_block.php',
        'category'          => 'custom-blocks',
        'icon'              => 'grid',
        'parent'            => array('acf/site-blocks'), // Указываем, что это дочерний блок для 'acf/site-blocks'
    ));
    // Регистрация элементов блока
    acf_register_block_type(array(
        'name'              => 'main-title',
        'title'             => __('Заголовок H1', 'your-theme-text-domain'),
        'description'       => __('Заголовок первого уровня (H1)', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/main-title.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading',
        'keywords'          => array('title', 'h1', 'heading'),
    ));
    acf_register_block_type(array(
        'name'              => 'element-get-bonus',
        'title'             => __('Блок получить бонус', 'your-theme-text-domain'),
        'description'       => __('Блок бонуса, в промо блоке', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-get-bonus.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    ));
    acf_register_block_type(array(
        'name'              => 'element-white-description',
        'title'             => __('Белый текст', 'your-theme-text-domain'),
        'description'       => __('Блок с белым текстом', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-white-description.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    ));
    acf_register_block_type(array(
        'name'              => 'element-top-section-title',
        'title'             => __('Верхний заголовок', 'your-theme-text-domain'),
        'description'       => __('Верхний заголовок секции', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-top-section-title.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    ));   
    acf_register_block_type(array(
        'name'              => 'element-top-section-description',
        'title'             => __('Верхнее описание секции', 'your-theme-text-domain'),
        'description'       => __('Верхнее описание секции', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-top-section-description.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    ));   
    
    acf_register_block_type(array(
        'name'              => 'element-section-title-level2',
        'title'             => __('Заголовок секции второго уровня', 'your-theme-text-domain'),
        'description'       => __('Заголовок секции второго уровня, серый цвет', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-section-title-level2.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    )); 
    
    acf_register_block_type(array(
        'name'              => 'element-banner-image',
        'title'             => __('Картинка - баннер', 'your-theme-text-domain'),
        'description'       => __('Картинка - баннер, серый цвет', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-banner-image.php',
        'category'          => 'custom-blocks',
        'icon'              => 'heading'
    )); 
    acf_register_block_type(array(
        'name'              => 'element-limit-table',
        'title'             => __('Таблица лимитов', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-limit-table.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'element-simple-text',
        'title'             => __('Простой текстовый блок', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-simple-text.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'element-coupon-block',
        'title'             => __('Блок с купоном', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-coupon-block.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'FAQ',
        'title'             => __('FAQ', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-faq.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'element-features-col',
        'title'             => __('Преимущества, колонка', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-features-col.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'element-features-row',
        'title'             => __('Преимущества, ряд', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-features-row.php',
        'category'          => 'custom-blocks'
    )); 
    acf_register_block_type(array(
        'name'              => 'play-now',
        'title'             => __('Блок играть сейчас', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/main-blocks/play-now.php',
        'category'          => 'custom-blocks'
    ));    
    acf_register_block_type(array(
        'name'              => 'element-play-now',
        'title'             => __('Кнопка, играть сейчас', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/elements-block/element-play-now.php',
        'category'          => 'custom-blocks'
    ));  
    acf_register_block_type(array(
        'name'              => 'breadcrumbs',
        'title'             => __('Хлебные крошки', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/main-blocks/breadcrumbs.php',
        'category'          => 'custom-blocks'
    ));    
    acf_register_block_type(array(
        'name'              => 'simply-text-block',
        'title'             => __('Хлебные крошки', 'your-theme-text-domain'),
        'render_template' => 'template-parts/blocks/main-blocks/simply-text-block.php',
        'category'          => 'custom-blocks'
    ));     

    // Регистрация элементов блока
}
?>