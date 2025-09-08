<?php
/**
 * Plugin Name: WP Custom Blocks
 * Description: Набор кастомных Gutenberg-блоков.
 * Version: 1.0.9
 * Author: —
 * Text Domain: wp-custom-blocks
 */

defined('ABSPATH') || exit;

/**
 * Регистрируем ВСЕ блоки из /build/blocks рекурсивно.
 * WP возьмёт зависимости/версии из index.asset.php каждого блока.
 */
add_action('init', function () {
    $root = __DIR__ . '/build/blocks';
    if (!is_dir($root)) return;

    $rii = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($rii as $item) {
        if (!$item->isDir()) continue;
        $dir = $item->getPathname();

        $index_js    = $dir . '/index.js';
        $index_asset = $dir . '/index.asset.php';

        if (file_exists($index_js) && file_exists($index_asset)) {
            register_block_type($dir);
        }
    }
});

/**
 * Фронтовые ассеты для Main Banner:
 * подключаем swiper.css/js и init-скрипт баннера только на страницах,
 * где реально используется блок wp-custom-blocks/banner.
 */
add_action('wp_enqueue_scripts', function () {
    // Ограничим подключение страницами с контентом
    if (!is_singular() && !is_front_page() && !is_home()) return;

    global $post;
    $has_banner = function_exists('has_block') && $post && has_block('wp-custom-blocks/banner', $post);
    if (!$has_banner) return;

    $plugin_url  = plugins_url('', __FILE__);
    $plugin_path = plugin_dir_path(__FILE__);

    // CSS баннера (если нужен на фронте)
    $banner_css = $plugin_path . 'build/blocks/main-banner/index.css';
    if (file_exists($banner_css)) {
        wp_enqueue_style(
            'wpcb-main-banner',
            $plugin_url . '/build/blocks/main-banner/index.css',
            [],
            filemtime($banner_css)
        );
    }

    // Swiper CSS
    $swiper_css = $plugin_path . 'build/swiper-styles.css';
    if (file_exists($swiper_css)) {
        wp_enqueue_style(
            'wpcb-swiper',
            $plugin_url . '/build/swiper-styles.css',
            [],
            filemtime($swiper_css)
        );
    }

    // Swiper JS
    $swiper_js = $plugin_path . 'build/swiper.js';
    if (file_exists($swiper_js)) {
        wp_enqueue_script(
            'wpcb-swiper',
            $plugin_url . '/build/swiper.js',
            [],
            filemtime($swiper_js),
            true
        );
    }

    // Init-скрипт баннера
    $init_js    = $plugin_path . 'build/blocks/main-banner/init-banner-sliders.js';
    $init_asset = $plugin_path . 'build/blocks/main-banner/init-banner-sliders.asset.php';

    $deps = [];
    $ver  = null;
    if (file_exists($init_asset)) {
        $asset = include $init_asset;
        $deps  = isset($asset['dependencies']) ? (array) $asset['dependencies'] : [];
        $ver   = isset($asset['version']) ? $asset['version'] : null;
    }
    // Гарантируем порядок: сначала Swiper, потом init
    if (!in_array('wpcb-swiper', $deps, true)) $deps[] = 'wpcb-swiper';

    if (file_exists($init_js)) {
        wp_enqueue_script(
            'wpcb-main-banner-init',
            $plugin_url . '/build/blocks/main-banner/init-banner-sliders.js',
            $deps,
            $ver ?: filemtime($init_js),
            true
        );
    }
});
