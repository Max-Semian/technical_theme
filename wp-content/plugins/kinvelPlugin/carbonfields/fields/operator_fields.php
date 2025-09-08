<?php
if( !defined("ABSPATH")){
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$langs = get_posts( [
    'post_type' => 'language',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
] );

$payments = get_posts( [
    'post_type' => 'payment_system',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
] );

$licenses = get_posts( [
    'post_type' => 'license',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
] );

$geos = get_posts( [
    'post_type' => 'geo',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
] );

$currencys = get_posts( [
    'post_type' => 'currency',
    'numberposts' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
] );

$langs_data = [];
if($langs){
    foreach($langs as $lang){
        $native_name = get_post_meta( $lang->ID, '_language_native_name', true );
        $langs_data[$lang->ID] = $lang->post_title.' ('.$native_name.')';
    }
}

$payments_data = [];
if($payments){
    foreach($payments as $payment){
        $payments_data[$payment->ID] = $payment->post_title;
    }
}

$licenses_data = [];
if($licenses){
    foreach($licenses as $license){
        $licenses_data[$license->ID] = $license->post_title;
    }
}

$geo_data = [];
if($geos){
    foreach($geos as $geo){
        $geo_data[$geo->ID] = $geo->post_title;
    }
}

$currency_data = [];
if($currencys){
    foreach($currencys as $currency){
        $currency_value = get_post_meta( $currency->ID, '_currency_value', true);
        $currency_data[$currency->ID] = $currency->post_title." ($currency_value)";
    }
}

Container::make( 'post_meta', 'Настройки оператора' )
->where( 'post_type', '=', 'operator' )
->add_tab('Основные', [
    Field::make( 'multiselect', 'operator_type', 'Тип оператора' )
        ->add_options([
            'Казино' => __('Казино'),
            'Букмейкер' => __('Букмейкер'),
            'Покер-рум' => __('Покер-рум')
        ])
        ->set_required( true ),
    Field::make( 'text', 'operator_foundation', __('Год основания') )->set_attribute('type', 'number'),
    Field::make( 'multiselect', 'operator_licenses', __('Лицензии' ) )
        ->add_options($licenses_data),
    Field::make( 'multiselect', 'operator_inteface_langs', __('Языки интерфейса' ) )
        ->add_options($langs_data),
    Field::make( 'multiselect', 'operator_support_langs', __('Языки саппорта' ) )
        ->add_options($langs_data),
    Field::make( 'multiselect', 'operator_payments_methods', __('Платежные методы' ) )
        ->add_options($payments_data),
    Field::make( 'multiselect', 'operator_currency_accept', __('Принимаемые валюты' ) )
        ->add_options($currency_data),
    Field::make( 'multiselect', 'operator_geo_allowed', __('Ращрешенные гео' ) )
        ->add_options($geo_data),
    Field::make( 'multiselect', 'operator_geo_forbidden', __('Зпрещенные гео' ) )
        ->add_options($geo_data),
    Field::make( 'checkbox', 'operator_supports_crypto', __('Поддерживает крипту' ) )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'operator_supports_fiat', __('Поддерживает фиат' ) )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'operator_app_andoroid', __('Приложение Android' ) )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'operator_app_ios', __('Приложение iOS' ) )
        ->set_option_value( '1' )
        ->set_width( 25 ),
    Field::make( 'checkbox', 'operator_displayable', __('Отображать на сайте' ) )
        ->set_option_value( '1' ),
    Field::make( 'text', 'operator_link', __('Аффилятный URL' ) )
        ->set_attribute('type', 'url')
        ->set_required( true ),
] )

->add_tab('Критерии', [
    Field::make( 'text', 'operator_criteria_reliability_name', __('Название критерия 1' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_reliability', __('Значение критерия 1' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_bonuses_name', __('Название критерия 2' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_bonuses', __('Значение критерия 2' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_payments_name', __('Название критерия 3' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_payments', __('Значение критерия 3' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_games_name', __('Название критерия 4' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_games', __('Значение критерия 4' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_ui_name', __('Название критерия 5' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_ui', __('Значение критерия 5' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_support_name', __('Название критерия 6' ) )->set_width( 50 ),
    Field::make( 'text', 'operator_criteria_support', __('Значение критерия 6' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('step', '0.1'),
    Field::make( 'text', 'operator_criteria_total_name', __('Текст к итоговой оценке' ) ),
    Field::make( 'text', 'operator_criteria_total', __('Итоговая оценка' ) )
        ->set_attribute('type', 'number')
        ->set_width( 50 )
        ->set_default_value(0)
        ->set_attribute('min', '0')
        ->set_attribute('max', '10')
        ->set_attribute('readOnly', true),
    Field::make( 'image', 'operator_criteria_img', __( 'Изображение блока' ) )->set_width(33),
])

->add_tab('Преимущества', [
    Field::make( 'complex', 'operator_advantages', 'Преимущества' )
        ->add_fields([
            Field::make( 'text', 'operator_advantage_text', __('Текст') )->set_width(67),
            Field::make( 'image', 'operator_advantages_img', __( 'Изображение' ) )->set_width(33),
        ])
]);