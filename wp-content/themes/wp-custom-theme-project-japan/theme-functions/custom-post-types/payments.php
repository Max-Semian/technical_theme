<?php

/*  Payments - Post Type Start */

add_action( 'init', 'init_custom_payments', 0 );

function init_custom_payments() {

	$payment_name = esc_html__( 'Payments', 'custom-theme' );

	if ( get_option( 'payments_section_name' ) ) {
		$payment_name = get_option( 'payments_section_name', 'Payments' );
	}

	$payment_args = array(
		'labels'             => array(
			'name'         => $payment_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'payment' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-store',
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
		'rest_base'          => 'payment',
		'rewrite'            => false,
	);

	register_post_type( 'payment', $payment_args );

	/* --- Payment Systems: Custom Taxonomy --- */

	$payment_systems_title = esc_html__( 'Payment systems', 'custom-theme' );

	$system_labels = array(
		'name'              => $payment_systems_title,
		'singular_name'     => $payment_systems_title,
		'search_items'      => esc_html__( 'Find Taxonomy', 'custom-theme' ),
		'all_items'         => esc_html__( 'All ', 'custom-theme' ) . $payment_systems_title,
		'parent_item'       => esc_html__( 'Parent Taxonomy', 'custom-theme' ),
		'parent_item_colon' => esc_html__( 'Parent Taxonomy:', 'custom-theme' ),
		'edit_item'         => esc_html__( 'Edit Taxonomy', 'custom-theme' ),
		'view_item'         => esc_html__( 'View Taxonomy', 'custom-theme' ),
		'update_item'       => esc_html__( 'Update Taxonomy', 'custom-theme' ),
		'add_new_item'      => esc_html__( 'Add New Taxonomy', 'custom-theme' ),
		'new_item_name'     => esc_html__( 'Taxonomy', 'custom-theme' ),
		'menu_name'         => $payment_systems_title,
	); 

	$system_args = array(
		'labels'                => $system_labels,
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

	register_taxonomy( 'payment-system', 'payment', $system_args );
}

/*  Payments - Post Type End */

/*  Payments - Short Description Start */

add_action( 'admin_init', 'payment_short_description_field' );

function payment_short_description_field() {
	$post_type  = 'payment';
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

function payment_short_description_display_meta_box( $post ) {
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

add_action( 'save_post', 'payment_short_description_save_field', 10, 2 );

function payment_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'short_desc', $post_id );
}

/*  Payments - Short Description End */

/*  Payments - Breadcrumb Title Start */

add_action( 'admin_init', 'payment_breadcrumb_title_field' );

function payment_breadcrumb_title_field() {
	$post_type  = 'payment';
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

function payment_breadcrumb_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'payment_breadcrumb_title_save_field', 10, 2 );

function payment_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'breadcrumb_title', $post_id );
}

/*  Payments - Breadcrumb Title End */

/*  Payments - Bonus Title Start */

add_action( 'admin_init', 'payment_bonus_title_field' );

function payment_bonus_title_field() {
	$post_type  = 'payment';
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

function payment_bonus_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'payment_bonus_title_save_field', 10, 2 );

function payment_bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'bonus_title', $post_id );
}

/*  Payments - Bonus Title End */

/*  Payments - Bonus Value Start */

add_action( 'admin_init', 'payment_bonus_value_field' );

function payment_bonus_value_field() {
	$post_type  = 'payment';
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

function payment_bonus_value_display_meta_box( $post ) {
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

add_action( 'save_post', 'payment_bonus_value_save_field', 10, 2 );

function payment_bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'bonus_value', $post_id );
}

/*  Payments - Bonus Value End */

/*  Payments - Promotional Code Start */

add_action( 'admin_init', 'payment_promotional_code_field' );

function payment_promotional_code_field() {
	$post_type  = 'payment';
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

function payment_promotional_code_display_meta_box( $post ) {
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

add_action( 'save_post', 'payment_promotional_code_save_field', 10, 2 );

function payment_promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'promotional_code', $post_id );
}

/*  Payments - Promotional Code End */

/*  Payments - Rating Start */

add_action( 'admin_init', 'payment_rating_field' );

function payment_rating_field() {

	$post_type = 'payment';

	add_meta_box(
		"{$post_type}_rating_meta_box",
		esc_html__( 'Payment Overall Rating', 'custom-theme' ),
		'custom_overall_rating_display_meta_box',
		$post_type,
		'normal',
		'high'
	);
}

add_action( 'save_post', 'payment_rating_save_field', 10, 2 );

function payment_rating_save_field( $post_id ) {
	custom_save_post_type_field( 'payment', 'overall_rating', $post_id );
}

/*  Payments - Rating End */

/*  Payments - Additional Fields Start */

add_action( 'admin_init', 'payment_additional_fields' );

function payment_additional_fields() {
	$post_type = 'payment';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'payment_additional_save_fields', 10, 2 );

function payment_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'payment', $post_id );
}

/*  Payments - Additional Fields End */

/*  Add Payment Systems Logo Start  */

add_action( 'payment-system_add_form_fields', 'add_taxonomy_taxonomy_image', 10, 2 );
add_action( 'created_payment-system', 'save_taxonomy_taxonomy_image', 10, 2 );
add_action( 'payment-system_edit_form_fields', 'edit_taxonomy_image_upload', 10, 2 );
add_action( 'edited_payment-system', 'update_taxonomy_image_upload', 10, 2 );

/*  Add Payment Systems Logo End  */
