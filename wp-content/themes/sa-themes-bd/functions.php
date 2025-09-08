<?php
// Подключаем стили и скрипты
function tgg_scripts() {
	//wp_deregister_style('wp-block-library');
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('slick', get_stylesheet_directory_uri().'/assets/css/slick.css');
	wp_enqueue_style('slick-theme', get_stylesheet_directory_uri().'/assets/css/slick-theme.css');
	wp_enqueue_style('fancybox', get_stylesheet_directory_uri().'/assets/css/fancybox.css');
	wp_deregister_script('jquery');
    wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), null, true);  
	wp_enqueue_script('jquery');
	wp_register_script('slick-script', get_stylesheet_directory_uri().'/assets/js/slick.js', array('jquery'), false, true);
	wp_enqueue_script('slick-script');
	wp_register_script('fancybox-script', get_stylesheet_directory_uri().'/assets/js/fancybox.js', array('jquery'), false, true);
	wp_enqueue_script('fancybox-script');
	wp_register_script('scripts-script', get_stylesheet_directory_uri().'/assets/js/scripts.js', array('jquery', 'slick-script'), false, array('in_footer' => true, 'strategy' => 'async'));
	wp_enqueue_script('scripts-script');
}
add_action('wp_enqueue_scripts', 'tgg_scripts');
// Подключаем стили для админки
function wph_add_css_file_admin() {
	wp_enqueue_style('mystyle-admin', get_stylesheet_uri());
    wp_enqueue_style('mystyle-admin');
}
add_action('enqueue_block_editor_assets', 'wph_add_css_file_admin');
// Подключаем функции
add_theme_support('menus');
add_theme_support( 'title-tag' );
register_nav_menus(array(
	'main_menu' => 'Главное меню',
	'footer_menu_one' => 'Меню в подвале 1',
	'footer_menu_two' => 'Меню в подвале 2',
	'footer_menu_three' => 'Меню в подвале 3',
	'footer_menu_four' => 'Меню в подвале 4'
));
add_theme_support('post-thumbnails');
//require_once get_template_directory().'/inc/filter-function.php';
// Убираем уведомление об обновлении тем
add_filter('site_transient_update_themes', 'no_update_is_themes');
function no_update_is_themes($value) {
	if (isset($value->response['twentytwentytwo'])) {
		unset($value->response['twentytwentytwo']);
	}
	return $value;
}
// Отключаем глобальные стили wordpress
add_action('init',function() {
	remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
	remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
});

// Разрешаем загрузку svg
function svg_upload_allow($mimes) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'svg_upload_allow');

// Стилизцем меню Header
class True_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		if ($depth == 0) {
			$output .= '<ul class="sub-menu">';
		} else {
			$output .= '<ul class="sub-sub-menu">';
		}
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		if ($depth == 0) {
			$output .= '</ul>';
		} else {
			$output .= '</ul>';
		}
	}
	function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0) {
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
		$image = get_field('image_icon', $item->ID);
		if ($image) {
			$image_html = '<img src="' . $image . '" alt="img" class="svg">';
		} else {
			$image_html = '';
		}
		$output .= $indent . '<li' . $id . $value . $class_names . '>';
		$attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
		
		// Ensure all links have href attribute for crawlability
		if (!empty($item->url)) {
			$attributes .= ' href="' . esc_attr($item->url) . '"';
		} else {
			// For menu items without URL (like parent items), add href="#" and accessibility attributes
			$attributes .= ' href="#" role="button" aria-expanded="false" aria-haspopup="true" tabindex="0"';
		}
		
		$item_output = $args->before;
		$item_output .= $image_html;
		$item_output .= '<a' . $attributes . '>';       
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

// Добавляем свои категории для блоков
function sa_add_custom_categories_blocks($categories) {
	$custom_categories = array(
		array(
			'slug' => 'sa-suctom-sections',
			'title' => 'Кастомные секции',
			'position' => 0,
		),
		array(
			'slug' => 'sa-custom-sidebars',
			'title' => 'Кастомные блоки для sidebar',
			'position' => 1,
		),
		array(
			'slug' => 'sa-custom-blocks',
			'title' => 'Кастомные блоки',
			'position' => 2,
		),
	);
	$added_categories = array();
	foreach ($custom_categories as $custom_category) {
		$position = $custom_category['position'];
		unset($custom_category['position']);
		$added_categories[$position] = $custom_category;
	}
	ksort($added_categories);
	foreach ($added_categories as $position => $custom_category) {
		array_splice($categories, $position, 0, array($custom_category));
	}
    return $categories;
}
add_filter('block_categories_all', 'sa_add_custom_categories_blocks', 10, 2);

// Шорткод блока содержимое
function info_content_function($atts) {
	$title = $atts['title'];
	return '<div class="info-block-button-mobile"></div><div class="info-block-text-mobile"></div><div class="right-info-block"><div class="title-info">'.$title.'</div><div class="info-block-lists"></div></div>';
}
add_shortcode('info_content', 'info_content_function');

// Шорткод блока содержимое страницы операторы
function operator_content_function($atts) {
	$title = $atts['title'];
	return '<div class="right-info-block operator-page-content"><div class="title-info">'.$title.'</div><div class="info-block-lists"></div></div>';
}
add_shortcode('operator_content', 'operator_content_function');

// Шорткод карточек на главной
function cards_section_function($atts) {
	ob_start();
	global $post;
	if ($atts['id']) {
		$ids = $bodytag = str_replace(' ', '', $atts['id']);
		$ids = explode(',', $atts['id']);
		$query = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => ['post', 'casino_review'],
			'orderby' => 'post__in',
			'post__in' => $ids
		));
	} else {
		$query = get_posts( array(
			'posts_per_page' => -1,
			'post_type' => ['post', 'casino_review'],
		));
	}
	$first_item = true;
	foreach($query as $post){
		setup_postdata($post);
?>
		<div class="card-item<?php if ($first_item == true) { ?> top<?php } ?>">
			<div class="card-item-image" style="background-color: grey; <?php if (get_lzb_meta('image')) { ?>background-image: url(<?php echo get_lzb_meta('image')['url']; ?>); <?php } ?>"></div>
			<div class="card-item-info">
				<div class="card-item-info-texts">
					<a href="<?php echo get_permalink(); ?>" target="_blank" class="cards-item-href"><h3 class="title"><?php echo get_the_title(); ?></h3></a>
					<div class="card-item-rating">
						<?php $rating = get_lzb_meta('rating');
						if ($rating) {
			  				$ball = $rating * 106 / 5; ?>
							<div class="card-rating-number"><?php echo round($rating, 2); ?></div>
							<div class="card-rating-stars" style="width: <?php echo round($ball, 2); ?>px;"><img src="/wp-content/uploads/2025/05/Stars.svg" alt="レーティング <?php echo round($rating, 2); ?> 星"></div>
						<?php } ?>
					</div>
					<div class="card-item-tags">
						<?php foreach (get_lzb_meta('sa_tags') as $item) { ?>
							<div class="card-item-tags-item"><?php echo $item['text']; ?></div>
						<?php } ?>
					</div>
					<div class="card-item-lists">
						<?php foreach (get_lzb_meta('advantages') as $item) { ?>
							<div class="cart-item-lists-item">
								<div class="card-item-lists-icon"><img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo !empty($item['icon']['alt']) ? $item['icon']['alt'] : $item['text']; ?>"></div>
								<div class="card-item-lists-text"><?php echo $item['text']; ?></div>
			 				</div>
						<?php } ?>
					</div>
				</div>
				<div class="card-item-info-buttons">
					<?php if (get_lzb_meta('sa_promocode')) { ?>
						<div class="card-item-buttons-promocode">
							<?php echo get_lzb_meta('text_promocode_button'); ?><br>
							<span class="promocode"><?php echo get_lzb_meta('sa_promocode'); ?></span>
						</div>
					<?php }
					if (get_lzb_meta('link_button_bonus')) { ?>
						<a href="<?php echo get_lzb_meta('link_button_bonus'); ?>" class="card-item-buttons-link" target="_blank"><?php echo get_lzb_meta('text_button_bonus'); ?></a>
					<?php } ?>
					<a href="<?php echo get_permalink(); ?>" class="card-item-buttons-reviews" target="_blank">レビューを読</a>
				</div>
			</div>
		</div>
	<?php $first_item = false;
	}
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode('cards_section', 'cards_section_function');

// Шорткод breadcrumbs
function custom_breadcrumbs_function($atts) {
	if (is_search()) {
		return '<section class="breadcrumbs"><div class="breadcrumb"><a href="/">ホームページ</a> <span>/</span> <b>検索結果: '.$_GET['s'].'</b></div></section>';
	} else if (is_single() && get_post_type() === 'post') {
		$category = get_the_category();
		$category_link = get_category_link($category[0]->term_id);
		return '<section class="breadcrumbs"><div class="breadcrumb"><a href="/">ホームページ</a> <span>/</span> <a href="'.esc_url($category_link).'">'.$category[0]->name.'</a> <span>/</span> <b>'.get_the_title().'</b></div></section>';
	} else if (is_single() && get_post_type() != 'post') {
		/*$category = wp_get_post_terms(get_the_ID(), 'casino_review_cat');
		$category_link = get_term_link($category[0]->term_id);
		return '<section class="breadcrumbs"><div class="breadcrumb"><a href="/">ホームページ</a> <span>/</span> <a href="'.esc_url($category_link).'">'.$category[0]->name.'</a> <span>/</span> <b>'.get_the_title().'</b></div></section>';*/
		return '<section class="breadcrumbs"><div class="breadcrumb"><a href="/">ホームページ</a> <span>/</span> オンラインカジノ <span>/</span> <b>'.get_the_title().'</b></div></section>';
	} else {
		return '<section class="breadcrumbs"><div class="breadcrumb"><a href="/">ホームページ</a> <span>/</span> <a href="/casinos/">オペレーターページ</a> <span>/</span> <b>'.get_the_title().'</b></div></section>';
	}
}
add_shortcode('custom_breadcrumbs', 'custom_breadcrumbs_function');

// Шорткод текущий год
function sa_current_year_function($atts) {
	return date('Y');
}
add_shortcode('current_year', 'sa_current_year_function');

// Шорткод текущий месяц
function sa_current_months_function($atts) {
	return date('n');
}
add_shortcode('current_months', 'sa_current_months_function');

// Включаем шорткоды в полях Yoast SEO
add_filter('wpseo_title', 'do_shortcode');
add_filter('wpseo_metadesc', 'do_shortcode');
add_filter('wpseo_opengraph_title', 'do_shortcode');
add_filter('wpseo_opengraph_desc', 'do_shortcode');
add_filter('wpseo_twitter_title', 'do_shortcode');
add_filter('wpseo_twitter_description', 'do_shortcode');

// Отключаем ненужные категории паттернов
function sa_custom_patterns_category() {
	if (class_exists('WP_Block_Patterns_Registry')) {
		// Удаляем ненужные
		unregister_block_pattern_category('banner');
		unregister_block_pattern_category('gallery');
		unregister_block_pattern_category('header');
		unregister_block_pattern_category('posts');
		unregister_block_pattern_category('about');
		unregister_block_pattern_category('testimonials');
		unregister_block_pattern_category('footer');
		unregister_block_pattern_category('call-to-action');
		unregister_block_pattern_category('text');
		// Добавляем свои
		register_block_pattern_category('custom-sections', array('label' => 'Секции'));
		register_block_pattern_category('custom-blocks', array('label' => 'Блоки'));
		register_block_pattern_category('custom-pages', array('label' => 'Страницы'));
	}
}
add_action('init', 'sa_custom_patterns_category', 25);

// Добавляем колонку к записям с их id
function sa_post_id($args){
	$args['post_page_id'] = 'ID';
	return $args;
}
function sa_post_id_content($column, $id){
	if($column === 'post_page_id'){
		echo $id;
	}
}
add_filter('manage_posts_columns', 'sa_post_id', 5);
add_action('manage_posts_custom_column', 'sa_post_id_content', 5, 2);

// Подключаем кастомные паттерны категории Секции
require_once get_stylesheet_directory() . '/inc/patterns/sections/text-and-right-image.php';
require_once get_stylesheet_directory() . '/inc/patterns/sections/information-block-home.php';

// Подключаем кастомные паттерны категории Блоки
require_once get_stylesheet_directory() . '/inc/patterns/blocks/empty-block.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/header-and-text.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/header-and-text-image.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/pros-and-cons.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/dropdown-list.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/dropdown-list-and-text-and-spisok.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/expert-comment.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/image-slider.php';
require_once get_stylesheet_directory() . '/inc/patterns/blocks/block-table.php';

// Подключаем кастомные паттерны custom-pages
require_once get_stylesheet_directory() . '/inc/patterns/pages/operator-page.php';
require_once get_stylesheet_directory() . '/inc/patterns/pages/operator-page-v2.php';

// Регистрируем новые типы записей
require_once get_stylesheet_directory() . '/inc/registers/review-casino.php';

// Добавляем функционал к блоку изображения в gutenberg
add_action('enqueue_block_editor_assets', function() {  
	wp_enqueue_script('sa-edit-block-image-gutenberg', get_template_directory_uri().'/assets/js/gutenberg/gutenbergimageblockedit.js', ['wp-edit-post']);   
});

// Accessibility improvement: Fix heading hierarchy issues
function fix_heading_hierarchy($content) {
    // Only run on frontend
    if (is_admin()) {
        return $content;
    }
    
    // Check if content has heading hierarchy issues
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    $headings = [];
    $xpath = new DOMXPath($dom);
    $heading_nodes = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');
    
    foreach ($heading_nodes as $node) {
        $level = intval(substr($node->tagName, 1));
        $headings[] = ['node' => $node, 'level' => $level];
    }
    
    // Check for hierarchy violations and add accessibility attributes
    $previous_level = 0;
    foreach ($headings as $heading) {
        $current_level = $heading['level'];
        $node = $heading['node'];
        
        // If heading jumps more than one level, add aria-level to clarify structure
        if ($current_level > $previous_level + 1 && $previous_level > 0) {
            // Add aria-level for screen readers
            $node->setAttribute('aria-level', $current_level);
            
            // Add screen reader text to explain the hierarchy
            $sr_text = $dom->createElement('span');
            $sr_text->setAttribute('class', 'sr-only');
            $sr_text->textContent = '(レベル ' . $current_level . ' 見出し) ';
            $node->insertBefore($sr_text, $node->firstChild);
        }
        
        $previous_level = $current_level;
    }
    
    return $dom->saveHTML();
}

// Apply heading hierarchy fix to content
add_filter('the_content', 'fix_heading_hierarchy', 10);

// Add accessibility improvements to search form
function add_search_form_accessibility($form) {
    $form = str_replace(
        '<input type="search"',
        '<input type="search" aria-label="検索キーワードを入力"',
        $form
    );
    
    $form = str_replace(
        '<button type="submit"',
        '<button type="submit" aria-label="検索を実行"',
        $form
    );
    
    return $form;
}
add_filter('get_search_form', 'add_search_form_accessibility');

// Add skip links for keyboard navigation
function add_skip_links() {
    echo '<a class="skip-link" href="#main-content">メインコンテンツへスキップ</a>';
    echo '<a class="skip-link" href="#main-navigation">ナビゲーションへスキップ</a>';
}
add_action('wp_body_open', 'add_skip_links');

// Fix uncrawlable links in content
function fix_uncrawlable_links($content) {
    // Only run on frontend
    if (is_admin()) {
        return $content;
    }
    
    // Replace anchor tags without href attribute
    $content = preg_replace_callback(
        '/<a(?![^>]*href=)([^>]*)>([^<]*)<\/a>/',
        function($matches) {
            $attributes = $matches[1];
            $text = $matches[2];
            
            // Add href="#" and appropriate attributes for accessibility
            $new_attributes = $attributes . ' href="#" role="button" tabindex="0" aria-label="' . esc_attr($text) . '"';
            
            return '<a' . $new_attributes . '>' . $text . '</a>';
        },
        $content
    );
    
    return $content;
}
add_filter('the_content', 'fix_uncrawlable_links', 15);

// Add structured data for better SEO
function add_website_structured_data() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => get_bloginfo('name'),
            'description' => get_bloginfo('description'),
            'url' => home_url('/'),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => array(
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url('/?s={search_term_string}')
                ),
                'query-input' => 'required name=search_term_string'
            )
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
add_action('wp_head', 'add_website_structured_data');

// Ensure Yoast SEO compatibility and add additional meta tags
function enhance_yoast_seo_output() {
    // Add additional meta tags for Japanese market
    echo '<meta name="language" content="ja">';
    echo '<meta name="geo.region" content="JP">';
    echo '<meta name="geo.country" content="Japan">';
    
    // Ensure proper hreflang if not handled by Yoast
    if (is_front_page()) {
        echo '<link rel="alternate" hreflang="ja" href="' . home_url('/') . '">';
    }
}
add_action('wp_head', 'enhance_yoast_seo_output', 1);

// Improve crawlability by ensuring all internal links are valid
function ensure_crawlable_internal_links($content) {
    // Only run on frontend
    if (is_admin()) {
        return $content;
    }
    
    // Fix relative URLs to absolute URLs for better crawling
    $content = str_replace('href="/', 'href="' . home_url('/'), $content);
    
    return $content;
}
add_filter('the_content', 'ensure_crawlable_internal_links', 20);

// Add canonical URL for better SEO (if not handled by Yoast)
function add_canonical_if_missing() {
    if (!function_exists('wpseo_auto_load') && !wp_get_canonical_url()) {
        echo '<link rel="canonical" href="' . get_permalink() . '">';
    }
}
add_action('wp_head', 'add_canonical_if_missing', 5);