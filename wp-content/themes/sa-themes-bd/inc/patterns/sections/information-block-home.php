<?php function sa_add_pattern_information_block_home() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-sections/information-block-home', array(
			'title' => 'Секция с сайдбаром',
			'description' => '',
			'content' => '<!-- wp:group {"tagName":"section","metadata":{"categories":["customs"],"patternName":"customs/text-and-right-image","name":"Секция с сайдбаром"},"className":"information-block","layout":{"type":"constrained"}} -->
<section class="wp-block-group information-block"><!-- wp:columns {"className":"information-container"} -->
<div class="wp-block-columns information-container"><!-- wp:column {"width":"","className":"information-block-left"} -->
<div class="wp-block-column information-block-left"><!-- wp:group {"className":"information-block-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group information-block-item"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">電子ウォレットはオンラインカジノの支払いに最適</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>電子支払いサービス（イーウォレット）は、オンラインカジノの特に出金には大変便利なサービスです。日本で有名な電子支払いサービスにはLINE PAYがありますが、オンラインカジノで代表的な電子支払いサービスにはペイズやベガウォレットがあります。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"information-block-item","layout":{"type":"constrained"}} -->
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
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"","className":"information-block-right"} -->
<div class="wp-block-column information-block-right"><!-- wp:shortcode -->
[info_content title="目次"]
<!-- /wp:shortcode --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
				'categories'  => array('custom-sections'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_information_block_home', 25); ?>