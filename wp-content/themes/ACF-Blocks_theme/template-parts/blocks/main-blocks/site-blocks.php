<?php
// template-parts/blocks/main-blocks/site-blocks.php

// Проверяем, есть ли гибкое поле 'site_blocks'
if (have_rows('site_blocks')) {

    // Проходим по блокам 'site_blocks'
    while (have_rows('site_blocks')) {
        the_row();
        // Получаем тип текущего блока
        $block_type = get_row_layout();
        // Создаем контекст для текущего блока
        $context = array(
            'field_name' => 'site_blocks',
            'field_key' => get_row_index(),
        );
        // Выводим содержимое текущего блока с передачей контекста
   
        get_template_part('template-parts/blocks/main-blocks/' . $block_type, null, array('context' => $context));
      
    }

}
?>