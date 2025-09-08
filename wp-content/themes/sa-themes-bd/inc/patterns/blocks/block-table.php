<?php function sa_add_pattern_block_table() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/block-table', array(
			'title' => 'Блок с таблицей',
			'description' => '',
			'content' => '<!-- wp:group {"className":"pay-system","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group pay-system"><!-- wp:group {"className":"pay-system-title","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group pay-system-title"><!-- wp:heading -->
<h2 class="wp-block-heading">決済システム</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"pay-system-buttons","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group pay-system-buttons"><!-- wp:lazyblock/sa-red-button {"blockId":"Z4qacc","blockUniqueClass":"lazyblock-sa-red-button-Z4qacc"} /-->

<!-- wp:lazyblock/sa-grey-button {"blockId":"Z12IQTR","blockUniqueClass":"lazyblock-sa-grey-button-Z12IQTR"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:table {"className":"custom-pay-tab"} -->
<figure class="wp-block-table custom-pay-tab"><table class="has-fixed-layout"><thead><tr><th>タイプ</th><th>最低限</th><th>最大</th><th>コミッション</th><th>エントリー時間</th></tr></thead><tbody><tr><td><img class="wp-image-83" style="width: NaNpx;" src="https://katsuoncasi.com/wp-content/uploads/2025/06/item-logo-1.svg" alt=""></td><td>100元</td><td>13800元</td><td>8.5%</td><td>即座に</td></tr><tr><td><img class="wp-image-82" style="width: NaNpx;" src="https://katsuoncasi.com/wp-content/uploads/2025/06/item-logo-2.svg" alt=""></td><td>100元</td><td>13800元</td><td>2%</td><td>即座に</td></tr><tr><td><img class="wp-image-81" style="width: NaNpx;" src="https://katsuoncasi.com/wp-content/uploads/2025/06/item-logo-3.svg" alt=""></td><td>100元</td><td>13800元</td><td>0%</td><td>即座に</td></tr><tr><td><img class="wp-image-80" style="width: NaNpx;" src="https://katsuoncasi.com/wp-content/uploads/2025/06/item-logo-4.svg" alt=""></td><td>100元</td><td>13800元</td><td>6.5%</td><td>即座に</td></tr><tr><td>即座に</td><td>100元</td><td>13800元</td><td>10%</td><td>即座に</td></tr></tbody></table></figure>
<!-- /wp:table --></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_block_table', 25); ?>