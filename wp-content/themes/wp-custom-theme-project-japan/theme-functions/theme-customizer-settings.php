<?php

function theme_customizer_setting( $wp_customize ) {
	$primary_color   = ! empty( $_ENV['PRIMARY_COLOR'] ) ? $_ENV['PRIMARY_COLOR'] : '#17946d';
	$secondary_color = ! empty( $_ENV['SECONDARY_COLOR'] ) ? $_ENV['SECONDARY_COLOR'] : '#f9b002';
	
	$border_color = ! empty( $_ENV['PRIMARY_COLOR'] ) ? $_ENV['PRIMARY_COLOR'] : '#17946d';
	
	$links_color       = ! empty( $_ENV['LINKS_COLOR'] ) ? $_ENV['LINKS_COLOR'] : '#d63031';
	$links_hover_color = ! empty( $_ENV['LINKS_HOVER_COLOR'] ) ? $_ENV['LINKS_HOVER_COLOR'] : '#d63031';

	$buttons_content_color = ! empty( $_ENV['BUTTONS_CONTENT_COLOR'] ) ? $_ENV['BUTTONS_CONTENT_COLOR'] : '#faf8fb';
	
	$body_color         = ! empty( $_ENV['BODY_COLOR'] ) ? $_ENV['BODY_COLOR'] : '#4e4e4e';
	$body_content_color = ! empty( $_ENV['BODY_CONTENT_COLOR'] ) ? $_ENV['BODY_CONTENT_COLOR'] : '#fff';
	
	$header_color                     = ! empty( $_ENV['HEADER_COLOR'] ) ? $_ENV['HEADER_COLOR'] : '#17946d';
	$header_menu_color                = ! empty( $_ENV['HEADER_MENU_LINK_COLOR'] ) ? $_ENV['HEADER_MENU_LINK_COLOR'] : '#fff';
	$header_hover_menu_color          = ! empty( $_ENV['HEADER_MENU_LINK_HOVER_COLOR'] ) ? $_ENV['HEADER_MENU_LINK_HOVER_COLOR'] : '#2e3246';
	$header_sub_menu_background_color = ! empty( $_ENV['HEADER_SUBMENU_COLOR'] ) ? $_ENV['HEADER_SUBMENU_COLOR'] : '#fff';
	$header_sub_menu_color            = ! empty( $_ENV['HEADER_SUBMENU_LINK_COLOR'] ) ? $_ENV['HEADER_SUBMENU_LINK_COLOR'] : '#121212';
	$header_hover_sub_menu_color      = ! empty( $_ENV['HEADER_SUBMENU_LINK_HOVER_COLOR'] ) ? $_ENV['HEADER_SUBMENU_LINK_HOVER_COLOR'] : '#2e3246';

	$header_mobile_color                       = ! empty( $_ENV['HEADER_MOBILE_COLOR'] ) ? $_ENV['HEADER_MOBILE_COLOR'] : '#17946d';
	$header_mobile_menu_color                  = ! empty( $_ENV['HEADER_MOBILE_MENU_LINK_COLOR'] ) ? $_ENV['HEADER_MOBILE_MENU_LINK_COLOR'] : '#fff';
	$header_mobile_hover_menu_color            = ! empty( $_ENV['HEADER_MOBILE_MENU_LINK_HOVER_COLOR'] ) ? $_ENV['HEADER_MOBILE_MENU_LINK_HOVER_COLOR'] : '#2e3246';
	$header_mobile_hover_menu_background_color = ! empty( $_ENV['HEADER_MOBILE_MENU_LINK_HOVER_BACKGROUND_COLOR'] ) ? $_ENV['HEADER_MOBILE_MENU_LINK_HOVER_BACKGROUND_COLOR'] : '#fff';
	$header_mobile_sub_menu_color              = ! empty( $_ENV['HEADER_MOBILE_SUBMENU_LINK_COLOR'] ) ? $_ENV['HEADER_MOBILE_SUBMENU_LINK_COLOR'] : '#fff';
	$header_mobile_hover_sub_menu_color        = ! empty( $_ENV['HEADER_MOBILE_SUBMENU_LINK_HOVER_COLOR'] ) ? $_ENV['HEADER_MOBILE_SUBMENU_LINK_HOVER_COLOR'] : '#2e3246';

	$footer_color            = ! empty( $_ENV['FOOTER_COLOR'] ) ? $_ENV['FOOTER_COLOR'] : '#353535';
	$footer_content_color    = ! empty( $_ENV['FOOTER_CONTENT_COLOR'] ) ? $_ENV['FOOTER_CONTENT_COLOR'] : '#fff';
	$footer_menu_color       = ! empty( $_ENV['FOOTER_MENU_LINK_COLOR'] ) ? $_ENV['FOOTER_MENU_LINK_COLOR'] : '#fff';
	$footer_hover_menu_color = ! empty( $_ENV['FOOTER_MENU_LINK_HOVER_COLOR'] ) ? $_ENV['FOOTER_MENU_LINK_HOVER_COLOR'] : '#fff';

	$table_odd_color        = ! empty( $_ENV['TABLE_COLOR'] ) ? $_ENV['TABLE_COLOR'] : '#3e7966';
	$table_even_color       = ! empty( $_ENV['TABLE_COLOR'] ) ? $_ENV['TABLE_COLOR'] : '#3e7966';
	$table_content_color    = ! empty( $_ENV['TABLE_CONTENT_COLOR'] ) ? $_ENV['TABLE_CONTENT_COLOR'] : '#fff';
	$table_border_color     = ! empty( $_ENV['TABLE_BORDER_COLOR'] ) ? $_ENV['TABLE_BORDER_COLOR'] : '#3e7966';
	$table_th_color         = ! empty( $_ENV['TABLE_TH_COLOR'] ) ? $_ENV['TABLE_TH_COLOR'] : '#0e5a43';
	$table_th_content_color = ! empty( $_ENV['TABLE_TH_CONTENT_COLOR'] ) ? $_ENV['TABLE_TH_CONTENT_COLOR'] : '#fff';

	$stars_active_color   = ! empty( $_ENV['YELLOW_COLOR'] ) ? $_ENV['YELLOW_COLOR'] : '#f9b15c';
	$stars_inactive_color = ! empty( $_ENV['GRIZZLY_LIGHT_COLOR'] ) ? $_ENV['GRIZZLY_LIGHT_COLOR'] : '#7f8c8d';

	$buttons_fixed_background_color = ! empty( $_ENV['DARK_COLOR'] ) ? $_ENV['DARK_COLOR'] : '#1b1d21';

	/*  --- Primary color ---  */

	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => $primary_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'    => esc_html__( 'Primary color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
			)
		)
	);

	/*  --- Secondary color ---  */

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'           => $secondary_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
				'label'    => esc_html__( 'Secondary color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
			)
		)
	);

	/*  --- Border color ---  */

	$wp_customize->add_setting(
		'border_color',
		array(
			'default'           => $border_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'border_color',
			array(
				'label'    => esc_html__( 'Border color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'border_color',
			)
		)
	);

	/*  --- Links color ---  */

	$wp_customize->add_setting(
		'links_color',
		array(
			'default'           => $links_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'links_color',
			array(
				'label'    => esc_html__( 'Links color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'links_color',
			)
		)
	);

	/*  --- Links hover color ---  */

	$wp_customize->add_setting(
		'links_hover_color',
		array(
			'default'           => $links_hover_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'links_hover_color',
			array(
				'label'    => esc_html__( 'Links hover color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'links_hover_color',
			)
		)
	);

	/*  --- Buttons content color ---  */

	$wp_customize->add_setting(
		'buttons_content_color',
		array(
			'default'           => $buttons_content_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'buttons_content_color',
			array(
				'label'    => esc_html__( 'Buttons content color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'buttons_content_color',
			)
		)
	);

	/*  --- Body color ---  */

	$wp_customize->add_setting(
		'body_color',
		array(
			'default'           => $body_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_color',
			array(
				'label'    => esc_html__( 'Body color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'body_color',
			)
		)
	);

	$wp_customize->add_setting(
		'body_content_color',
		array(
			'default'           => $body_content_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_content_color',
			array(
				'label'    => esc_html__( 'Body content color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'body_content_color',
			)
		)
	);

	$wp_customize->add_setting(
		'stars_active_color',
		array(
			'default'           => $stars_active_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'stars_active_color',
			array(
				'label'    => esc_html__( 'Stars active color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'stars_active_color',
			)
		)
	);

	$wp_customize->add_setting(
		'stars_inactive_color',
		array(
			'default'           => $stars_inactive_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'stars_inactive_color',
			array(
				'label'    => esc_html__( 'Stars inactive color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'stars_inactive_color',
			)
		)
	);

	$wp_customize->add_setting(
		'buttons_fixed_background_color',
		array(
			'default'           => $buttons_fixed_background_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'buttons_fixed_background_color',
			array(
				'label'    => esc_html__( 'Fixed button background color', 'custom-theme' ),
				'section'  => 'colors',
				'settings' => 'buttons_fixed_background_color',
			)
		)
	);

	/*  --- Header Settings ---  */

	$wp_customize->add_panel(
		'theme_header_settings',
		array(
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Header', 'custom-theme' ),
		)
	);

	$wp_customize->add_section(
		'theme_header_settings',
		array(
			'title' => esc_html__( 'Header colors', 'custom-theme' ),
			'panel' => 'theme_header_settings',
		) 
	);

	$wp_customize->add_section(
		'theme_mobile_header_settings',
		array(
			'title' => esc_html__( 'Mobile header colors', 'custom-theme' ),
			'panel' => 'theme_header_settings',
		) 
	);

	$wp_customize->add_section(
		'theme_header_auth_button',
		array(
			'title' => esc_html__( 'Header authorization button', 'custom-theme' ),
			'panel' => 'theme_header_settings',
		) 
	);

	/*  --- Header color ---  */

	$wp_customize->add_setting(
		'header_color',
		array(
			'default'           => $header_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color',
			array(
				'label'    => esc_html__( 'Header color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_color',
			)
		)
	);

	/*  --- Main menu link color ---  */

	$wp_customize->add_setting(
		'header_menu_color',
		array(
			'default'           => $header_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_menu_color',
			array(
				'label'    => esc_html__( 'Main menu link color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_menu_color',
			)
		)
	);

	/*  --- Header mobile color ---  */

	$wp_customize->add_setting(
		'header_mobile_color',
		array(
			'default'           => $header_mobile_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_color',
			array(
				'label'    => esc_html__( 'Header mobile color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_color',
			)
		)
	);

	$wp_customize->add_setting(
		'header_mobile_menu_color',
		array(
			'default'           => $header_mobile_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_menu_color',
			array(
				'label'    => esc_html__( 'Main menu mobile link color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_menu_color',
			)
		)
	);

	/*  --- Main menu link hover color ---  */

	$wp_customize->add_setting(
		'header_hover_menu_color',
		array(
			'default'           => $header_hover_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_hover_menu_color',
			array(
				'label'    => esc_html__( 'Main menu link hover color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_hover_menu_color',
			)
		)
	);

	$wp_customize->add_setting(
		'header_mobile_hover_menu_color',
		array(
			'default'           => $header_mobile_hover_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_hover_menu_color',
			array(
				'label'    => esc_html__( 'Main menu mobile link hover color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_hover_menu_color',
			)
		)
	);

	/*  --- Main menu link hover color ---  */

	$wp_customize->add_setting(
		'header_mobile_hover_menu_background_color',
		array(
			'default'           => $header_mobile_hover_menu_background_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_hover_menu_background_color',
			array(
				'label'    => esc_html__( 'Main menu mobile link hover background color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_hover_menu_background_color',
			)
		)
	);

	/*  --- Submenu background color ---  */

	$wp_customize->add_setting(
		'header_sub_menu_background_color',
		array(
			'default'           => $header_sub_menu_background_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_sub_menu_background_color',
			array(
				'label'    => esc_html__( 'Submenu background color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_sub_menu_background_color',
			)
		)
	);

	/*  --- Submenu link color ---  */

	$wp_customize->add_setting(
		'header_sub_menu_color',
		array(
			'default'           => $header_sub_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_sub_menu_color',
			array(
				'label'    => esc_html__( 'Submenu link color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_sub_menu_color',
			)
		)
	);

	$wp_customize->add_setting(
		'header_mobile_sub_menu_color',
		array(
			'default'           => $header_mobile_sub_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_sub_menu_color',
			array(
				'label'    => esc_html__( 'Submenu mobile link color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_sub_menu_color',
			)
		)
	);

	/*  --- Submenu link hover color ---  */

	$wp_customize->add_setting(
		'header_hover_sub_menu_color',
		array(
			'default'           => $header_hover_sub_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_hover_sub_menu_color',
			array(
				'label'    => esc_html__( 'Submenu link hover color', 'custom-theme' ),
				'section'  => 'theme_header_settings',
				'settings' => 'header_hover_sub_menu_color',
			)
		)
	);

	$wp_customize->add_setting(
		'header_mobile_hover_sub_menu_color',
		array(
			'default'           => $header_mobile_hover_sub_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_mobile_hover_sub_menu_color',
			array(
				'label'    => esc_html__( 'Submenu mobile link hover color', 'custom-theme' ),
				'section'  => 'theme_mobile_header_settings',
				'settings' => 'header_mobile_hover_sub_menu_color',
			)
		)
	);

	/*  --- Header authorization button ---  */

	$wp_customize->add_setting(
		'header_auth_button_text',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => 'Log in / Sign up',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);
	
	$wp_customize->add_control(
		'header_auth_button_text',
		array(
			'type'    => 'text',
			'section' => 'theme_header_auth_button',
			'label'   => esc_html__( 'Header authorization button text', 'custom-theme' ),
		) 
	);

	$wp_customize->add_setting(
		'header_auth_button_url',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);
	
	$wp_customize->add_control(
		'header_auth_button_url',
		array(
			'type'    => 'url',
			'section' => 'theme_header_auth_button',
			'label'   => esc_html__( 'Header authorization button link', 'custom-theme' ),
		) 
	);

	/*  --- Footer Settings ---  */

	$wp_customize->add_section(
		'theme_footer_settings',
		array(
			'title'    => esc_html__( 'Footer', 'custom-theme' ),
			'priority' => 140,
		) 
	);

	/*  --- Footer color ---  */

	$wp_customize->add_setting(
		'footer_color',
		array(
			'default'           => $footer_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_color',
			array(
				'label'    => esc_html__( 'Footer color', 'custom-theme' ),
				'section'  => 'theme_footer_settings',
				'settings' => 'footer_color',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_content_color',
		array(
			'default'           => $footer_content_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_content_color',
			array(
				'label'    => esc_html__( 'Footer content color', 'custom-theme' ),
				'section'  => 'theme_footer_settings',
				'settings' => 'footer_content_color',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_menu_color',
		array(
			'default'           => $footer_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_menu_color',
			array(
				'label'    => esc_html__( 'Footer menu link color', 'custom-theme' ),
				'section'  => 'theme_footer_settings',
				'settings' => 'footer_menu_color',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_hover_menu_color',
		array(
			'default'           => $footer_hover_menu_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_hover_menu_color',
			array(
				'label'    => esc_html__( 'Footer menu link hover color', 'custom-theme' ),
				'section'  => 'theme_footer_settings',
				'settings' => 'footer_hover_menu_color',
			)
		)
	);

	/*  --- Footer description ---  */

	$wp_customize->add_setting(
		'footer_description',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);
	
	$wp_customize->add_control(
		'footer_description',
		array(
			'type'        => 'textarea',
			'section'     => 'theme_footer_settings',
			'label'       => esc_html__( 'Footer Description', 'custom-theme' ),
			'description' => esc_html__( 'Add your description to the footer.', 'custom-theme' ),
		) 
	);

	/*  --- Theme Settings ---  */

	$wp_customize->add_panel(
		'theme_settings',
		array(
			'priority'   => 150,
			'capability' => 'edit_theme_options',
			'title'      => esc_html__( 'Theme settings', 'custom-theme' ),
		)
	);

	/*  --- Theme descriptions ---  */

	$wp_customize->add_section(
		'theme_settings_descriptions',
		array(
			'title' => esc_html__( 'Descriptions', 'custom-theme' ),
			'panel' => 'theme_settings',
		) 
	);

	/*  --- Comments description ---  */

	$wp_customize->add_setting(
		'comments_description',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);

	$wp_customize->add_control(
		'comments_description',
		array(
			'type'        => 'textarea',
			'section'     => 'theme_settings_descriptions',
			'label'       => esc_html__( 'Comments Description', 'custom-theme' ),
			'description' => esc_html__( 'Add your description to the comments block.', 'custom-theme' ),
		) 
	);

	/*  --- Feedback description ---  */

	$wp_customize->add_setting(
		'subscribe_description',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);

	$wp_customize->add_control(
		'subscribe_description',
		array(
			'type'        => 'textarea',
			'section'     => 'theme_settings_descriptions',
			'label'       => esc_html__( 'Subscribe Description', 'custom-theme' ),
			'description' => esc_html__( 'Add your description to the subscribe block.', 'custom-theme' ),
		) 
	);

	/*  --- Table settings ---  */

	$wp_customize->add_section(
		'theme_settings_table_settings',
		array(
			'title' => esc_html__( 'Table settings', 'custom-theme' ),
			'panel' => 'theme_settings',
		) 
	);

	/*  --- Table color ---  */

	$wp_customize->add_setting(
		'table_odd_color',
		array(
			'default'           => $table_odd_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_odd_color',
			array(
				'label'    => esc_html__( 'Table background odd rows color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_odd_color',
			)
		)
	);

	$wp_customize->add_setting(
		'table_even_color',
		array(
			'default'           => $table_even_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_even_color',
			array(
				'label'    => esc_html__( 'Table background even rows color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_even_color',
			)
		)
	);

	$wp_customize->add_setting(
		'table_border_color',
		array(
			'default'           => $table_border_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_border_color',
			array(
				'label'    => esc_html__( 'Table border color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_border_color',
			)
		)
	);


	$wp_customize->add_setting(
		'table_th_color',
		array(
			'default'           => $table_th_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_th_color',
			array(
				'label'    => esc_html__( 'Table header background color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_th_color',
			)
		)
	);

	$wp_customize->add_setting(
		'table_th_content_color',
		array(
			'default'           => $table_th_content_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_th_content_color',
			array(
				'label'    => esc_html__( 'Table header text color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_th_content_color',
			)
		)
	);

	$wp_customize->add_setting(
		'table_content_color',
		array(
			'default'           => $table_content_color,
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'table_content_color',
			array(
				'label'    => esc_html__( 'Table body text color', 'custom-theme' ),
				'section'  => 'theme_settings_table_settings',
				'settings' => 'table_content_color',
			)
		)
	);

	/*  --- Table border radius ---  */

	$wp_customize->add_setting(
		'table_border_radius',
		array(
			'default'   => 0,
			'transport' => 'postMessage',
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Range(
			$wp_customize,
			'table_border_radius',
			array(
				'label'   => esc_html__( 'Table border radius', 'custom-theme' ),
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'section' => 'theme_settings_table_settings',
			) 
		) 
	);
}
add_action( 'customize_register', 'theme_customizer_setting' );

function theme_customizer_style_settings() {
	if ( ! $primary_custom_color = get_theme_mod( 'primary_color' ) ) {
		$primary_custom_color = '#17946d';
	} else {
		$primary_custom_color = get_theme_mod( 'primary_color' );
	}

	if ( ! $secondary_custom_color = get_theme_mod( 'secondary_color' ) ) {
		$secondary_custom_color = '#f9b002';
	} else {
		$secondary_custom_color = get_theme_mod( 'secondary_color' );
	}

	if ( ! $border_custom_color = get_theme_mod( 'border_color' ) ) {
		$border_custom_color = '#17946d';
	} else {
		$border_custom_color = get_theme_mod( 'border_color' );
	}

	if ( ! $links_custom_color = get_theme_mod( 'links_color' ) ) {
		$links_custom_color = '#d63031';
	} else {
		$links_custom_color = get_theme_mod( 'links_color' );
	}

	if ( ! $links_custom_hover_color = get_theme_mod( 'links_hover_color' ) ) {
		$links_custom_hover_color = '#d63031';
	} else {
		$links_custom_hover_color = get_theme_mod( 'links_hover_color' );
	}

	if ( ! $buttons_custom_content_color = get_theme_mod( 'buttons_content_color' ) ) {
		$buttons_custom_content_color = '#faf8fb';
	} else {
		$buttons_custom_content_color = get_theme_mod( 'buttons_content_color' );
	}

	if ( ! $body_custom_color = get_theme_mod( 'body_color' ) ) {
		$body_custom_color = '#4e4e4e';
	} else {
		$body_custom_color = get_theme_mod( 'body_color' );
	}

	if ( ! $body_custom_content_color = get_theme_mod( 'body_content_color' ) ) {
		$body_custom_content_color = '#fff';
	} else {
		$body_custom_content_color = get_theme_mod( 'body_content_color' );
	}

	if ( ! $stars_custom_active_color = get_theme_mod( 'stars_active_color' ) ) {
		$stars_custom_active_color = '#f9b15c';
	} else {
		$stars_custom_active_color = get_theme_mod( 'stars_active_color' );
	}

	if ( ! $stars_custom_inactive_color = get_theme_mod( 'stars_inactive_color' ) ) {
		$stars_custom_inactive_color = '#7f8c8d';
	} else {
		$stars_custom_inactive_color = get_theme_mod( 'stars_inactive_color' );
	}

	if ( ! $buttons_custom_fixed_background_color = get_theme_mod( 'buttons_fixed_background_color' ) ) {
		$buttons_custom_fixed_background_color = '#1b1d21';
	} else {
		$buttons_custom_fixed_background_color = get_theme_mod( 'buttons_fixed_background_color' );
	}

	if ( ! $header_custom_color = get_theme_mod( 'header_color' ) ) {
		$header_custom_color = '#17946d';
	} else {
		$header_custom_color = get_theme_mod( 'header_color' );
	}

	if ( ! $header_custom_menu_color = get_theme_mod( 'header_menu_color' ) ) {
		$header_custom_menu_color = '#fff';
	} else {
		$header_custom_menu_color = get_theme_mod( 'header_menu_color' );
	}

	if ( ! $header_custom_mobile_menu_color = get_theme_mod( 'header_mobile_menu_color' ) ) {
		$header_custom_mobile_menu_color = '#fff';
	} else {
		$header_custom_mobile_menu_color = get_theme_mod( 'header_mobile_menu_color' );
	}

	if ( ! $header_custom_hover_menu_color = get_theme_mod( 'header_hover_menu_color' ) ) {
		$header_custom_hover_menu_color = '#2e3246';
	} else {
		$header_custom_hover_menu_color = get_theme_mod( 'header_hover_menu_color' );
	}

	if ( ! $header_custom_mobile_hover_menu_color = get_theme_mod( 'header_mobile_hover_menu_color' ) ) {
		$header_custom_mobile_hover_menu_color = '#2e3246';
	} else {
		$header_custom_mobile_hover_menu_color = get_theme_mod( 'header_mobile_hover_menu_color' );
	}

	if ( ! $header_custom_mobile_hover_menu_background_color = get_theme_mod( 'header_mobile_hover_menu_background_color' ) ) {
		$header_custom_mobile_hover_menu_background_color = '#fff';
	} else {
		$header_custom_mobile_hover_menu_background_color = get_theme_mod( 'header_mobile_hover_menu_background_color' );
	}

	if ( ! $header_custom_sub_menu_background_color = get_theme_mod( 'header_sub_menu_background_color' ) ) {
		$header_custom_sub_menu_background_color = '#fff';
	} else {
		$header_custom_sub_menu_background_color = get_theme_mod( 'header_sub_menu_background_color' );
	}

	if ( ! $header_custom_sub_menu_color = get_theme_mod( 'header_sub_menu_color' ) ) {
		$header_custom_sub_menu_color = '#121212';
	} else {
		$header_custom_sub_menu_color = get_theme_mod( 'header_sub_menu_color' );
	}

	if ( ! $header_custom_mobile_sub_menu_color = get_theme_mod( 'header_mobile_sub_menu_color' ) ) {
		$header_custom_mobile_sub_menu_color = '#121212';
	} else {
		$header_custom_mobile_sub_menu_color = get_theme_mod( 'header_mobile_sub_menu_color' );
	}

	if ( ! $header_custom_hover_sub_menu_color = get_theme_mod( 'header_hover_sub_menu_color' ) ) {
		$header_custom_hover_sub_menu_color = '#2e3246';
	} else {
		$header_custom_hover_sub_menu_color = get_theme_mod( 'header_hover_sub_menu_color' );
	}

	if ( ! $header_custom_mobile_hover_sub_menu_color = get_theme_mod( 'header_mobile_hover_sub_menu_color' ) ) {
		$header_custom_mobile_hover_sub_menu_color = '#2e3246';
	} else {
		$header_custom_mobile_hover_sub_menu_color = get_theme_mod( 'header_mobile_hover_sub_menu_color' );
	}

	if ( ! $header_custom_mobile_color = get_theme_mod( 'header_mobile_color' ) ) {
		$header_custom_mobile_color = '#17946d';
	} else {
		$header_custom_mobile_color = get_theme_mod( 'header_mobile_color' );
	}

	if ( ! $footer_custom_color = get_theme_mod( 'footer_color' ) ) {
		$footer_custom_color = '#353535';
	} else {
		$footer_custom_color = get_theme_mod( 'footer_color' );
	}

	if ( ! $footer_custom_content_color = get_theme_mod( 'footer_content_color' ) ) {
		$footer_custom_content_color = '#fff';
	} else {
		$footer_custom_content_color = get_theme_mod( 'footer_content_color' );
	}

	if ( ! $footer_custom_menu_color = get_theme_mod( 'footer_menu_color' ) ) {
		$footer_custom_menu_color = '#fff';
	} else {
		$footer_custom_menu_color = get_theme_mod( 'footer_menu_color' );
	}

	if ( ! $footer_custom_hover_menu_color = get_theme_mod( 'footer_hover_menu_color' ) ) {
		$footer_custom_hover_menu_color = '#fff';
	} else {
		$footer_custom_hover_menu_color = get_theme_mod( 'footer_hover_menu_color' );
	}

	if ( ! $table_custom_odd_color = get_theme_mod( 'table_odd_color' ) ) {
		$table_custom_odd_color = '#3e7966';
	} else {
		$table_custom_odd_color = get_theme_mod( 'table_odd_color' );
	}

	if ( ! $table_custom_even_color = get_theme_mod( 'table_even_color' ) ) {
		$table_custom_even_color = '#3e7966';
	} else {
		$table_custom_even_color = get_theme_mod( 'table_even_color' );
	}

	if ( ! $table_custom_border_color = get_theme_mod( 'table_border_color' ) ) {
		$table_custom_border_color = '#3e7966';
	} else {
		$table_custom_border_color = get_theme_mod( 'table_border_color' );
	}

	if ( ! $table_custom_th_color = get_theme_mod( 'table_th_color' ) ) {
		$table_custom_th_color = '#0e5a43';
	} else {
		$table_custom_th_color = get_theme_mod( 'table_th_color' );
	}

	if ( ! $table_custom_th_content_color = get_theme_mod( 'table_th_content_color' ) ) {
		$table_custom_th_content_color = '#fff';
	} else {
		$table_custom_th_content_color = get_theme_mod( 'table_th_content_color' );
	}

	if ( ! $table_custom_content_color = get_theme_mod( 'table_content_color' ) ) {
		$table_custom_content_color = '#fff';
	} else {
		$table_custom_content_color = get_theme_mod( 'table_content_color' );
	}

	if ( ! $table_custom_border_radius = get_theme_mod( 'table_border_radius' ) ) {
		$table_custom_border_radius = 0;
	} else {
		$table_custom_border_radius = get_theme_mod( 'table_border_radius' );
	}

	if ( ! $is_priority_theme_primary_color = get_theme_mod( 'is_priority_theme_primary_color' ) ) {
		$is_priority_theme_primary_color = false;
	} else {
		$is_priority_theme_primary_color = get_theme_mod( 'is_priority_theme_primary_color' );
	}

	$custom_css = '
		body.theme-body,
		.editor-styles-wrapper {
			background-color: ' . esc_attr( $body_custom_color ) . ';
			color: ' . esc_attr( $body_custom_content_color ) . ';
		}

		header {
			background-color: ' . esc_attr( $header_custom_color ) . ';
		}

		.main-menu-link {
			color: ' . esc_attr( $header_custom_mobile_menu_color ) . ';
		}

		.main-menu-link:not(.mobile-exclude):hover,
		.dropdown-toggle:not(.mobile-exclude):hover {
			color: ' . esc_attr( $header_custom_mobile_hover_menu_color ) . ';
		}

		.main-menu-link.mobile-exclude:hover,
		.dropdown-toggle.mobile-exclude:hover {
			color: ' . esc_attr( $header_custom_hover_menu_color ) . ';
		}

		header .menu-link:not(.mobile-exclude):hover {
			background-color: ' . esc_attr( $header_custom_mobile_hover_menu_background_color ) . ';
		}

		.dropdown-menu.mobile-exclude {
			background-color: ' . esc_attr( $header_custom_sub_menu_background_color ) . ';
		}

		.sub-menu-link:not(.mobile-exclude) {
			color: ' . esc_attr( $header_custom_mobile_sub_menu_color ) . ';
		}

		.sub-menu-link.mobile-exclude {
			color: ' . esc_attr( $header_custom_sub_menu_color ) . ';
		}

		.sub-menu-link:not(.mobile-exclude):hover {
			color: ' . esc_attr( $header_custom_mobile_hover_sub_menu_color ) . ';
		}

		.sub-menu-link.mobile-exclude:hover {
			color: ' . esc_attr( $header_custom_hover_sub_menu_color ) . ';
		}

		.mobile-menu-wrapper {
			background-color: ' . esc_attr( $header_custom_mobile_color ) . ';
		}

		footer {
			background-color: ' . esc_attr( $footer_custom_color ) . ';
			color: ' . esc_attr( $footer_custom_content_color ) . ';
		}

		footer a {
			color: ' . esc_attr( $footer_custom_menu_color ) . ';
		}

		footer a:hover {
			color: ' . esc_attr( $footer_custom_hover_menu_color ) . ';
		}

		.main-blocks ul:not(.ez-toc-list) li::before,
		.wp-block-post-content ul li::before,
		.main-button .background,
		.author-read-link,
		.comment-submit,
		input[type=checkbox]:checked ~ .switcher,
		#back-to-top {
			background-color: ' . esc_attr( $primary_custom_color ) . ' !important;
		}

		.main-border,
		.divide-primary>:not([hidden])~:not([hidden]) {
			border-color: ' . esc_attr( $border_custom_color ) . ' !important;
		}

		.secondary-button {
			background-color: ' . esc_attr( $secondary_custom_color ) . ' !important;
		}

		.fixed-button {
			background-color: ' . esc_attr( $buttons_custom_fixed_background_color ) . ' !important;
		}

		.comment-list .comment .comment-wrapper .comment-author,
		#load-comments,
		.empty-comments {
			color: ' . esc_attr( $primary_custom_color ) . ';
		}

		main a:not(.ez-toc-link) {
			color: ' . esc_attr( $links_custom_color ) . ' !important;
		}

		main a:not(.ez-toc-link):hover {
			color: ' . esc_attr( $links_custom_hover_color ) . ' !important;
		}

		.main-button,
		.main-button a,
		.main-button span,
		.secondary-button,
		.secondary-button a,
		.secondary-button span,
		.fixed-button,
		#back-to-top {
			color: ' . esc_attr( $buttons_custom_content_color ) . ' !important;
		}

		.wp-block-table table {
			border-collapse: separate;
			border-spacing: 0;
		}

		.wp-block-table table tbody tr:nth-child(odd) > * {
			background-color: ' . esc_attr( $table_custom_odd_color ) . ';
		}

		.wp-block-table table tbody tr:nth-child(even) > * {
			background-color: ' . esc_attr( $table_custom_even_color ) . ';
		}

		.wp-block-table table th {
			color: ' . esc_attr( $table_custom_th_content_color ) . ';
			background-color: ' . esc_attr( $table_custom_th_color ) . ';
		}

		.wp-block-table table td {
			color: ' . esc_attr( $table_custom_content_color ) . ';
			border-right: 1px solid ' . esc_attr( $table_custom_th_color ) . ';
			border-bottom: 1px solid ' . esc_attr( $table_custom_th_color ) . ';
		}

		.wp-block-table table tr th,
		.wp-block-table table tr td {
			border-right: 1px solid ' . esc_attr( $table_custom_border_color ) . ';
			border-bottom: 1px solid ' . esc_attr( $table_custom_border_color ) . ';
			border-color: ' . esc_attr( $table_custom_border_color ) . ';
		}

		.wp-block-table table tr th:first-child,
		.wp-block-table table tr td:first-child {
			border-left: 1px solid ' . esc_attr( $table_custom_border_color ) . ';
		}

		.wp-block-table table tr th {
			border-top: 1px solid ' . esc_attr( $table_custom_border_color ) . ';
			border-color: ' . esc_attr( $table_custom_border_color ) . ';
		}

		.wp-block-table table tr:first-child th:first-child {
			border-top-left-radius: ' . esc_attr( $table_custom_border_radius ) . 'px;
		}

		.wp-block-table table tr:first-child th:last-child {
			border-top-right-radius: ' . esc_attr( $table_custom_border_radius ) . 'px;
		}

		.wp-block-table table tr:last-child td:first-child {
			border-bottom-left-radius: ' . esc_attr( $table_custom_border_radius ) . 'px;
		}

		.wp-block-table table tr:last-child td:last-child {
			border-bottom-right-radius: ' . esc_attr( $table_custom_border_radius ) . 'px;
		}

		.star {
			color: ' . esc_attr( $stars_custom_inactive_color ) . ';
		}

		.star.active {
			color: ' . esc_attr( $stars_custom_active_color ) . ';
		}

		@media (min-width: 1280px) {
			.main-menu-link {
				color: ' . esc_attr( $header_custom_menu_color ) . ';
			}

			.dropdown-menu {
				background-color: ' . esc_attr( $header_custom_sub_menu_background_color ) . ';
			}

			.sub-menu-link {
				color: ' . esc_attr( $header_custom_sub_menu_color ) . ' !important;
			}

			.main-menu-link:hover,
			.dropdown-toggle:hover {
				color: ' . esc_attr( $header_custom_hover_menu_color ) . ' !important;
			}

			header .menu-link:hover {
				background-color: transparent !important;
			}

			.sub-menu-link:hover {
				color: ' . esc_attr( $header_custom_hover_sub_menu_color ) . ' !important;
			}
		}
	';

	if ( $is_priority_theme_primary_color ) {
		$primary_custom_grizzly_color   = 'rgb(' . esc_attr( join( ' ', sscanf( $primary_custom_color, '#%02x%02x%02x' ) ) ) . ' / 50%)';
		$primary_custom_light_color     = 'rgb(' . esc_attr( join( ' ', sscanf( $primary_custom_color, '#%02x%02x%02x' ) ) ) . ' / 25%)';
		$primary_custom_brightest_color = 'rgb(' . esc_attr( join( ' ', sscanf( $primary_custom_color, '#%02x%02x%02x' ) ) ) . ' / 10%)';

		$custom_css .= '
			.wp-custom-blocks-questions .question {
				border-color: ' . esc_attr( $primary_custom_light_color ) . ' !important;
			}

			.wp-custom-blocks-questions .question.active,
			.wp-custom-blocks-questions .question:hover {
				background-color: ' . $primary_custom_brightest_color . ' !important;
			}

			.wp-custom-blocks-questions .question .more-arrow.active,
			.wp-custom-blocks-cards .item-card button,
			.wp-custom-blocks-steps .step .line,
			.wp-custom-blocks-steps .step .number {
				background-color: ' . esc_attr( $primary_custom_color ) . ' !important;
			}

			.wp-custom-blocks-steps .step .description {
				border-color: ' . $primary_custom_grizzly_color . ' !important;
			}

			.wp-custom-blocks-banner {
				border-color: ' . $primary_custom_grizzly_color . ' !important;
			}

			.wp-custom-blocks-banner .bonus-button {
				background-color: ' . esc_attr( $primary_custom_color ) . ' !important;
			}

			.wp-custom-blocks-banner .domain {
				color: ' . esc_attr( $primary_custom_color ) . ' !important;
			}

			.wp-custom-blocks-banner .payment {
				background-color: ' . $primary_custom_brightest_color . ' !important;
			}

			.wp-custom-blocks-author {
				background-color: ' . esc_attr( $primary_custom_color ) . ' !important;
			}

			.wp-custom-blocks-bonuses .link-button {
				background-color: ' . esc_attr( $secondary_custom_color ) . ' !important;
			}
	
			.wp-custom-blocks-bonuses .bonus .title {
				color: ' . esc_attr( $secondary_custom_color ) . ' !important;
			}
	
			.wp-custom-blocks-bonuses .bonus .bonus-button {
				background-color: ' . esc_attr( $secondary_custom_color ) . ' !important;
			}
		';
	}

	$key = 'page-style-custom';

	wp_register_style( $key, false, array(), true, true );
	wp_add_inline_style( $key, $custom_css );
	wp_enqueue_style( $key );
}
add_action( 'wp_enqueue_scripts', 'theme_customizer_style_settings' );
add_action( 'enqueue_block_editor_assets', 'theme_customizer_style_settings' );
