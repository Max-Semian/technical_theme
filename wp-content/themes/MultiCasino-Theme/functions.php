<?php

add_action('wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get('Version');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version);
    wp_enqueue_style('media-style', get_template_directory_uri() . '/assets/css/media.css', array(), $theme_version);

    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js');
    wp_enqueue_script('jquery');

    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $theme_version, false);
});

//function theme_dynamic_css() {
//    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/components/css/style.php?ver=' . time() . '">';
// }
// add_action('wp_head', 'theme_dynamic_css');


add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 0);

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');

add_theme_support('menus');


# SVG
add_filter('upload_mimes', 'svg_upload_allow');

function svg_upload_allow($mimes)
{
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

# Fixing the MIME type for SVG files.
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

    // WP 5.1 +
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    } else {
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));
    }

    // the mime type was reset, let's fix it
    // and also check user rights
    if ($dosvg) {

        // allow
        if (current_user_can('manage_options')) {

            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // forbid
        else {
            $data['ext']  = false;
            $data['type'] = false;
        }
    }

    return $data;
}
#SVG

// Регистрация меню
add_action('after_setup_theme', function () {
    register_nav_menus([
        'header_menu' => 'Меню в шапке',
        'footer_menu' => 'Меню в подвале',
    ]);
});

add_action('init', 'mytheme_register_polylang_strings', 20);

function mytheme_register_polylang_strings()
{
    if (function_exists('pll_register_string')) {
        // Зарегистрировать строки из кастомайзера
        pll_register_string('footer_lang_title', 'Select language', 'Theme Strings');
        pll_register_string('footer_copyright_title', 'Footer Copyright Title', 'Theme Strings');
        pll_register_string('footer_copyright_text', 'Footer Copyright Text', 'Theme Strings');
        pll_register_string('404 Title', '404 Title', 'Theme Strings');
        pll_register_string('404 Subtitle', '404 Subtitle', 'Theme Strings');
        pll_register_string('404 Button Text', '404 Button Text', 'Theme Strings');
        pll_register_string('page_published', 'Published', 'Theme Strings');
        pll_register_string('page_updated', 'Updated', 'Theme Strings');
        pll_register_string('text_learn_more', 'Learn more', 'Theme Strings');
    }
}


// внизу functions.php
require get_template_directory() . '/customize.php';


function disable_custom_logo_support()
{
    remove_theme_support('custom-logo');
}
add_action('after_setup_theme', 'disable_custom_logo_support', 20);

function remove_custom_menu_panel($wp_customize)
{
    // Удаление панели "Меню"
    if ($wp_customize->get_panel('nav_menus')) {
        $wp_customize->remove_panel('nav_menus');
    }
}
add_action('customize_register', 'remove_custom_menu_panel', 99);


//alt from media
function mytheme_get_image_alt_by_url($image_url)
{
    if (! $image_url) return '';

    $attachment_id = attachment_url_to_postid($image_url);

    if (! $attachment_id) return '';

    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

    return $alt ? esc_attr($alt) : '';
}

class Custom_Menu_Walker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes) ? ' has-submenu' : '';

        $output .= '<li class="' . trim($has_children) . '">';

        if ($depth === 0 && $has_children) {
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        } else {
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $output .= "</li>\n";
    }

    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= "<ul>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= "</ul>\n";
    }
}

// === Mobile header walker (для разметки как в макете) ===
class Mobile_Header_Walker extends Walker_Nav_Menu {

  public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
    $classes = empty($item->classes) ? [] : (array) $item->classes;
    $has_children = in_array('menu-item-has-children', $classes);

    // li класс для верхнего уровня
    $li_classes = [];
    if ($depth === 0 && $has_children) {
      $li_classes[] = 'has-submenu';
    }
    $li_class_attr = $li_classes ? ' class="'.esc_attr(implode(' ', $li_classes)).'"' : '';

    $output .= '<li'.$li_class_attr.'>';

    // ссылка
    $title = apply_filters('the_title', $item->title, $item->ID);
    $atts  = ' href="'.esc_url($item->url).'"';
    $output .= '<a'.$atts.'>'.esc_html($title).'</a>';

    // стрелка сразу после <a> только у верхнего уровня с детьми
    if ($depth === 0 && $has_children) {
      $arrow = trailingslashit(get_template_directory_uri()).'assets/img/drop_arrow_white_icon.svg';
      $output .= '<img src="'.esc_url($arrow).'" class="submenu-arrow more" alt="">';
    }
  }

  public function end_el( &$output, $item, $depth = 0, $args = null ) {
    $output .= "</li>\n";
  }

  public function start_lvl( &$output, $depth = 0, $args = null ) {
    // подменю как в макете: просто <ul>
    $output .= "<ul>\n";
  }

  public function end_lvl( &$output, $depth = 0, $args = null ) {
    $output .= "</ul>\n";
  }
}


class AMP_Mobile_Header_Walker extends Walker_Nav_Menu {
  private $top_idx = -1;
  private $current_top_idx = null;

  public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
    $classes       = empty($item->classes) ? [] : (array) $item->classes;
    $has_children  = in_array('menu-item-has-children', $classes, true);

    if ($depth === 0) { $this->top_idx++; $this->current_top_idx = $this->top_idx; }

    $li_classes = [];
    if ($depth === 0 && $has_children) { $li_classes[] = 'has-submenu'; }

    $state = 'submenuOpen' . (int) $this->current_top_idx;

    // li открытие c bind только если есть дети
    if ($depth === 0 && $has_children) {
      $output .= sprintf(
        '<li class="%1$s" data-amp-bind-class="%2$s ? &#39;has-submenu open&#39; : &#39;has-submenu&#39;">',
        esc_attr(implode(' ', $li_classes)),
        esc_attr($state)
      );
    } else {
      $output .= $li_classes
        ? sprintf('<li class="%s">', esc_attr(implode(' ', $li_classes)))
        : '<li>';
    }

    // ссылка
    $title = apply_filters('the_title', $item->title, $item->ID);
    $output .= sprintf(
      '<a href="%s">%s</a>',
      esc_url($item->url),
      esc_html($title)
    );

    // кнопка-стрелка для верхнего уровня с детьми
    if ($depth === 0 && $has_children) {
      $arrow = trailingslashit(get_template_directory_uri()) . 'assets/img/drop_arrow_white_icon.svg';
      $output .= sprintf(
        '<button class="submenu-arrow" on="tap:AMP.setState({%1$s: !%1$s})"><amp-img src="%2$s" width="12" height="12" layout="fixed" alt="arrow"></amp-img></button>',
        esc_attr($state),
        esc_url($arrow)
      );
    }
  }

  public function end_el( &$output, $item, $depth = 0, $args = null ) {
    $output .= "</li>\n";
  }

  public function start_lvl( &$output, $depth = 0, $args = null ) {
    if ($depth === 0) {
      $state = 'submenuOpen' . (int) $this->current_top_idx;
      $output .= sprintf(
        '<ul class="submenu" data-amp-bind-class="%s ? &#39;submenu is-open&#39; : &#39;submenu&#39;">'."\n",
        esc_attr($state)
      );
    } else {
      $output .= "<ul>\n";
    }
  }

  public function end_lvl( &$output, $depth = 0, $args = null ) {
    $output .= "</ul>\n";
  }
}



class Walker_Footer_Groups extends Walker_Nav_Menu {

  // Для каждого top-level пункта
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
    if ($depth === 0) {
      // Открываем группу и сразу UL
      $output .= '<section class="yvcLVUuP">';
      $output .=   '<section class="wAXgJnAELvhM">' . esc_html($item->title) . '</section>';
      $output .=   '<ul class="vBKhY0NS8">';
    } else {
      // Элемент подменю
      $output .= '<li><a href="' . esc_url($item->url) . '">' 
               . esc_html($item->title) . '</a></li>';
    }
  }

  // Закрываем UL и обёртку группы
  public function end_el(&$output, $item, $depth = 0, $args = null) {
    if ($depth === 0) {
      $output .=   '</ul>';
      $output .= '</section>';
    }
  }

  // Больше не используем
  public function start_lvl(&$output, $depth = 0, $args = null) {}
  public function end_lvl(&$output, $depth = 0, $args = null) {}
}


// AMP Sidebar Walker
class AMP_Menu_Walker extends Walker_Nav_Menu {
  private $submenu_index = 0;

  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $submenu_id = 'submenuOpen' . $this->submenu_index;
    $output .= '<ul class="submenu" [class]="' . $submenu_id . ' ? \'submenu is-open\' : \'submenu\'">';
  }

  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</ul>';
    $this->submenu_index++;
  }

  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $has_children = in_array('menu-item-has-children', $item->classes);
    $submenu_id = 'submenuOpen' . $this->submenu_index;

    if ($has_children) {
      $output .= '<li class="has-submenu" [class]="' . $submenu_id . ' ? \'has-submenu open\' : \'has-submenu\'">';
      $output .= '<p role="button" tabindex="0" on="tap:AMP.setState({' . $submenu_id . ': !' . $submenu_id . '})">';
      $output .= esc_html($item->title);
      $output .= '</p>';
    } else {
      $output .= '<li>';
      $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }
  }

  public function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= '</li>';
  }
}

// Добавляем фильтр по шаблонам страниц
add_action('restrict_manage_posts', function () {
    global $typenow;

    if ($typenow !== 'page') return;

    $selected = $_GET['page_template'] ?? '';

    $theme_dir = get_template_directory();
    $template_files = glob($theme_dir . '/*.php');

    $templates = wp_get_theme()->get_page_templates();
    $templates_flipped = array_flip($templates);

    echo '<select name="page_template">';
    echo '<option value="">Все шаблоны</option>';

    foreach ($template_files as $filepath) {
        $file = basename($filepath);

        $label = $templates_flipped[$file] ?? basename($file, '.php');

        $selected_attr = selected($file, $selected, false);
        echo "<option value='{$file}' {$selected_attr}>{$label}</option>";
    }

    echo '</select>';
});


add_filter('parse_query', function ($query) {
    global $pagenow;

    if (
        is_admin() &&
        $pagenow === 'edit.php' &&
        $query->get('post_type') === 'page' &&
        !empty($_GET['page_template'])
    ) {
        $query->set('meta_key', '_wp_page_template');
        $query->set('meta_value', $_GET['page_template']);
    }
});
//==========================================================================================

// Добавляем поддержку тегов для страниц
function add_tags_support_for_pages()
{
    // Регистрируем таксономию тегов для типа записи 'page'
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tags_support_for_pages');

// Показываем метабокс тегов в редакторе страниц
function add_tags_meta_box_to_pages()
{
    // Повторно регистрируем для админки, на всякий случай
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('admin_init', 'add_tags_meta_box_to_pages');



// =====================COMMENTS========================================================
add_filter('comment_form_fields', 'top10_reorder_comment_fields');

function top10_reorder_comment_fields($fields)
{

    // the desired order - this fields will be at the beginning
    $myorder = ['author', 'comment'];

    // die(print_r( $fields )); // see what fields are there

    $new_fields = [];

    foreach ($myorder as $key) {
        $new_fields[$key] = $fields[$key];
        unset($fields[$key]);
    }

    // if there are any other fields, let's add them to the end
    if ($fields) {

        foreach ($fields as $key => $val) {
            $new_fields[$key] = $val;
        }
    }

    return $new_fields;
}

function custom_comment_output($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

?>
    <section class="item">
        <?php
        // Вывод изображения аватара
        echo get_avatar($comment, 74);
        ?>

        <section class="AFEal3wW3jwW">
            <ul class="rating">
                <?php
                // Здесь вы можете вставить код для вывода рейтинга
                ?>
            </ul>

            <p class="SUFXkKuPnV6g8mk"><?php echo get_comment_author(); ?></p>
            <p class="SiarGysO5CXH0y3"><?php comment_text(); ?></p>
            <p class="YidciCyW5"><?php comment_date('d.m.Y, H:i'); ?></p>
        </section>
    </section>
<?php
}

function top10_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

?>
    <section class="item">
        <?php
        echo get_avatar($comment, 100, '', '', array('class' => 'huMDpSlLpX'));
        ?>

        <section class="AFEal3wW3jwW">
            <?php
            $stars = get_comment_meta(get_comment_ID(), 'stars', true);
            ?>
            <ul class="rating">
                <?php
                // Вывод звезд в соответствии с $stars
                for ($i = 1; $i <= 5; $i++) {
                    $active = $i <= $stars ? 'active' : '';
                    echo '<li><section class="star ' . $active . '"></section></li>';
                }
                ?>
            </ul>

            <p class="SUFXkKuPnV6g8mk"><?php echo get_comment_author(); ?></p>
            <p class="SiarGysO5CXH0y3"><?php comment_text(); ?></p>
            <p class="YidciCyW5"><?php comment_date('d.m.Y, H:i'); ?></p>
        </section>
    </section>
    <?php
}

function save_comment_stars($comment_id)
{
    if (isset($_POST['stars'])) {
        $stars = intval($_POST['stars']);
        add_comment_meta($comment_id, 'stars', $stars);
    }
}

add_action('comment_post', 'save_comment_stars');

// Функция для получения среднего рейтинга комментариев
function get_comments_avg_rating($post_id = null)
{
    if ($post_id === null) {
        $post_id = get_the_ID();
    }

    $comments = get_comments(array('post_id' => $post_id, 'meta_key' => 'stars'));

    if (!$comments) {
        return 0;
    }

    $total_rating = 0;
    $total_votes = 0;

    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'stars', true);
        if ($rating !== '') {
            $total_rating += (int)$rating;
            $total_votes++;
        }
    }

    return ($total_votes > 0) ? round($total_rating / $total_votes, 1) : 0;
}


// Функция для получения общего числа голосов комментариев
function get_comments_total_votes($post_id = null)
{
    if ($post_id === null) {
        $post_id = get_the_ID();
    }

    $comments = get_comments(array('post_id' => $post_id, 'meta_key' => 'stars'));

    if (!$comments) {
        return 0;
    }

    $total_votes = 0;

    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'stars', true);
        if ($rating !== '') {
            $total_votes += 1;
        }
    }

    return $total_votes;
}
// =====================NE==========COMMENTS========================================================


/*

PAGE All bonuses add ajax btn

*/
// Регистрируем скрипт и передаём данные
// Регистрируем скрипт и передаём данные
function mcf_enqueue_bonus_scripts()
{
    wp_enqueue_script('mcf-bonuses', get_template_directory_uri() . '/assets/js/mcf-bonuses.js', ['jquery'], null, true);

    wp_localize_script('mcf-bonuses', 'mcfBonusesData', [
        'ajax_url'      => admin_url('admin-ajax.php'),
        'jKITgip3jdD7VbI'          => get_terms(['taxonomy' => 'post_tag', 'hide_empty' => false]),
        'loading_text'  => 'Loading...',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_bonus_scripts');

// Обработка AJAX
add_action('wp_ajax_nopriv_mcf_filter_bonuses', 'mcf_filter_bonuses');
add_action('wp_ajax_mcf_filter_bonuses', 'mcf_filter_bonuses');

function mcf_filter_bonuses()
{
    $tag_id = isset($_POST['tag_id']) ? intval($_POST['tag_id']) : 0;
    $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = [
        'post_type'      => ['post', 'page'],
        'tax_query'      => [
            [
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tag_id,
            ],
        ],
        'posts_per_page' => 5,
        'paged'          => $page,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();

            $raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
            $rating = intval(round($raw_rating)); // округляем
            $rating = max(0, min(5, $rating)); // ограничиваем от 0 до 5
    ?>
            <section class="ZAOYv1NRyNdr">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
                <section class="wOFCI2kSjym6B">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section> <!-- динамическая звезда -->
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
                    <section class="zzwFqKDfTAE8H"><?php mcf_the_field('Lid_bonusa_template_review_'); ?></section>
                    <section class="buttons">
                        <a href="<?php mcf_the_field('URL_BTN_bonus_template_review_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_GET_BONUS'); ?></a>
                    </section>
                </section>
            </section>
        <?php
        }
        wp_reset_postdata();
        $content = ob_get_clean();
        echo $content;
    } else {
        echo '<p>No bonuses found.</p>';
    }

    wp_die();
}

/*
Close function
PAGE All bonuses add ajax btn
*/

/*
template single bonuses ajax
*/

/*block 1 */
// Подключаем JS
function enqueue_bonus_block_1_script()
{
    wp_enqueue_script(
        'template-single-bonus-block-1',
        get_template_directory_uri() . '/assets/js/template-single-bonus-block-1.js',
        ['jquery'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_bonus_block_1_script');




function load_more_bonus_block_1()
{
    $tag_ids = isset($_POST['tag_ids']) ? explode(',', sanitize_text_field($_POST['tag_ids'])) : [];
    $tag_ids = array_map('intval', $tag_ids);

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;

    $args = [
        'post_type' => ['post', 'page'],
        'tax_query' => [
            [
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
            ],
        ],
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
            $rating = max(0, min(5, intval(round($raw_rating))));
        ?>
            <section class="ZAOYv1NRyNdr">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
                <section class="wOFCI2kSjym6B">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
                    <?php mcf_the_field('Lid_bonusa_template_review_'); ?>
                    <section class="buttons">
                        <a href="<?php mcf_the_field('URL_BTN_bonus_template_review_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_GET_BONUS'); ?></a>
                    </section>
                </section>
            </section>
        <?php
        }
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_bonus_block_1', 'load_more_bonus_block_1');
add_action('wp_ajax_nopriv_load_more_bonus_block_1', 'load_more_bonus_block_1');

/*block 2 */

function enqueue_bonus_block_2_script()
{
    wp_enqueue_script(
        'template-single-bonus-block-2',
        get_template_directory_uri() . '/assets/js/template-single-bonus-block-2.js',
        ['jquery'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_bonus_block_2_script');


// AJAX обработчик блока 2
function load_more_bonus_block_2()
{
    $tag_ids = isset($_POST['tag_ids']) ? explode(',', sanitize_text_field($_POST['tag_ids'])) : [];
    $tag_ids = array_map('intval', $tag_ids);

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;

    $args = [
        'post_type' => ['post', 'page'],
        'tax_query' => [
            [
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
            ],
        ],
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
            $rating = max(0, min(5, intval(round($raw_rating))));
            $name_btn = mcf_get_field('Nazvanie_knopki_GET_BONUS');
            $url_btn = mcf_get_field('URL_BTN_bonus_template_review_');
        ?>
            <section class="ZAOYv1NRyNdr">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
                <section class="wOFCI2kSjym6B">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
                    <?php mcf_the_field('Lid_bonusa_template_review_'); ?>
                    <section class="buttons">
                        <a href="<?php echo esc_url($url_btn); ?>" class="button HKYDfj0abmr"><?php echo esc_html($name_btn); ?></a>
                    </section>
                </section>
            </section>
        <?php
        }
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_bonus_block_2', 'load_more_bonus_block_2');
add_action('wp_ajax_nopriv_load_more_bonus_block_2', 'load_more_bonus_block_2');


/*
    close functions template single bonuses ajax btn
*/


/*

ajax template all casino

*/
function mcf_enqueue_casinos_scripts()
{
    wp_enqueue_script(
        'mcf-casinos',
        get_template_directory_uri() . '/assets/js/mcf-casinos.js',
        ['jquery'],
        null,
        true
    );
    wp_localize_script('mcf-casinos', 'mcfCasinosData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Other casinos',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_casinos_scripts');

// AJAX-обработчик


add_action('wp_ajax_nopriv_mcf_filter_casinos', 'mcf_filter_casinos');
add_action('wp_ajax_mcf_filter_casinos', 'mcf_filter_casinos');
function mcf_filter_casinos()
{
    $tag_id   = isset($_POST['tag_id']) ? intval($_POST['tag_id']) : 0;
    $page     = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : ''; // ДОБАВЛЕНО

    if ($block_id !== 'casinos-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 9,
        'paged'          => $page,
        's'              => $search_query, // ДОБАВЛЕНО ПОИСК
    ];

    if ($tag_id > 0) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        ]];
    } elseif (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();

            $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');

            // Проверяем: если пусто или не число → ставим 0
            $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;

            // Ограничиваем от 0 до 5
            $rating = max(0, min(5, intval($rating)));

            $bonus_text = mcf_get_field('Bonus_ot_etego_kazino__review_single');
            $bonus_t = $bonus_text
        ?>
            <section class="row">
                <section class="cOaNiWcYOOqn LOoqvoP6rrX1T">
                    <?php if (mcf_get_field('Rekomendovannoe_kazino_') == 1): ?>
                        <section class="ZsCBRiEHhjKWIb marker-anim SHZRzuYEDpXjOCf iFbbZygETQm">
                            <span>Recommend</span>
                        </section>
                    <?php endif; ?>
                    <section class="num"><?php echo ($page - 1) * 9 + $query->current_post + 1; ?></section>
                </section>
                <section class="cOaNiWcYOOqn JaAgXBCqq">
                    <?php the_post_thumbnail([79, 79]); ?>
                </section>
                <section class="cOaNiWcYOOqn rcFHnqBtJsdoQl">
                    <section class="casino-name"><?php the_title(); ?></section>
                </section>
                <section class="cOaNiWcYOOqn bQUGYcsZWp">
                    <section class="bonus"><?php mcf_the_field('Bonus_ot_etogo_kazino__review_single'); ?></section>
                </section>
                <section class="cOaNiWcYOOqn ihVIsVxw">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </section>
                <section class="cOaNiWcYOOqn column-6">
                    <section class="buttons">
                        <?php if (mcf_get_field('Pokazyvat_knopku_visit_') == 1): ?>
                            <a href="<?php mcf_the_field('Ssylka_knopki_visit_'); ?>" class="button HKYDfj0abmr">
                                <?php mcf_the_field('Tekst_knopki_visit_'); ?>
                            </a>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button EoXFIVifwrJ">
                            <?php mcf_the_field('Tekst_knopki_review'); ?>
                        </a>
                    </section>
                </section>
            </section>
        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No casinos found.</p>';
    }

    wp_die();
}


//bonus
// Подключаем JS
function enqueue_bonus_block_3_script()
{
    wp_enqueue_script(
        'template-all-casino-bonuses',
        get_template_directory_uri() . '/assets/js/template-all-casino-bonuses.js',
        ['jquery'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_bonus_block_3_script');

// Обработчик AJAX
function load_more_bonus_block_3()
{
    $tag_ids = isset($_POST['tag_ids']) ? explode(',', sanitize_text_field($_POST['tag_ids'])) : [];
    $tag_ids = array_map('intval', $tag_ids);

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 5;

    $args = [
        'post_type' => ['post', 'page'],
        'tax_query' => [
            [
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
            ],
        ],
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
            $rating = max(0, min(5, intval(round($raw_rating))));
        ?>
            <section class="ZAOYv1NRyNdr">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
                <section class="wOFCI2kSjym6B">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
                    <?php mcf_the_field('Lid_bonusa_template_review_'); ?>
                    <section class="buttons">
                        <a href="<?php mcf_the_field('URL_BTN_bonus_template_review_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_GET_BONUS'); ?></a>
                    </section>
                </section>
            </section>
        <?php
        }
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_bonus_block_3', 'load_more_bonus_block_3');
add_action('wp_ajax_nopriv_load_more_bonus_block_3', 'load_more_bonus_block_3');

/*

close ajax template all casino

*/




/* all bonus */
// ✅ Подключаем JS
function mcf_enqueue_slots_scripts()
{
    wp_enqueue_script(
        'mcf-slots',
        get_template_directory_uri() . '/assets/js/mcf-slots.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-slots', 'mcfSlotsData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_slots_scripts');

// ✅ Обработчик AJAX
add_action('wp_ajax_nopriv_mcf_filter_slots', 'mcf_filter_slots');
add_action('wp_ajax_mcf_filter_slots', 'mcf_filter_slots');

function mcf_filter_slots()
{
    $tag_id       = isset($_POST['tag_id']) ? intval($_POST['tag_id']) : 0;
    $page         = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id     = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';
    $all_tag_ids  = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'slots-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => array('post', 'page'),

        'posts_per_page' => 15,
        'paged'          => $page,
        's'              => $search_query,
    ];

    if ($tag_id > 0) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tag_id,
        ]];
    } elseif (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
        ?>
            <section class="slot">
                <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                    <?php the_post_thumbnail([79, 79]); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                    <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                    <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                </a>
                <section class="IlCFhK8wJ">
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                    </section>
                </section>
                <section class="buttons">
                    <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1) : ?>
                        <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_na_slote'); ?></a>
                    <?php endif; ?>
                </section>
            </section>
        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No slots found.</p>';
    }

    wp_die();
}

/* close */

/* page casino rating */
function mcf_enqueue_casino_rating_scripts()
{
    wp_enqueue_script(
        'mcf-casino-rating',
        get_template_directory_uri() . '/assets/js/mcf-casino-rating.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-casino-rating', 'mcfCasinoRatingData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_casino_rating_scripts');

add_action('wp_ajax_nopriv_mcf_filter_casino_rating', 'mcf_filter_casino_rating');
add_action('wp_ajax_mcf_filter_casino_rating', 'mcf_filter_casino_rating');

function mcf_filter_casino_rating()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'casinos-block-2') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 14, // Кол-во постов
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');
            $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
            $rating = max(0, min(5, intval($rating)));
        ?>

            <section class="row">
                <section class="cOaNiWcYOOqn LOoqvoP6rrX1T">
                    <?php if (mcf_get_field('Rekomendovannoe_kazino_') == 1): ?>
                        <section class="ZsCBRiEHhjKWIb marker-anim SHZRzuYEDpXjOCf iFbbZygETQm"><span>Recommend</span></section>
                    <?php endif; ?>
                    <section class="num"><?php echo ($page - 1) * 14 + $query->current_post + 1; ?></section>
                </section>
                <section class="cOaNiWcYOOqn JaAgXBCqq"><?php the_post_thumbnail([79, 79]); ?></section>
                <section class="cOaNiWcYOOqn rcFHnqBtJsdoQl">
                    <section class="casino-name"><?php the_title(); ?></section>
                </section>
                <section class="cOaNiWcYOOqn bQUGYcsZWp">
                    <section class="bonus"><?php mcf_the_field('Bonus_ot_etogo_kazino__review_single'); ?></section>
                </section>
                <section class="cOaNiWcYOOqn ihVIsVxw">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </section>
                <section class="cOaNiWcYOOqn column-6">
                    <section class="buttons">
                        <?php if (mcf_get_field('Pokazyvat_knopku_visit_') == 1): ?>
                            <a href="<?php mcf_the_field('Ssylka_knopki_visit_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_knopki_visit_'); ?></a>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button EoXFIVifwrJ"><?php mcf_the_field('Tekst_knopki_review'); ?></a>
                    </section>
                </section>
            </section>

        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No casinos found.</p>';
    }

    wp_die();
}

//////////////////////////SLOTS//////////////
function mcf_enqueue_slots_rating_scripts()
{
    wp_enqueue_script(
        'mcf-slots-rating',
        get_template_directory_uri() . '/assets/js/mcf-slots-rating.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-slots-rating', 'mcfSlotsRatingData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_slots_rating_scripts');

add_action('wp_ajax_nopriv_mcf_filter_slots_rating', 'mcf_filter_slots_rating');
add_action('wp_ajax_mcf_filter_slots_rating', 'mcf_filter_slots_rating');

function mcf_filter_slots_rating()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'slots-block-2') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 15, // 👈 Меняешь тут если нужно
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
        ?>
            <section class="slot">
                <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                    <?php the_post_thumbnail([79, 79]); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                    <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                    <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                </a>
                <section class="IlCFhK8wJ">
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                    </section>
                </section>
                <section class="buttons">
                    <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1): ?>
                        <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_na_slote'); ?></a>
                    <?php endif; ?>
                </section>
            </section>
        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No slots found.</p>';
    }

    wp_die();
}


/* close */

/* home */

//casinos
function mcf_enqueue_best_casinos_scripts()
{
    wp_enqueue_script(
        'mcf-best-casinos',
        get_template_directory_uri() . '/assets/js/mcf-best-casinos.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-best-casinos', 'mcfBestCasinosData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_best_casinos_scripts');

add_action('wp_ajax_nopriv_mcf_filter_best_casinos', 'mcf_filter_best_casinos');
add_action('wp_ajax_mcf_filter_best_casinos', 'mcf_filter_best_casinos');

function mcf_filter_best_casinos()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'best-casinos-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 14, // 👈 Количество постов
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');
            $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
            $rating = max(0, min(5, intval($rating)));
        ?>

            <section class="row">
                <section class="cOaNiWcYOOqn LOoqvoP6rrX1T">
                    <?php if (mcf_get_field('Rekomendovannoe_kazino_') == 1): ?>
                        <section class="ZsCBRiEHhjKWIb marker-anim SHZRzuYEDpXjOCf iFbbZygETQm"><span>Recommend</span></section>
                    <?php endif; ?>
                    <section class="num"><?php echo ($page - 1) * 14 + $query->current_post + 1; ?></section>
                </section>
                <section class="cOaNiWcYOOqn JaAgXBCqq"><?php the_post_thumbnail([79, 79]); ?></section>
                <section class="cOaNiWcYOOqn rcFHnqBtJsdoQl">
                    <section class="casino-name"><?php the_title(); ?></section>
                </section>
                <section class="cOaNiWcYOOqn bQUGYcsZWp">
                    <section class="bonus"><?php mcf_the_field('Bonus_ot_etogo_kazino__review_single'); ?></section>
                </section>
                <section class="cOaNiWcYOOqn ihVIsVxw">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </section>
                <section class="cOaNiWcYOOqn column-6">
                    <section class="buttons">
                        <?php if (mcf_get_field('Pokazyvat_knopku_visit_') == 1): ?>
                            <a href="<?php mcf_the_field('Ssylka_knopki_visit_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_knopki_visit_'); ?></a>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button EoXFIVifwrJ"><?php mcf_the_field('Tekst_knopki_review'); ?></a>
                    </section>
                </section>
            </section>

        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No casinos found.</p>';
    }

    wp_die();
}


///////////slots///////
function mcf_enqueue_last_slots_scripts()
{
    wp_enqueue_script(
        'mcf-last-slots',
        get_template_directory_uri() . '/assets/js/mcf-last-slots.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-last-slots', 'mcfLastSlotsData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_last_slots_scripts');

add_action('wp_ajax_nopriv_mcf_filter_last_slots', 'mcf_filter_last_slots');
add_action('wp_ajax_mcf_filter_last_slots', 'mcf_filter_last_slots');

function mcf_filter_last_slots()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'last-slots-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 15,
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <section class="slot">
                <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                    <?php the_post_thumbnail([79, 79]); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                    <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                    <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                </a>
                <section class="IlCFhK8wJ">
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                    </section>
                </section>
                <section class="buttons">
                    <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1): ?>
                        <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr">
                            <?php mcf_the_field('Nazvanie_knopki_na_slote'); ?>
                        </a>
                    <?php endif; ?>
                </section>
            </section>
        <?php }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No slots found.</p>';
    }

    wp_die();
}

/* close home */


/* single casino */

function mcf_enqueue_one_slots_scripts()
{
    wp_enqueue_script(
        'mcf-one-slots',
        get_template_directory_uri() . '/assets/js/mcf-one-slots.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-one-slots', 'mcfOneSlotsData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_one_slots_scripts');

add_action('wp_ajax_nopriv_mcf_filter_one_slots', 'mcf_filter_one_slots');
add_action('wp_ajax_mcf_filter_one_slots', 'mcf_filter_one_slots');

function mcf_filter_one_slots()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'one-slots-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 15, // Количество слотов
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <section class="slot">
                <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                    <?php the_post_thumbnail([79, 79]); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                    <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                    <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                </a>
                <section class="IlCFhK8wJ">
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                    </section>
                </section>
                <section class="buttons">
                    <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1): ?>
                        <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr">
                            <?php mcf_the_field('Nazvanie_knopki_na_slote'); ?>
                        </a>
                    <?php endif; ?>
                </section>
            </section>
        <?php }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No slots found.</p>';
    }

    wp_die();
}

/* close single casino */

/*
single slots
*/


/////casino
function mcf_enqueue_multicasino_scripts()
{
    wp_enqueue_script(
        'mcf-multicasino',
        get_template_directory_uri() . '/assets/js/mcf-multicasino.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-multicasino', 'mcfMulticasinoData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_multicasino_scripts');

add_action('wp_ajax_nopriv_mcf_filter_multicasino', 'mcf_filter_multicasino');
add_action('wp_ajax_mcf_filter_multicasino', 'mcf_filter_multicasino');

function mcf_filter_multicasino()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'multicasino-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 14,
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();

            $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');
            $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
            $rating = max(0, min(5, intval($rating)));
        ?>

            <section class="row">
                <section class="cOaNiWcYOOqn LOoqvoP6rrX1T">
                    <?php if (mcf_get_field('Rekomendovannoe_kazino_') == 1): ?>
                        <section class="ZsCBRiEHhjKWIb marker-anim SHZRzuYEDpXjOCf iFbbZygETQm"><span>Recommend</span></section>
                    <?php endif; ?>
                    <section class="num"><?php echo ($page - 1) * 14 + $query->current_post + 1; ?></section>
                </section>
                <section class="cOaNiWcYOOqn JaAgXBCqq"><?php the_post_thumbnail([79, 79]); ?></section>
                <section class="cOaNiWcYOOqn rcFHnqBtJsdoQl">
                    <section class="casino-name"><?php the_title(); ?></section>
                </section>
                <section class="cOaNiWcYOOqn bQUGYcsZWp">
                    <section class="bonus"><?php mcf_the_field('Bonus_ot_etogo_kazino__review_single'); ?></section>
                </section>
                <section class="cOaNiWcYOOqn ihVIsVxw">
                    <ul class="rating">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <li>
                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </section>
                <section class="cOaNiWcYOOqn column-6">
                    <section class="buttons">
                        <?php if (mcf_get_field('Pokazyvat_knopku_visit_') == 1): ?>
                            <a href="<?php mcf_the_field('Ssylka_knopki_visit_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_knopki_visit_'); ?></a>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="button EoXFIVifwrJ"><?php mcf_the_field('Tekst_knopki_review'); ?></a>
                    </section>
                </section>
            </section>

        <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No casinos found.</p>';
    }

    wp_die();
}




//////slots
function mcf_enqueue_more_slots_scripts()
{
    wp_enqueue_script(
        'mcf-more-slots',
        get_template_directory_uri() . '/assets/js/mcf-more-slots.js',
        ['jquery'],
        null,
        true
    );

    wp_localize_script('mcf-more-slots', 'mcfMoreSlotsData', [
        'ajax_url'     => admin_url('admin-ajax.php'),
        'loading_text' => 'Loading...',
        'no_more_text' => 'Load more',
    ]);
}
add_action('wp_enqueue_scripts', 'mcf_enqueue_more_slots_scripts');

add_action('wp_ajax_nopriv_mcf_filter_more_slots', 'mcf_filter_more_slots');
add_action('wp_ajax_mcf_filter_more_slots', 'mcf_filter_more_slots');

function mcf_filter_more_slots()
{
    $page        = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $block_id    = isset($_POST['block_id']) ? sanitize_text_field($_POST['block_id']) : '';
    $all_tag_ids = isset($_POST['all_tag_ids']) && is_array($_POST['all_tag_ids']) ? array_map('intval', $_POST['all_tag_ids']) : [];

    if ($block_id !== 'more-slots-block-1') {
        wp_send_json_error(['message' => 'Invalid block ID']);
    }

    $args = [
        'post_type'      => ['post', 'page'],
        'posts_per_page' => 15,
        'paged'          => $page,
    ];

    if (!empty($all_tag_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $all_tag_ids,
        ]];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <section class="slot">
                <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                    <?php the_post_thumbnail([79, 79]); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                    <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                    <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                </a>
                <section class="IlCFhK8wJ">
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                    </section>
                    <section class="trjlVdTr2tR6YcY">
                        <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                        <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                    </section>
                </section>
                <section class="buttons">
                    <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1): ?>
                        <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr">
                            <?php mcf_the_field('Nazvanie_knopki_na_slote'); ?>
                        </a>
                    <?php endif; ?>
                </section>
            </section>
<?php }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No slots found.</p>';
    }

    wp_die();
}


/* close single slots */


///// Top slots and casinos for AMP /////

function render_amp_posts_block($args, $block_type = 'casino') {
    $query = new WP_Query($args);

    if ($query->have_posts()):
        $counter = 1;
        while ($query->have_posts()): $query->the_post();

            if ($block_type === 'casino'): ?>
                <section class="row">
                    <section class="cOaNiWcYOOqn LOoqvoP6rrX1T">
                        <?php if (mcf_get_field('Rekomendovannoe_kazino_') == 1): ?>
                            <section class="ZsCBRiEHhjKWIb marker-anim SHZRzuYEDpXjOCf iFbbZygETQm">
                                <span>Recommend</span>
                            </section>
                        <?php endif; ?>
                        <section class="num"><?php echo $counter++; ?></section>
                    </section>
                    <section class="cOaNiWcYOOqn JaAgXBCqq">
                        <?php the_post_thumbnail([79, 79]); ?>
                    </section>
                    <section class="cOaNiWcYOOqn rcFHnqBtJsdoQl">
                        <section class="casino-name"><?php the_title(); ?></section>
                    </section>
                    <section class="cOaNiWcYOOqn bQUGYcsZWp">
                        <section class="bonus"><?php mcf_the_field('Bonus_ot_etogo_kazino__review_single'); ?></section>
                    </section>
                    <section class="cOaNiWcYOOqn ihVIsVxw">
                        <ul class="rating">
                            <?php
                            $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');
                            $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
                            $rating = max(0, min(5, intval($rating)));
                            for ($i = 1; $i <= 5; $i++): ?>
                                <li><section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section></li>
                            <?php endfor; ?>
                        </ul>
                    </section>
                    <section class="cOaNiWcYOOqn column-6">
                        <section class="buttons">
                            <?php if (mcf_get_field('Pokazyvat_knopku_visit_') == 1): ?>
                                <a href="<?php mcf_the_field('Ssylka_knopki_visit_'); ?>" class="button HKYDfj0abmr">
                                    <?php mcf_the_field('Tekst_knopki_visit_'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="button EoXFIVifwrJ">
                                <?php mcf_the_field('Tekst_knopki_review'); ?>
                            </a>
                        </section>
                    </section>
                </section>

            <?php elseif ($block_type === 'slot'): ?>
                <section class="slot">
                    <a href="<?php the_permalink(); ?>" class="XCuKthEN2OQnf0">
                        <?php the_post_thumbnail([79, 79]); ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="BqIJeVAzjV9L">
                        <section class="BRBOAATfZs5B"><?php mcf_the_field('provider_text'); ?></section>
                        <section class="HFOqyQGvliz52"><?php the_title(); ?></section>
                    </a>
                    <section class="IlCFhK8wJ">
                        <section class="trjlVdTr2tR6YcY">
                            <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_rtp_slots'); ?></section>
                            <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_RTP'); ?></section>
                        </section>
                        <section class="trjlVdTr2tR6YcY">
                            <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Volatility'); ?></section>
                            <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Volatility'); ?></section>
                        </section>
                        <section class="trjlVdTr2tR6YcY">
                            <section class="imgJmIHawxNbiC PWOqjNJwVO"><?php mcf_the_field('Tekst_Jackpot'); ?></section>
                            <section class="imgJmIHawxNbiC TwMHTramQOCvr"><?php mcf_the_field('Soderzhimoe_Jackpot'); ?></section>
                        </section>
                    </section>
                    <section class="buttons">
                        <?php if (mcf_get_field('Pokazyvat_knopku_?') == 1): ?>
                            <a href="<?php mcf_the_field('ssylka_knopki_na_slote'); ?>" class="button HKYDfj0abmr">
                                <?php mcf_the_field('Nazvanie_knopki_na_slote'); ?>
                            </a>
                        <?php endif; ?>
                    </section>
                </section>
            <?php endif;

        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Записей нет.</p>';
    endif;
}
///// close top slots and casinos for AMP /////

// AMP

/*

MAIN

*/

//amp Не чего не трогать
 /*function force_amp_template( $template ) {

    if ( is_home() || is_front_page() ) {
            return get_stylesheet_directory() . '/home-amp.php';

        } elseif ( is_404() ) {
            return get_stylesheet_directory() . '/404-amp.php';

        } elseif ( is_category() ) {
            return get_stylesheet_directory() . '/category-amp.php';

        } elseif ( is_single() ) {
            return get_stylesheet_directory() . '/single-amp.php';

        } elseif ( is_tag() ) {
            return get_stylesheet_directory() . '/tag-amp.php';

        } elseif ( is_page_template( 'about-author.php' ) ) {
            return get_stylesheet_directory() . '/about-author-amp.php';

        } elseif ( is_page_template( 'all-bonuses.php' ) ) {
            return get_stylesheet_directory() . '/all-bonuses-amp.php';

        } elseif ( is_page_template( 'all-casinos.php' ) ) {
            return get_stylesheet_directory() . '/all-casinos-amp.php';

        } elseif ( is_page_template( 'all-slots.php' ) ) {
            return get_stylesheet_directory() . '/all-slots-amp.php';

        } elseif ( is_page_template( 'bonuses-review.php' ) ) {
            return get_stylesheet_directory() . '/bonuses-review-amp.php';

        } elseif ( is_page_template( 'casino-rating.php' ) ) {
            return get_stylesheet_directory() . '/casino-rating-amp.php';

        } elseif ( is_page_template( 'casinos-review.php' ) ) {
            return get_stylesheet_directory() . '/casinos-review-amp.php';

        } elseif ( is_page_template( 'payouts.php' ) ) {
            return get_stylesheet_directory() . '/payouts-amp.php';

        } elseif ( is_page_template( 'privacy-policy.php' ) ) {
            return get_stylesheet_directory() . '/privacy-policy-amp.php';

        } elseif ( is_page_template( 'slot-review.php' ) ) {
            return get_stylesheet_directory() . '/slot-review-amp.php';

        } else {
            return get_stylesheet_directory() . '/index-amp.php';
        }

    return $template;
    }
    add_filter( 'template_include', 'force_amp_template', 10 );


function remove_amp_query_var_and_endpoint() {
    add_action( 'template_redirect', function() {
        global $wp;
        if ( isset( $wp->query_vars['amp'] ) ) {
            unset( $wp->query_vars['amp'] );
        }
    });

    add_filter( 'rewrite_rules_array', function( $rules ) {
        foreach ( $rules as $rule => $rewrite ) {
            if ( strpos( $rewrite, 'is_amp_endpoint' ) !== false ) {
                unset( $rules[ $rule ] );
            }
        }
        return $rules;
    });

    add_filter( 'amp_post_template_data', function( $data ) {
        $data['amp_endpoint'] = false;
        return $data;
    });
}
add_action( 'init', 'remove_amp_query_var_and_endpoint' );

//amp ничего не трогать
function redirect_amp_to_clean_url() {
    if ( strpos( $_SERVER['REQUEST_URI'], '/amp' ) !== false || isset( $_GET['amp'] ) ) {
        $clean_url = str_replace('/amp', '', $_SERVER['REQUEST_URI']);
        $clean_url = remove_query_arg('amp', $clean_url);
        wp_redirect($clean_url, 301);
        exit;
    }
}
add_action( 'template_redirect', 'redirect_amp_to_clean_url' );

//amp ничего не трогать
function add_amphtml_link() {
    if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
        $amp_url = home_url( add_query_arg( null, null ) );
       //$amp_url = "melbet-turk-giris.top";
        echo '<link rel="amphtml" href="' . esc_url( $amp_url ) . '">';
    }
}
add_action( 'wp_head', 'add_amphtml_link' );

//amp ничего не трогать
//
//
//

//amp-url меняем 
function custom_replace_amp_urls_in_head() {
    ob_start(function($buffer) {
        // Получаем текущий домен сайта
        $site_url = home_url();
        // Получаем кастомный AMP-домен из хупса
        $amp_domain = do_shortcode('[hoops name="amp_domain"]');

        // Заменяем URL только в <link rel="alternate"> и <link rel="amphtml">
        $buffer = preg_replace_callback(
            '/<link\s+rel="(alternate|amphtml)"[^>]*href="([^"]+)"/i',
            function($matches) use ($site_url, $amp_domain) {
                $original_href = $matches[2];
                // Заменяем домен на AMP-домен
                $new_href = str_replace($site_url, rtrim($amp_domain, '/'), $original_href);
                // Если нужно, можно удалить /amp в конце:
                // $new_href = preg_replace('#/amp/?$#', '', $new_href); // Удаляет '/amp' или '/amp/'
                return str_replace($original_href, $new_href, $matches[0]);
            },
            $buffer
        );

        return $buffer;
    });
}
add_action('wp_head', 'custom_replace_amp_urls_in_head', 1);


// Добавляем каноническую ссылку для AMP
function add_canonical_link() 
    {
    if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
        // Получаем значение хупса для канонического сайта
        $canonical_site = do_shortcode('[hoops name="canonical_site"]');
        error_log("Canonical Site URL: " . $canonical_site);

        // Получаем текущий путь URL без домена
        $current_path = parse_url(home_url(add_query_arg(null, null)), PHP_URL_PATH);
        // Формируем каноническую ссылку с заменой домена
        $canonical_url = $canonical_site . $current_path;
        
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">';
    }
}
add_action('wp_head', 'add_canonical_link');*/


/*

MAIN

*/

/*

MAIN

*/

/*

ЗЕРКАЛО

*/
//amp Не чего не трогать
/* function force_amp_template( $template ) {

    if ( is_home() || is_front_page() ) {
            return get_stylesheet_directory() . '/home-amp.php';

        } elseif ( is_404() ) {
            return get_stylesheet_directory() . '/404-amp.php';

        } elseif ( is_category() ) {
            return get_stylesheet_directory() . '/category-amp.php';

        } elseif ( is_single() ) {
            return get_stylesheet_directory() . '/single-amp.php';

        } elseif ( is_tag() ) {
            return get_stylesheet_directory() . '/tag-amp.php';

        } elseif ( is_page_template( 'about-author.php' ) ) {
            return get_stylesheet_directory() . '/about-author-amp.php';

        } elseif ( is_page_template( 'all-bonuses.php' ) ) {
            return get_stylesheet_directory() . '/all-bonuses-amp.php';

        } elseif ( is_page_template( 'all-casinos.php' ) ) {
            return get_stylesheet_directory() . '/all-casinos-amp.php';

        } elseif ( is_page_template( 'all-slots.php' ) ) {
            return get_stylesheet_directory() . '/all-slots-amp.php';

        } elseif ( is_page_template( 'bonuses-review.php' ) ) {
            return get_stylesheet_directory() . '/bonuses-review-amp.php';

        } elseif ( is_page_template( 'casino-rating.php' ) ) {
            return get_stylesheet_directory() . '/casino-rating-amp.php';

        } elseif ( is_page_template( 'casinos-review.php' ) ) {
            return get_stylesheet_directory() . '/casinos-review-amp.php';

        } elseif ( is_page_template( 'payouts.php' ) ) {
            return get_stylesheet_directory() . '/payouts-amp.php';

        } elseif ( is_page_template( 'privacy-policy.php' ) ) {
            return get_stylesheet_directory() . '/privacy-policy-amp.php';

        } elseif ( is_page_template( 'slot-review.php' ) ) {
            return get_stylesheet_directory() . '/slot-review-amp.php';

        } else {
            return get_stylesheet_directory() . '/index-amp.php';
        }

    return $template;
    }
    add_filter( 'template_include', 'force_amp_template', 10 );




// Добавляем каноническую ссылку для AMP
function add_canonical_link() {
    if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
        // Получаем значение хупса для канонического сайта
        $canonical_site = do_shortcode('[hoops name="canonical_site"]');
        error_log("Canonical Site URL: " . $canonical_site);

        // Получаем текущий путь URL без домена
        $current_path = parse_url(home_url(add_query_arg(null, null)), PHP_URL_PATH);
        // Формируем каноническую ссылку с заменой домена
        $canonical_url = $canonical_site . $current_path;
        
        echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">';
    }
}
add_action('wp_head', 'add_canonical_link');

// Фильтр для замены канонической ссылки в AMP с доменом из хупса
function custom_canonical_url($canonical) {
    if (is_amp_endpoint()) {
        // Получаем значение хупса для канонического сайта
        $canonical_site = do_shortcode('[hoops name="canonical_site"]');
        error_log("Canonical Site URL in Filter: " . $canonical_site);

        // Получаем текущий путь URL без домена
        $current_path = parse_url($canonical, PHP_URL_PATH);
        // Формируем новый канонический URL с заменой домена
        $canonical = $canonical_site . $current_path;
    }
    return $canonical;
}
add_filter('wpseo_canonical', 'custom_canonical_url');
*/
/*

ЗЕРКАЛО

*/

// AMP








?>



