<?php function sa_add_pattern_text_and_right_image() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-sections/text-and-right-image', array(
			'title' => 'Секция с картинкой',
			'description' => '',
			'content' => '<!-- wp:group {"tagName":"section","className":"about","layout":{"type":"constrained"}} -->
<section class="wp-block-group about"><!-- wp:columns {"className":"about-container"} -->
<div class="wp-block-columns about-container"><!-- wp:column {"width":"","className":"about-left"} -->
<div class="wp-block-column about-left"><!-- wp:heading {"className":"title"} -->
<h2 class="wp-block-heading title">オンラインカジノの日本最大級情報ハブ</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"description"} -->
<p class="description">プレイヤー全員集合！おすすめオンラインカジノランキングの最高峰</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"text"} -->
<p class="text">オンラインカジノの中でもおすすめのサイト探しや、最新カジノニュースはもちろん、信用できるオンライ<br>ンカジノを比較するのに役立つ場所。 オンカジが大好きなあなた！ ジャパカジの右に出るところはナシっ</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"","className":"about-right"} -->
<div class="wp-block-column about-right"><!-- wp:image {"id":38,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://katsuoncasi.com/wp-content/uploads/2025/05/about.webp" alt="" class="wp-image-38"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
				'categories'  => array('custom-sections'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_text_and_right_image', 25); ?>