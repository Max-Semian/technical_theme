<?php function sa_add_pattern_expert_comment() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/expert-comment', array(
			'title' => 'Список плюсов и минусов',
			'description' => '',
			'content' => '<!-- wp:columns {"className":"comment-block"} -->
<div class="wp-block-columns comment-block"><!-- wp:column {"className":"comment-block-left"} -->
<div class="wp-block-column comment-block-left"><!-- wp:image {"id":84,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="https://katsuoncasi.com/wp-content/uploads/2025/06/comment-image.webp" alt="" class="wp-image-84"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"comment-block-right"} -->
<div class="wp-block-column comment-block-right"><!-- wp:paragraph -->
<p>で本人確認される最も早い方法は、ポータルのアカウントを使用することです。もしプレーヤーが本人確認されたアカウントを持っていない場合、オンラインで書類を送って本人確認をするよう提案されます。パスポートの見開きの写真2枚（メインページと登録ページ）を添付する必要があり、それぞれの写真には「」という署名と現在の日付の入ったシールが貼られていなければなりません。また、選手の顔とパスポートを広げた状態を映した短いビデオクリップを送信する必要があります。送信されたデータは通常10分以内に処理され、その後オペレーターから番号保持者の本人確認の電話がかかってきます。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_expert_comment', 25); ?>