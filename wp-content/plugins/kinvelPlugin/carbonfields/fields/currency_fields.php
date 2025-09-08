<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Настройки валюты' )
->where( 'post_type', '=', 'currency' )
->add_fields([
    Field::make( 'text', 'currency_value', 'Обозначение валюты' ),
    Field::make( 'text', 'currency_iso', 'Код ISO-4217' ),
    Field::make( 'checkbox', 'currency_checkbox', 'Отображение перед суммой' ),
] );