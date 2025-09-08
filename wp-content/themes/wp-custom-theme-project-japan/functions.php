<?php

// Ensure custom menu walkers are available even if templates call wp_nav_menu() early.
if ( file_exists( get_template_directory() . '/theme-functions/header-walker-nav-menu.php' ) ) {
	require_once get_template_directory() . '/theme-functions/header-walker-nav-menu.php';
}
if ( file_exists( get_template_directory() . '/theme-functions/footer-walker-nav-menu.php' ) ) {
	require_once get_template_directory() . '/theme-functions/footer-walker-nav-menu.php';
}

global $custom_theme_version;
$custom_theme_version = '1.2.0';

$vendor_dir = __DIR__ . '/vendor';
$env_file   = __DIR__ . '/.env';

if ( is_dir( $vendor_dir ) && file_exists( $env_file ) ) {
	require_once __DIR__ . '/vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
	$dotenv->load();
}

add_theme_support( 'title-tag' );

function register_custom_menus() {
	register_nav_menus(
		array(
			'header' => _( 'Header Menu' ),
			'footer' => _( 'Footer Menu' ),
		)
	);
}
add_action( 'init', 'register_custom_menus' );

function link_localize_theme( $locale ) {
	if ( isset( $_GET['lang'] ) ) {
		return esc_attr( $_GET['lang'] );
	}
	return $locale;
}
add_filter( 'locale', 'link_localize_theme' );

function custom_theme_setup() {
	add_theme_support( 'post-thumbnails' );

	load_theme_textdomain( 'custom-theme', get_template_directory() . '/languages' );

	require_once get_template_directory() . '/theme-functions/header-walker-nav-menu.php';
	require_once get_template_directory() . '/theme-functions/footer-walker-nav-menu.php';
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

function custom_logo_setup() {
	$defaults = array(
		'height'      => 32,
		'width'       => 32,
		'flex-height' => true,
		'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'custom_logo_setup' );

function enqueue_time_versioned_style( $handle, $src = '', $deps = array(), $media = 'all' ) {
	$host_path      = get_theme_file_uri( $src );
	$directory_path = get_stylesheet_directory() . $src;

	wp_register_style( $handle, $host_path, $deps, @filemtime( $directory_path ), $media );
	wp_enqueue_style( $handle );
}

function style_theme() {
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
	enqueue_time_versioned_style( 'wp_custom_main_style', 'dist/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'style_theme' );
add_action( 'enqueue_block_editor_assets', 'style_theme' );

function style_loader_tag_filter_preload( $tag, $handle, $href ) {
	if ( 'wp-block-library' === $handle ) {
		$noscript = '<noscript><link rel="stylesheet" href="' . $href . '"></noscript>';
		$new_tag  = str_replace( "rel='stylesheet'", "rel='preload' as='style'", $tag );

		return str_replace( "type='text/css'", "media='all' onload='this.onload=null;this.rel=" . '"stylesheet"' . "'", $new_tag ) . $noscript;
	}

	return $tag;
}
add_filter( 'style_loader_tag', 'style_loader_tag_filter_preload', 10, 4 );

function enqueue_theme_versioned_script( $handle, $path = '', $deps = array() ) {
	$main_path = get_theme_file_uri( $path );

	wp_register_script(
		$handle,
		$main_path,
		$deps,
		@filemtime( $main_path ),
		array(
			'in_footer' => true,
			'strategy'  => 'async',
		)
	);
	wp_enqueue_script( $handle );
}

function scripts_theme() {
	wp_enqueue_script( 'jquery' );  

	enqueue_theme_versioned_script( 'wp_custom_main_script', '/dist/js/main.js', array( 'jquery' ) );
	wp_localize_script( 'wp_custom_main_script', 'ajax_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'scripts_theme' );

/*  Image Uploader Start  */

function custom_taxonomy_image_uploader() {
	global $typenow;
	
	if ( in_array( $typenow, array( 'organization', 'app', 'payment' ) ) ) {

		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		enqueue_theme_versioned_script( 'custom-taxonomy-image-uploader', '/dist/js/imageUploader.js', array( 'jquery' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'custom_taxonomy_image_uploader' );

/*  Image Uploader End  */

/**  Custom Settings Page - Start  */

require_once __DIR__ . '/theme-functions/custom-settings-page.php';

/**  Custom Settings Page - End  */

/**  Custom Star Rating - Start  */

require_once __DIR__ . '/theme-functions/custom-star-rating.php';

/**  Custom Star Rating - End  */

/** Custom Post Type - Start  */

require_once __DIR__ . '/theme-functions/custom-post-types.php';

/**  Custom Post Type - End  */

/** Theme Customizer Range - Start  */

require_once __DIR__ . '/theme-functions/class-wp-customize-range.php';

/**  Theme Customizer Range - End  */

/** Theme Customizer Colors - Start  */

require_once __DIR__ . '/theme-functions/theme-customizer-settings.php';

/** Theme Customizer Colors - End  */
function change_logo_class( $html ) {
	$html = str_replace( 'custom-logo-link', '[&>img]:max-w-32', $html );
	
	return $html;
}
add_filter( 'get_custom_logo', 'change_logo_class' );

function theme_comments_reply() {
	if ( comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_comments_reply' );

add_filter( 'comment_form_default_fields', 'comment_remove_url_field', 25 );
function comment_remove_url_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}

// Display all comment form fields when user is logged in
add_filter( 'comment_form_fields', 'show_all_comment_fields' );
function show_all_comment_fields( $fields ) {
	unset( $fields['cookies'] );

	if ( is_user_logged_in() ) {
		$comment_field_keys = array_diff( array_keys( $fields ), array( 'comment' ) );

		$first_field = reset( $comment_field_keys );
		$last_field  = end( $comment_field_keys );


		foreach ( $fields as $name => $field ) {
			if ( 'comment' === $name ) {
				echo apply_filters( 'comment_form_field_comment', $field );
			} else {
				if ( $first_field === $name ) {
					do_action( 'comment_form_before_fields' );
				}

				echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
				if ( $last_field === $name ) {
					do_action( 'comment_form_after_fields' );
				}
			}
		}

		return array();
	}

	unset( $fields['is-get-auth-data'] );

	return $fields;
}

// Save rating number
add_action( 'comment_post', 'save_comment_additional_field' );
function save_comment_additional_field( $comment_id ) {
	if ( isset( $_POST['rating'] ) ) {
		$rating = intval( $_POST['rating'] );
		add_comment_meta( $comment_id, 'rating', $rating );
	}

	if ( isset( $_POST['is-get-auth-data'] ) ) {
		$is_save_user_data = filter_var( $_POST['is-get-auth-data'], FILTER_VALIDATE_BOOLEAN );
		add_comment_meta( $comment_id, 'is-get-auth-data', $is_save_user_data );
	}
}

function print_review_rating( $id ) {
	$val   = get_comment_meta( $id, 'rating', true );
	$title = $val ? '<strong class="review-rating">' . $val . '</strong>' : '';
	return $title;
}

add_filter( 'manage_edit-comments_columns', 'my_add_comments_columns' );
function my_add_comments_columns( $my_cols ) {
	$temp_columns = array(
		'rating' => 'Rating',
	);
	$my_cols      = array_slice( $my_cols, 0, 3, true ) + $temp_columns + array_slice( $my_cols, 3, null, true );

	return $my_cols;
}

add_action( 'manage_comments_custom_column', 'my_add_comment_columns_content', 10, 2 );
function my_add_comment_columns_content( $column, $comment_id ) {
	global $comment;
	switch ( $column ) :

		case 'rating': {
			echo get_comment_meta( $comment_id, 'rating', true );
			break;
		}
	endswitch;
}

add_action( 'add_meta_boxes_comment', 'comment_add_meta_box' );
function comment_add_meta_box() {
	add_meta_box( 'my-comment-title', __( 'Rating' ), 'comment_meta_box_age', 'comment', 'normal', 'high' );
}

function comment_meta_box_age( $comment ) {
	$title = get_comment_meta( $comment->comment_ID, 'rating', true );

	?>
	<p>
		<label for="rating"><?php _e( 'Rating' ); ?></label>
		<input type="text" name="rating" value="<?php echo esc_attr( $title ); ?>" class="widefat" />
	</p>
	<?php
}

add_filter( 'comment_form_defaults', 'add_comment_field' );
function add_comment_field( $default ) {

	$default['fields']['rating'] = '<p class="comment-form-rating"><label for="rating">rating</label><input id="rating" name="rating" size="30" type="text" /></p>';

	$default['fields']['is-get-auth-data'] = '<p class="comment-form-is-get-auth-data"><label for="is-get-auth-data">is-get-auth-data</label><input id="is-get-auth-data" name="is-get-auth-data" size="30" type="text" /></p>';

	return $default;
}

require_once __DIR__ . '/theme-functions/custom-comment-items.php';

// ajax comment
require_once __DIR__ . '/theme-functions/wp-handle-comment-ajax.php';

add_action( 'wp_ajax_sendcomment', 'ajax_send_comment' );
add_action( 'wp_ajax_nopriv_sendcomment', 'ajax_send_comment' );
function ajax_send_comment() {
	$comment = wp_handle_comment_ajax( wp_unslash( $_POST ) );

	if ( is_wp_error( $comment ) ) {
		$data = (int) $comment->get_error_data();

		if ( ! empty( $data ) ) {
			wp_die(
				'<p>' . $comment->get_error_message() . '</p>',
				__( 'Comment Submission Failure', 'custom-theme' ),
				array(
					'response'  => $data,
					'back_link' => true,
				)
			);
		} else {
			exit;
		}
	}

	$user            = wp_get_current_user();
	$cookies_consent = ( isset( $_POST['wp-comment-cookies-consent'] ) );

	do_action( 'set_comment_cookies', $comment, $user, $cookies_consent );

	wp_list_comments(
		array(
			'avatar_size' => 0,
			'style'       => 'ul',
			'short_ping'  => true,
			'callback'    => 'comment_custom',
			'reply_text'  => esc_html__( 'Reply', 'custom-theme' ),
		),
		array( $comment )
	);

	die;
}

require_once __DIR__ . '/theme-functions/wp-pagination-comment-ajax.php';

/*  Widgets Setup Start  */

add_action( 'widgets_init', 'theme_widgets_init' );
function theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Subscribe blocks', 'custom-theme' ),
			'id'            => 'subscribe-widgets',
			'description'   => esc_html__( 'For text and images only.', 'custom-theme' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}

/*  Widgets Setup End  */

add_action( 'init', 'create_approver_taxonomy' );
function create_approver_taxonomy() {
	register_taxonomy(
		'approver',
		array( 'post', 'page' ),
		array(
			'label'              => 'approver',
			'show_ui'            => false,
			'public'             => true,
			'publicly_queryable' => null,
			'hierarchical'       => false,
			'rewrite'            => true,
		)
	);
}

add_action( 'transition_post_status', 'set_approver_on_transition_only', 10, 3 );
function set_approver_on_transition_only( $new_status, $old_status, $post ) {
	if ( $old_status === $new_status || 'pending' !== $old_status || 'publish' !== $new_status ) {
		return;
	}

	$user = wp_get_current_user();

	wp_set_post_terms( $post->ID, $user->ID, 'approver' );
}

add_filter( 'bcn_breadcrumb_title', 'custom_breadcrumb_title', 3, 10 );
function custom_breadcrumb_title( $title, $type, $id ) {
	$custom_post_types = array( 'organization', 'app', 'payment', 'promo', 'registration', 'bonus' );
	
	foreach ( $custom_post_types as $post_type ) {
		if ( in_array( "post-$post_type", $type ) ) {
			$post_breadcrumb_title = get_post_meta( $id, $post_type . '_breadcrumb_title', true );
	
			if ( ! empty( $post_breadcrumb_title ) ) {
				return wp_kses( $post_breadcrumb_title, array() );
			}
		}
	}

	$page_breadcrumb_title = get_field( 'custom_breadcrumb_title', $id );

	if ( in_array( 'post-page', $type ) && ! empty( $page_breadcrumb_title ) ) {
		$title = wp_kses( $page_breadcrumb_title, array() );
	}

	return $title;
}
