<?php
/**
 * Bonus Cards Block Template
 */

// Get block attributes with defaults
$background_color = isset($attributes['backgroundColor']) ? $attributes['backgroundColor'] : '#1a1d29';
$block_title = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : 'Наши бонусы';
$bonuses = isset($attributes['bonuses']) ? $attributes['bonuses'] : array();

// Debug output (remove in production)
// echo '<!-- DEBUG: Bonuses data: ' . json_encode($bonuses) . ' -->';

// Build CSS classes
$css_classes = ['bonus-cards-block'];

// Build CSS custom properties
$css_vars = array(
    '--bonus-cards-bg-color: ' . esc_attr($background_color)
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
    <div class="bonus-cards-container">
        <?php if (!empty($block_title)) : ?>
            <h2 class="bonus-cards-title"><?php echo esc_html($block_title); ?></h2>
        <?php endif; ?>
        
        <?php if (!empty($bonuses) && is_array($bonuses)) : ?>
            <div class="bonus-cards-grid">
                <?php foreach ($bonuses as $index => $bonus) : ?>
                    <div class="bonus-card-item">
                        <a href="<?php echo esc_url($bonus['url'] ?? '#'); ?>" 
                           class="bonus-card-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           title="<?php echo esc_attr($bonus['title'] ?? 'Бонус'); ?>">
                            
                            <div class="bonus-card-image-container">
                                <?php if (!empty($bonus['imageUrl'])) : ?>
                                    <!-- DEBUG: Image URL: <?php echo esc_html($bonus['imageUrl']); ?> -->
                                    <img src="<?php echo esc_url($bonus['imageUrl']); ?>" 
                                         alt="<?php echo esc_attr($bonus['title'] ?? 'Бонус'); ?>" 
                                         class="bonus-card-image"
                                         onerror="console.log('Image failed to load:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="bonus-card-image-placeholder" style="display: none;">
                                        <span>🎁</span>
                                        <small>Ошибка загрузки</small>
                                    </div>
                                <?php else : ?>
                                    <div class="bonus-card-image-placeholder">
                                        <span>🎁</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($bonus['status'])) : ?>
                                    <span class="bonus-card-status"><?php echo esc_html($bonus['status']); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="bonus-card-content">
                                <h3 class="bonus-card-title">
                                    <?php echo esc_html($bonus['title'] ?? 'Бонус без названия'); ?>
                                </h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="bonus-cards-grid">
                <div class="bonus-card-item">
                    <div class="bonus-card-placeholder">
                        Бонусы еще не добавлены - Debug: <?php echo count($bonuses); ?> бонусов
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
