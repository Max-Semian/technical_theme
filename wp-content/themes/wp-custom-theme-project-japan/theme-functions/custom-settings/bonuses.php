<?php 

/*  Bonuses settings - Start  */

function bonuses_settings_init() {

	/*  Bonuses settings tab - Start  */

	/*  --- The setting sections ---  */

	add_settings_section(
		'bonuses_tab_titles',
		esc_html__( 'Titles', 'custom-theme' ),
		'custom_tab_titles_callback',
		'bonuses_tab'
	);

	add_settings_section(
		'bonuses_tab_slugs',
		esc_html__( 'Slugs', 'custom-theme' ),
		'custom_tab_slugs_callback',
		'bonuses_tab'
	);

	add_settings_section(
		'bonuses_tab_other_settings',
		esc_html__( 'Other settings', 'custom-theme' ),
		'bonuses_tab_other_settings_callback',
		'bonuses_tab'
	);

	/*  --- Descriptions ---  */

	function bonuses_tab_other_settings_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Other settings for bonuses.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	/*
	----------------
	Title setting fields
	----------------  */

	/*  --- "Bonuses" section title ---  */

	add_settings_field(
		'bonuses_section_name',
		esc_html__( 'The title of the &quot;Bonuses&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'bonuses_tab',
		'bonuses_tab_titles',
		array(
			'id'          => 'bonuses_section_name', 
			'option_name' => 'bonuses_section_name',
		)  
	);
	register_setting( 'bonuses_tab', 'bonuses_section_name', 'esc_attr' );

	/*
	------------------------
	Slugs setting fields
	------------------------  */

	/*  --- Bonuses slug ---  */

	add_settings_field(
		'bonus_section_slug',
		esc_html__( 'The slug of the &quot;Bonuses&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'bonuses_tab',
		'bonuses_tab_slugs',
		array(
			'id'          => 'bonus_slug', 
			'option_name' => 'bonus_section_slug',
		)  
	);
	register_setting( 'bonuses_tab', 'bonus_section_slug', 'esc_attr' );

	/*
	----------------

	Other settings fields

	----------------  */

	/*  --- The title "Follow" button of a bonus ---  */

	add_settings_field(
		'bonus_button_title',
		esc_html__( 'The global title of the &quot;Follow&quot; button', 'custom-theme' ),
		'custom_textfield_button_title_callback',
		'bonuses_tab',
		'bonuses_tab_other_settings',
		array(
			'id'          => 'bonus_button_title', 
			'option_name' => 'bonus_button_title',
		)  
	);
	register_setting( 'bonuses_tab', 'bonus_button_title', 'esc_attr' );

	/*  --- The title "Permalink" button of a bonus ---  */

	add_settings_field(
		'bonus_permalink_button_title',
		esc_html__( 'The global title of the &quot;Permalink&quot; button', 'custom-theme' ),
		'custom_textfield_permalink_button_title_callback',
		'bonuses_tab',
		'bonuses_tab_other_settings',
		array(
			'id'          => 'bonus_permalink_button_title', 
			'option_name' => 'bonus_permalink_button_title',
		)  
	);
	register_setting( 'bonuses_tab', 'bonus_permalink_button_title', 'esc_attr' );

	/*  --- The number of stars in the rating ---  */

	add_settings_field(
		'bonus_rating_stars_number',
		esc_html__( 'The number of stars', 'custom-theme' ),
		'bonus_rating_stars_number_callback',
		'bonuses_tab',
		'bonuses_tab_other_settings' 
	);
	register_setting( 'bonuses_tab', 'bonus_rating_stars_number', 'esc_attr' );

	function bonus_rating_stars_number_callback() {
 
		$options       = get_option( 'bonus_rating_stars_number' );
		$number_values = array( '5', '6', '7', '8', '9', '10' );
		?>
		<select id="bonus_rating_stars_number" name="bonus_rating_stars_number">
			<?php foreach ( $number_values as $number_value ) { ?>
				<option value="<?php echo esc_attr( $number_value ); ?>" <?php selected( $options, $number_value ); ?>><?php echo esc_html( $number_value ); ?></option>
			<?php } ?>
		</select>
		<?php
	}
}

add_action( 'admin_init', 'bonuses_settings_init' );
