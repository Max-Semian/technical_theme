<?php 

/*  Apps settings - Start  */

function apps_settings_init() {

	/*  Apps settings tab - Start  */

	/*  --- The setting sections ---  */

	add_settings_section(
		'apps_tab_titles',
		esc_html__( 'Titles', 'custom-theme' ),
		'custom_tab_titles_callback',
		'apps_tab'
	);

	add_settings_section(
		'apps_tab_slugs',
		esc_html__( 'Slugs', 'custom-theme' ),
		'custom_tab_slugs_callback',
		'apps_tab'
	);

	add_settings_section(
		'apps_tab_other_settings',
		esc_html__( 'Other settings', 'custom-theme' ),
		'apps_tab_other_settings_callback',
		'apps_tab'
	);

	/*  --- Descriptions ---  */

	function apps_tab_other_settings_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Other settings for apps.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	/*
	----------------
	Title setting fields
	----------------  */

	/*  --- "Apps" section title ---  */

	add_settings_field(
		'apps_section_name',
		esc_html__( 'The title of the &quot;Apps&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'apps_tab',
		'apps_tab_titles',
		array(
			'id'          => 'apps_section_name', 
			'option_name' => 'apps_section_name',
		)  
	);
	register_setting( 'apps_tab', 'apps_section_name', 'esc_attr' );

	/*
	------------------------
	Slugs setting fields
	------------------------  */

	/*  --- Apps slug ---  */

	add_settings_field(
		'app_section_slug',
		esc_html__( 'The slug of the &quot;Apps&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'apps_tab',
		'apps_tab_slugs',
		array(
			'id'          => 'app_slug', 
			'option_name' => 'app_section_slug',
		)  
	);
	register_setting( 'apps_tab', 'app_section_slug', 'esc_attr' );

	/*
	----------------

	Other settings fields

	----------------  */

	/*  --- The title "Follow" button of a app ---  */

	add_settings_field(
		'app_button_title',
		esc_html__( 'The global title of the &quot;Follow&quot; button', 'custom-theme' ),
		'custom_textfield_button_title_callback',
		'apps_tab',
		'apps_tab_other_settings',
		array(
			'id'          => 'app_button_title', 
			'option_name' => 'app_button_title',
		)  
	);
	register_setting( 'apps_tab', 'app_button_title', 'esc_attr' );

	/*  --- The title "Permalink" button of a app ---  */

	add_settings_field(
		'app_permalink_button_title',
		esc_html__( 'The global title of the &quot;Permalink&quot; button', 'custom-theme' ),
		'custom_textfield_permalink_button_title_callback',
		'apps_tab',
		'apps_tab_other_settings',
		array(
			'id'          => 'app_permalink_button_title', 
			'option_name' => 'app_permalink_button_title',
		)  
	);
	register_setting( 'apps_tab', 'app_permalink_button_title', 'esc_attr' );

	/*  --- The number of stars in the rating ---  */

	add_settings_field(
		'app_rating_stars_number',
		esc_html__( 'The number of stars', 'custom-theme' ),
		'app_rating_stars_number_callback',
		'apps_tab',
		'apps_tab_other_settings' 
	);
	register_setting( 'apps_tab', 'app_rating_stars_number', 'esc_attr' );

	function app_rating_stars_number_callback() {
 
		$options       = get_option( 'app_rating_stars_number' );
		$number_values = array( '5', '6', '7', '8', '9', '10' );
		?>
		<select id="app_rating_stars_number" name="app_rating_stars_number">
			<?php foreach ( $number_values as $number_value ) { ?>
				<option value="<?php echo esc_attr( $number_value ); ?>" <?php selected( $options, $number_value ); ?>><?php echo esc_html( $number_value ); ?></option>
			<?php } ?>
		</select>
		<?php
	}
}

add_action( 'admin_init', 'apps_settings_init' );
