<?php
/**
 * acf_blocks functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package acf_blocks
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
require_once get_template_directory() . '/inc/acf_register_fields.php';
require_once get_template_directory() . '/inc/acf_register_blocks.php';
require_once get_template_directory() . '/inc/acf_gutenberg_container_fields.php';
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function acf_blocks_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on acf_blocks, use a find and replace
		* to change 'acf_blocks' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'acf_blocks', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Меню в шапке', 'acf_blocks' ),
			'menu-2' => esc_html__( 'Меню в отдельном блоке', 'acf_blocks' ),
			'menu-3' => esc_html__( 'Меню в подвале, колонка 1', 'acf_blocks' ),
			'menu-4' => esc_html__( 'Меню в подвале, колонка 2', 'acf_blocks' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'acf_blocks_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	function my_plugin_body_class($classes) {
		$classes[] = 'body';
		return $classes;
	}
	
	add_filter('body_class', 'my_plugin_body_class');
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'acf_blocks_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function acf_blocks_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'acf_blocks_content_width', 640 );
}
add_action( 'after_setup_theme', 'acf_blocks_content_width', 0 );
function current_year_shortcode() {
    return date('Y');
}
add_shortcode('currentyear', 'current_year_shortcode');
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acf_blocks_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'acf_blocks' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'acf_blocks' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'acf_blocks_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
$asset_version = '2.9.5';

function enqueue_time_versioned_style( $handle, $src = '', $deps = array(), $media = 'all' ) {
	$host_path      = get_theme_file_uri( $src );
	$directory_path = get_stylesheet_directory() . $src;

	wp_register_style( $handle, $host_path, $deps, @filemtime( $directory_path ), $media );
	wp_enqueue_style( $handle );
}

function acf_blocks_scripts() {
    global $asset_version;

    // CSS files
	enqueue_time_versioned_style( 'montserrat', '/assets/fonts/montserrat.css' );
	enqueue_time_versioned_style( 'inter', '/assets/fonts/inter.css' );
	enqueue_time_versioned_style( 'main-css', '/assets/css/main.css' );
	enqueue_time_versioned_style( 'response', '/assets/css/response.css' );
	enqueue_time_versioned_style( 'reset', '/assets/css/reset.css' );

    wp_style_add_data('acf_blocks-style', 'rtl', 'replace');

    // JS files
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), $asset_version, true);
    
    // Gutenberg Container Block Enhancement (только в админке)
    if (is_admin()) {
        wp_enqueue_script('gutenberg-container', get_template_directory_uri() . '/assets/js/gutenberg-container.js', array('jquery'), $asset_version, true);
        // Блоки для редактора Gutenberg
        wp_enqueue_script('gutenberg-container-blocks', get_template_directory_uri() . '/assets/js/gutenberg-container-blocks.js', array('wp-blocks', 'wp-element', 'wp-editor'), $asset_version, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action( 'wp_enqueue_scripts', 'acf_blocks_scripts' );
function my_theme_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'footer_logo', array(
        'default'        => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label'   => __( 'Логотип в подвале', 'my-theme' ),
        'section' => 'title_tagline',
        'settings'   => 'footer_logo',
    ) ) );
}
add_action( 'customize_register', 'my_theme_customize_register' );



function my_theme_customize_register2( $wp_customize ) {
    $wp_customize->add_setting( 'header_dark_logo', array(
        'default'        => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_dark_logo', array(
        'label'   => __( 'Логотип в шапке, темная тема', 'my-theme' ),
        'section' => 'title_tagline',
        'settings'   => 'header_dark_logo',
    ) ) );
}
add_action( 'customize_register', 'my_theme_customize_register2' );

function my_custom_body_class($classes) {
	$id  = get_the_ID();
	$dark_mode = get_field('black_logo', $id );
	if($dark_mode){
    $classes[] = 'dark-mode';
	}

    return $classes;
}
add_filter('body_class', 'my_custom_body_class');

/**
 * ===================================================================
 * НОВАЯ GUTENBERG BLOCKS СИСТЕМА (по образцу wp-new)
 * ===================================================================
 */

/**
 * Register and enqueue block assets
 */
function acf_blocks_theme_register_block_assets() {
    // Register block editor script
    wp_register_script(
        'acf-blocks-theme-blocks-editor',
        get_template_directory_uri() . '/assets/js/blocks-editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
        wp_get_theme()->get('Version'),
        true
    );

    // Register block editor styles
    wp_register_style(
        'acf-blocks-theme-blocks-editor',
        get_template_directory_uri() . '/assets/css/blocks-editor.css',
        array('wp-edit-blocks'),
        wp_get_theme()->get('Version')
    );

    // Register frontend block styles
    wp_register_style(
        'acf-blocks-theme-blocks',
        get_template_directory_uri() . '/assets/css/blocks.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('init', 'acf_blocks_theme_register_block_assets');

/**
 * Auto-register all blocks from /blocks/ directory
 */
function acf_blocks_theme_register_blocks() {
    // Create casino theme category
    add_filter('block_categories_all', function($categories) {
        array_unshift($categories, array(
            'slug' => 'casino-theme',
            'title' => __('Casino Theme', 'acf-blocks-theme')
        ));
        return $categories;
    });

    // Enqueue block editor scripts and styles
    add_action('enqueue_block_editor_assets', function() {
        // Bonus Cards Block
        wp_enqueue_script(
            'acf-blocks-theme-bonus-cards-editor',
            get_template_directory_uri() . '/blocks/bonus-cards/index.js',
            array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components'),
            '1.0.0',
            true
        );
        
        wp_enqueue_style(
            'acf-blocks-theme-bonus-cards-editor-style',
            get_template_directory_uri() . '/blocks/bonus-cards/editor.css',
            array(),
            '1.0.0'
        );

        // Sports Categories Block
        wp_enqueue_script(
            'acf-blocks-theme-sports-categories-editor',
            get_template_directory_uri() . '/blocks/sports-categories/index.js',
            array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components'),
            '1.0.0',
            true
        );
        
        wp_enqueue_style(
            'acf-blocks-theme-sports-categories-editor-style',
            get_template_directory_uri() . '/blocks/sports-categories/editor.css',
            array(),
            '1.0.0'
        );

        // Recommended Pages Block
        wp_enqueue_script(
            'acf-blocks-theme-recommended-pages-editor',
            get_template_directory_uri() . '/blocks/recommended-pages/index.js',
            array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components'),
            '1.0.0',
            true
        );
        
        wp_enqueue_style(
            'acf-blocks-theme-recommended-pages-editor-style',
            get_template_directory_uri() . '/blocks/recommended-pages/editor.css',
            array(),
            '1.0.0'
        );

        // Popular Slots Block
        wp_enqueue_script(
            'acf-blocks-theme-popular-slots-editor',
            get_template_directory_uri() . '/blocks/popular-slots/index.js',
            array('wp-blocks', 'wp-element', 'wp-i18n', 'wp-block-editor', 'wp-components'),
            time() + 3,
            true
        );

        wp_enqueue_style(
            'acf-blocks-theme-popular-slots-editor-style',
            get_template_directory_uri() . '/blocks/popular-slots/editor.css',
            array(),
            time() + 1
        );
    });

    // Enqueue frontend assets
    add_action('wp_enqueue_scripts', function() {
        // Bonus Cards Block
        wp_enqueue_style(
            'acf-blocks-theme-bonus-cards-style',
            get_template_directory_uri() . '/blocks/bonus-cards/style.css',
            array(),
            '1.0.0'
        );
        
        wp_enqueue_script(
            'acf-blocks-theme-bonus-cards-script',
            get_template_directory_uri() . '/blocks/bonus-cards/script.js',
            array('jquery'),
            '1.0.0',
            true
        );

        // Sports Categories Block
        wp_enqueue_style(
            'acf-blocks-theme-sports-categories-style',
            get_template_directory_uri() . '/blocks/sports-categories/style.css',
            array(),
            '1.0.0'
        );
        
        wp_enqueue_script(
            'acf-blocks-theme-sports-categories-script',
            get_template_directory_uri() . '/blocks/sports-categories/script.js',
            array('jquery'),
            '1.0.0',
            true
        );

        // Recommended Pages Block
        wp_enqueue_style(
            'acf-blocks-theme-recommended-pages-style',
            get_template_directory_uri() . '/blocks/recommended-pages/style.css',
            array(),
            '1.0.0'
        );
        
        wp_enqueue_script(
            'acf-blocks-theme-recommended-pages-script',
            get_template_directory_uri() . '/blocks/recommended-pages/script.js',
            array('jquery'),
            '1.0.0',
            true
        );

        // Popular Slots Block
        wp_enqueue_style(
            'acf-blocks-theme-popular-slots-style',
            get_template_directory_uri() . '/blocks/popular-slots/style.css',
            array(),
            time()
        );
        
        wp_enqueue_script(
            'acf-blocks-theme-popular-slots-script',
            get_template_directory_uri() . '/blocks/popular-slots/script.js',
            array('jquery'),
            time(),
            true
        );
    });

    // Register blocks using block.json
    register_block_type(get_template_directory() . '/blocks/bonus-cards/block.json');
    register_block_type(get_template_directory() . '/blocks/sports-categories/block.json');
    register_block_type(get_template_directory() . '/blocks/recommended-pages/block.json');
    register_block_type(get_template_directory() . '/blocks/popular-slots/block.json');
}
add_action('init', 'acf_blocks_theme_register_blocks', 5);