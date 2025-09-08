<?php
/**
 * Sports Categories Block Template
 */

// Get block attributes with defaults
$background_color = isset($attributes['backgroundColor']) ? $attributes['backgroundColor'] : '#1a1d29';
$block_title = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : 'Все виды спорта';
$sports_categories = isset($attributes['sportsCategories']) ? $attributes['sportsCategories'] : array();

// Debug output (remove in production)
// echo '<!-- DEBUG: Sports categories data: ' . json_encode($sports_categories) . ' -->';

// Build CSS classes
$css_classes = ['sports-categories-block'];

// Build CSS custom properties
$css_vars = array(
    '--sports-categories-bg-color: ' . esc_attr($background_color)
);

// Get wrapper attributes with anchor support
$anchor_attr = array(
    'class' => implode(' ', $css_classes),
    'style' => implode('; ', $css_vars)
);

// Add anchor ID if present
if (!empty($attributes['anchor'])) {
    $anchor_attr['id'] = $attributes['anchor'];
} elseif (!empty($block->anchor)) {
    $anchor_attr['id'] = $block->anchor;
}

$wrapper_attributes = get_block_wrapper_attributes($anchor_attr);

?>

<div <?php echo $wrapper_attributes; ?>>
    <div class="sports-categories-container">
        <?php if (!empty($block_title)) : ?>
            <h2 class="sports-categories-title"><?php echo esc_html($block_title); ?></h2>
        <?php endif; ?>
        
        <?php if (!empty($sports_categories) && is_array($sports_categories)) : ?>
            <div class="sports-categories-grid">
                <?php foreach ($sports_categories as $index => $sport) : ?>
                    <a href="<?php echo esc_url($sport['url'] ?? '#'); ?>" 
                       class="sport-category-item"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="<?php echo esc_attr($sport['name'] ?? 'Спорт'); ?>">
                        
                        <span class="sport-category-name">
                            <?php echo esc_html($sport['name'] ?? 'Спорт'); ?>
                        </span>
                        
                        <div class="sport-category-icon-container">
                            <?php if (!empty($sport['iconUrl'])) : ?>
                                <!-- DEBUG: Icon URL: <?php echo esc_html($sport['iconUrl']); ?> -->
                                <img src="<?php echo esc_url($sport['iconUrl']); ?>" 
                                     alt="<?php echo esc_attr($sport['name'] ?? 'Спорт'); ?>" 
                                     class="sport-category-icon"
                                     onerror="console.log('Icon failed to load:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="sport-category-icon-placeholder" style="display: none;">
                                    <span>⚽</span>
                                </div>
                            <?php else : ?>
                                <div class="sport-category-icon-placeholder">
                                    <span>⚽</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="sports-categories-grid">
                <div class="sport-category-placeholder">
                    Категории спорта еще не добавлены - Debug: <?php echo count($sports_categories); ?> категорий
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
