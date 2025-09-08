<?php 

/*  Organizations settings - Start  */

function organizations_settings_init() {

	/*  Organizations settings tab - Start  */

	/*  --- The setting sections ---  */

	add_settings_section(
		'organizations_tab_rating_titles',
		esc_html__( 'Rating titles', 'custom-theme' ),
		'organizations_tab_rating_titles_callback',
		'organizations_tab'
	);

	add_settings_section(
		'organizations_tab_titles',
		esc_html__( 'Titles', 'custom-theme' ),
		'custom_tab_titles_callback',
		'organizations_tab'
	);

	add_settings_section(
		'organizations_tab_slugs',
		esc_html__( 'Slugs', 'custom-theme' ),
		'custom_tab_slugs_callback',
		'organizations_tab'
	);

	add_settings_section(
		'organizations_tab_other_settings',
		esc_html__( 'Other settings', 'custom-theme' ),
		'organizations_tab_other_settings_callback',
		'organizations_tab'
	);

	/*  --- Descriptions ---  */


	function organizations_tab_rating_titles_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Here you can change the default titles of the ratings.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	function organizations_tab_other_settings_callback( $args ) {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php esc_html_e( 'Other settings for organizations.', 'custom-theme' ); ?>
		</p>
			<?php
	}

	/*
	------------------------

	Rating titles setting fields

	------------------------  */

	/*  --- Trust & Fairness ---  */

	add_settings_field(
		'rating_1',
		esc_html__( 'Trust & Fairness', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_1',
		)  
	);
	register_setting( 'organizations_tab', 'rating_1', 'esc_attr' );

	/*  --- Games & Software ---  */

	add_settings_field(
		'rating_2',
		esc_html__( 'Games & Software', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_2',
		)  
	);
	register_setting( 'organizations_tab', 'rating_2', 'esc_attr' );

	/*  --- Bonuses & Promotions ---  */

	add_settings_field(
		'rating_3',
		esc_html__( 'Bonuses & Promotions', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_3',
		)  
	);
	register_setting( 'organizations_tab', 'rating_3', 'esc_attr' );

	/*  --- Customer Support ---  */

	add_settings_field(
		'rating_4',
		esc_html__( 'Customer Support', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_4',
		)  
	);
	register_setting( 'organizations_tab', 'rating_4', 'esc_attr' );

	/*  --- Pre ---  */

	add_settings_field(
		'rating_5',
		esc_html__( 'Pre', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_5',
		)  
	);
	register_setting( 'organizations_tab', 'rating_5', 'esc_attr' );

	/*  --- Live ---  */

	add_settings_field(
		'rating_6',
		esc_html__( 'Live', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_6',
		)  
	);
	register_setting( 'organizations_tab', 'rating_6', 'esc_attr' );

	/*  --- Coefficients ---  */

	add_settings_field(
		'rating_7',
		esc_html__( 'Coefficients', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_7',
		)  
	);
	register_setting( 'organizations_tab', 'rating_7', 'esc_attr' );

	/*  --- Convenience of payments ---  */

	add_settings_field(
		'rating_8',
		esc_html__( 'Convenience of payments', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_8',
		)  
	);
	register_setting( 'organizations_tab', 'rating_8', 'esc_attr' );

	/*  --- Interface/Features ---  */

	add_settings_field(
		'rating_9',
		esc_html__( 'Interface/Features', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'rating_9',
		)  
	);
	register_setting( 'organizations_tab', 'rating_9', 'esc_attr' );

	/*  --- Overall Rating ---  */

	add_settings_field(
		'overall_rating',
		esc_html__( 'Overall Rating', 'custom-theme' ),
		'custom_textfield_rating_titles_callback',
		'organizations_tab',
		'organizations_tab_rating_titles',
		array(
			'overall_rating',
		)  
	);
	register_setting( 'organizations_tab', 'overall_rating', 'esc_attr' );

	/*  General Text Field Callback (for rating titles) Start */

	function custom_textfield_rating_titles_callback( $args ) {
		$option = esc_attr( get_option( $args[0] ) );
		?>
		<input type="text" id="<?php echo esc_attr( $args[0] ); ?>" name="<?php echo esc_attr( $args[0] ); ?>" value="<?php echo esc_attr( $option ); ?>"  class="regular-text" />
			<?php
	}

	/*  General Text Field Callback (for rating titles) End */

	/*  --- The number of stars in the rating ---  */

	add_settings_field(
		'custom_rating_stars_number',
		esc_html__( 'The number of stars', 'custom-theme' ),
		'custom_rating_stars_number_callback',
		'organizations_tab',
		'organizations_tab_rating_titles' 
	);
	register_setting( 'organizations_tab', 'custom_rating_stars_number', 'esc_attr' );

	function custom_rating_stars_number_callback() {
 
		$options       = get_option( 'custom_rating_stars_number' );
		$number_values = array( '5', '6', '7', '8', '9', '10' );
		?>
		<select id="custom_rating_stars_number" name="custom_rating_stars_number">
			<?php foreach ( $number_values as $number_value ) { ?>
				<option value="<?php echo esc_attr( $number_value ); ?>" <?php selected( $options, $number_value ); ?>><?php echo esc_html( $number_value ); ?></option>
			<?php } ?>
		</select>
			<?php
	}

	/*
	----------------
	Title setting fields
	----------------  */

	/*  --- "Organizations" section title ---  */

	add_settings_field(
		'organizations_section_name',
		esc_html__( 'The title of the &quot;Organizations&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'organizations_tab',
		'organizations_tab_titles',
		array(
			'id'          => 'organizations_section_name', 
			'option_name' => 'organizations_section_name',
		)  
	);
	register_setting( 'organizations_tab', 'organizations_section_name', 'esc_attr' );

	/*
	------------------------
	Slugs setting fields
	------------------------  */

	/*  --- Organizations slug ---  */

	add_settings_field(
		'organization_section_slug',
		esc_html__( 'The slug of the &quot;Organizations&quot; custom post type', 'custom-theme' ),
		'custom_textfield_name_callback',
		'organizations_tab',
		'organizations_tab_slugs',
		array(
			'id'          => 'organization_slug', 
			'option_name' => 'organization_section_slug',
		)  
	);
	register_setting( 'organizations_tab', 'organization_section_slug', 'esc_attr' );

	/*
	----------------

	Other settings fields

	----------------  */

	/*  --- The title "Play Now" button of a organization ---  */

	add_settings_field(
		'organizations_play_now_title',
		esc_html__( 'The global title of the &quot;Play Now&quot; button', 'custom-theme' ),
		'custom_textfield_play_now_title_callback',
		'organizations_tab',
		'organizations_tab_other_settings',
		array(
			'id'          => 'organizations_play_now_title', 
			'option_name' => 'organizations_play_now_title',
		)  
	);
	register_setting( 'organizations_tab', 'organizations_play_now_title', 'esc_attr' );

	function custom_textfield_play_now_title_callback( $args ) {
		$option      = esc_attr( get_option( $args['option_name'] ) );
		$id          = $args['id'];
		$option_name = $args['option_name'];
		?>
		<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option ); ?>" placeholder="<?php echo esc_attr( 'Default &quot;Play Now&quot;' ); ?>" class="regular-text" />
			<?php
	}

	/*  --- The title "Read Review" button of a organization ---  */

	add_settings_field(
		'organizations_read_review_title',
		esc_html__( 'The global title of the &quot;Read Review&quot; button', 'custom-theme' ),
		'custom_textfield_read_review_title_callback',
		'organizations_tab',
		'organizations_tab_other_settings',
		array(
			'id'          => 'organizations_read_review_title', 
			'option_name' => 'organizations_read_review_title',
		)  
	);
	register_setting( 'organizations_tab', 'organizations_read_review_title', 'esc_attr' );

	function custom_textfield_read_review_title_callback( $args ) {
		$option      = esc_attr( get_option( $args['option_name'] ) );
		$id          = $args['id'];
		$option_name = $args['option_name'];
		?>
		<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option ); ?>" placeholder="<?php echo esc_attr( 'Default &quot;Read Review&quot;' ); ?>" class="regular-text" />
			<?php
	}
}

add_action( 'admin_init', 'organizations_settings_init' );
