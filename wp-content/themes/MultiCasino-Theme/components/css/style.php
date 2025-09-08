<style>
    :root {
        <?php
        $fields = [
            // Базовые цвета
            'color_text_main'         => '--color-text-main',
            'color_text_subtle'       => '--color-text-subtle',
            'color_heading'           => '--color-heading',
            'color_h1'                => '--color-h1',
            'color_h12'               => '--color-h12',
            'color_body_bg'           => '--color-body-bg',

            // Ссылки
            'color_link'              => '--color-link',
            'color_link2'              => '--color-link2',
            'color_link_hover'        => '--color-link-hover',
            'color_error'             => '--color-error',

            // Хедер и меню
            'color_header_bg'         => '--color-header-bg',
            'color_header_bg2'        => '--color-header-bg2',
            'color_accent'            => '--color-accent',
            'color_submenu_bg'        => '--color-submenu-bg',
            'color_submenu_hover'     => '--color-submenu-hover',

            // Кнопки
            'color_button_1_bg'       => '--color-button-1-bg',
            'color_button_1_bg2'       => '--color-button-1-bg2',
            'color_button_1_text'     => '--color-button-1-text',
            'color_button_2_border'   => '--color-button-2-border',
            'color_button_2_border2'     => '--color-button-2-border2',

            // Блоки
            'color_block_head_bg'     => '--color-block-head-bg',
            'color_block_banner_bg'   => '--color-block-banner-bg',
            'color_marker_bg'         => '--color-marker-bg',

            // Таблицы и прочее
            'color_border_light'      => '--color-border-light',
            'color_table_row_bg_even' => '--color-table-row-bg-even',
            'color_table_row_bg_odd'  => '--color-table-row-bg-odd',
            'color_table_border'      => '--color-table-border',
            'color_404_bg'            => '--color-404-bg',
            'color_table_head'        => '--color-table-head',
            'color_table_body'        => '--color-table-body',
        ];


        $defaults = [
            // Базовые цвета
            'color_text_main'         => '#FFFFFF',
            'color_text_subtle'       => '#DDBBF7',
            'color_heading'           => '#FFFFFF',
            'color_h1'                => '#FFC527',
            'color_h12'               => '#FF5500',
            'color_body_bg'           => '#1D0341',

            // Ссылки
            'color_link'              => '#FFC527',
            'color_link2'             => '#FF5500',
            'color_link_hover'        => '#2DFD84',
            'color_error'             => '#EE4646',

            // Хедер и меню
            'color_header_bg'         => '#290956',
            'color_header_bg2'        => '#3E1672',
            'color_accent'            => '#2F0071',
            'color_submenu_bg'        => '#27005c',
            'color_submenu_hover'     => '#290956',

            // Кнопки
            'color_button_1_bg'       => '#FFC527',
            'color_button_1_bg2'      => '#FF5500',
            'color_button_1_text'     => '#FFFFFF',
            'color_button_2_border'   => '#FFC527',
            'color_button_2_border2'  => '#FF5500',

            // Блоки
            'color_block_head_bg'     => '#311359',
            'color_block_banner_bg'   => '#270f47',
            'color_marker_bg'         => '#4EC331',

            // Таблицы и прочее
            'color_border_light'      => '#7E668F',
            'color_table_row_bg_even' => '#27005c',
            'color_table_row_bg_odd'  => '#1c0043',
            'color_table_border'      => '#27005c',
            'color_404_bg'            => '#FAFAFA',
            'color_table_head'        => '#30115b',
            'color_table_body'        => '#250452',
        ];

    foreach ( $fields as $setting_name => $css_var ) {
        $default = $defaults[$setting_name] ?? '';
        $value = get_theme_mod( $setting_name, $default );
        if ( $value ) {
            echo "{$css_var}: " . esc_attr( $value ) . ";\n";
        }
    }
    
      $bg_default_url = get_stylesheet_directory_uri() . '/assets/img/bonus_block_bg.webp'; // ← твой дефолт
        $bg_url = get_theme_mod('main_block_bg_image', $bg_default_url);
        if ( $bg_url ) {
            // печатаем сразу с url(...)
            echo "--main-block-bg-image: url('" . esc_url( $bg_url ) . "');\n";
        }
        ?>
    
    }
</style>
