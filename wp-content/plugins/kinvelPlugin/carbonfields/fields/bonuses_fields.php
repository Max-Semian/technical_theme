<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once(__DIR__.'/bonus_type_hc.php');

$currencys = get_posts( [
    'post_type' => 'currency',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
] );

$operators = get_posts( [
    'post_type' => 'operator',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
] );

// $bonus_types = get_posts( [
//     'post_type' => 'bonus_type',
//     'numberposts' => -1,
//     'orderby' => 'title',
//     'order' => 'ASC',
// ] );

$currency_data = [];
if($currencys){
    foreach($currencys as $currency){
        $currency_value = get_post_meta( $currency->ID, '_currency_value', true);
        $currency_data[$currency->ID] = $currency->post_title." ($currency_value)";
    }
}

$operator_data = [];
if($operators){
    foreach($operators as $operator){
        $operator_data[$operator->ID] = $operator->post_title;
    }
}

global $bonuses_types;

// $bonus_type_data = [];
// if($bonus_types){
//     foreach($bonus_types as $bonus_type){
//         $bonus_type_data[$bonus_type->ID] = $bonus_type->post_title;
//     }
// }

// var_dump($bonuses_types);

Container::make( 'post_meta', 'Настройки бонуса' )
->where( 'post_type', '=', 'bonus' )
->add_fields([
    Field::make( 'select', 'bonus_operator', 'Оператор бонуса' )
        ->add_options($operator_data),
    // Field::make( 'select', 'bonus_type', 'Тип бонуса' )
    //     ->add_options($bonus_type_data),
    Field::make( 'select', 'bonus_type', 'Тип бонуса' )
        ->add_options($bonuses_types)
        ->set_required( true ),
    Field::make( 'rich_text', 'bonus_welcome_conditions', 'Условия приветственного бонуса' )
        ->set_conditional_logic([[
            'field' => 'bonus_type',
            'value' => 'welcome_bonus',
            'compare' => '='
        ]]),
    Field::make( 'text', 'bonus_code', 'Код бонуса' ),
    Field::make( 'text', 'bonus_min_deposit', 'Минимальный депозит' )->set_attribute('type', 'number'),
    
    Field::make( 'select', 'bonus_currency_accept', 'Принимаемые валюты' )
        ->add_options($currency_data),
    Field::make( 'text', 'bonus_max', 'Максимальный бонус в процентах' )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_attribute('min', '0')
        ->set_attribute('step', '1'),
    Field::make( 'text', 'bonus_maximum_val', 'Максимальное значение' )
        ->set_width( 50 ),
    Field::make( 'text', 'bonus_free_spins', 'Фриспины' )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_attribute('min', '0')
        ->set_attribute('step', '1'),
    Field::make( 'rich_text', 'bonus_wager', 'Вейджер' ),
    Field::make( 'checkbox', 'bonus_exclusive', 'Эксклюзивный' )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'bonus_operator_visible', 'Отображать в карточке оператора' )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'bonus_visible', 'Отображать на сайте' )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'text', 'bonus_get_link', 'Получить бонус URL' )
        ->set_attribute('type', 'url')
        ->set_required( true ),
] );