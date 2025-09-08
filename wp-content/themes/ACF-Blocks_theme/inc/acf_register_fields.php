<?php
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Настройки кнопок Хедера',
        'menu_title'    => 'Настройки кнопок Хедера',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_header_settings',
    'title' => 'Настройки шапки',
    'fields' => array(
        array(
            'key' => 'field_header_reg_link',
            'label' => 'Ссылка кнопки регистрации',
            'name' => 'header-reg-link',
            'type' => 'url',
            'required' => 0,
        ),
        array(
            'key' => 'field_header_reg_text',
            'label' => 'Текст кнопки регистрации',
            'name' => 'header-reg-text',
            'type' => 'text',
            'required' => 0,
        ),
        array(
            'key' => 'field_header_login_link',
            'label' => 'Ссылка кнопки входа',
            'name' => 'header-login-link',
            'type' => 'url',
            'required' => 0,
        ),
        array(
            'key' => 'field_header_login_text',
            'label' => 'Текст кнопки входа',
            'name' => 'header-login-text',
            'type' => 'text',
            'required' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-general-settings',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
));

endif;
