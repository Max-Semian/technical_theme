<?php
require_once(__DIR__.'/carbonfields/fields/bonus_type_hc.php');

function get_operator ($id = 0, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'operator',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_operator_displayable',
                'value' => '1'
            ],
		]
    ];
    if($id) {
        $args['include'] = $id;
    }
    $operators = get_posts( $args );
    if($operators){
        foreach($operators as $operator){
            $type = carbon_get_post_meta($operator->ID, 'operator_type');
            $foundation = carbon_get_post_meta($operator->ID, 'operator_foundation');
            $license = carbon_get_post_meta($operator->ID, 'operator_licenses');
            $il = carbon_get_post_meta($operator->ID, 'operator_inteface_langs');
            $sl = carbon_get_post_meta($operator->ID, 'operator_support_langs');
            $payments = carbon_get_post_meta($operator->ID, 'operator_payments_methods');
            $currency = carbon_get_post_meta($operator->ID, 'operator_currency_accept');
            $geoa = carbon_get_post_meta($operator->ID, 'operator_geo_allowed');
            $geof = carbon_get_post_meta($operator->ID, 'operator_geo_forbidden');
            $crypto = carbon_get_post_meta($operator->ID, 'operator_supports_crypto');
            $fiat = carbon_get_post_meta($operator->ID, 'operator_supports_fiat');
            $android = carbon_get_post_meta($operator->ID, 'operator_app_andoroid');
            $ios = carbon_get_post_meta($operator->ID, 'operator_app_ios');
            $visible = carbon_get_post_meta($operator->ID, 'operator_displayable');
            $link = carbon_get_post_meta($operator->ID, 'operator_link');
            $rating_reliability = carbon_get_post_meta($operator->ID, 'operator_criteria_reliability');
            $rating_bonuses = carbon_get_post_meta($operator->ID, 'operator_criteria_bonuses');
            $rating_payments = carbon_get_post_meta($operator->ID, 'operator_criteria_payments');
            $rating_games = carbon_get_post_meta($operator->ID, 'operator_criteria_games');
            $rating_ui = carbon_get_post_meta($operator->ID, 'operator_criteria_ui');
            $rating_support = carbon_get_post_meta($operator->ID, 'operator_criteria_support');
            $rating_total = carbon_get_post_meta($operator->ID, 'operator_criteria_total');
            $rating_reliability_name = carbon_get_post_meta($operator->ID, 'operator_criteria_reliability_name');
            $rating_bonuses_name = carbon_get_post_meta($operator->ID, 'operator_criteria_bonuses_name');
            $rating_payments_name = carbon_get_post_meta($operator->ID, 'operator_criteria_payments_name');
            $rating_games_name = carbon_get_post_meta($operator->ID, 'operator_criteria_games_name');
            $rating_ui_name = carbon_get_post_meta($operator->ID, 'operator_criteria_ui_name');
            $rating_support_name = carbon_get_post_meta($operator->ID, 'operator_criteria_support_name');
            $rating_total_name = carbon_get_post_meta($operator->ID, 'operator_criteria_total_name');


            $operator_criteria_img = carbon_get_post_meta($operator->ID, 'operator_criteria_img');
            $operator_criteria_img_url = '';
            if($operator_criteria_img){
                $operator_criteria_img_url = wp_get_attachment_image_url( $operator_criteria_img, 'full' );
            }
            $advantages = carbon_get_post_meta($operator->ID, 'operator_advantages');

            $operator->type = $type;
            $operator->foundation = $foundation;
            $operator->license = $license;
            $operator->iinteface_lang = $il;
            $operator->support_lang = $sl;
            $operator->payments = $payments;
            $operator->currency = $currency;
            $operator->geo_allowed = $geoa;
            $operator->geo_forbidden = $geof;
            $operator->supports_crypto = $crypto;
            $operator->supports_fiat = $fiat;
            $operator->android_app = $android;
            $operator->ios_app = $ios;
            $operator->visible = $visible;
            $operator->affilative_url = $link;
            $operator->ratings = [
                'reliability' => ['name' => $rating_reliability_name, 'value'=>$rating_reliability],
                'bonuses' => ['name' => $rating_bonuses_name, 'value'=>$rating_bonuses],
                'payments' => ['name' => $rating_payments_name, 'value'=>$rating_payments],
                'games' => ['name' => $rating_games_name, 'value'=>$rating_games],
                'ui' => ['name' => $rating_ui_name, 'value'=>$rating_ui],
                'support' => ['name' => $rating_support_name, 'value'=>$rating_support]
            ];
            $operator->rating_total = ['name' => $rating_total_name, 'value'=>$rating_total];
            $operator->operator_criteria_img_url = $operator_criteria_img_url;
            $operator->advantages = $advantages;
        }
        return $operators;
    }
    return false;
}

function get_bonus ($id = 0, $for_operator=false, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'bonus',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_bonus_visible',
                'value' => '1'
            ],
		]
    ];
    if($id) {
        $args['meta_query'][] = ['key'=>'_bonus_operator', 'value'=>$id];
    }
    if($for_operator) {
        $args['meta_query'][] = ['key'=>'_bonus_operator_visible', 'value'=>'1'];
    }
    $bonuses = get_posts( $args );
    if($bonuses){
        global $bonuses_types;
        foreach($bonuses as $bonus){
            $bt = carbon_get_post_meta($bonus->ID, 'bonus_type');
            $operator = carbon_get_post_meta($bonus->ID, 'bonus_operator');
            $bonus_type_slug = $bt;
            $bonus_type_name = $bonuses_types[$bt];
            $bonus_code = carbon_get_post_meta($bonus->ID, 'bonus_code');
            $bonus_min_deposit = carbon_get_post_meta($bonus->ID, 'bonus_min_deposit');
            $bonus_currency_accept = get_currency(carbon_get_post_meta($bonus->ID, 'bonus_currency_accept'));
            $bonus_max = carbon_get_post_meta($bonus->ID, 'bonus_max');
            $bonus_free_spins = carbon_get_post_meta($bonus->ID, 'bonus_free_spins');
            $bonus_wager = carbon_get_post_meta($bonus->ID, 'bonus_wager');
            $bonus_exclusive = carbon_get_post_meta($bonus->ID, 'bonus_exclusive');
            $bonus_visible = carbon_get_post_meta($bonus->ID, 'bonus_visible');
            $bonus_maximum_val = carbon_get_post_meta($bonus->ID, 'bonus_maximum_val');
            $bonus_welcome_conditions = carbon_get_post_meta($bonus->ID, 'bonus_welcome_conditions');
            $bonus_get_link = carbon_get_post_meta($bonus->ID, 'bonus_get_link');

            $bonus->operator = $operator;
            $bonus->bonus_type_slug = $bonus_type_slug;
            $bonus->bonus_type_name = $bonus_type_name;
            $bonus->bonus_code = $bonus_code;
            $bonus->bonus_min_deposit = $bonus_min_deposit;
            $bonus->bonus_currency_accept = $bonus_currency_accept;
            $bonus->bonus_max = $bonus_max;
            $bonus->bonus_free_spins = $bonus_free_spins;
            $bonus->bonus_wager = $bonus_wager;
            $bonus->bonus_exclusive = $bonus_exclusive;
            $bonus->bonus_visible = $bonus_visible;
            $bonus->bonus_maximum_val = $bonus_maximum_val;
            $bonus->bonus_welcome_conditions = $bonus_welcome_conditions;
            $bonus->bonus_get_link = $bonus_get_link;
        }
        return $bonuses;
    }
    return false;
}

// function get_bonus_types ($id = 0, $sort = 'ASC', $sort_by = 'title') {
//     $args = [
//         'post_type' => 'bonus_type',
//         'numberposts' => -1,
//         'orderby' => $sort_by,
//         'order' => $sort,
//         'post_status' => 'publish',
//     ];
//     if($id) {
//         $args['include'] = $id;
//     }
//     $bonus_types = get_posts( $args );
//     if($bonus_types){
//         return $bonus_types;
//     }
//     return false;
// }

function get_currency ($id = 0, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'currency',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
    ];
    if($id) {
        $args['include'] = $id;
    }
    $currencys = get_posts( $args );
    if($currencys){
        foreach($currencys as $currency){
            $currency_value = carbon_get_post_meta($currency->ID, 'currency_value');
            $currency_checkbox = carbon_get_post_meta($currency->ID, 'currency_checkbox');
            $currency_image = get_the_post_thumbnail_url( $currency->ID, 'full' );
            $currency_iso = carbon_get_post_meta($currency->ID, 'currency_ISO');

            $currency->currency_value = $currency_value;
            $currency->currency_before_summ = $currency_checkbox;
            $currency->currency_image = $currency_image;
            $currency->iso = $currency_iso;
        }
        return $currencys;
    }
    return false;
}

function get_rating ($id = 0, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'rating',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
    ];
    if($id) {
        $args['include'] = $id;
    }
    $ratings = get_posts( $args );
    if($ratings){
        foreach($ratings as $rating){
            $rating_entyties = carbon_get_post_meta($rating->ID, 'rating_entyties');
            $rating_items = [];
            if($rating_entyties === 'bonus'){
                $rating_items = carbon_get_post_meta($rating->ID, 'rating_items_bonus');
            }
            if($rating_entyties === 'operator'){
                $rating_items = carbon_get_post_meta($rating->ID, 'rating_items_operator');
            }

            $rating->rating_entyties = $rating_entyties;
            $rating->rating_items = $rating_items;
        }
        return $ratings;
    }
    return false;
}

function get_geo ($id = 0, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'geo',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
    ];
    if($id) {
        $args['include'] = $id;
    }
    $geos = get_posts( $args );
    if($geos){
        foreach($geos as $geo){
            $geo_iso_1 = carbon_get_post_meta($geo->ID, 'geo_iso_1');
            $geo_iso_2 = carbon_get_post_meta($geo->ID, 'geo_iso_2');
            $geo_country_code = carbon_get_post_meta($geo->ID, 'geo_country_code');

            $geo->iso_1 = $geo_iso_1;
            $geo->iso_2 = $geo_iso_2;
            $geo->country_code = $geo_country_code;
        }
        return $geos;
    }
    return false;
}

function get_language ($id = 0, $sort = 'ASC', $sort_by = 'title') {
    $args = [
        'post_type' => 'language',
        'numberposts' => -1,
        'orderby' => $sort_by,
        'order' => $sort,
        'post_status' => 'publish',
    ];
    if($id) {
        $args['include'] = $id;
    }
    $languages = get_posts( $args );
    if($languages){
        foreach($languages as $language){
            $language_iso_1 = carbon_get_post_meta($language->ID, 'language_iso_1');
            $language_iso_2 = carbon_get_post_meta($language->ID, 'language_iso_2');
            $language_native_name = carbon_get_post_meta($language->ID, 'language_native_name');

            $language->iso_1 = $language_iso_1;
            $language->iso_2 = $language_iso_2;
            $language->native_name = $language_native_name;
        }
        return $languages;
    }
    return false;
}

add_shortcode( 'show_operator_card', 'show_operator_card' );
function show_operator_card ($args) {
    if(!is_admin(  )){
        $id = isset($args['id']) ? $args['id'] : 0;
        $sort = isset($args['sort']) ? $args['sort'] : 'ASC';
        $sort_by = isset($args['sort_by']) ? $args['sort_by']: 'title';
        $operators = get_operator($id, $sort, $sort_by);
        $html = '';
        if(!empty($operators)){
            foreach($operators as $operator){ 
                $bonuses = get_bonus($operator->ID, true);
                $currencys = get_currency($operator->currency);
                $percents = $operator->rating_total['value'] * 10;
                $min_deposit = '';
                $max_bonus = '';
                $bonus_free_spins = '';
                $max_value = '';
                $conditions = '';
                $get_bonus_link = '';
                if(!empty($bonuses)){
                    $min_deposit = !empty($bonuses[0]->bonus_min_deposit) ? $bonuses[0]->bonus_min_deposit : '';
                    if(!empty($min_deposit) && !empty($bonuses[0]->bonus_currency_accept[0])){
                        $min_deposit = $bonuses[0]->bonus_currency_accept[0]->currency_before_summ ? $bonuses[0]->bonus_currency_accept[0]->currency_value.$min_deposit : $min_deposit.$bonuses[0]->bonus_currency_accept[0]->currency_value;
                    }
                    $max_bonus = !empty($bonuses[0]->bonus_max) ? $bonuses[0]->bonus_max : '';
                    if(!empty($max_bonus)){
                        $max_bonus .= '%';
                    }
                    $bonus_free_spins = $bonuses[0]->bonus_free_spins;
                    if(!empty($bonus_free_spins)){
                        $bonus_free_spins .= ' FS';
                    }
                    $max_value = $bonuses[0]->bonus_maximum_val;
                    if(!empty($max_value) && !empty($bonuses[0]->bonus_currency_accept[0])){
                        $max_value = $max_value.$bonuses[0]->bonus_currency_accept[0]->currency_value;
                    }
                    $conditions = $bonuses[0]->bonus_welcome_conditions;
                    $get_bonus_link = !empty($bonuses[0]->bonus_get_link) ? $bonuses[0]->bonus_get_link : '';
                }
                $html .= '<div class="card-item">
                            <div class="card-item-image" style="background-image: url('.get_the_post_thumbnail_url( $operator->ID, 'full' ).'"></div>
                            <div class="card-item-info">
                                <div class="card-item-info-texts">
                                    <a href="'.get_permalink($operator->ID).'" class="cards-item-href">
                                    <h3 class="title">'.__($operator->post_title).'</h3>
                                    </a>
                                    <div class="card-item-rating">
                                        <div class="card-rating-number">'.$operator->rating_total['value'].'</div>
                                        <div class="card-rating-stars"><img src="/wp-content/uploads/2025/05/Stars.svg" style="mask-image: linear-gradient(to right, black '.$percents.'%, transparent '.$percents.'%);"></div>
                                    </div>
                                    <div class="card-item-tags">';
                                    if(!empty($conditions)){
                                        $html .= '<div class="card-item-tags-item">'.__($conditions).'</div>';
                                    }
                                    if(!empty($max_value) || !empty($max_bonus) || !empty($bonus_free_spins)){
                                        $html .= '<div class="card-item-tags-item">';
                                        if(!empty($max_value)){
                                            $html .= $max_value.' ';
                                        }
                                        if(!empty($max_bonus)){
                                            $html .= $max_bonus.' ';
                                        }
                                        if(!empty($bonus_free_spins)){
                                            $html .= $bonus_free_spins;
                                        }
                                        $html .= '</div>';
                                    }
                                    $html .= '</div>
                                    <div class="card-item-lists">';
                                        if(!empty($operator->advantages)){
                                            foreach($operator->advantages as $advantage){
                                                $img_url = '';
                                                if($advantage['operator_advantages_img']){
                                                    $img_url = wp_get_attachment_image_url( $advantage['operator_advantages_img'], 'full' );
                                                }
                                                $html .= '<div class="cart-item-lists-item">';
                                                if(!empty($img_url)){
                                                    $html .= '<div class="card-item-lists-icon"><img src="'.$img_url.'"></div>';
                                                }
                                                    $html .= '<div class="card-item-lists-text">'.__($advantage['operator_advantage_text']).'</div>';
                                                $html .= '</div>';
                                            }
                                        }
                                    $html .= '</div>
                                </div>
                                <div class="card-item-info-buttons">';
                                if(!empty($bonuses[0]->bonus_code)){
                                    $html .= '<div class="card-item-buttons-promocode">
                                                '.__('プロモコード').'<br>
                                                <span class="promocode">'.$bonuses[0]->bonus_code.'</span>
                                            </div>';
                                }
                                $html .= '<a href="'.$get_bonus_link.'" class="card-item-buttons-link" target="_blank">'.__('ボーナスを受け取る').'</a>
                                    <a href="'.$operator->affilative_url.'" class="card-item-buttons-reviews" target="_blank">'.__('レビューを読む').'</a>
                                </div>
                            </div>
                        </div>';
            }
            return $html;
        }
    }
}


add_shortcode( 'show_operator_page_card', 'show_operator_page_card' );
function show_operator_page_card ($args) {
    if(!is_admin(  )){
        $id = isset($args['id']) ? $args['id'] : get_the_ID();
        $sort = isset($args['sort']) ? $args['sort'] : 'ASC';
        $sort_by = isset($args['sort_by']) ? $args['sort_by']: 'title';
        $operators = get_operator($id, $sort, $sort_by);
        $html = '';
        if(!empty($operators)){
            $operator = $operators[0];
            $percents = $operator->rating_total['value'] * 10;
            $html .= '<div class="info-operator-top">
                        <div class="operator-top-image" style="background-color: grey; background-image: url('.get_the_post_thumbnail_url($operator->ID).');"></div>
                        <div class="operator-top-content">
                            <div class="operator-top-content-left">
                                <h1>'.$operator->post_title.'</h1>
                                <div class="operator-top-content-stars-block">
                                        <div class="operator-top-content-stars">
                                            <img decoding="async" src="/wp-content/uploads/2025/05/Stars.svg" style="mask-image: linear-gradient(to right, black '.$percents.'%, transparent '.$percents.'%);">
                                        </div>
                                        <div class="operator-top-content-number">
                                            '.$operator->rating_total['value'].' <span>/ 10</span>
                                        </div>
                                </div>
                                <a href="'.$operator->affilative_url.'" class="operator-top-content-link" target="_blank">'.__('レビューを読').'</a>
                            </div>
                            <div class="operator-top-content-right">';
                                if(!empty($operator->advantages)){
                                    foreach($operator->advantages as $advantage){
                                        $img_url = '';
                                        if($advantage['operator_advantages_img']){
                                            $img_url = wp_get_attachment_image_url( $advantage['operator_advantages_img'], 'full' );
                                        }
                                        $html .= '<div class="operator-top-content-right-item">';
                                        if(!empty($img_url)){
                                            $html .= '<img decoding="async" src="'.$img_url.'">';
                                        }
                                            $html .= '<div>'.__($advantage['operator_advantage_text']).'</div>';
                                        $html .= '</div>';
                                    }
                                }                                
                            $html .= '</div>
                        </div>
                    </div>';
            $html .= '<div class="lazyblock-operator-kartinka-i-statistika-CNeds wp-block-lazyblock-operator-kartinka-i-statistika"><div class="info-operator-stat">
                        <a data-fancybox="stats" data-src="'.$operator->operator_criteria_img_url.'" class="info-operator-stat-left" style="background-image: url('.$operator->operator_criteria_img_url.');"></a>
                        <div class="info-operator-stat-right">';
                                if($operator->ratings){
                                    foreach($operator->ratings as $rating){
                                        $html .= '<div class="info-operator-stat-right-item">
                                                        <div class="stat-item-info">
                                                            <div class="item-name">'.__($rating['name']).'</div>
                                                            <div class="item-bal">'.$rating['value'].' <span>/ 10</span></div>
                                                        </div>
                                                        <div class="item-gradient" style="width: '. $rating['value'] * 10 .'%;"></div>
                                                    </div>';
                                    }
                                }
                        $html .= '<div class="info-operator-stat-right-item">
                                    <div class="stat-item-info">
                                        <div class="item-name">'.$operator->rating_total['name'].'</div>
                                        <div class="item-bal">'.$operator->rating_total['value'].' <span>/ 10</span></div>
                                    </div>
                                    <div class="item-gradient" style="width: '. $operator->rating_total['value'] * 10 .'%;"></div>
                                </div>
                                </div>
                    </div></div>';
        }
        return $html;
    }
}

add_shortcode( 'show_bonus_page_card', 'show_bonus_page_card' );
function show_bonus_page_card ($args) {
    if(!is_admin(  )){
        $id = isset($args['id']) ? $args['id'] : get_the_ID();
        $sort = isset($args['sort']) ? $args['sort'] : 'ASC';
        $sort_by = isset($args['sort_by']) ? $args['sort_by']: 'title';
        $bonuses = get_bonus($id, false, $sort, $sort_by);
        $html = '';
        if(!empty($bonuses)){
            foreach ($bonuses as $bonus) {
                $min_deposit = '';
                $max_bonus = '';
                $bonus_free_spins = '';
                $max_value = '';
                $conditions = '';
                $get_bonus_link = '';
                $min_deposit = !empty($bonus->bonus_min_deposit) ? $bonus->bonus_min_deposit : '';
                if(!empty($min_deposit) && !empty($bonus->bonus_currency_accept[0])){
                    $min_deposit = $bonus->bonus_currency_accept[0]->currency_before_summ ? $bonus->bonus_currency_accept[0]->currency_value.$min_deposit : $min_deposit.$bonus->bonus_currency_accept[0]->currency_value;
                }
                $max_bonus = !empty($bonus->bonus_max) ? $bonus->bonus_max : '';
                if(!empty($max_bonus)){
                    $max_bonus .= '%';
                }
                $bonus_free_spins = $bonus->bonus_free_spins;
                if(!empty($bonus_free_spins)){
                    $bonus_free_spins .= ' FS';
                }
                $max_value = $bonus->bonus_maximum_val;
                if(!empty($max_value) && !empty($bonus->bonus_currency_accept[0])){
                    $max_value = $max_value.$bonus->bonus_currency_accept[0]->currency_value;
                }
                $conditions = $bonus->bonus_welcome_conditions;
                $get_bonus_link = !empty($bonus->bonus_get_link) ? $bonus->bonus_get_link : '';
                $html .= '<div class="lazyblock-operator-blok-s-promokodom-Z1FzruD wp-block-lazyblock-operator-blok-s-promokodom"><div class="info-operator-right info-operator-right-pk">
                        <div class="info-operator-right-tags">';
                            if(!empty($conditions)){
                                $html .= '<div class="info-operator-tags-item">'.__($conditions).'</div>';
                            }
                            if(!empty($max_value) || !empty($max_bonus) || !empty($bonus_free_spins)){
                                $html .= '<div class="info-operator-tags-item">';
                                if(!empty($max_value)){
                                    $html .= $max_value.' ';
                                }
                                if(!empty($max_bonus)){
                                    $html .= $max_bonus.' ';
                                }
                                if(!empty($bonus_free_spins)){
                                    $html .= $bonus_free_spins;
                                }
                                $html .= '</div>';
                            }
                        $html .= '</div>
                    <div class="info-operator-right-buttons">';
                    if(!empty($bonus->bonus_code)){
                        $html .= '<div class="info-operator-buttons-copy">
                            プロモコード<br>
                            <span class="promocode">'.$bonus->bonus_code.'</span>
                        </div>';
                    }
                    $html .= '<a href="'.$get_bonus_link.'" class="info-operator-buttons-link" target="_blank">ボーナスを受け取る</a>
                        </div>
                    </div>
                </div>';
            }
        }
        return $html;
    }
}

add_shortcode( 'show_rating_operator_cards', 'show_rating_operator_cards' );
function show_rating_operator_cards ($args) {
    $raitng = get_rating();
    $html = '';
    if(empty($args['id'])){
        return false;
    }
    if(!empty($raitng)){
        foreach($raitng as $r_item){
            if($r_item->rating_entyties !== 'operator') { return false; }
            if(!empty($args['sort'])){
                $args['sort'] === 'DESC' ? 
                    usort($r_item->rating_items, function($a, $b){return intval($b['rating_item_operator_position']) - intval($a['rating_item_operator_position']);}) 
                    : usort($r_item->rating_items, function($a, $b){return intval($a['rating_item_operator_position']) - intval($b['rating_item_operator_position']);});
            } else {
                usort($r_item->rating_items, function($a, $b){return intval($a['rating_item_operator_position']) - intval($b['rating_item_operator_position']);});
            }
            foreach($r_item->rating_items as $item){
                $html .= do_shortcode( '[show_operator_card id="'.$item['rating_item_operator_id'].'"]');
            }
        }
    }
    return $html;
}