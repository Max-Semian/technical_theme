<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Настройки страны' )
->where( 'post_type', '=', 'geo' )
->add_fields([
    Field::make( 'text', 'geo_iso_1', 'Код ISO alpha-2' ),
    Field::make( 'text', 'geo_iso_2', 'Код ISO alpha-3' ),
    Field::make( 'text', 'geo_country_code', 'Код страны ISO' ),
] );