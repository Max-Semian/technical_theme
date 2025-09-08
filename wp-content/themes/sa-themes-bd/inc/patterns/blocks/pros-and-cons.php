<?php function sa_add_pattern_pros_and_cons() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/pros-and-cons', array(
			'title' => 'Список плюсов и минусов',
			'description' => '',
			'content' => '<!-- wp:columns {"className":"texts-plus-minus"} -->
<div class="wp-block-columns texts-plus-minus"><!-- wp:column {"className":"texts-plus-minus-left"} -->
<div class="wp-block-column texts-plus-minus-left"><!-- wp:group {"className":"texts-plus-minus-title","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group texts-plus-minus-title"><!-- wp:image {"id":79,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://katsuoncasi.com/wp-content/uploads/2025/06/plus.svg" alt="" class="wp-image-79"/></figure>
<!-- /wp:image -->

<!-- wp:heading -->
<h2 class="wp-block-heading">おすすめポイント</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>ウェルカムボーナス</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>豊富なビデオ放送</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>豊富なラインナップと詳細なスプレッド</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>キャッシュアウトとベット編集機能</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>テニスで最も低いマージン</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"texts-plus-minus-right"} -->
<div class="wp-block-column texts-plus-minus-right"><!-- wp:group {"className":"texts-plus-minus-title","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group texts-plus-minus-title"><!-- wp:image {"id":78,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://katsuoncasi.com/wp-content/uploads/2025/06/minus.svg" alt="" class="wp-image-78"/></figure>
<!-- /wp:image -->

<!-- wp:heading -->
<h2 class="wp-block-heading">おすすめポイント</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>プレー制限の可能性</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>スポーツマンシップに反する試合の疑いによるベットの返還</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_pros_and_cons', 25); ?>