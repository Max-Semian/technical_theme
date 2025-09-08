<?php 

/*  Promotional Codes settings - Start  */

function promo_settings_init() {

	/*  Promotional Codes settings tab - Start  */

	/*  --- The setting sections ---  */

	add_settings_section(
		'promo_tab_titles',
		esc_html__( 'Titles', 'custom-theme' ),
		'custom_tab_titles_callback',
		'promo_tab'
	);

	add_settings_section(
		'promo_tab_slugs',
		esc_html__( 'Slugs', 'custom-theme' ),
		'custom_tab_slugs_callback',
		'promo_tab'
	);

	add_settings_section(
		'promo_tab_other_settings',
		esc_html__( 'Other settings', 'custom-theme' ),
		'promo_tab_other_settings_callback',
		'promo_tab'
	);

	/*  --- Descriptions ---  */

	function promo_tab_other_settings_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Other settings for promotional code.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	/*
	----------------
	Title setting fields
	----------------  */

	/*  --- "Promotional Codes" section title ---  */

	add_settings_field(
		'promo_section_name',
		esc_html__( 'The title of the &quot;Promotional Codes&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'promo_tab',
		'promo_tab_titles',
		array(
			'id'          => 'promo_section_name', 
			'option_name' => 'promo_section_name',
		)  
	);
	register_setting( 'promo_tab', 'promo_section_name', 'esc_attr' );

	/*
	------------------------
	Slugs setting fields
	------------------------  */

	/*  --- Promotional Codes slug ---  */

	add_settings_field(
		'promo_section_slug',
		esc_html__( 'The slug of the &quot;Promotional Codes&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'promo_tab',
		'promo_tab_slugs',
		array(
			'id'          => 'promo_slug', 
			'option_name' => 'promo_section_slug',
		)  
	);
	register_setting( 'promo_tab', 'promo_section_slug', 'esc_attr' );

	/*
	----------------

	Other settings fields

	----------------  */

	/*  --- The title "Follow" button of a promo ---  */

	add_settings_field(
		'promo_button_title',
		esc_html__( 'The global title of the &quot;Follow&quot; button', 'custom-theme' ),
		'custom_textfield_button_title_callback',
		'promo_tab',
		'promo_tab_other_settings',
		array(
			'id'          => 'promo_button_title', 
			'option_name' => 'promo_button_title',
		)  
	);
	register_setting( 'promo_tab', 'promo_button_title', 'esc_attr' );

	/*  --- The title "Permalink" button of a promo ---  */

	add_settings_field(
		'promo_permalink_button_title',
		esc_html__( 'The global title of the &quot;Permalink&quot; button', 'custom-theme' ),
		'custom_textfield_permalink_button_title_callback',
		'promo_tab',
		'promo_tab_other_settings',
		array(
			'id'          => 'promo_permalink_button_title', 
			'option_name' => 'promo_permalink_button_title',
		)  
	);
	register_setting( 'promo_tab', 'promo_permalink_button_title', 'esc_attr' );

	/*  --- The number of stars in the rating ---  */

	add_settings_field(
		'promo_rating_stars_number',
		esc_html__( 'The number of stars', 'custom-theme' ),
		'promo_rating_stars_number_callback',
		'promo_tab',
		'promo_tab_other_settings' 
	);
	register_setting( 'promo_tab', 'promo_rating_stars_number', 'esc_attr' );

	function promo_rating_stars_number_callback() {
 
		$options       = get_option( 'promo_rating_stars_number' );
		$number_values = array( '5', '6', '7', '8', '9', '10' );
		?>
		<select id="promo_rating_stars_number" name="promo_rating_stars_number">
			<?php foreach ( $number_values as $number_value ) { ?>
				<option value="<?php echo esc_attr( $number_value ); ?>" <?php selected( $options, $number_value ); ?>><?php echo esc_html( $number_value ); ?></option>
			<?php } ?>
		</select>
		<?php
	}
}

add_action( 'admin_init', 'promo_settings_init' );
