<?php

/*  Registration - Post Type Start */

add_action( 'init', 'init_custom_registration', 0 );

function init_custom_registration() {

	$registration_name = esc_html__( 'Registration', 'custom-theme' );

	if ( get_option( 'registration_section_name' ) ) {
		$registration_name = get_option( 'registration_section_name', 'Registration' );
	}

	$registration_args = array(
		'labels'             => array(
			'name'         => $registration_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'registration' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-admin-network',
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
		'rest_base'          => 'registration',
		'rewrite'            => false,
	);

	register_post_type( 'registration', $registration_args );
}
	
/*  Registration - Post Type End */

/*  Registration - Short Description Start */

add_action( 'admin_init', 'registration_short_description_field' );

function registration_short_description_field() {
	$post_type  = 'registration';
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

function registration_short_description_display_meta_box( $post ) {
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

add_action( 'save_post', 'registration_short_description_save_field', 10, 2 );

function registration_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'short_desc', $post_id );
}

/*  Registration - Short Description End */

/*  Registration - Breadcrumb Title Start */

add_action( 'admin_init', 'registration_breadcrumb_title_field' );

function registration_breadcrumb_title_field() {
	$post_type  = 'registration';
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

function registration_breadcrumb_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'registration_breadcrumb_title_save_field', 10, 2 );

function registration_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'breadcrumb_title', $post_id );
}

/*  Registration - Breadcrumb Title End */

/*  Registration - Bonus Title Start */

add_action( 'admin_init', 'registration_bonus_title_field' );

function registration_bonus_title_field() {
	$post_type  = 'registration';
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

function registration_bonus_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'registration_bonus_title_save_field', 10, 2 );

function registration_bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'bonus_title', $post_id );
}

/*  Registration - Bonus Title End */

/*  Registration - Bonus Value Start */

add_action( 'admin_init', 'registration_bonus_value_field' );

function registration_bonus_value_field() {
	$post_type  = 'registration';
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

function registration_bonus_value_display_meta_box( $post ) {
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

add_action( 'save_post', 'registration_bonus_value_save_field', 10, 2 );

function registration_bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'bonus_value', $post_id );
}

/*  Registration - Bonus Value End */

/*  Registration - Promotional Code Start */

add_action( 'admin_init', 'registration_promotional_code_field' );

function registration_promotional_code_field() {
	$post_type  = 'registration';
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

function registration_promotional_code_display_meta_box( $post ) {
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

add_action( 'save_post', 'registration_promotional_code_save_field', 10, 2 );

function registration_promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'promotional_code', $post_id );
}

/*  Registration - Promotional Code End */

/*  Registration - Rating Start */

add_action( 'admin_init', 'registration_rating_field' );

function registration_rating_field() {

	$post_type = 'registration';

	add_meta_box(
		"{$post_type}_rating_meta_box",
		esc_html__( 'Registration Overall Rating', 'custom-theme' ),
		'custom_overall_rating_display_meta_box',
		$post_type,
		'normal',
		'high'
	);
}

add_action( 'save_post', 'registration_rating_save_field', 10, 2 );

function registration_rating_save_field( $post_id ) {
	custom_save_post_type_field( 'registration', 'overall_rating', $post_id );
}

/*  Registration - Rating End */

/*  Registration - Additional Fields Start */

add_action( 'admin_init', 'registration_additional_fields' );

function registration_additional_fields() {
	$post_type = 'registration';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'registration_additional_save_fields', 10, 2 );

function registration_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'registration', $post_id );
}

/*  Registration - Additional Fields End */
