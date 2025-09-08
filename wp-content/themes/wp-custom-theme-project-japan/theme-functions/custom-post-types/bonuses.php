<?php

/*  Bonuses - Post Type Start */

add_action( 'init', 'init_custom_bonuses', 0 );

function init_custom_bonuses() {

	$bonus_name = esc_html__( 'Bonuses', 'custom-theme' );

	if ( get_option( 'bonuses_section_name' ) ) {
		$bonus_name = get_option( 'bonuses_section_name', 'Bonuses' );
	}

	$bonus_args = array(
		'labels'             => array(
			'name'         => $bonus_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'bonus' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-money-alt',
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
		'rest_base'          => 'bonus',
		'rewrite'            => false,
	);

	register_post_type( 'bonus', $bonus_args );
}

/*  Bonuses - Post Type End */

/*  Bonuses - Short Description Start */

add_action( 'admin_init', 'bonus_short_description_field' );

function bonus_short_description_field() {
	$post_type  = 'bonus';
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

function bonus_short_description_display_meta_box( $post ) {
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

add_action( 'save_post', 'bonus_short_description_save_field', 10, 2 );

function bonus_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'short_desc', $post_id );
}

/*  Bonuses - Short Description End */

/*  Bonuses - Breadcrumb Title Start */

add_action( 'admin_init', 'bonus_breadcrumb_title_field' );

function bonus_breadcrumb_title_field() {
	$post_type  = 'bonus';
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

function bonus_breadcrumb_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'bonus_breadcrumb_title_save_field', 10, 2 );

function bonus_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'breadcrumb_title', $post_id );
}

/*  Bonuses - Breadcrumb Title End */

/*  Bonuses - Bonus Title Start */

add_action( 'admin_init', 'bonus_title_field' );

function bonus_title_field() {
	$post_type  = 'bonus';
	$field_name = 'bonus_title';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Bonus title', 'custom-theme' ),
		"{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function bonus_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'bonus_title_save_field', 10, 2 );

function bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'bonus_title', $post_id );
}

/*  Bonuses - Bonus Title End */

/*  Bonuses - Bonus Value Start */

add_action( 'admin_init', 'bonus_value_field' );

function bonus_value_field() {
	$post_type  = 'bonus';
	$field_name = 'bonus_value';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Bonus value', 'custom-theme' ),
		"{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function bonus_value_display_meta_box( $post ) {
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

add_action( 'save_post', 'bonus_value_save_field', 10, 2 );

function bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'bonus_value', $post_id );
}

/*  Bonuses - Bonus Value End */

/*  Bonuses - Promotional Code Start */

add_action( 'admin_init', 'bonus_promotional_code_field' );

function bonus_promotional_code_field() {
	$post_type  = 'bonus';
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

function bonus_promotional_code_display_meta_box( $post ) {
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

add_action( 'save_post', 'bonus_promotional_code_save_field', 10, 2 );

function bonus_promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'promotional_code', $post_id );
}

/*  Bonuses - Promotional Code End */

/*  Bonuses - Rating Start */

add_action( 'admin_init', 'bonus_rating_field' );

function bonus_rating_field() {

	$post_type = 'bonus';

	add_meta_box(
		"{$post_type}_rating_meta_box",
		esc_html__( 'Bonus Overall Rating', 'custom-theme' ),
		'custom_overall_rating_display_meta_box',
		$post_type,
		'normal',
		'high'
	);
}

add_action( 'save_post', 'bonus_rating_save_field', 10, 2 );

function bonus_rating_save_field( $post_id ) {
	custom_save_post_type_field( 'bonus', 'overall_rating', $post_id );
}

/*  Bonuses - Rating End */

/*  Bonuses - Additional Fields Start */

add_action( 'admin_init', 'bonus_additional_fields' );

function bonus_additional_fields() {
	$post_type = 'bonus';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'bonus_additional_save_fields', 10, 2 );

function bonus_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'bonus', $post_id );
}

/*  Bonuses - Additional Fields End */
