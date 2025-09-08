<?php
if( !defined("ABSPATH")){
    exit;
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once(__DIR__. '/../vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();

}

add_action( 'carbon_fields_register_fields', 'kinvel_add_fields' );
function kinvel_add_fields() {
    require_once(__DIR__.'/fields/operator_fields.php');
    require_once(__DIR__.'/fields/currency_fields.php');
    require_once(__DIR__.'/fields/bonuses_fields.php');
    require_once(__DIR__.'/fields/rating_fields.php');
    require_once(__DIR__.'/fields/geo_fields.php');
    require_once(__DIR__.'/fields/languages_fields.php');
}