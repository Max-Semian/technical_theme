<?php

/*  Apps - Post Type Start */

add_action( 'init', 'init_custom_apps', 0 );

function init_custom_apps() {

	$app_name = esc_html__( 'Apps', 'custom-theme' );

	if ( get_option( 'apps_section_name' ) ) {
		$app_name = get_option( 'apps_section_name', 'Apps' );
	}

	$app_args = array(
		'labels'             => array(
			'name'         => $app_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'app' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-smartphone',
		'_builtin'           => false,
		'_edit_link'         => 'post.php?post=%d',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array(
			'title',
			'editor',
			'author',
			'comments',
			'thumbnail',
			'excerpt',
			'revisions',
		),
		'has_archive'        => false,
		'rest_base'          => 'app',
		'rewrite'            => false,
	);

	register_post_type( 'app', $app_args );

	/* --- App Platforms: Custom Taxonomy --- */

	$app_platforms_title = esc_html__( 'App platforms', 'custom-theme' );

	$platform_labels = array(
		'name'              => $app_platforms_title,
		'singular_name'     => $app_platforms_title,
		'search_items'      => esc_html__( 'Find Taxonomy', 'custom-theme' ),
		'all_items'         => esc_html__( 'All ', 'custom-theme' ) . $app_platforms_title,
		'parent_item'       => esc_html__( 'Parent Taxonomy', 'custom-theme' ),
		'parent_item_colon' => esc_html__( 'Parent Taxonomy:', 'custom-theme' ),
		'edit_item'         => esc_html__( 'Edit Taxonomy', 'custom-theme' ),
		'view_item'         => esc_html__( 'View Taxonomy', 'custom-theme' ),
		'update_item'       => esc_html__( 'Update Taxonomy', 'custom-theme' ),
		'add_new_item'      => esc_html__( 'Add New Taxonomy', 'custom-theme' ),
		'new_item_name'     => esc_html__( 'Taxonomy', 'custom-theme' ),
		'menu_name'         => $app_platforms_title,
	); 

	$platform_args = array(
		'labels'                => $platform_labels,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'show_tagcloud'         => true,
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		'query_var'             => '',
		'capabilities'          => array(),
		'_builtin'              => false,
	);

	register_taxonomy( 'app-platform', 'app', $platform_args ); 
}

/*  Apps - Post Type End */

/*  Apps - Short Description Start */

add_action( 'admin_init', 'app_short_description_field' );

function app_short_description_field() {
	$post_type  = 'app';
	$field_name = 'short_description';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Short Description', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_short_description_display_meta_box( $post ) {
	custom_text_field_display_meta_box(
		'short_desc',
		$post,
		array(
			'tinymce'       => array(
				'toolbar1' => 'bold,italic,underline,bullist,numlist,link,unlink,undo,redo',
			),
			'quicktags'     => array(
				'buttons' => 'em,strong,link,ul,li,ol,close',
			),
			'media_buttons' => false,
			'textarea_rows' => 4,
		)
	);
}

add_action( 'save_post', 'app_short_description_save_field', 10, 2 );

function app_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'short_desc', $post_id );
}

/*  Apps - Short Description End */

/*  Apps - Breadcrumb Title Start */

add_action( 'admin_init', 'app_breadcrumb_title_field' );

function app_breadcrumb_title_field() {
	$post_type  = 'app';
	$field_name = 'breadcrumb_title';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Breadcrumb Title', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_breadcrumb_title_display_meta_box( $post ) {
	custom_text_field_display_meta_box(
		'breadcrumb_title',
		$post,
		array(
			'tinymce'       => false,
			'quicktags'     => false,
			'media_buttons' => false,
			'textarea_rows' => 1,
		)
	);
}

add_action( 'save_post', 'app_breadcrumb_title_save_field', 10, 2 );

function app_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'breadcrumb_title', $post_id );
}

/*  Apps - Breadcrumb Title End */

/*  Apps - Bonus Title Start */

add_action( 'admin_init', 'app_bonus_title_field' );

function app_bonus_title_field() {
	$post_type  = 'app';
	$field_name = 'bonus_title';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Bonus title', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_bonus_title_display_meta_box( $post ) {
	custom_text_field_display_meta_box(
		'bonus_title',
		$post,
		array(
			'tinymce'       => array(
				'toolbar1' => 'bold,italic,underline,link,unlink,undo,redo',
			),
			'quicktags'     => array(
				'buttons' => 'em,strong,link,close',
			),
			'media_buttons' => false,
			'textarea_rows' => 8,
		)
	);
}

add_action( 'save_post', 'app_bonus_title_save_field', 10, 2 );

function app_bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'bonus_title', $post_id );
}

/*  Apps - Bonus Title End */

/*  Apps - Bonus Value Start */

add_action( 'admin_init', 'app_bonus_value_field' );

function app_bonus_value_field() {
	$post_type  = 'app';
	$field_name = 'bonus_value';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Bonus value', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_bonus_value_display_meta_box( $post ) {
	custom_text_field_display_meta_box(
		'bonus_value',
		$post,
		array(
			'tinymce'       => false,
			'quicktags'     => false,
			'media_buttons' => false,
			'textarea_rows' => 1,
		)
	);
}

add_action( 'save_post', 'app_bonus_value_save_field', 10, 2 );

function app_bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'bonus_value', $post_id );
}

/*  Apps - Bonus Value End */

/*  Apps - Promotional Code Start */

add_action( 'admin_init', 'app_promotional_code_field' );

function app_promotional_code_field() {
	$post_type  = 'app';
	$field_name = 'promotional_code';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Promotional code', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_promotional_code_display_meta_box( $post ) {
	custom_text_field_display_meta_box(
		'promotional_code',
		$post,
		array(
			'tinymce'       => false,
			'quicktags'     => false,
			'media_buttons' => false,
			'textarea_rows' => 1,
		)
	);
}

add_action( 'save_post', 'app_promotional_code_save_field', 10, 2 );

function app_promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'promotional_code', $post_id );
}

/*  Apps - Promotional Code End */

/*  Apps - Rating Start */

add_action( 'admin_init', 'app_rating_field' );

function app_rating_field() {

	$post_type = 'app';

	add_meta_box(
		"{$post_type}_rating_meta_box",
		esc_html__( 'App Overall Rating', 'custom-theme' ),
		'custom_overall_rating_display_meta_box',
		$post_type,
		'normal',
		'high'
	);
}

add_action( 'save_post', 'app_rating_save_field', 10, 2 );

function app_rating_save_field( $post_id ) {
	custom_save_post_type_field( 'app', 'overall_rating', $post_id );
}

/*  Apps - Rating End */

/*  Apps - Platform Links Start */

add_action( 'admin_init', 'app_platform_links_field' );

function app_platform_links_field() {
	$post_type = 'app';

	add_meta_box(
		"{$post_type}_platform_links_meta_box",
		esc_html__( 'Platform links', 'custom-theme' ),
		"{$post_type}_platform_links_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function app_platform_links_display_meta_box( $post ) {
	$post_type = $post->post_type;
	
	$app_platforms = get_terms( 'app-platform', array( 'hide_empty' => false ) );

	foreach ( $app_platforms as $app_platform ) { 
		
		$field_name  = "{$post_type}_platform_link_{$app_platform->term_id}";
		$field_value = get_post_meta( $post->ID, $field_name, true );


		wp_nonce_field( "{$field_name}_box", "{$field_name}_nonce" );

		?>
		<div class="components-base-control" style="margin-bottom:20px;">
			<div class="components-base-control__field">
				<label class="components-base-control__label" for="<?php echo esc_attr( $field_name ); ?>"><?php esc_html_e( 'External URL for the', 'custom-theme' ); ?> <strong><?php echo esc_html( "{$app_platform->name}" ); ?></strong> <?php esc_html_e( 'platform', 'custom-theme' ); ?></label>
				<input style="width:100%;" type="url" name="<?php echo esc_attr( $field_name ); ?>" id="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_url( $field_value ); ?>" style="display: block; margin-bottom: 10px;" />
			</div>
		</div>

		<?php 
	}
}

add_action( 'save_post', 'app_platform_links_save_field', 10, 2 );

function app_platform_links_save_field( $post_id ) {
	$app_platforms = get_terms( 'app-platform', array( 'hide_empty' => false ) );

	foreach ( $app_platforms as $app_platform ) {
		custom_save_post_type_field( 'app', "platform_link_{$app_platform->term_id}", $post_id );
	}
}

/*  Apps - Platform Links End */

/*  Apps - Additional Fields Start */

add_action( 'admin_init', 'app_additional_fields' );

function app_additional_fields() {
	$post_type = 'app';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'app_additional_save_fields', 10, 2 );

function app_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'app', $post_id );
}

/*  Apps - Additional Fields End */

/*  Add App Platforms Logo Start  */

add_action( 'app-platform_add_form_fields', 'add_taxonomy_taxonomy_image', 10, 2 );
add_action( 'created_app-platform', 'save_taxonomy_taxonomy_image', 10, 2 );
add_action( 'app-platform_edit_form_fields', 'edit_taxonomy_image_upload', 10, 2 );
add_action( 'edited_app-platform', 'update_taxonomy_image_upload', 10, 2 );

/*  Add App Platforms Logo End  */
