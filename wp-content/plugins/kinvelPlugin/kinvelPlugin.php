<?php
/**
 * Plugin Name: Katsuoncasi entyties
 * Description: Add entyties
 *
 * Author:      Deakin pavel (Kinvel)
 *
 * Text Domain: ID перевода, указывается в load_plugin_textdomain()
 * Domain Path: Путь до файла перевода.
 *
 * Requires at least: 5.7
 * Requires PHP: 7.0
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     true - активирует плагин для всей сети
 *
 *
 * Version:     1.0
 */

 if( !defined("ABSPATH")){
    exit;
}



require_once(__DIR__.'/transliteration.php');

add_action( 'admin_enqueue_scripts', 'kinvel_enqueue_admin_scripts' );
function kinvel_enqueue_admin_scripts () {
	wp_enqueue_script( 'kinvel_admin_script', plugins_url( '/index.js', __FILE__ ), [], null, true );
}

add_action( 'wp_enqueue_scripts',  'kinvel_enqueue_scripts');
function kinvel_enqueue_scripts () {
    wp_enqueue_style( 'kinvel_style_css', '/wp-content/plugins/kinvelPlugin/kinvel.css');
}

add_action( 'init', 'kinvel_init' );
function kinvel_init(){
    require_once(__DIR__.'/type_records/operator.php');
    require_once(__DIR__.'/type_records/license.php');
    require_once(__DIR__.'/type_records/payments_systems.php');
    require_once(__DIR__.'/type_records/bonuses.php');
    // require_once(__DIR__.'./type_records/bonus_types.php');
    require_once(__DIR__.'/type_records/languages.php');
    require_once(__DIR__.'/type_records/geo.php');
    require_once(__DIR__.'/type_records/currency.php');
    require_once(__DIR__.'/type_records/rating.php');
    require_once(__DIR__.'/getters.php');
}

register_activation_hook( __FILE__, 'kinvel_install' );
function kinvel_install(){
	// Запускаем функцию регистрации типа записи
	kinvel_init();

	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
	flush_rewrite_rules();

    $lang_data = file_get_contents(__DIR__.'/iso_639.json');
    if(!empty($lang_data)){
        $lang_data = json_decode($lang_data);
    }
    if(!empty($lang_data)){
        foreach($lang_data as $lang) {
            $post_data = array(
                'post_type'     => 'language',
                'post_title'    => sanitize_text_field( $lang->name ),
                'post_content'  => '',
                'post_status'   => 'publish',
            );
            $post_id = wp_insert_post( $post_data );
            if($post_id){
                update_post_meta( $post_id, '_language_iso_1', sanitize_text_field( $lang->{'639-1'} ) );
                update_post_meta( $post_id, '_language_iso_2', sanitize_text_field( $lang->{'639-2'} ) );
                update_post_meta( $post_id, '_language_native_name', sanitize_text_field( $lang->nativeName ) );
            }
        }
    }

    $state_data = file_get_contents(__DIR__.'/iso_3166.json');
    if(!empty($state_data)){
        $state_data = json_decode($state_data);
    }
    if(!empty($state_data)){
        foreach($state_data as $state) {
            $post_data = array(
                'post_type'     => 'geo',
                'post_title'    => sanitize_text_field( $state->name ),
                'post_content'  => '',
                'post_status'   => 'publish',
            );
            $post_id = wp_insert_post( $post_data );
            if($post_id){
                update_post_meta( $post_id, '_geo_iso_1', sanitize_text_field( $state->{'alpha-2'} ) );
                update_post_meta( $post_id, '_geo_iso_2', sanitize_text_field( $state->{'alpha-3'} ) );
                update_post_meta( $post_id, '_geo_country_code', sanitize_text_field( $state->{'country-code'} ) );
            }
        }
    }

    $currency_data = file_get_contents(__DIR__.'/iso_4217.json');
    if(!empty($currency_data)){
        $currency_data = json_decode($currency_data);
    }
    if(!empty($currency_data)){
        foreach($currency_data as $currency) {
            $post_data = array(
                'post_type'     => 'currency',
                'post_title'    => sanitize_text_field( $currency->name ),
                'post_content'  => '',
                'post_status'   => 'publish',
            );
            $post_id = wp_insert_post( $post_data );
            if($post_id){
                update_post_meta( $post_id, '_currency_value', sanitize_text_field( $currency->symbol ) );
                update_post_meta( $post_id, '_currency_iso', sanitize_text_field( $currency->alpha ) );
            }
        }
    }
}

register_deactivation_hook( __FILE__, 'myplugin_deactivation' );
function myplugin_deactivation() {
	// Тип записи не регистрируется, а значит он автоматически удаляется - его не нужно удалять как-то еще.
    $currencies = get_currency();
    if(!empty($currencies)){
        foreach($currencies as $currency){
            wp_delete_post( $currency->ID, true );
        }
    }

    $geos = get_geo();
    if(!empty($geos)){
        foreach($geos as $geo){
            wp_delete_post( $geo->ID, true );
        }
    }

    $languages = get_language();
    if(!empty($languages)){
        foreach($languages as $language){
            wp_delete_post( $language->ID, true );
        }
    }
	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
	flush_rewrite_rules();
}



// add_filter('wp_unique_post_slug', 'my_custom_post_slug', 10, 6);
// function my_custom_post_slug($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug) {
//     if($post_type !== 'attachment'){
//         $post = get_post($post_ID);
//         $slug = transliterate(mb_strtolower($post->post_title));
//     }
//     return $slug;
// }

require (__DIR__.'/carbonfields/init.php');