<?php 

/*  Payments settings - Start  */

function payments_settings_init() {

	/*  Payments settings tab - Start  */

	/*  --- The setting sections ---  */

	add_settings_section(
		'payments_tab_titles',
		esc_html__( 'Titles', 'custom-theme' ),
		'custom_tab_titles_callback',
		'payments_tab'
	);

	add_settings_section(
		'payments_tab_slugs',
		esc_html__( 'Slugs', 'custom-theme' ),
		'custom_tab_slugs_callback',
		'payments_tab'
	);

	add_settings_section(
		'payments_tab_other_settings',
		esc_html__( 'Other settings', 'custom-theme' ),
		'payments_tab_other_settings_callback',
		'payments_tab'
	);

	/*  --- Descriptions ---  */

	function payments_tab_other_settings_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Other settings for payments.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	/*
	----------------
	Title setting fields
	----------------  */

	/*  --- "Payments" section title ---  */

	add_settings_field(
		'payments_section_name',
		esc_html__( 'The title of the &quot;Payments&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'payments_tab',
		'payments_tab_titles',
		array(
			'id'          => 'payments_section_name', 
			'option_name' => 'payments_section_name',
		)  
	);
	register_setting( 'payments_tab', 'payments_section_name', 'esc_attr' );

	/*
	------------------------
	Slugs setting fields
	------------------------  */

	/*  --- Payments slug ---  */

	add_settings_field(
		'payment_section_slug',
		esc_html__( 'The slug of the &quot;Payments&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'payments_tab',
		'payments_tab_slugs',
		array(
			'id'          => 'payment_slug', 
			'option_name' => 'payment_section_slug',
		)  
	);
	register_setting( 'payments_tab', 'payment_section_slug', 'esc_attr' );

	/*
	----------------

	Other settings fields

	----------------  */

	/*  --- The title "Follow" button of a payment ---  */

	add_settings_field(
		'payment_button_title',
		esc_html__( 'The global title of the &quot;Follow&quot; button', 'custom-theme' ),
		'custom_textfield_button_title_callback',
		'payments_tab',
		'payments_tab_other_settings',
		array(
			'id'          => 'payment_button_title', 
			'option_name' => 'payment_button_title',
		)  
	);
	register_setting( 'payments_tab', 'payment_button_title', 'esc_attr' );

	/*  --- The title "Permalink" button of a payment ---  */

	add_settings_field(
		'payment_permalink_button_title',
		esc_html__( 'The global title of the &quot;Permalink&quot; button', 'custom-theme' ),
		'custom_textfield_permalink_button_title_callback',
		'payments_tab',
		'payments_tab_other_settings',
		array(
			'id'          => 'payment_permalink_button_title', 
			'option_name' => 'payment_permalink_button_title',
		)  
	);
	register_setting( 'payments_tab', 'payment_permalink_button_title', 'esc_attr' );

	/*  --- The number of stars in the rating ---  */

	add_settings_field(
		'payment_rating_stars_number',
		esc_html__( 'The number of stars', 'custom-theme' ),
		'payment_rating_stars_number_callback',
		'payments_tab',
		'payments_tab_other_settings' 
	);
	register_setting( 'payments_tab', 'payment_rating_stars_number', 'esc_attr' );

	function payment_rating_stars_number_callback() {
 
		$options       = get_option( 'payment_rating_stars_number' );
		$number_values = array( '5', '6', '7', '8', '9', '10' );
		?>
		<select id="payment_rating_stars_number" name="payment_rating_stars_number">
			<?php foreach ( $number_values as $number_value ) { ?>
				<option value="<?php echo esc_attr( $number_value ); ?>" <?php selected( $options, $number_value ); ?>><?php echo esc_html( $number_value ); ?></option>
			<?php } ?>
		</select>
		<?php
	}
}

add_action( 'admin_init', 'payments_settings_init' );
