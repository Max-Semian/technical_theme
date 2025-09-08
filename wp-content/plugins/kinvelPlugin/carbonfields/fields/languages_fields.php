<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Настройки страны' )
->where( 'post_type', '=', 'language' )
->add_fields([
    Field::make( 'text', 'language_iso_1', 'Код ISO 639-1' ),
    Field::make( 'text', 'language_iso_2', 'Код ISO 639-2' ),
    Field::make( 'text', 'language_native_name', 'Нативное название' ),
] );