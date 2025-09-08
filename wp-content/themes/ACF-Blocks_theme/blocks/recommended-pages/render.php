<?php
/**
 * Recommended Pages Block Template
 */

// Get block attributes with defaults
$background_color = isset($attributes['backgroundColor']) ? $attributes['backgroundColor'] : '#0B0F18';
$block_title = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : 'Рекомендуемые страницы';
$recommended_pages = isset($attributes['recommendedPages']) ? $attributes['recommendedPages'] : array();

// Debug output
echo "<!-- DEBUG: Recommended pages count: " . count($recommended_pages) . " -->\n";
foreach ($recommended_pages as $index => $page) {
    echo '<!-- DEBUG Page ' . ($index + 1) . ' data: ' . json_encode($page, JSON_UNESCAPED_UNICODE) . ' -->';
}

// Build CSS classes
$css_classes = ['recommended-pages-block'];

// Build CSS custom properties
$css_vars = array(
    '--recommended-pages-bg-color: ' . esc_attr($background_color)
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
    <div class="recommended-pages-container">
        <?php if (!empty($block_title)) : ?>
            <h2 class="recommended-pages-title"><?php echo esc_html($block_title); ?></h2>
        <?php endif; ?>
        
        <?php if (!empty($recommended_pages) && is_array($recommended_pages)) : ?>
            <div class="recommended-pages-grid">
                <?php foreach ($recommended_pages as $index => $page) : ?>
                    <?php 
                    // Debug output for image URL
                    $background_image = $page['backgroundImage'] ?? '';
                    $image_id = $page['imageId'] ?? 0;
                    
                    // Fallback: get image URL by ID if URL is empty but ID exists
                    if (empty($background_image) && !empty($image_id)) {
                        $background_image = wp_get_attachment_image_url($image_id, 'full');
                    }
                    
                    echo '<!-- DEBUG Page ' . ($index + 1) . ': ';
                    echo 'Title: ' . esc_html($page['title'] ?? 'No title') . ', ';
                    echo 'Image URL: ' . esc_html($background_image) . ', ';
                    echo 'Image ID: ' . esc_html($image_id) . ', ';
                    echo 'Fallback URL: ' . esc_html(wp_get_attachment_image_url($image_id, 'full')) . ' -->';
                    ?>
                    <a href="<?php echo esc_url($page['url'] ?? '#'); ?>" 
                       class="recommended-page-item"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="<?php echo esc_attr($page['title'] ?? 'Рекомендуемая страница'); ?>">
                        
                        <?php if (!empty($background_image)) : ?>
                            <img src="<?php echo esc_url($background_image); ?>" 
                                 alt="<?php echo esc_attr($page['title'] ?? 'Background'); ?>" 
                                 class="recommended-page-background-image"
                                 onerror="console.log('Background image failed to load:', this.src);">
                        <?php endif; ?>
                        
                        <div class="recommended-page-overlay"></div>
                        
                        <div class="recommended-page-content">
                            <h5 class="recommended-page-title">
                                <?php echo esc_html($page['title'] ?? 'Рекомендуемая страница'); ?>
                            </h5>
                        </div>
                        
                        <?php if (empty($background_image)) : ?>
                            <!-- DEBUG: No background image available for: <?php echo esc_html($page['title']); ?> (ID: <?php echo esc_html($image_id); ?>) -->
                            <div class="recommended-page-placeholder">
                                <span>🎯</span>
                                <small>ID: <?php echo esc_html($image_id); ?></small>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="recommended-pages-grid">
                <div class="recommended-pages-placeholder">
                    Рекомендуемые страницы еще не добавлены - Debug: <?php echo count($recommended_pages); ?> страниц
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
