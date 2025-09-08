<?php function sa_add_pattern_empty_block() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/empty-block', array(
			'title' => 'Пустой блок',
			'description' => '',
			'content' => '<!-- wp:group {"className":"sa-empty-block","layout":{"type":"constrained"}} -->
<div class="wp-block-group sa-empty-block"></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_empty_block', 25); ?>