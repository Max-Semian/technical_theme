<?php function sa_add_pattern_header_and_text() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/header-and-text', array(
			'title' => 'Заголовок и текст',
			'description' => '',
			'content' => '<!-- wp:group {"className":"information-block-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group information-block-item"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">電子ウォレットはオンラインカジノの支払いに最適</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>電子支払いサービス（イーウォレット）は、オンラインカジノの特に出金には大変便利なサービスです。日本で有名な電子支払いサービスにはLINE PAYがありますが、オンラインカジノで代表的な電子支払いサービスにはペイズやベガウォレットがあります。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_header_and_text', 25); ?>