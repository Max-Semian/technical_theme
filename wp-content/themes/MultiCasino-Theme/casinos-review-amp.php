<?php
/*
Template Name: casinos-review - amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
    <section class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>
        <?php
        $raw_rating = mcf_get_field('Kolvo_zvyozd_review_single');
        $rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
        $rating = max(0, min(5, intval($rating)));
        $text2 = mcf_get_field('Kolvo_golosov_review_single');
        ?>
        <?php if (mcf_have_rows('Osnovnoy_kontent_Casinos_review_single')): ?>
            <?php while (mcf_have_rows('Osnovnoy_kontent_Casinos_review_single')): mcf_the_row(); ?>
                <?php if (mcf_get_row_layout() === 'Main_block_review_single'): ?>
                    <section class="block bQPx8ig52">
                        <h1 class="ttOKnNStIgHIN"><?php the_title() ?></h1>
                        <section class="yoSFOmoQYpDLN">
                            <section class="cDuZQjGrhcf6">
                                <?= the_post_thumbnail(array(258, 258), array('class' => 'olCugVN4WXw2G', 'alt' => get_the_title())); ?>
                                <section class="info-stat">
                                    <ul class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <li>
                                                <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                    <section class="AbKnhMLKHjMIs1Gv"><?php echo $text2; ?></section>
                                </section>
                            </section>
                            <section class="dNZlZimGFmcI7FV">
                                <p><?php mcf_the_field('Lid_review_single'); ?></p>
                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Tablitsa_s_knopkami_review_single'): ?>
                    <section class="best-casinos-items LiwiBKaAgIR">

                        <?php if (mcf_have_rows('table_header_review_single')): ?>
                            <section class="row cVdjC8KmH">
                                <?php
                                $col_index = 1;
                                $header_titles = [];

                                while (mcf_have_rows('table_header_review_single')): mcf_the_row();
                                    $header_title = mcf_get_field('Nazvanie_kolonki_review_single');
                                    $header_titles[] = $header_title;
                                ?>
                                    <section class="cOaNiWcYOOqn column-<?php echo $col_index; ?>">
                                        <?php echo esc_html($header_title); ?>
                                    </section>
                                    <?php $col_index++; ?>
                                <?php endwhile; ?>
                            </section>
                        <?php endif; ?>

                        <?php if (mcf_have_rows('table_rows_review_single')): ?>
                            <?php while (mcf_have_rows('table_rows_review_single')): mcf_the_row(); ?>
                                <section class="row">
                                    <?php
                                    $col_index = 1;
                                    if (mcf_have_rows('table_row_columns_review_single')):
                                        while (mcf_have_rows('table_row_columns_review_single')): mcf_the_row();
                                            $content = mcf_get_field('table_text_row_columns_review_single');
                                            $show_button = mcf_get_field('Pokazyvat_knopku_table_rows');
                                            $link = mcf_get_field('Ssylka_dlya_knopki_table_rows');
                                            $button_text = mcf_get_field('button_text_review_single');
                                    ?>
                                            <section class="cOaNiWcYOOqn column-<?php echo $col_index; ?>">

                                                <?php
                                                if ($col_index !== 1 && empty($show_button) && !empty($header_titles[$col_index - 1])):
                                                ?>
                                                    <p class="cVdjC8KmH FRHAjcEsQAT"><?php echo esc_html($header_titles[$col_index - 1]); ?></p>
                                                <?php endif; ?>

                                                <?php if (!empty($content)): ?>
                                                    <p><?php echo esc_html($content); ?></p>
                                                <?php endif; ?>

                                                <?php if (!empty($show_button) && !empty($link)): ?>
                                                    <section class="buttons">
                                                        <a href="<?php echo esc_url($link); ?>" class="button HKYDfj0abmr">
                                                            <?php echo esc_html($button_text ?: $content); ?>
                                                        </a>
                                                    </section>
                                                <?php endif; ?>

                                            </section>
                                    <?php
                                            $col_index++;
                                        endwhile;
                                    endif;
                                    ?>
                                </section>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Tekstovyy_blok_review_single'): ?>
                    <section class="block wOFCI2kSjym6B">
                        <section class="vjUy54vJFJ5J">
                            <section class="text">

                                <?php mcf_the_field('Kontent_Tekstovyy_blok_review_single'); ?>

                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Glavnye_harakteristiki_review_single'): ?>
                    <section class="block oFbUdMHIY4Mn">

                        <?php
                        $main_title = mcf_get_field('Zagolovok_glavnye_harakteristiki');
                        if (!empty($main_title)): ?>
                            <h2 class="ttOKnNStIgHIN"><?php echo esc_html($main_title); ?></h2>
                        <?php endif; ?>

                        <?php
                        $sub_title = mcf_get_field('Podzagolovok_glavnye_harakteristiki');
                        if (!empty($sub_title)): ?>
                            <h3 class="fBkRfgAkHYF"><?php echo esc_html($sub_title); ?></h3>
                        <?php endif; ?>

                        <?php if (mcf_have_rows('Kartochki_glavnye_harakteristiki')): ?>
                            <section class="SxgaTQMS">

                                <?php while (mcf_have_rows('Kartochki_glavnye_harakteristiki')): mcf_the_row(); ?>

                                    <?php
                                    $card_title = mcf_get_field('Zagolovok_kartochki_glavnye_harakteristiki');
                                    $has_content = mcf_have_rows('Kontent_kartochki_glavnye_harakteristiki');
                                    if (empty($card_title) && !$has_content) continue;
                                    ?>

                                    <section class="item">

                                        <?php if (!empty($card_title)): ?>
                                            <section class="item-title"><?php echo esc_html($card_title); ?></section>
                                        <?php endif; ?>

                                        <?php if ($has_content): ?>
                                            <section class="item-info">
                                                <?php while (mcf_have_rows('Kontent_kartochki_glavnye_harakteristiki')): mcf_the_row(); ?>
                                                    <?php
                                                    $col1 = mcf_get_field('Kolonka_1_glavnye_harakteristiki');
                                                    $col2 = mcf_get_field('Kolonka_2_glavnye_harakteristiki');

                                                    if (empty($col1) && empty($col2)) continue; // Пустая строка → не выводим
                                                    ?>
                                                    <section class="row">
                                                        <?php if (!empty($col1)): ?>
                                                            <section class="col col-name"><?php echo wp_kses_post($col1); ?></section>
                                                        <?php endif; ?>

                                                        <?php if (!empty($col2)): ?>
                                                            <section class="col CmTOgfmhqO2E7IYh"><?php echo wp_kses_post($col2); ?></section>
                                                        <?php endif; ?>
                                                    </section>
                                                <?php endwhile; ?>
                                            </section>
                                        <?php endif; ?>
                                    </section>
                                <?php endwhile; ?>
                            </section>
                        <?php endif; ?>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Plyusy_minusy_review_single'): ?>
                    <section class="block SciZsukvXQR7Im">

                        <?php
                        $title = mcf_get_field('Zagolovok_plyusy_minusy');
                        if (!empty($title)): ?>
                            <h2 class="ttOKnNStIgHIN"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <section class="YMirgtevyOTSo">

                            <?php if (mcf_have_rows('Plyusy_plyusy_minusy')): ?>
                                <ul class="item gIokOdMZ7">
                                    <?php while (mcf_have_rows('Plyusy_plyusy_minusy')): mcf_the_row(); ?>
                                        <?php
                                        $plus_text = mcf_get_field('Tekst_plyusov_plyusy_minusy');
                                        if (!empty($plus_text)): ?>
                                            <li><?php echo esc_html($plus_text); ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (mcf_have_rows('Minusy_plyusy_minusy')): ?>
                                <ul class="item IHgFsboBZ">
                                    <?php while (mcf_have_rows('Minusy_plyusy_minusy')): mcf_the_row(); ?>
                                        <?php
                                        $minus_text = mcf_get_field('Tekst_minusov_plyusy_minusy');
                                        if (!empty($minus_text)): ?>
                                            <li><?php echo esc_html($minus_text); ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Galereya_foto_video_review_single'): ?>
                    <section class="block block-news-previews">

                        <?php if (mcf_have_rows('Galereya_repeater_review_single')): ?>
                            <section class="wUbnokcWHf731SWN">

                                <?php while (mcf_have_rows('Galereya_repeater_review_single')): mcf_the_row(); ?>

                                    <?php
                                    $video_link = mcf_get_field('Ssylka_na_yutub__repeater_review_single');
                                    $img = mcf_get_image_field('Kartinka_repeater_review_single');

                                    if (empty($img)) continue; // Нет картинки — пропускаем

                                    // Проверяем есть ли видео
                                    $video_id = '';
                                    if (!empty($video_link)) {
                                        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([^\&\?\/]+)/', $video_link, $matches);
                                        $video_id = $matches[1] ?? '';
                                    }
                                    ?>

                                    <?php if (!empty($video_id)): ?>
                                        <section class="item" data-video-id="<?php echo esc_attr($video_id); ?>">
                                            <section class="PpCWpAb2C2V9">
                                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                            </section>
                                        </section>
                                    <?php else: ?>
                                        <section class="item">
                                            <section class="PpCWpAb2C2V9">
                                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                                            </section>
                                        </section>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </section>
                        <?php endif; ?>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'add_slots_block_Ispolzovat_tolko_odin_na_stranitse'): ?>
                    <section class="block DOWlz7LHfQhP" id="one-slots-block-1">
                        <h2 class="ttOKnNStIgHIN">
                            <?php mcf_the_field('Title_slots_block'); ?>
                        </h2>
                
                        <section class="slots-items">
                            <?php
                            $slot_tag_ids = get_taxonomy_field('Po_kakomu_tegu_vyvodit_sloty');
                            $slot_tag_ids = array_map('intval', (array)$slot_tag_ids);
                
                            if (!empty($slot_tag_ids)) {
                                $args = [
                                    'post_type'      => ['post', 'page'],
                                    'posts_per_page' => 15,
                                    'post_status'    => 'publish',
                                    'tax_query'      => [[
                                        'taxonomy' => 'post_tag',
                                        'field'    => 'term_id',
                                        'terms'    => $slot_tag_ids,
                                        'operator' => 'IN',
                                    ]],
                                ];
                
                                render_amp_posts_block($args, 'slot');
                            } else {
                                echo '<p>Теги не выбраны.</p>';
                            }
                            ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Welcome_bonus'): ?>
                    				<?php $img = mcf_get_image_field('img_bg_bonus'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
                        <h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok'); ?></h2>
                        <p><?php mcf_the_field('Tekst_dlya_vydeleniya_teksta_obvorachivaem_v_'); ?></p>
                        <a href="<?php mcf_the_field('Ssylka_knopki_bonusov'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki'); ?></a>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Faq_single_casino'): ?>
                    <section class="block block-faq">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_faq_1'); ?></h2>
                        <section class="aLhNneSpZ1O5w">

                            <?php if (mcf_have_rows('add__faq')): ?>
                                <?php while (mcf_have_rows('add__faq')): mcf_the_row(); ?>

                                    <amp-accordion animate expand-single-section class="faq-item">
                                        <section>
                                            <h2 class="faq-item-title"><?php mcf_the_field('question'); ?></h2>
                                            <div class="faq-item-info">
                                                <p><?php mcf_the_field('Answer'); ?></p>
                                            </div>
                                        </section>
                                    </amp-accordion>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'add__coments'): ?>
                    <section class="block yMSFpu0QsG">
                        <?php if (comments_open() || get_comments_number()) : ?>
                            <?php include get_template_directory() . '/template-parts/comments-amp.php'; ?>
                        <?php endif; ?>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Author'): ?>
                    <section class="block GEoGOtPQNfqqjR">
                        <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora'); ?>" class="HIQnu8tc6zhPt">
                            <?php $img = mcf_get_image_field('Izobrazhenie_Avtora'); ?>
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <section class="bLBEoxAG7i">
                            <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora'); ?></a>
                            <section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora'); ?></section>
                            <p><?php mcf_the_field('Opisanie_Avtora'); ?></p>
                            <?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin') == 1) : ?>
                                <ul class="hasMjGScosx">
                                    <li><a href="<?php mcf_the_field('Ssylka_na_Linkedin'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>

                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>


        <?php if (mcf_get_field('Pokazyvat_datu_publikatsii_?') == 1) : ?>
            <section class="block foiLTGtp3Xgv6fDZ">
                <p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
            </section>
        <?php endif; ?>
    </section>
</section>


<?php get_template_part('footer', 'amp'); ?>
