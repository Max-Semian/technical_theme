<?php

/*  Promotional Codes - Post Type Start */

add_action( 'init', 'init_custom_promo', 0 );

function init_custom_promo() {

	$promo_name = esc_html__( 'Promotional codes', 'custom-theme' );

	if ( get_option( 'promo_section_name' ) ) {
		$promo_name = get_option( 'promo_section_name', 'Promotional codes' );
	}

	$promo_args = array(
		'labels'             => array(
			'name'         => $promo_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'promo' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-tickets-alt',
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
		'rest_base'          => 'promo',
		'rewrite'            => false,
	);

	register_post_type( 'promo', $promo_args );
}

/*  Promotional Codes - Post Type End */

/*  Promotional Codes - Short Description Start */

add_action( 'admin_init', 'promo_short_description_field' );

function promo_short_description_field() {
	$post_type  = 'promo';
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

function promo_short_description_display_meta_box( $post ) {
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

add_action( 'save_post', 'promo_short_description_save_field', 10, 2 );

function promo_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'short_desc', $post_id );
}

/*  Promotional Codes - Short Description End */

/*  Promotional Codes - Breadcrumb Title Start */

add_action( 'admin_init', 'promo_breadcrumb_title_field' );

function promo_breadcrumb_title_field() {
	$post_type  = 'promo';
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

function promo_breadcrumb_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'promo_breadcrumb_title_save_field', 10, 2 );

function promo_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'breadcrumb_title', $post_id );
}

/*  Promotional Codes - Breadcrumb Title End */

/*  Promotional Codes - Bonus Title Start */

add_action( 'admin_init', 'promo_bonus_title_field' );

function promo_bonus_title_field() {
	$post_type  = 'promo';
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

function promo_bonus_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'promo_bonus_title_save_field', 10, 2 );

function promo_bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'bonus_title', $post_id );
}

/*  Promotional Codes - Bonus Title End */

/*  Promotional Codes - Bonus Value Start */

add_action( 'admin_init', 'promo_bonus_value_field' );

function promo_bonus_value_field() {
	$post_type  = 'promo';
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

function promo_bonus_value_display_meta_box( $post ) {
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

add_action( 'save_post', 'promo_bonus_value_save_field', 10, 2 );

function promo_bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'bonus_value', $post_id );
}

/*  Promotional Codes - Bonus Value End */

/*  Promotional Codes - Promotional Code Start */

add_action( 'admin_init', 'promotional_code_field' );

function promotional_code_field() {
	$post_type  = 'promo';
	$field_name = 'promotional_code';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Promotional code', 'custom-theme' ),
		"{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function promotional_code_display_meta_box( $post ) {
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

add_action( 'save_post', 'promotional_code_save_field', 10, 2 );

function promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'promotional_code', $post_id );
}

/*  Promotional Codes - Promotional Code End */

/*  Promotional Codes - Rating Start */

add_action( 'admin_init', 'promo_rating_field' );

function promo_rating_field() {

	$post_type = 'promo';

	add_meta_box(
		"{$post_type}_rating_meta_box",
		esc_html__( 'Promotional Code Overall Rating', 'custom-theme' ),
		'custom_overall_rating_display_meta_box',
		$post_type,
		'normal',
		'high'
	);
}

add_action( 'save_post', 'promo_rating_save_field', 10, 2 );

function promo_rating_save_field( $post_id ) {
	custom_save_post_type_field( 'promo', 'overall_rating', $post_id );
}

/*  Promotional Codes - Rating End */

/*  Promotional Codes - Additional Fields Start */

add_action( 'admin_init', 'promo_additional_fields' );

function promo_additional_fields() {
	$post_type = 'promo';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'promo_additional_save_fields', 10, 2 );

function promo_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'promo', $post_id );
}

/*  Promotional Codes - Additional Fields End */
