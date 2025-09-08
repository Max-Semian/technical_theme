<?php function sa_add_pattern_header_and_text_image() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/header-and-text-image', array(
			'title' => 'Заголовок, изобраение и текст',
			'description' => '',
			'content' => '<!-- wp:group {"className":"information-block-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group information-block-item"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">電子ウォレットはオンラインカジノの支払いに最適</h2>
<!-- /wp:heading -->

<!-- wp:columns {"className":"information-block-img-text"} -->
<div class="wp-block-columns information-block-img-text"><!-- wp:column {"className":"information-block-image"} -->
<div class="wp-block-column information-block-image"><!-- wp:image {"id":48,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://katsuoncasi.com/wp-content/uploads/2025/05/information-image.webp" alt="" class="wp-image-48"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"information-block-text"} -->
<div class="wp-block-column information-block-text"><!-- wp:paragraph -->
<p>、カジノ運営者たちと直に交渉・調査をしているので、情報が最速で確実💨 ぜーんぶ『本音』でお届けしていますっ！</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>また、直感的な操作でスムーズに使用できるサイト構成はもちろん、業界内でも圧倒的に見やすい評価方法やカテゴリー別フィルターを用意しているため、海外を拠点とする日本のオンラインカジノをランキング順にチェックしていただくことが可能 💪</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_header_and_text_image', 25); ?>