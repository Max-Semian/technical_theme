<?php
/**
 * Popular Slots Block Template
 */

// Get block attributes with defaults
$background_color = isset($attributes['backgroundColor']) ? $attributes['backgroundColor'] : '#0B0F18';
$block_title = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : 'Популярные слоты';
$slots = isset($attributes['slots']) ? $attributes['slots'] : array();

// Debug output
echo "<!-- DEBUG: Popular slots count: " . count($slots) . " -->\n";
foreach ($slots as $index => $slot) {
    echo '<!-- DEBUG Slot ' . ($index + 1) . ' data: ' . json_encode($slot, JSON_UNESCAPED_UNICODE) . ' -->';
}

// CSS custom properties for dynamic styling
$style_props = "--popular-slots-bg-color: {$background_color};";
?>

<div class="popular-slots-block" style="<?php echo esc_attr($style_props); ?>">
    <div class="popular-slots-container">
        <h2 class="popular-slots-title"><?php echo esc_html($block_title); ?></h2>
        
        <div class="popular-slots-grid">
            <?php if (!empty($slots) && is_array($slots)): ?>
                <?php foreach ($slots as $index => $slot): ?>
                    <?php
                    // Get slot data with defaults
                    $slot_title = isset($slot['title']) ? $slot['title'] : 'Slot ' . ($index + 1);
                    $demo_url = isset($slot['demoUrl']) ? $slot['demoUrl'] : '#';
                    $play_url = isset($slot['playUrl']) ? $slot['playUrl'] : '#';
                    $image_id = isset($slot['imageId']) ? intval($slot['imageId']) : 0;
                    $image_url = isset($slot['image']) ? $slot['image'] : '';
                    
                    // Fallback: try to get image URL by ID if URL is empty
                    if (empty($image_url) && $image_id > 0) {
                        $image_url = wp_get_attachment_image_url($image_id, 'medium');
                    }
                    
                    // Debug per slot
                    echo "<!-- DEBUG Slot " . ($index + 1) . ": Title='" . esc_html($slot_title) . "', Demo='" . esc_attr($demo_url) . "', Play='" . esc_attr($play_url) . "', Image ID=" . $image_id . ", Image URL='" . esc_attr($image_url) . "' -->\n";
                    ?>
                    
                    <div class="popular-slot-item">
                        <div class="popular-slot-image">
                            <?php if (!empty($image_url)): ?>
                                <img src="<?php echo esc_url($image_url); ?>" 
                                     alt="<?php echo esc_attr($slot_title); ?>"
                                     class="slot-image"
                                     onerror="console.log('Slot image failed to load:', this.src); this.style.display='none';" />
                            <?php else: ?>
                                <div class="slot-image-placeholder">
                                    🎰
                                    <?php if ($image_id > 0): ?>
                                        <small>ID: <?php echo $image_id; ?></small>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="popular-slot-content">
                            <h5 class="popular-slot-title"><?php echo esc_html($slot_title); ?></h5>
                            
                            <div class="popular-slot-buttons">
                                <a href="<?php echo esc_url($demo_url); ?>" 
                                   class="slot-btn slot-btn-demo"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    DEMO
                                </a>
                                <a href="<?php echo esc_url($play_url); ?>" 
                                   class="slot-btn slot-btn-play"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    PLAY
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Default slots for empty state -->
                <?php for ($i = 0; $i < 8; $i++): ?>
                    <div class="popular-slot-item">
                        <div class="popular-slot-image">
                            <div class="slot-image-placeholder">🎰</div>
                        </div>
                        <div class="popular-slot-content">
                            <h5 class="popular-slot-title">Slot Game <?php echo ($i + 1); ?></h5>
                            <div class="popular-slot-buttons">
                                <a href="#" class="slot-btn slot-btn-demo">DEMO</a>
                                <a href="#" class="slot-btn slot-btn-play">PLAY</a>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
