<?php

/*  The standard field for the upload image of custom single page - Start  */

function custom_image_uploader( $name, $value = '', $size = '' ) {
	$image   = ' button">' . esc_html__( 'Upload image', 'custom-theme' );
	$display = 'none';
 
	if ( $image_attributes = wp_get_attachment_image_src( $value, $size ) ) {
		$image   = '"><img src="' . $image_attributes[0] . '" style="max-width: 100%; width: auto; display: block;" />';
		$display = 'block';
	} 
 
	return '
		<div style="margin-top: 1em;">
			<a href="#" style="display: inline-block;" class="custom_upload_button' . $image . '</a>
			<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . esc_attr( $value ) . '" />
			<a href="#" class="custom_remove_button components-button is-link is-destructive" style="margin-top: 1em; display:' . $display . '">' . esc_html__( 'Remove image', 'custom-theme' ) . '</a>
		</div>
	';
}

/*  The standard field for the upload image of custom single page - End  */

/*  Add Taxonomy Logo Start  */

/* --- Add custom taxonomy field --- */

function add_taxonomy_taxonomy_image( $taxonomy ) {
	?>
<div class="form-field term-group">
	<label for="taxonomy-image-id">
		<?php esc_html_e( 'Logo', 'custom-theme' ); ?>
	</label>
	<input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" class="custom_media_url" value="">
	<div id="taxonomy-image-wrapper"></div>
	<p>
		<input type="button" class="button button-secondary custom_media_button" id="custom_media_button" name="custom_media_button" value="<?php esc_attr_e( 'Add Logo', 'custom-theme' ); ?>" />
		<input type="button" class="button button-secondary custom_media_remove" id="custom_media_remove" name="custom_media_remove" value="<?php esc_attr_e( 'Remove Logo', 'custom-theme' ); ?>" />
	</p>
</div>
	<?php
}

/* --- Save the custom taxonomy field --- */

function save_taxonomy_taxonomy_image( $term_id, $tt_id ) {
	if ( isset( $_POST['taxonomy-image-id'] ) && '' !== $_POST['taxonomy-image-id'] ) {
		$image = esc_attr( $_POST['taxonomy-image-id'] );
		add_term_meta( $term_id, 'taxonomy-image-id', $image, true );
	}
}

/* --- Add custom taxonomy field for edit --- */

function edit_taxonomy_image_upload( $term, $taxonomy ) {
	?>
<tr class="form-field term-group-wrap">
	<th scope="row">
		<label for="taxonomy-image-id">
			<?php esc_html_e( 'Logo', 'custom-theme' ); ?>
		</label>
	</th>
	<td>
		<?php $image_id = get_term_meta( $term->term_id, 'taxonomy-image-id', true ); ?>
		<input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
		<div id="taxonomy-image-wrapper">
		<?php if ( $image_id ) { ?>
			<?php echo wp_get_attachment_image( $image_id ); ?>
		<?php } ?>
			</div>
			<p>
			<input type="button" class="button button-secondary custom_media_button" id="custom_media_button" name="custom_media_button" value="<?php esc_attr_e( 'Add Logo', 'custom-theme' ); ?>" />
			<input type="button" class="button button-secondary custom_media_remove" id="custom_media_remove" name="custom_media_remove" value="<?php esc_attr_e( 'Remove Logo', 'custom-theme' ); ?>" />
		</p>
	</td>
</tr>
	<?php
}

/* --- Save the edited value of the custom taxonomy field --- */

function update_taxonomy_system_image_upload( $term_id, $tt_id ) {
	if ( isset( $_POST['taxonomy-image-id'] ) && '' !== $_POST['taxonomy-image-id'] ) {
		$image = esc_attr( $_POST['taxonomy-image-id'] );
		update_term_meta( $term_id, 'taxonomy-image-id', $image );
	} else {
		update_term_meta( $term_id, 'taxonomy-image-id', '' );
	}
}

/*  Add Taxonomy Logo End  */

/*  Add Custom Text Field Start */

function custom_text_field_display_meta_box( $field_name, $post, $editor_args = array(), $label = '' ) {

	$post_type = $post->post_type;

	wp_nonce_field( "{$post_type}_{$field_name}_box", "{$post_type}_{$field_name}_nonce" );

	$field_value = get_post_meta( $post->ID, "{$post_type}_{$field_name}", false );
	
	?>

	<div class="components-base-control">
		<div class="components-base-control__field">
			<?php
			if ( empty( $field_value[0] ) ) {
				$field_value[0] = '';
			}

			if ( ! empty( $label ) ) { 
				?>

				<label class="components-base-control__label">
					<?php echo esc_html( $label ); ?>
				</label>
				
				<?php 
			}

			wp_editor( $field_value[0], "{$post_type}_{$field_name}", $editor_args );
			?>
		</div>
	</div>

	<?php
}

function custom_save_post_type_field( $post_type, $field_name, $post_id ) {

	if ( ! isset( $_POST[ "{$post_type}_{$field_name}_nonce" ] ) ) {
		return $post_id;
	}

	$nonce = $_POST[ "{$post_type}_{$field_name}_nonce" ];

	if ( ! wp_verify_nonce( $nonce, "{$post_type}_{$field_name}_box" ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( $post_type === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	}

	if ( isset( $_POST[ "{$post_type}_{$field_name}" ] ) ) {
		update_post_meta( $post_id, "{$post_type}_{$field_name}", sanitize_text_field( wp_unslash( $_POST[ "{$post_type}_{$field_name}" ] ) ) );
	}
}

/*  Add Custom Text Field End */

/*  Add Custom Overall Rating Start  */

function custom_overall_rating_display_meta_box( $post ) {

	$meta      = get_post_meta( $post->ID );
	$post_type = $post->post_type;

	wp_nonce_field( "{$post_type}_rating_box", "{$post_type}_rating_nonce" );

	$post_overall_rating = ( isset( $meta[ "{$post_type}_overall_rating" ][0] ) && '' !== $meta[ "{$post_type}_overall_rating" ][0] ) ? $meta[ "{$post_type}_overall_rating" ][0] : '';

	// Get the number of stars in the rating

	$rating_stars_number_value = 5;

	if ( get_option( "{$post_type}_rating_stars_number" ) ) {
		$rating_stars_number_value = get_option( "{$post_type}_rating_stars_number" );
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

<div class="components-base-control post_overall_rating">
	<div class="components-base-control__field">
		<div class="custom-theme-single-rating-box">
			<?php
			for ( $i = 0; $i <= $rating_stars_number_value; $i++ ) {
				?>
				<label>
					<input type="radio" name="<?php echo esc_attr( $post_type ); ?>_overall_rating" value="<?php echo esc_attr( $i ); ?>" <?php checked( $post_overall_rating, $i ); ?>>
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

/*  Add Custom Overall Rating End  */

/*  Add Additional Fields Start */

function custom_additional_fields_display_meta_box( $post ) {

	$post_type = $post->post_type;

	wp_nonce_field( "{$post_type}_additional_box", "{$post_type}_additional_nonce" );

	$post_external_link          = get_post_meta( $post->ID, "{$post_type}_external_link", true );
	$post_button_title           = get_post_meta( $post->ID, "{$post_type}_button_title", true );
	$post_permalink_button_title = get_post_meta( $post->ID, "{$post_type}_permalink_button_title", true );

	?>

<div class="components-base-control">
	<div class="components-base-control__field">
		<label class="components-base-control__label" for="<?php echo esc_attr( $post_type ); ?>_external_link-0"><?php esc_html_e( 'External URL for the', 'custom-theme' ); ?> <strong><?php esc_html_e( 'Follow Link', 'custom-theme' ); ?></strong> <?php esc_html_e( 'button', 'custom-theme' ); ?></label>
		<input type="url" name="<?php echo esc_attr( $post_type ); ?>_external_link" id="<?php echo esc_attr( $post_type ); ?>_external_link-0" value="<?php echo esc_url( $post_external_link ); ?>" style="display: block; margin-bottom: 10px;" />
	</div>
</div>

<div class="components-base-control">
	<div class="components-base-control__field">
		<label class="components-base-control__label" for="<?php echo esc_attr( $post_type ); ?>_button_title-0"><?php esc_html_e( 'Custom title for the', 'custom-theme' ); ?> <strong><?php esc_html_e( 'Follow Link', 'custom-theme' ); ?></strong> <?php esc_html_e( 'button', 'custom-theme' ); ?></label>
		<input type="text" name="<?php echo esc_attr( $post_type ); ?>_button_title" id="<?php echo esc_attr( $post_type ); ?>_button_title-0" value="<?php echo esc_attr( $post_button_title ); ?>" style="display: block; margin-bottom: 10px;" />
	</div>
</div>

<div class="components-base-control">
	<div class="components-base-control__field">
		<label class="components-base-control__label" for="<?php echo esc_attr( $post_type ); ?>_permalink_button_title-0"><?php esc_html_e( 'Custom title for the', 'custom-theme' ); ?> <strong><?php esc_html_e( 'Read', 'custom-theme' ); ?></strong> <?php esc_html_e( 'button', 'custom-theme' ); ?></label>
		<input type="text" name="<?php echo esc_attr( $post_type ); ?>_permalink_button_title" id="<?php echo esc_attr( $post_type ); ?>_permalink_button_title-0" value="<?php echo esc_attr( $post_permalink_button_title ); ?>" style="display: block; margin-bottom: 10px;" />
	</div>
</div>

	<?php
}

function custom_additional_fields_save_field( $post_type, $post_id ) {

	if ( ! isset( $_POST[ "{$post_type}_additional_nonce" ] ) ) {
		return $post_id;
	}

	$nonce = $_POST[ "{$post_type}_additional_nonce" ];

	if ( ! wp_verify_nonce( $nonce, "{$post_type}_additional_box" ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( $post_type === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	}

	$post_external_link = esc_url( $_POST[ "{$post_type}_external_link" ] );
	update_post_meta( $post_id, "{$post_type}_external_link", $post_external_link );

	$post_button_title = sanitize_text_field( $_POST[ "{$post_type}_button_title" ] );
	update_post_meta( $post_id, "{$post_type}_button_title", $post_button_title );

	$post_permalink_button_title = sanitize_text_field( $_POST[ "{$post_type}_permalink_button_title" ] );
	update_post_meta( $post_id, "{$post_type}_permalink_button_title", $post_permalink_button_title );
}

/*  Add Additional Fields End */

/** Custom Organizations - Start  */

require_once __DIR__ . '/custom-post-types/organizations.php';

/**  Custom Organizations - End  */

/** Custom Apps - Start  */

require_once __DIR__ . '/custom-post-types/apps.php';

/**  Custom Apps - End  */

/** Custom Payments - Start  */

require_once __DIR__ . '/custom-post-types/payments.php';

/**  Custom Payments - End  */

/** Custom Registration - Start  */

require_once __DIR__ . '/custom-post-types/registration.php';

/**  Custom Registration - End  */

/** Custom Bonuses - Start  */

require_once __DIR__ . '/custom-post-types/bonuses.php';

/**  Custom Bonuses - End  */

/** Custom Promo - Start  */

require_once __DIR__ . '/custom-post-types/promo.php';

/**  Custom Promo - End  */

/*  Relationship of the Child Post Types and Organizations Start  */

add_action( 'admin_init', 'custom_post_types_organizations_list' );

function custom_post_types_organizations_list() {

	$organizations_section_name = esc_html__( 'Organizations', 'custom-theme' );

	if ( get_option( 'organizations_section_name' ) ) {
		$organizations_section_name = get_option( 'organizations_section_name', 'Organizations' );
	}

	$custom_child_post_types = array( 'app', 'payment', 'promo', 'registration', 'bonus' );

	foreach ( $custom_child_post_types as $post_type ) {
		add_meta_box(
			"custom_{$post_type}_organizations_list_meta_box",
			$organizations_section_name,
			'custom_post_types_display_organizations_list_meta_box',
			$post_type,
			'side',
			'high'
		);
	}
}

function custom_post_types_display_organizations_list_meta_box( $post ) {
	$organizations = get_posts(
		array(
			'post_type'      => 'organization',
			'posts_per_page' => -1,
			'orderby'        => 'post_title',
			'order'          => 'ASC',
		) 
	);

	if ( $organizations ) {
		$elements = array();

		foreach ( $organizations as $organization ) {
			$elements[ $organization->ID ] = $organization->post_title;
		}

		?>
	<div style="max-height:200px; overflow-y:auto;">
		<ul>
			<li>
				<label>
					<input type="radio" name="post_parent" value="0" <?php checked( 0, $post->post_parent ); ?>>
					<?php esc_html_e( 'Without parent', 'custom-theme' ); ?>
				</label>
			</li>
			<?php foreach ( $elements as $id => $element ) { ?>
				<li>
					<label>
						<input type="radio" name="post_parent" value="<?php echo esc_attr( $id ); ?>" <?php checked( $id, $post->post_parent ); ?>>
						<?php echo esc_html( $element ); ?>
					</label>
				</li>
			<?php } ?>
		</ul>
	</div>
		<?php
	} else {
		esc_html_e( 'No items', 'custom-theme' );
	}
}

/*  Relationship of the Child Post Types and Organizations End  */

/*  Rewrite Links Of Custom Post Types Start  */

add_action( 'init', 'custom_posts_rewrite_rules' );

function custom_posts_rewrite_rules() {
	$custom_child_post_types = array( 'app', 'payment', 'promo', 'registration', 'bonus' );
	
	foreach ( $custom_child_post_types as $post_type ) {
		$rewrite_tag = '%' . $post_type . '%';

		add_rewrite_tag( $rewrite_tag, '([^/]+)', $post_type . '=' );

		$organization_slug = 'organization';

		if ( get_option( 'organization_section_slug' ) ) {
			$organization_slug = get_option( 'organization_section_slug', 'organization' );
		}
		
		add_permastruct( $post_type, "$organization_slug/%parent_name%/$rewrite_tag", false );
		
		add_rewrite_rule( "^$organization_slug/([^/]+)/([^/]+)/?", 'index.php?' . $post_type . '=$matches[2]', 'top' );
	}
}

function custom_post_type_permalinks( $link, $post ) {
	$custom_child_post_types = array( 'app', 'payment', 'promo', 'registration', 'bonus' );

	if ( in_array( get_post_type( $post ), $custom_child_post_types ) ) {
		if ( $post->post_parent ) {
			$parent = get_post( $post->post_parent );

			if ( ! empty( $parent->post_name ) ) {
				return str_replace( '%parent_name%', $parent->post_name, $link );
			}
		}   
	}
	return $link;
}

add_filter( 'post_type_link', 'custom_post_type_permalinks', 10, 3 );

function custom_rewrite_conflicts( $request ) {
	$custom_child_post_types = array( 'app', 'payment', 'promo', 'registration', 'bonus' );

if ( ! is_admin()
     && isset( $request['post_type'] )
     && in_array( $request['post_type'], $custom_child_post_types, true )
){
		$request['post_type'] = $custom_child_post_types;
	}

	return $request;
}
add_filter( 'request', 'custom_rewrite_conflicts' );

/*  Rewrite Links Of Custom Post Types End  */
