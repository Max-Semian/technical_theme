<?php

/*  Organizations - Post Type Start */

add_action( 'init', 'init_custom_organizations', 0 );

function init_custom_organizations() {

	$organization_name = esc_html__( 'Organizations', 'custom-theme' );

	if ( get_option( 'organizations_section_name' ) ) {
		$organization_name = get_option( 'organizations_section_name', 'Organizations' );
	}

	$organization_slug = 'organization';

	if ( get_option( 'organization_section_slug' ) ) {
		$organization_slug = get_option( 'organization_section_slug', 'organization' );
	}

	$organization_args = array(
		'labels'             => array(
			'name'         => $organization_name,
			'add_new'      => esc_html__( 'Add New', 'custom-theme' ),
			'edit_item'    => esc_html__( 'Edit Item', 'custom-theme' ),
			'add_new_item' => esc_html__( 'Add New', 'custom-theme' ),
			'view_item'    => esc_html__( 'View Item', 'custom-theme' ),
		),
		'singular_label'     => __( 'organization' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-welcome-widgets-menus',
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
		'rest_base'          => 'organization',
		'rewrite'            => array(
			'slug'       => $organization_slug,
			'with_front' => false,
		),
	);

	register_post_type( 'organization', $organization_args );
}

/*  Organizations - Post Type End */

/*  Organizations - Short Description Start */

add_action( 'admin_init', 'organization_short_description_field' );

function organization_short_description_field() {
	$post_type  = 'organization';
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

function organization_short_description_display_meta_box( $post ) {
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

add_action( 'save_post', 'organization_short_description_save_field', 10, 2 );

function organization_short_description_save_field( $post_id ) {
	custom_save_post_type_field( 'organization', 'short_desc', $post_id );
}

/*  Organizations - Short Description End */

/*  Organizations - Breadcrumb Title Start */

add_action( 'admin_init', 'organization_breadcrumb_title_field' );

function organization_breadcrumb_title_field() {
	$post_type  = 'organization';
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

function organization_breadcrumb_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'organization_breadcrumb_title_save_field', 10, 2 );

function organization_breadcrumb_title_save_field( $post_id ) {
	custom_save_post_type_field( 'organization', 'breadcrumb_title', $post_id );
}

/*  Organizations - Breadcrumb Title End */

/*  Organizations - Bonus Title Start */

add_action( 'admin_init', 'organization_bonus_title_field' );

function organization_bonus_title_field() {
	$post_type  = 'organization';
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

function organization_bonus_title_display_meta_box( $post ) {
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

add_action( 'save_post', 'organization_bonus_title_save_field', 10, 2 );

function organization_bonus_title_save_field( $post_id ) {
	custom_save_post_type_field( 'organization', 'bonus_title', $post_id );
}

/*  Organizations - Bonus Title End */

/*  Organizations - Bonus Value Start */

add_action( 'admin_init', 'organization_bonus_value_field' );

function organization_bonus_value_field() {
	$post_type  = 'organization';
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

function organization_bonus_value_display_meta_box( $post ) {
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

add_action( 'save_post', 'organization_bonus_value_save_field', 10, 2 );

function organization_bonus_value_save_field( $post_id ) {
	custom_save_post_type_field( 'organization', 'bonus_value', $post_id );
}

/*  Organizations - Bonus Value End */

/*  Organizations - Promotional Code Start */

add_action( 'admin_init', 'organization_promotional_code_field' );

function organization_promotional_code_field() {
	$post_type  = 'organization';
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

function organization_promotional_code_display_meta_box( $post ) {
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

add_action( 'save_post', 'organization_promotional_code_save_field', 10, 2 );

function organization_promotional_code_save_field( $post_id ) {
	custom_save_post_type_field( 'organization', 'promotional_code', $post_id );
}

/*  Organizations - Promotional Code End */

/*  Organizations - Ratings Start */

add_action( 'admin_init', 'organization_ratings_fields' );

function organization_ratings_fields() {
	$post_type = 'organization';

	add_meta_box(
		"{$post_type}_ratings_meta_box",
		esc_html__( 'Item Ratings', 'custom-theme' ),
		"{$post_type}_ratings_display_meta_box",
		$post_type,
		'normal',
		'high'
	);
}

function organization_ratings_display_meta_box( $organization ) {

	wp_nonce_field( 'organization_ratings_box', 'organization_ratings_nonce' );
	$meta = get_post_meta( $organization->ID );

	$organization_rating_trust    = ( isset( $meta['organization_rating_trust'][0] ) && '' !== $meta['organization_rating_trust'][0] ) ? $meta['organization_rating_trust'][0] : '';
	$organization_rating_games    = ( isset( $meta['organization_rating_games'][0] ) && '' !== $meta['organization_rating_games'][0] ) ? $meta['organization_rating_games'][0] : '';
	$organization_rating_bonus    = ( isset( $meta['organization_rating_bonus'][0] ) && '' !== $meta['organization_rating_bonus'][0] ) ? $meta['organization_rating_bonus'][0] : '';
	$organization_rating_customer = ( isset( $meta['organization_rating_customer'][0] ) && '' !== $meta['organization_rating_customer'][0] ) ? $meta['organization_rating_customer'][0] : '';
	$organization_rating_pre      = ( isset( $meta['organization_rating_pre'][0] ) && '' !== $meta['organization_rating_pre'][0] ) ? $meta['organization_rating_pre'][0] : '';
	$organization_rating_live     = ( isset( $meta['organization_rating_live'][0] ) && '' !== $meta['organization_rating_live'][0] ) ? $meta['organization_rating_live'][0] : '';
	$organization_rating_coef     = ( isset( $meta['organization_rating_coef'][0] ) && '' !== $meta['organization_rating_coef'][0] ) ? $meta['organization_rating_coef'][0] : '';
	$organization_rating_payments = ( isset( $meta['organization_rating_payments'][0] ) && '' !== $meta['organization_rating_payments'][0] ) ? $meta['organization_rating_payments'][0] : '';
	$organization_rating_features = ( isset( $meta['organization_rating_features'][0] ) && '' !== $meta['organization_rating_features'][0] ) ? $meta['organization_rating_features'][0] : '';

	function organization_rating_display_meta_box( $args ) {
		$defaults = array(
			'rating_type'              => '',
			'meta_rating'              => 0,
			'default_title'            => '',
			'rating_title_option_name' => '',
		);
		
		$parsed_args = wp_parse_args( $args, $defaults );
	
		$rating_type              = $parsed_args['rating_type'];
		$meta_rating              = $parsed_args['meta_rating'];
		$default_title            = $parsed_args['default_title'];
		$rating_title_option_name = $parsed_args['rating_title_option_name'];
	
		if ( get_option( 'custom_rating_stars_number' ) ) {
			$rating_stars_number_value = get_option( 'custom_rating_stars_number' );
		} else {
			$rating_stars_number_value = '5';
		}
	
		?>
	
		<div class="components-base-control">
			<div class="components-base-control__field">
				<label class="components-base-control__label">
					<?php
	
					$rating_title = get_option( $rating_title_option_name );
	
					if ( $rating_title ) {
						echo esc_html( $rating_title );
					} else {
						echo esc_html( $default_title );
					}
					?>
				</label>
	
				<div class="custom-theme-single-rating-box">
					<?php
					for ( $i = 0; $i <= $rating_stars_number_value; $i++ ) {
						?>
						<label>
							<input type="radio" name="organization_rating_<?php echo esc_attr( $rating_type ); ?>" value="<?php echo esc_attr( $i ); ?>" <?php checked( $meta_rating, $i ); ?>>
							<?php echo esc_attr( $i ); ?>
						</label>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	
		<?php 
	}

	?>

<style type="text/css">
	.custom-theme-single-rating-box {
		padding-bottom: 10px;
	}
	
	.custom-theme-single-rating-box label {
		padding-right: 12px;
	}

	.custom-theme-single-rating-box label:last-child {
		padding-right: 0;
	}

	.custom-theme-single-rating-box label input[type=radio] {
		margin-right: 0 !important;
	}
</style>

	<?php 

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'trust',
			'meta_rating'              => $organization_rating_trust,
			'rating_title_option_name' => 'rating_1',
			'default_title'            => esc_html__( 'Trust & Fairness', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'games',
			'meta_rating'              => $organization_rating_games,
			'rating_title_option_name' => 'rating_2',
			'default_title'            => esc_html__( 'Games & Software', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'bonus',
			'meta_rating'              => $organization_rating_bonus,
			'rating_title_option_name' => 'rating_3',
			'default_title'            => esc_html__( 'Bonuses & Promotions', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'customer',
			'meta_rating'              => $organization_rating_customer,
			'rating_title_option_name' => 'rating_4',
			'default_title'            => esc_html__( 'Customer Support', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'pre',
			'meta_rating'              => $organization_rating_pre,
			'rating_title_option_name' => 'rating_5',
			'default_title'            => esc_html__( 'In the pre', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'live',
			'meta_rating'              => $organization_rating_live,
			'rating_title_option_name' => 'rating_6',
			'default_title'            => esc_html__( 'Live', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'coef',
			'meta_rating'              => $organization_rating_coef,
			'rating_title_option_name' => 'rating_7',
			'default_title'            => esc_html__( 'Coefficients', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'payments',
			'meta_rating'              => $organization_rating_payments,
			'rating_title_option_name' => 'rating_8',
			'default_title'            => esc_html__( 'Convenience of payments', 'custom-theme' ),
		) 
	);

	organization_rating_display_meta_box(
		array(
			'rating_type'              => 'features',
			'meta_rating'              => $organization_rating_features,
			'rating_title_option_name' => 'rating_9',
			'default_title'            => esc_html__( 'Interface/Features', 'custom-theme' ),
		) 
	);
}

add_action( 'save_post', 'organization_ratings_save_fields', 10, 2 );

function organization_ratings_save_fields( $post_id ) {

	if ( ! isset( $_POST['organization_ratings_nonce'] ) ) {
		return $post_id;
	}

	$nonce = $_POST['organization_ratings_nonce'];

	if ( ! wp_verify_nonce( $nonce, 'organization_ratings_box' ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'organization' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	}

	if ( isset( $_POST['organization_rating_trust'] ) ) {
		update_post_meta( $post_id, 'organization_rating_trust', sanitize_text_field( wp_unslash( $_POST['organization_rating_trust'] ) ) );
	}

	if ( isset( $_POST['organization_rating_games'] ) ) {
		update_post_meta( $post_id, 'organization_rating_games', sanitize_text_field( wp_unslash( $_POST['organization_rating_games'] ) ) );
	}

	if ( isset( $_POST['organization_rating_bonus'] ) ) {
		update_post_meta( $post_id, 'organization_rating_bonus', sanitize_text_field( wp_unslash( $_POST['organization_rating_bonus'] ) ) );
	}

	if ( isset( $_POST['organization_rating_customer'] ) ) {
		update_post_meta( $post_id, 'organization_rating_customer', sanitize_text_field( wp_unslash( $_POST['organization_rating_customer'] ) ) );
	}

	if ( isset( $_POST['organization_rating_pre'] ) ) {
		update_post_meta( $post_id, 'organization_rating_pre', sanitize_text_field( wp_unslash( $_POST['organization_rating_pre'] ) ) );
	}

	if ( isset( $_POST['organization_rating_live'] ) ) {
		update_post_meta( $post_id, 'organization_rating_live', sanitize_text_field( wp_unslash( $_POST['organization_rating_live'] ) ) );
	}

	if ( isset( $_POST['organization_rating_coef'] ) ) {
		update_post_meta( $post_id, 'organization_rating_coef', sanitize_text_field( wp_unslash( $_POST['organization_rating_coef'] ) ) );
	}

	if ( isset( $_POST['organization_rating_payments'] ) ) {
		update_post_meta( $post_id, 'organization_rating_payments', sanitize_text_field( wp_unslash( $_POST['organization_rating_payments'] ) ) );
	}

	if ( isset( $_POST['organization_rating_features'] ) ) {
		update_post_meta( $post_id, 'organization_rating_features', sanitize_text_field( wp_unslash( $_POST['organization_rating_features'] ) ) );
	}

	if ( ! wp_is_post_revision( $post_id ) ) {

		$organization_rating_trust    = get_post_meta( $post_id, 'organization_rating_trust', true );
		$organization_rating_games    = get_post_meta( $post_id, 'organization_rating_games', true );
		$organization_rating_bonus    = get_post_meta( $post_id, 'organization_rating_bonus', true );
		$organization_rating_customer = get_post_meta( $post_id, 'organization_rating_customer', true );
		$organization_rating_pre      = get_post_meta( $post_id, 'organization_rating_pre', true );
		$organization_rating_live     = get_post_meta( $post_id, 'organization_rating_live', true );
		$organization_rating_coef     = get_post_meta( $post_id, 'organization_rating_coef', true );
		$organization_rating_payments = get_post_meta( $post_id, 'organization_rating_payments', true );
		$organization_rating_features = get_post_meta( $post_id, 'organization_rating_features', true );
		
		$organization_ratings_all = array(
			$organization_rating_trust,
			$organization_rating_games,
			$organization_rating_bonus,
			$organization_rating_customer,
			$organization_rating_pre,
			$organization_rating_live,
			$organization_rating_coef,
			$organization_rating_payments,
			$organization_rating_features,
		);

		function filter_rating_callback( $rating ) {
			return intval( $rating ) > 0;
		}
		
		$organization_ratings_all_filtered = array_filter( $organization_ratings_all, 'filter_rating_callback' );

		$organization_overall_rating = esc_html( array_sum( $organization_ratings_all_filtered ) / count( $organization_ratings_all_filtered ) );

		if ( is_float( $organization_overall_rating ) ) {
			$organization_overall_rating = number_format( $organization_overall_rating, 1 ); 
		}

		update_post_meta( $post_id, 'organization_overall_rating', $organization_overall_rating );

	}
}

/*  Organizations - Ratings End */

/*  Organizations - Additional Fields Start */

add_action( 'admin_init', 'organization_additional_fields' );

function organization_additional_fields() {
	$post_type = 'organization';

	add_meta_box(
		"{$post_type}_additional_meta_box",
		esc_html__( 'Additional information', 'custom-theme' ),
		'custom_additional_fields_display_meta_box',
		$post_type,
		'side',
		'high'
	);
}

add_action( 'save_post', 'organization_additional_save_fields', 10, 2 );

function organization_additional_save_fields( $post_id ) {
	custom_additional_fields_save_field( 'organization', $post_id );
}

/*  Organizations - Additional Fields End */

/*  Upload Mobile image of organization single page - Start  */

add_action( 'admin_menu', 'organization_mobile_image_block' );

function organization_mobile_image_block() {
	$post_type  = 'organization';
	$field_name = 'mobile_image';

	add_meta_box(
		"{$post_type}_{$field_name}_meta_box",
		esc_html__( 'Mobile Image', 'custom-theme' ),
		"{$post_type}_{$field_name}_display_meta_box",
		$post_type,
		'normal',
		'core'
	);
}

function organization_mobile_image_display_meta_box( $organization ) {
	$post_type                      = 'organization';
	$field_name                     = 'mobile_image';
	$organization_mobile_image_name = "{$post_type}_{$field_name}";

	wp_nonce_field( "{$organization_mobile_image_name}_box", "{$organization_mobile_image_name}_nonce" );

	echo custom_image_uploader( $organization_mobile_image_name, get_post_meta( $organization->ID, $organization_mobile_image_name, true ), 'medium' );
}
 
add_action( 'save_post', 'custom_organization_mobile_image_block_save' );

function custom_organization_mobile_image_block_save( $post_id ) {
	custom_save_post_type_field( 'organization', 'mobile_image', $post_id );
}

/*  Upload Mobile image of organization single page - End  */

/*  Display the Relationship of the Organization and Child Post Types Start  */

add_action( 'admin_init', 'custom_organization_post_types_list' );

function custom_organization_post_types_list() {

	$apps_section_name = esc_html__( 'Apps', 'custom-theme' );
	$post_type         = 'organization';

	if ( get_option( 'apps_section_name' ) ) {
		$apps_section_name = get_option( 'apps_section_name', 'Apps' );
	}

	add_meta_box(
		"custom_${post_type}_apps_list_meta_box",
		$apps_section_name,
		"custom_${post_type}_display_apps_list_meta_box",
		$post_type,
		'side',
		'high'
	);

	$payments_section_name = esc_html__( 'Payments', 'custom-theme' );

	if ( get_option( 'payments_section_name' ) ) {
		$payments_section_name = get_option( 'payments_section_name', 'Payments' );
	}

	add_meta_box(
		"custom_${post_type}_payments_list_meta_box",
		$payments_section_name,
		"custom_${post_type}_display_payments_list_meta_box",
		$post_type,
		'side',
		'high'
	);

	$registration_section_name = esc_html__( 'Registration', 'custom-theme' );

	if ( get_option( 'registration_section_name' ) ) {
		$registration_section_name = get_option( 'registration_section_name', 'Registration' );
	}

	add_meta_box(
		"custom_{$post_type}_registration_list_meta_box",
		$registration_section_name,
		"custom_{$post_type}_display_registration_list_meta_box",
		$post_type,
		'side',
		'high'
	);

	$bonuses_section_name = esc_html__( 'Bonuses', 'custom-theme' );

	if ( get_option( 'bonuses_section_name' ) ) {
		$bonuses_section_name = get_option( 'bonuses_section_name', 'Bonuses' );
	}

	add_meta_box(
		"custom_{$post_type}_bonuses_list_meta_box",
		$bonuses_section_name,
		"custom_{$post_type}_display_bonuses_list_meta_box",
		$post_type,
		'side',
		'high'
	);

	$promo_section_name = esc_html__( 'Promotional codes', 'custom-theme' );

	if ( get_option( 'promo_section_name' ) ) {
		$promo_section_name = get_option( 'promo_section_name', 'Promotional codes' );
	}

	add_meta_box(
		"custom_{$post_type}_promo_list_meta_box",
		$promo_section_name,
		"custom_{$post_type}_display_promo_list_meta_box",
		$post_type,
		'side',
		'high'
	);
}

function custom_organization_display_child_list_meta_box( $child_post_type, $post_parent ) {
	$posts = get_posts(
		array(
			'post_type'      => $child_post_type,
			'posts_per_page' => -1,
			'orderby'        => 'post_title',
			'order'          => 'ASC',
			'post_parent'    => $post_parent->ID,
			
		)
	);

	if ( $posts ) {
		?>
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
			<?php foreach ( $posts as $post ) { ?>
				<li><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" title="<?php echo esc_attr( $post->post_title ); ?>" target="_blank"><?php echo esc_html( $post->post_title ); ?></a></li>
			<?php } ?>
			</ul>
		</div>
		<?php
	} else {
		esc_html_e( 'No items', 'custom-theme' );
	}
}

/*  Display the Relationship of the Organization and Apps Start  */

function custom_organization_display_apps_list_meta_box( $post ) {
	custom_organization_display_child_list_meta_box( 'app', $post );
}

/*  Display the Relationship of the Organization and Apps End  */

/*  Display the Relationship of the Organization and Payments Start  */

function custom_organization_display_payments_list_meta_box( $post ) {
	custom_organization_display_child_list_meta_box( 'payment', $post );
}

/*  Display the Relationship of the Organization and Payments End  */

/*  Display the Relationship of the Organization and Registration Start  */

function custom_organization_display_registration_list_meta_box( $post ) {
	custom_organization_display_child_list_meta_box( 'registration', $post );
}

/*  Display the Relationship of the Organization and Registration End  */

/*  Display the Relationship of the Organization and Bonuses Start  */

function custom_organization_display_bonuses_list_meta_box( $post ) {
	custom_organization_display_child_list_meta_box( 'bonus', $post );
}

/*  Display the Relationship of the Organization and Bonuses End  */

/*  Display the Relationship of the Organization and Promo Start  */

function custom_organization_display_promo_list_meta_box( $post ) {
	custom_organization_display_child_list_meta_box( 'promo', $post );
}

/*  Display the Relationship of the Organization and Promo End  */

/*  Display the Relationship of the Organization and Child Post Types End  */
