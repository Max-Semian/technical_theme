<?php
/**
 * Gutenberg Container Block Template
 * 
 * @package ACF-Blocks_theme
 */

// Получаем поля ACF
$container_title = get_field('container_title');
$background_color = get_field('background_color') ?: 'transparent';
$css_class = get_field('css_class') ?: '';
$padding = get_field('padding') ?: 'medium';
$container_type = get_field('container_type') ?: 'default';

// ID блока для якорей
$block_id = !empty($block['anchor']) ? $block['anchor'] : 'gutenberg-container-' . $block['id'];

// Классы блока
$class_name = 'gutenberg-container';
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

// Стили для контейнера
$container_styles = array();
if ($background_color && $background_color !== 'transparent') {
    $container_styles[] = 'background-color: ' . $background_color;
}
$style_attr = !empty($container_styles) ? 'style="' . implode('; ', $container_styles) . '"' : '';

// Получаем содержимое InnerBlocks
$inner_blocks_content = '<InnerBlocks />';
$allowed_blocks = array(
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
    'core/columns',
    'core/group',
    'core/spacer',
    'core/separator',
    'core/button',
    'core/buttons',
    // Универсальные ACF блоки
    'acf/promo-block-universal',
    'acf/nav-block-universal',
    'acf/game-block-universal',
    'acf/advice-block-universal',
    'acf/faq-block-universal',
    // Элементы блоков
    'acf/main-title',
    'acf/bonus-card',
    'acf/game-card',
    'acf/review-card',
);
?>

<div id="<?php echo esc_attr($block_id); ?>" 
     class="<?php echo esc_attr($class_name); ?>" 
     <?php echo $style_attr; ?>>
     
    <?php if ($container_title): ?>
        <div class="container-header">
            <h2 class="container-title"><?php echo esc_html($container_title); ?></h2>
        </div>
    <?php endif; ?>
    
    <div class="container-content">
        <?php echo $inner_blocks_content; ?>
    </div>
</div>
