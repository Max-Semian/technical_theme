<?php function sa_add_pattern_dropdown_list() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		register_block_pattern('custom-blocks/dropdown-list', array(
			'title' => 'Выпадающий список с нумерацией',
			'description' => '',
			'content' => '<!-- wp:group {"className":"vypad-spisok","layout":{"type":"constrained"}} -->
<div class="wp-block-group vypad-spisok"><!-- wp:heading -->
<h2 class="wp-block-heading">ベッティングの始め方</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"vypad-spisok-toogle","layout":{"type":"constrained"}} -->
<div class="wp-block-group vypad-spisok-toogle"><!-- wp:group {"className":"spisok-toogle-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-item"><!-- wp:group {"className":"spisok-toogle-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-head"><!-- wp:heading {"level":3,"className":"toogle-title"} -->
<h3 class="wp-block-heading toogle-title">参加登録</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"spisok-toogle-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-text"><!-- wp:paragraph -->
<p>モバイルアプリケーションの登録ボタンは「プロフィール」の中にあります。右上の 「サインイン 」ボタンをタップし、次の画面で 「登録 」をクリックしてください。登録フォームでは、電話番号、生年月日、パスワード、画像からの確認コードを入力し、BCのルールに同意する必要があります。登録はロシア連邦番号でのみ可能。外国籍の方も登録できますが、のいずれかのクラブを訪問した後に限ります。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"spisok-toogle-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-item"><!-- wp:group {"className":"spisok-toogle-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-head"><!-- wp:heading {"level":3,"className":"toogle-title"} -->
<h3 class="wp-block-heading toogle-title">参加登録</h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"spisok-toogle-text","layout":{"type":"constrained"}} -->
<div class="wp-block-group spisok-toogle-text"><!-- wp:paragraph -->
<p>モバイルアプリケーションの登録ボタンは「プロフィール」の中にあります。右上の 「サインイン 」ボタンをタップし、次の画面で 「登録 」をクリックしてください。登録フォームでは、電話番号、生年月日、パスワード、画像からの確認コードを入力し、BCのルールに同意する必要があります。登録はロシア連邦番号でのみ可能。外国籍の方も登録できますが、のいずれかのクラブを訪問した後に限ります。</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
				'categories'  => array('custom-blocks'),
			)
		);
	}
}
add_action('init', 'sa_add_pattern_dropdown_list', 25); ?>