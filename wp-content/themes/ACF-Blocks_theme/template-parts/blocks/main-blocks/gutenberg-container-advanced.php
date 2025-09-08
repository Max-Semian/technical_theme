<?php
/**
 * Advanced Gutenberg Container Block Template
 * 
 * @package ACF-Blocks_theme
 */

// Получаем поля ACF
$container_title = get_field('container_title');
$background_color = get_field('background_color') ?: 'transparent';
$css_class = get_field('css_class') ?: '';
$padding = get_field('padding') ?: 'medium';
$container_type = get_field('container_type') ?: 'default';
$restrict_blocks = get_field('restrict_blocks');
$allowed_block_types = get_field('allowed_block_types');
$max_blocks = get_field('max_blocks');
$show_block_count = get_field('show_block_count');

// ID блока для якорей
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'gutenberg-container-' . $block['id'];

// Классы блока
$class_name = 'gutenberg-container gutenberg-container-advanced';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($css_class)) {
    $class_name .= ' ' . $css_class;
}
$class_name .= ' padding-' . $padding;
$class_name .= ' container-type-' . $container_type;

// Alignment
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Настройки для InnerBlocks
if ($restrict_blocks && !empty($allowed_block_types)) {
    $allowed_blocks = $allowed_block_types;
} else {
    $allowed_blocks = array(
        // Базовые блоки WordPress
        'core/paragraph',
        'core/heading', 
        'core/image',
        'core/gallery',
        'core/list',
        'core/quote',
        'core/pullquote',
        'core/file',
        'core/audio',
        'core/video',
        'core/embed',
        
        // Блоки компоновки
        'core/columns',
        'core/group',
        'core/spacer',
        'core/separator',
        
        // Интерактивные блоки
        'core/button',
        'core/buttons',
        
        // Ваши кастомные ACF блоки
        'acf/promo-block',
        'acf/nav-block',
        'acf/game-block',
        'acf/advice-block',
        'acf/news-block',
        'acf/bonuses-block',
        'acf/licenses-block',
        'acf/providers-block',
        'acf/methods-block',
        'acf/text-block',
        'acf/reviews-block',
        'acf/faq-block',
    );
}

// Шаблон по умолчанию
$template = array(
    array('core/paragraph', array(
        'placeholder' => 'Начните добавлять контент в этот контейнер...'
    )),
);

// Стили для контейнера
$container_styles = array();
if ($background_color && $background_color !== 'transparent') {
    $container_styles[] = 'background-color: ' . $background_color;
}
$style_attr = !empty($container_styles) ? 'style="' . implode('; ', $container_styles) . '"' : '';

// Получаем количество блоков для отображения (только в админке)
$block_count = '';
if (is_admin() && $show_block_count) {
    $inner_blocks = parse_blocks(get_field('inner_blocks', false, false));
    $count = count($inner_blocks);
    $block_count = ' (' . $count . ' блоков)';
}
?>

<div id="<?php echo esc_attr($block_id); ?>" 
     class="<?php echo esc_attr($class_name); ?>" 
     <?php echo $style_attr; ?>
     <?php if ($max_blocks): ?>data-max-blocks="<?php echo esc_attr($max_blocks); ?>"<?php endif; ?>>
     
    <?php if ($container_title): ?>
        <div class="container-header">
            <h2 class="container-title">
                <?php echo esc_html($container_title); ?>
                <?php echo $block_count; ?>
            </h2>
        </div>
    <?php endif; ?>
    
    <div class="container-content">
        <InnerBlocks 
            allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>"
            template="<?php echo esc_attr(wp_json_encode($template)); ?>"
            templateLock="false"
            renderAppender="InnerBlocks.ButtonBlockAppender"
            <?php if ($max_blocks): ?>
            maxBlocks="<?php echo esc_attr($max_blocks); ?>"
            <?php endif; ?>
        />
    </div>
    
    <?php if ($max_blocks && is_admin()): ?>
        <div class="container-footer">
            <small class="block-limit-info">
                Максимум блоков: <?php echo esc_html($max_blocks); ?>
            </small>
        </div>
    <?php endif; ?>
</div>
