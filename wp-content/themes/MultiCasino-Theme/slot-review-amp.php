<?php
/*
Template Name: slot-review-amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<?php
$raw_rating = mcf_get_field('Kollichestvo_zvezd_-_reyting');
$rating = is_numeric($raw_rating) ? round(floatval($raw_rating)) : 0;
$rating = max(0, min(5, intval($rating)));
$text_vote  = mcf_get_field('Reytingg_535_votes');
?>
<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
    <section class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <?php if (mcf_have_rows('add_block_template_slot_review')): ?>
            <?php while (mcf_have_rows('add_block_template_slot_review')): mcf_the_row(); ?>

                <?php if (mcf_get_row_layout() === 'Game_slots_iframe_template_slot_review'): ?>

                    <section class="block TomHEyzPWM4H2AR">
                        <section class="nBMYyvZsMSwmkO">
                            <h2 class="ttOKnNStIgHIN"><?php the_title() ?></h2>
                            <section class="info-stat">
                                <ul class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <li>
                                            <section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                                <section class="AbKnhMLKHjMIs1Gv"><?php echo $text_vote; ?></section>
                            </section>
                        </section>
						
<!-- 						<amp-state id="gameStarted">
						  <script type="application/json">false</script>
						</amp-state> -->
						
						<?php 
                        $iframe = mcf_get_field('iframe'); // Получаем iframe из админки
                        
                        if ($iframe && preg_match('/src="([^"]+)"/', $iframe, $match)) {
                            $src = esc_url($match[1]); // Извлекаем только src из iframe
                            ?>
                            <section class="bzaYhmVZu53bf" id="bzaYhmVZu53bf" [class]="gameStarted ? 'bzaYhmVZu53bf SOCwuP6e' : 'bzaYhmVZu53bf'">
                                <amp-iframe 
                                    width="100" 
                                    height="350" 
                                    layout="responsive" 
                                    sandbox="allow-scripts allow-same-origin" 
                                    frameborder="0"
                                    src="<?= $src ?>">
                                </amp-iframe>
                            </section>
                        <?php } ?>
						
                        <section class="SuZhockAv7dz" [class]="gameStarted ? 'bzaYhmVZu53bf hide' : 'bzaYhmVZu53bf'">
                            <?php $img = mcf_get_image_field('Izobrazhenie_so_slotom_slot_review'); ?>
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>

                            <section class="buttons">
                                <?php if (mcf_get_field('Pokazyvat_pervuyu_knopku_') == 1) : ?>
                                    <a href="<?php mcf_the_field('Url_btn_1'); ?>" class="button fsMxwlrorxwwLFR6"><?php mcf_the_field('Name_btn_1'); ?></a>
                                <?php endif; ?>
                                <?php if (mcf_get_field('Pokazyvat_vtoruyu_knopku_?') == 1) : ?>
                                    <a class="button HKYDfj0abmr lSxZiErAjnsDTin" href="javascript:void(0)" on="tap:AMP.setState({gameStarted: true})"><?php mcf_the_field('Name_btn_2'); ?></a>
                                <?php endif; ?>

                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Multicasino_template_slot_review'): ?>
                    <section class="block HgNEXbcXKiOWGk0V" id="multicasino-block-1">
                        <h1 class="BqgaXaXeHMc"><?php mcf_the_field('Title_template_slot_review_lvl_2_0'); ?></h1>
                        <h2 class="ttOKnNStIgHIN pGogQv3MnXHv"><?php mcf_the_field('title_h3_casino'); ?></h2>
                
                        <section class="best-casinos-items">
                            <?php
                            $args = [
                                'post_type'      => ['post', 'page'],
                                'posts_per_page' => 10,
                                'post_status'    => 'publish',
                                'tax_query'      => [[
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'term_id',
                                    'terms'    => array_map('intval', (array)get_taxonomy_field('Po_kakomu_tegu_pokazyvat_kazino_v_bloke')),
                                ]],
                            ];
                
                            render_amp_posts_block($args, 'casino');
                            ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Tablitsa_top_10_slot_review'): ?>
                    <section class="block oFbUdMHIY4Mn">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('zagolovok_tablitsa_slot_review'); ?></h2>
                        <h3 class="fBkRfgAkHYF"><?php mcf_the_field('Podzagolovok_tablitsa_slot_review'); ?></h3>
                        <section class="SxgaTQMS">
                            <?php if (mcf_have_rows('Dobavit_tablitsu')): ?>
                                <?php while (mcf_have_rows('Dobavit_tablitsu')): mcf_the_row(); ?>
                                    <section class="item">
                                        <section class="item-title"><?php mcf_the_field('Nazvanie_tablitsy'); ?></section>
                                        <section class="item-info">

                                            <?php if (mcf_have_rows('Dobavit_v_tablitsu_polya')): ?>
                                                <?php while (mcf_have_rows('Dobavit_v_tablitsu_polya')): mcf_the_row(); ?>
                                                    <section class="row">
                                                        <section class="col col-name"><?php mcf_the_field('name'); ?></section>
                                                        <section class="col CmTOgfmhqO2E7IYh"><?php mcf_the_field('value'); ?></section>
                                                    </section>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </section>
                                    </section>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'block_Pros_and_Cons_template_slot_review'): ?>
                    <section class="block SciZsukvXQR7Im">
                        <?php
                        $title = mcf_get_field('Title_template_slot_review_lvl_4');
                        if (!empty($title)): ?>
                            <h2 class="ttOKnNStIgHIN"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        <section class="YMirgtevyOTSo">

                            <?php if (mcf_have_rows('add_plus_template_slot_review_lvl_4')): ?>
                                <ul class="item gIokOdMZ7">
                                    <?php while (mcf_have_rows('add_plus_template_slot_review_lvl_4')): mcf_the_row(); ?>
                                        <?php
                                        $plus_text = mcf_get_field('text_plus_template_slot_review_lvl_4');
                                        if (!empty($plus_text)): ?>
                                            <li><?php echo esc_html($plus_text); ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (mcf_have_rows('add_minus_template_slot_review_lvl_4')): ?>
                                <ul class="item IHgFsboBZ">
                                    <?php while (mcf_have_rows('add_minus_template_slot_review_lvl_4')): mcf_the_row(); ?>
                                        <?php
                                        $minus_text = mcf_get_field('text_minus_template_slot_review_lvl_4');
                                        if (!empty($minus_text)): ?>
                                            <li><?php echo esc_html($minus_text); ?></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Galereya_video_kartinki_template_slot_review'): ?>
                    <section class="block block-news-previews">
                        <?php if (mcf_have_rows('Galereya_repeater_review_single2')): ?>
                            <section class="wUbnokcWHf731SWN">

                                <?php while (mcf_have_rows('Galereya_repeater_review_single2')): mcf_the_row(); ?>

                                    <?php
                                    $video_link = mcf_get_field('Ssylka_na_yutub__repeater_review_single2');
                                    $img = mcf_get_image_field('Kartinka_repeater_review_single2');

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


                <?php elseif (mcf_get_row_layout() === 'Overall_score_template_slot_review'): ?>
                    <section class="block block-score">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_template_slot_review_lvl_7'); ?></h2>
                        <section class="eUqIyO2oEmy6T">
                            <section class="hESlezeL5Imoz">
                                <?php $img = mcf_get_image_field('Kartinka_slota_slot_review'); ?>
                                <?php if ($img) : ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                <?php endif; ?>
                            </section>

                            <section class="nOaVpVKs61v8">
                                <?php if (mcf_have_rows('score_repeater_slot_review')): ?>
                                    <?php while (mcf_have_rows('score_repeater_slot_review')): mcf_the_row(); ?>
                                        <?php
                                        // Получаем данные полей
                                        $score_name = mcf_get_field('score_name_slot_review');
                                        $score_value_raw = mcf_get_field('score_value_slot_review');

                                        // Подготовка значения: заменяем запятую на точку
                                        $score_value_clean = str_replace(',', '.', $score_value_raw);
                                        $score_number = floatval($score_value_clean);

                                        // Защита от переполнения
                                        if ($score_number > 5) {
                                            $score_number = 5;
                                        } elseif ($score_number < 0) {
                                            $score_number = 0;
                                        }

                                        // Полные звёзды
                                        $full_stars = floor($score_number);

                                        // Полузвезда, если остаток >= 0.5
                                        $has_half_star = ($score_number - $full_stars) >= 0.5;

                                        // Считаем общее число звёзд
                                        $total_stars = $full_stars + ($has_half_star ? 1 : 0);
                                        if ($total_stars > 5) {
                                            $has_half_star = false;
                                        }
                                        ?>
                                        <section class="OiKRoJfSlRYHey">
                                            <section class="mecAzxHI8vvb"><?php echo $score_name; ?></section>
                                            <section class="info-stat">
                                                <section class="XVgxXEP1JF"><?php echo esc_html($score_number); ?>/5</section>
                                                <ul class="rating">
                                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                        <li>
                                                            <?php if ($i <= $full_stars) : ?>
                                                                <section class="star active"></section>
                                                            <?php elseif ($i == $full_stars + 1 && $has_half_star) : ?>
                                                                <section class="star ZBOfnsKwgAr"></section>
                                                            <?php else : ?>
                                                                <section class="star"></section>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </section>
                                        </section>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'More_Slots_template_slot_review'): ?>
                    <section class="block DOWlz7LHfQhP" id="more-slots-block-1">
                        <h2 class="ttOKnNStIgHIN">
                            <?php mcf_the_field('Title_template_slot_review_lvl_8'); ?>
                        </h2>
                
                        <section class="slots-items">
                            <?php
                            $args = [
                                'post_type'      => ['post', 'page'],
                                'posts_per_page' => 15,
                                'post_status'    => 'publish',
                                'post__not_in'   => [get_the_ID()],
                                'tax_query'      => [[
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'term_id',
                                    'terms'    => array_map('intval', (array)get_taxonomy_field('Po_kakomu_tegu_vyvodit_slot_review')),
                                ]],
                            ];
                
                            render_amp_posts_block($args, 'slot');
                            ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Faq_template_slot_review'): ?>
                    <section class="block block-faq">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_faq_template_slot_review_lvl_9'); ?></h2>
                        <section class="aLhNneSpZ1O5w">
                            <?php if (mcf_have_rows('add_faq')): ?>
                                <?php while (mcf_have_rows('add_faq')): mcf_the_row(); ?>
                                    <amp-accordion animate expand-single-section class="faq-item">
                                        <section>
                                            <h2 class="faq-item-title"><?php mcf_the_field('question_template_slot_review_lvl_9'); ?></h2>
                                            <div class="faq-item-info">
                                                <p><?php mcf_the_field('Answer_template_slot_review_lvl_9'); ?></p>
                                            </div>
                                        </section>
                                    </amp-accordion>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Comments_template_slot_review'): ?>
                    <section class="block yMSFpu0QsG">
                        <?php if (comments_open() || get_comments_number()) : ?>
                            <?php include get_template_directory() . '/template-parts/comments-amp.php'; ?>
                        <?php endif; ?>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Text_template_slot_review'): ?>
                    <section class="block wOFCI2kSjym6B">
                        <section class="vjUy54vJFJ5J">
                            <section class="text">
                                <?php mcf_the_field('text_template_slot_review_lvl_6'); ?>
                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Welcome_Bonus_template_slot_review'): ?>
                   				<?php $img = mcf_get_image_field('img_bg_template_slot_review_lvl_11'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
                        <h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_template_slot_review_lvl_11'); ?></h2>
                        <p><?php mcf_the_field('Tekst_template_slot_review_lvl_11'); ?></p>
                        <a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_slot_review_lvl_11'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_slot_review_lvl_11'); ?></a>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Author_template_slot_review'): ?>
                    <section class="block GEoGOtPQNfqqjR">
                        <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_slot_review_lvl_12'); ?>" class="HIQnu8tc6zhPt">
                            <?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_slot_review_lvl_12'); ?>
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <section class="bLBEoxAG7i">
                            <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_slot_review_lvl_12'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_slot_review_lvl_12'); ?></a>
                            <section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_slot_review_lvl_12'); ?></section>
                            <p><?php mcf_the_field('Opisanie_Avtora_template_slot_review_lvl_12'); ?></p>
                            <?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_slot_review_lvl_12') == 1) : ?>
                                <ul class="hasMjGScosx">
                                    <li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_slot_review_lvl_12'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>


        <?php if (mcf_get_field('Pokazyvat_datu_slot_review') == 1) : ?>
            <section class="block">
                <p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
            </section>
        <?php endif; ?>
    </section>
</section>


<?php get_template_part('footer', 'amp'); ?>
