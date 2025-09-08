<?php

register_post_type( 'license', [
    'label'  => 'Лицензии',
    'labels' => [
        'name'               => 'Лицензии', // основное название для типа записи
        'singular_name'      => 'Лицензии', // название для одной записи этого типа
        'add_new'            => 'Добавить лицензию', // для добавления новой записи
        'add_new_item'       => 'Добавить лицензию', // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => 'Редактировать', // для редактирования типа записи
        'new_item'           => 'Новая лицензия', // текст новой записи
        'view_item'          => 'Смотреть ', // для просмотра записи этого типа.
        'search_items'       => 'Искать ', // для поиска по этим типам записи
        'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
        'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => 'Лицензии', // название меню
    ],
    'description'         => '',
    'public'              => true,
    'show_in_menu'        => true,
    'rest_base'           => null,
    'hierarchical'        => false,
    'show_in_rest'        => false,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
    'has_archive'         => false,
    'rewrite'             => ['slug' => 'license'],
] );