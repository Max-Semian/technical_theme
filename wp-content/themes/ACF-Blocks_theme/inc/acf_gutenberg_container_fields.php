<?php
/**
 * ACF Fields for Gutenberg Container Blocks
 */

// Регистрируем поля для базового контейнера
if (function_exists('acf_add_local_field_group')) {
    
    // Базовый контейнер
    acf_add_local_field_group(array(
        'key' => 'group_gutenberg_container',
        'title' => 'Контейнер для Gutenberg блоков',
        'fields' => array(
            array(
                'key' => 'field_container_title',
                'label' => 'Заголовок контейнера',
                'name' => 'container_title',
                'type' => 'text',
                'instructions' => 'Заголовок будет отображен над содержимым контейнера',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Введите заголовок',
            ),
            array(
                'key' => 'field_background_color',
                'label' => 'Цвет фона',
                'name' => 'background_color',
                'type' => 'color_picker',
                'instructions' => 'Выберите цвет фона для контейнера',
                'required' => 0,
                'default_value' => '',
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            array(
                'key' => 'field_padding',
                'label' => 'Размер отступов',
                'name' => 'padding',
                'type' => 'select',
                'instructions' => 'Выберите размер внутренних отступов',
                'required' => 0,
                'choices' => array(
                    'small' => 'Маленькие',
                    'medium' => 'Средние',
                    'large' => 'Большие',
                ),
                'default_value' => 'medium',
                'wrapper' => array(
                    'width' => '33',
                ),
            ),
            array(
                'key' => 'field_container_type',
                'label' => 'Тип контейнера',
                'name' => 'container_type',
                'type' => 'select',
                'instructions' => 'Выберите визуальный стиль контейнера',
                'required' => 0,
                'choices' => array(
                    'default' => 'Обычный',
                    'card' => 'Карточка',
                    'section' => 'Секция',
                ),
                'default_value' => 'default',
                'wrapper' => array(
                    'width' => '34',
                ),
            ),
            array(
                'key' => 'field_css_class',
                'label' => 'Дополнительные CSS классы',
                'name' => 'css_class',
                'type' => 'text',
                'instructions' => 'Добавьте дополнительные CSS классы для кастомизации',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'custom-class another-class',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gutenberg-container',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    // Расширенный контейнер
    acf_add_local_field_group(array(
        'key' => 'group_gutenberg_container_advanced',
        'title' => 'Расширенный контейнер Gutenberg',
        'fields' => array(
            array(
                'key' => 'field_container_title_adv',
                'label' => 'Заголовок контейнера',
                'name' => 'container_title',
                'type' => 'text',
                'instructions' => 'Заголовок будет отображен над содержимым контейнера',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Введите заголовок',
            ),
            array(
                'key' => 'field_background_color_adv',
                'label' => 'Цвет фона',
                'name' => 'background_color',
                'type' => 'color_picker',
                'instructions' => 'Выберите цвет фона для контейнера',
                'required' => 0,
                'default_value' => '',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_padding_adv',
                'label' => 'Размер отступов',
                'name' => 'padding',
                'type' => 'select',
                'instructions' => 'Выберите размер внутренних отступов',
                'required' => 0,
                'choices' => array(
                    'small' => 'Маленькие',
                    'medium' => 'Средние',
                    'large' => 'Большие',
                ),
                'default_value' => 'medium',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_container_type_adv',
                'label' => 'Тип контейнера',
                'name' => 'container_type',
                'type' => 'select',
                'instructions' => 'Выберите визуальный стиль контейнера',
                'required' => 0,
                'choices' => array(
                    'default' => 'Обычный',
                    'card' => 'Карточка',
                    'section' => 'Секция',
                ),
                'default_value' => 'default',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_show_block_count',
                'label' => 'Показать счетчик блоков',
                'name' => 'show_block_count',
                'type' => 'true_false',
                'instructions' => 'Показать количество блоков в заголовке (только в админке)',
                'required' => 0,
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_restrict_blocks',
                'label' => 'Ограничить типы блоков',
                'name' => 'restrict_blocks',
                'type' => 'true_false',
                'instructions' => 'Включить ограничение на типы блоков, которые можно добавлять',
                'required' => 0,
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_max_blocks',
                'label' => 'Максимальное количество блоков',
                'name' => 'max_blocks',
                'type' => 'number',
                'instructions' => 'Максимальное количество блоков, которое можно добавить (0 = без ограничений)',
                'required' => 0,
                'default_value' => 0,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_allowed_block_types',
                'label' => 'Разрешенные типы блоков',
                'name' => 'allowed_block_types',
                'type' => 'checkbox',
                'instructions' => 'Выберите типы блоков, которые можно добавлять в контейнер',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_restrict_blocks',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'choices' => array(
                    'core/paragraph' => 'Абзац',
                    'core/heading' => 'Заголовок',
                    'core/image' => 'Изображение',
                    'core/gallery' => 'Галерея',
                    'core/list' => 'Список',
                    'core/quote' => 'Цитата',
                    'core/button' => 'Кнопка',
                    'core/buttons' => 'Кнопки',
                    'core/columns' => 'Колонки',
                    'core/group' => 'Группа',
                    'core/spacer' => 'Разделитель',
                    'acf/promo-block' => 'Промо блок',
                    'acf/nav-block' => 'Навигационный блок',
                    'acf/game-block' => 'Блок игр',
                    'acf/advice-block' => 'Блок советов',
                    'acf/news-block' => 'Блок новостей',
                    'acf/bonuses-block' => 'Блок бонусов',
                    'acf/faq-block' => 'FAQ блок',
                ),
                'default_value' => array(),
                'layout' => 'vertical',
            ),
            array(
                'key' => 'field_css_class_adv',
                'label' => 'Дополнительные CSS классы',
                'name' => 'css_class',
                'type' => 'text',
                'instructions' => 'Добавьте дополнительные CSS классы для кастомизации',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'custom-class another-class',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/gutenberg-container-advanced',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
?>
