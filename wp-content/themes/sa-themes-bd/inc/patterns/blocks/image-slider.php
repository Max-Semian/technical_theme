<?php function sa_add_pattern_image_slider() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/image-slider', array(
			'title' => 'Слайдер изображений',
			'description' => '',
			'content' => '<!-- wp:group {"className":"slider-content-image","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group slider-content-image"><!-- wp:gallery {"linkTo":"none","className":"slider-content-images"} -->
<figure class="wp-block-gallery has-nested-images columns-default is-cropped slider-content-images"></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_image_slider', 25); ?>