<?php
/**
 * File: customize.php
 * Theme Customizer settings: colors + main block background image
 */

if ( ! defined('ABSPATH') ) { exit; }

function mytheme_customize_register(WP_Customize_Manager $wp_customize)
{
    //
    // 🎨 ПАНЕЛЬ: Цвета
    //
    $wp_customize->add_panel('panel_colors', [
        'title'    => __('Цвета', 'your-theme'),
        'priority' => 30,
    ]);

    // ===== СЕКЦИЯ: Базовые цвета =====
    $wp_customize->add_section('section_base_colors', [
        'title' => __('Базовые цвета', 'your-theme'),
        'panel' => 'panel_colors',
    ]);

    $base_colors = [
        'color_text_main'    => ['#FFFFFF', 'Текст'],
        'color_text_subtle'  => ['#DDBBF7', 'Второстепенный текст (в карточках RTP и т.д)'],
        'color_heading'      => ['#FFFFFF', 'Заголовки (кроме h1)'],
        'color_h1'           => ['#FFC527', 'Заголовок (h2 и акценты в блоке бонуса) 1-й цвет градиента'],
        'color_h12'          => ['#FF5500', 'Заголовок (h2 и акценты в блоке бонуса) 2-й цвет градиента'],
        'color_body_bg'      => ['#1D0341', 'Фон сайта'],
    ];
    foreach ($base_colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            [
                'label'    => $label,
                'section'  => 'section_base_colors', // КОММЕНТАРИЙ: правильный ключ section
                'settings' => $id,
            ]
        ));
    }

    // ===== СЕКЦИЯ: Ссылки =====
    $wp_customize->add_section('section_links', [
        'title' => __('Ссылки и кнопки', 'your-theme'),
        'panel' => 'panel_colors',
    ]);

    $link_colors = [
        'color_link'            => ['#FFC527', 'Цвет выделенного текста в футере, кнопки на бонуске и карточках слотов 1-й цвет градиента'],
        'color_link2'           => ['#FF5500', 'Цвет выделенного текста в футере, кнопки на бонуске и карточках слотов 2-й цвет градиента'],
        'color_link_hover'      => ['#2DFD84', 'Ссылка при наведении'],
        'color_error'           => ['#EE4646', 'Цвет ошибок/акцентов'],
        'color_button_1_bg'     => ['#FFC527', 'Кнопка 1 (фон) 1-й цвет градиента'],
        'color_button_1_bg2'    => ['#FF5500', 'Кнопка 1 (фон) 2-й цвет градиента'],
        'color_button_1_text'   => ['#FFFFFF', 'Кнопка 1 (текст)'],
        'color_button_2_border' => ['#FFC527', 'Кнопка 2 (граница) 1-й цвет градиента'],
        'color_button_2_border2'=> ['#FF5500', 'Кнопка 2 (граница) 2-й цвет градиента'],
    ];
    foreach ($link_colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            [
                'label'    => $label,
                'section'  => 'section_links', // КОММЕНТАРИЙ
                'settings' => $id,
            ]
        ));
    }

    // ===== СЕКЦИЯ: Хедер и меню =====
    $wp_customize->add_section('section_header', [
        'title' => __('Хедер и меню', 'your-theme'),
        'panel' => 'panel_colors',
    ]);

    $header_colors = [
        'color_header_bg'     => ['#290956', 'Фон шапки 1-й цвет градиента'],
        'color_header_bg2'    => ['#3E1672', 'Фон шапки 2-й цвет градиента'],
        'color_accent'        => ['#2F0071', 'Акцент (линии под пунктами меню при наведении)'],
        'color_submenu_bg'    => ['#27005c', 'Фон подменю'],
        'color_submenu_hover' => ['#290956', 'Hover подменю'],
    ];
    foreach ($header_colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            [
                'label'    => $label,
                'section'  => 'section_header', // КОММЕНТАРИЙ
                'settings' => $id,
            ]
        ));
    }

    // ===== СЕКЦИЯ: Блоки =====
    $wp_customize->add_section('section_blocks', [
        'title' => __('Блоки', 'your-theme'),
        'panel' => 'panel_colors',
    ]);

    $block_colors = [
        'color_block_head_bg'   => ['#311359', 'Фон карточек слотов'],
        'color_block_banner_bg' => ['#270f47', 'Фон остальных баннеров'],
        'color_marker_bg'       => ['#4EC331', 'Цвет маркера (recommend)'],
    ];
    foreach ($block_colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            [
                'label'    => $label,
                'section'  => 'section_blocks', // КОММЕНТАРИЙ
                'settings' => $id,
            ]
        ));
    }

    // ===== ПОЛЕ: Главное изображение бэкграунда для main-блока =====
    $wp_customize->add_setting('main_block_bg_image', [
        'default'           => '',               // КОММЕНТАРИЙ: пусто — возьмём дефолт из темы
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'main_block_bg_image',
        [
            'label'    => __('Главное изображение  топ блок', 'your-theme'),
            'section'  => 'section_blocks', // КОММЕНТАРИЙ: в секции "Блоки"
            'settings' => 'main_block_bg_image',
        ]
    ));

    // ===== СЕКЦИЯ: Таблицы и прочее =====
    $wp_customize->add_section('section_misc', [
        'title' => __('Таблицы и прочее', 'your-theme'),
        'panel' => 'panel_colors',
    ]);

    $misc_colors = [
        'color_border_light'      => ['#7E668F', 'Границы (light)'],
        'color_table_row_bg_even' => ['#27005c', 'Чётные строки таблицы'],
        'color_table_row_bg_odd'  => ['#1c0043', 'Нечётные строки таблицы'],
        'color_table_border'      => ['#27005C', 'Границы таблиц'],
        'color_404_bg'            => ['#FAFAFA', 'Фон 404 страницы'],
        'color_table_head'        => ['#30115b', 'Фон шапки таблицы, которая вставляется текстовым редактором'],
        'color_table_body'        => ['#250452', 'Фон тела таблицы, которая вставляется текстовым редактором'],
    ];
    foreach ($misc_colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'transport'         => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            [
                'label'    => $label,
                'section'  => 'section_misc', // КОММЕНТАРИЙ
                'settings' => $id,
            ]
        ));
    }
}
add_action('customize_register', 'mytheme_customize_register');

