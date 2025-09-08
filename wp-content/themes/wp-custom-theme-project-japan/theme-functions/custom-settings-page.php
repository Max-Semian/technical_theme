<?php

/*  Custom Options Menu Item Start */

function custom_options_page() {
	add_menu_page(
		esc_html__( 'Custom settings', 'custom-theme' ),
		esc_html__( 'Custom settings', 'custom-theme' ),
		'manage_options',
		'custom-settings',
		'theme_options_page_html',
		'dashicons-admin-generic',
		59
	);
}
add_action( 'admin_menu', 'custom_options_page' );

/*  Custom Options Menu Item End */

/*  Custom Options Page Start */

function theme_options_page_html() {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'custom_messages', 'custom_message', esc_html__( 'Settings Saved', 'custom-theme' ), 'updated' );
	}

	settings_errors( 'custom_messages' );

	if ( isset( $_GET['tab'] ) ) {  
		$active_tab = $_GET['tab'];  
	} else {
		$active_tab = 'organizations_tab';
	}

	$organizations_tab_name = esc_html__( 'Organizations', 'custom-theme' );
	if ( get_option( 'organizations_section_name' ) ) {
		$organizations_tab_name = get_option( 'organizations_section_name' );
	}

	$apps_tab_name = esc_html__( 'Apps', 'custom-theme' );
	if ( get_option( 'apps_section_name' ) ) {
		$apps_tab_name = get_option( 'apps_section_name' );
	}

	$payments_tab_name = esc_html__( 'Payments', 'custom-theme' );
	if ( get_option( 'payments_section_name' ) ) {
		$payments_tab_name = get_option( 'payments_section_name' );
	}

	$registration_tab_name = esc_html__( 'Registration', 'custom-theme' );
	if ( get_option( 'registration_section_name' ) ) {
		$registration_tab_name = get_option( 'registration_section_name' );
	}

	$bonuses_tab_name = esc_html__( 'Bonuses', 'custom-theme' );
	if ( get_option( 'bonuses_section_name' ) ) {
		$bonuses_tab_name = get_option( 'bonuses_section_name' );
	}

	$promo_tab_name = esc_html__( 'Promo', 'custom-theme' );
	if ( get_option( 'promo_section_name' ) ) {
		$promo_tab_name = get_option( 'promo_section_name' );
	}

	?>

<div class="wrap">
	<style type="text/css">
		#custom_organizations_tab_rating_titles,
		#custom_organizations_tab_other_settings {
			border-top: 1px solid #ccc;
			padding-top: 5px;
		}
		
		form h2 {
			color: #e74c3c;
		}
	</style>
	<h1 class="wp-heading-inline"><?php echo esc_html( get_admin_page_title() ); ?><span class="title-count theme-count"><?php echo esc_html( $GLOBALS['custom_theme_version'] ); ?></span></h1>
	
	<h2 class="nav-tab-wrapper">
		<a href="?page=custom-settings&tab=organizations_tab" class="nav-tab <?php echo 'organizations_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Organizations', 'custom-theme' ); ?> (<?php echo esc_html( $organizations_tab_name ); ?>)</a>
		<a href="?page=custom-settings&tab=apps_tab" class="nav-tab <?php echo 'apps_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Apps', 'custom-theme' ); ?> (<?php echo esc_html( $apps_tab_name ); ?>)</a>
		<a href="?page=custom-settings&tab=payments_tab" class="nav-tab <?php echo 'payments_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Payments', 'custom-theme' ); ?> (<?php echo esc_html( $payments_tab_name ); ?>)</a>
		<a href="?page=custom-settings&tab=registration_tab" class="nav-tab <?php echo 'registration_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Registration', 'custom-theme' ); ?> (<?php echo esc_html( $registration_tab_name ); ?>)</a>
		<a href="?page=custom-settings&tab=bonuses_tab" class="nav-tab <?php echo 'bonuses_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Bonuses', 'custom-theme' ); ?> (<?php echo esc_html( $bonuses_tab_name ); ?>)</a>
		<a href="?page=custom-settings&tab=promo_tab" class="nav-tab <?php echo 'promo_tab' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Promotional Codes', 'custom-theme' ); ?> (<?php echo esc_html( $promo_tab_name ); ?>)</a>
	</h2> 

	<form method="post" action="options.php">
		<?php

		submit_button( esc_html__( 'Save Settings', 'custom-theme' ) );

		settings_fields( $active_tab );
		do_settings_sections( $active_tab );

		submit_button( esc_html__( 'Save Settings', 'custom-theme' ) );

		?>
	</form>
</div>

	<?php
}

/*  Custom Options Page End */


function custom_textfield_name_callback( $args ) {
	$option      = esc_attr( get_option( $args['option_name'] ) );
	$id          = $args['id'];
	$option_name = $args['option_name'];

	?>
	<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option ); ?>" class="regular-text" />
	<?php
}

function custom_tab_titles_callback( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>">
		<?php esc_html_e( 'Here you can change the default titles.', 'custom-theme' ); ?>
	</p>
		<?php
}

function custom_tab_slugs_callback( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>">
		<?php esc_html_e( 'Here you can change the default slugs.', 'custom-theme' ); ?>
	</p>
	<div class="card">
		<p>
			<strong><?php echo esc_html( 'WARNING:', 'custom-theme' ); ?></strong><br>
			<?php echo esc_html( 'Slugs at custom post types (e.g. Organizations, Apps) cannot be the same.', 'custom-theme' ); ?>
			<hr>
			<em><?php esc_html_e( 'After saving these settings, please, go to &quot;Settings&quot; - &quot;', 'custom-theme' ); ?><strong><a href="<?php echo esc_url( admin_url( 'options-permalink.php' ) ); ?>" title="<?php esc_attr_e( 'Permalinks', 'custom-theme' ); ?>"><?php esc_html_e( 'Permalinks', 'custom-theme' ); ?></a></strong><?php esc_html_e( '&quot; and click the &quot;Save Changes&quot; button.', 'custom-theme' ); ?> <strong><?php esc_html_e( 'Only after this action, new slugs will work.', 'custom-theme' ); ?></strong></em>
		</p>
	</div>
	<?php
}

function custom_textfield_button_title_callback( $args ) {
	$option      = esc_attr( get_option( $args['option_name'] ) );
	$id          = $args['id'];
	$option_name = $args['option_name'];
	?>
	<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option ); ?>" placeholder="<?php echo esc_attr( 'Default &quot;Follow&quot;' ); ?>" class="regular-text" />
		<?php
}

function custom_textfield_permalink_button_title_callback( $args ) {
	$option      = esc_attr( get_option( $args['option_name'] ) );
	$id          = $args['id'];
	$option_name = $args['option_name'];
	?>
	<input type="text" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $option_name ); ?>" value="<?php echo esc_attr( $option ); ?>" placeholder="<?php echo esc_attr( 'Default &quot;Read&quot;' ); ?>" class="regular-text" />
		<?php
}

/** Custom Settings Organizations - Start  */

require_once __DIR__ . '/custom-settings/organizations.php';

/**  Custom Settings Organizations - End  */

/** Custom Settings Apps - Start  */

require_once __DIR__ . '/custom-settings/apps.php';

/**  Custom Settings Apps - End  */

/** Custom Settings Payments - Start  */

require_once __DIR__ . '/custom-settings/payments.php';

/**  Custom Settings Payments - End  */

/** Custom Settings Registration - Start  */

require_once __DIR__ . '/custom-settings/registration.php';

/**  Custom Settings Registration - End  */

/** Custom Settings Bonuses - Start  */

require_once __DIR__ . '/custom-settings/bonuses.php';

/**  Custom Settings Bonuses - End  */

/** Custom Settings Promo - Start  */

require_once __DIR__ . '/custom-settings/promo.php';

/**  Custom Settings Promo - End  */
