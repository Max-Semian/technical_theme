<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once(__DIR__.'/../../getters.php');

$bonuses = get_bonus();
$operators = get_operator();

$operator_data = [];
if($operators){
    foreach($operators as $operator){
        $operator_data[$operator->ID] = $operator->post_title;
    }
}

$bonus_data = [];
if($bonuses){
    foreach($bonuses as $bonus){
        $bonus_data[$bonus->ID] = $bonus->post_title;
    }
}

Container::make( 'post_meta', 'Настройки Рейтинга' )
->where( 'post_type', '=', 'rating' )
->add_fields([
    Field::make( 'select', 'rating_entyties', __('Сущности рейтинга') )
        ->add_options([
            'bonus' => __('Бонусы'),
            'operator' => __('Операторы'),
        ]),
    Field::make( 'complex', 'rating_items_operator', __('Участники рейтинга (операторы)') )
        ->set_conditional_logic([[
            'field' => 'rating_entyties',
            'value' => 'operator',
            'compare' => '='
        ]])
        ->add_fields([
            Field::make( 'text', 'rating_item_operator_position', __('Позиция') )
                ->set_width(10)
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('step', '1')
                ->set_required( true ),
            Field::make( 'select', 'rating_item_operator_id', __('Оператор') )
                ->add_options($operator_data)
                ->set_required( true )
                ->set_width(80),
        ]),
    Field::make( 'complex', 'rating_items_bonus', __('Участники рейтинга (бонусы)') )
        ->set_conditional_logic([[
            'field' => 'rating_entyties',
            'value' => 'bonus',
            'compare' => '='
        ]])
        ->add_fields([
            Field::make( 'text', 'rating_item_bonus_position', __('Позиция') )
                ->set_width(10)
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('step', '1')
                ->set_required( true ),
            Field::make( 'select', 'rating_item_bonus_id', __('Бонус') )
                ->add_options($bonus_data)
                ->set_required( true )
                ->set_width(80),
        ]),
] );