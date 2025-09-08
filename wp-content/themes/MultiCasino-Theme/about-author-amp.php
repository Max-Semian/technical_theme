<?php
/*
Template Name: about-author - amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
    <section class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <?php if (mcf_have_rows('pro_author_page')): ?>
            <?php while (mcf_have_rows('pro_author_page')): mcf_the_row(); ?>
                <?php if (mcf_get_row_layout() === 'avtor_blok'): ?>
                    <?php $img = mcf_get_image_field('Izobrazhenie_Avtora_about'); ?>

                    <section class="block GEoGOtPQNfqqjR own">
                        <h1>Online Casinos of 2024</h1>
                        <section class="bqfItAeMx0O">
                            <section class="HIQnu8tc6zhPt">
                                <?php if ($img) : ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                <?php endif; ?>
                            </section>
                            <section class="bLBEoxAG7i">
                                <section class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_about'); ?></section>
                                <section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_about'); ?></section>
                                <?php mcf_the_field('Opisanie_Avtora_about'); ?>

                                <?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_about') == 1) : ?>
                                    <ul class="hasMjGScosx">
                                        <li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_about'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
                                    </ul>
                                <?php endif; ?>
                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'text_block_about'): ?>
                    <section class="block wOFCI2kSjym6B">
                        <section class="vjUy54vJFJ5J">
                            <section class="text">
                                <?php mcf_the_field('content_about'); ?>
                            </section>
                        </section>
                    </section>

                <?php elseif (mcf_get_row_layout() === 'Poslednie_obzory_3_sht_about'): ?>

                    <?php
                    $tag_ids = get_taxonomy_field('nazvanie_metki_about');
                    ?>

                    <section class="block block-article-preview">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('zagolovok_bloka_about'); ?></h2>
                        <section class="bSdIfdKL2SjnS1t1">

                            <?php if ($tag_ids) : ?>
                                <?php
                                $args = [
                                    'post_type'      => array('post', 'page'),
                                    'tax_query'      => [
                                        [
                                            'taxonomy' => 'post_tag',
                                            'field'    => 'term_id',
                                            'terms'    => $tag_ids,
                                        ],
                                    ],
                                    'posts_per_page' => 3,
                                ];

                                $query = new WP_Query($args);

                                if ($query->have_posts()) : ?>
                                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                                        <section class="yyehIpuM8iuT">
                                            <a href="<?php the_permalink(); ?>" class="KUoQCGTCNMevmC4">
                                                <?php the_post_thumbnail(array(182, 182)); ?>
                                            </a>
                                            <section class="item-info">
                                                <p class="DvyQMDA7IB7E"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                <p><?php the_excerpt(); ?></p>
                                                <section class="buttons">
                                                    <a href="<?php the_permalink(); ?>" class="button cBIsltsilrX"><?php echo esc_html(pll__('Learn more')); ?></a>
                                                </section>
                                            </section>
                                        </section>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p><?php echo esc_html(pll__('No posts found with selected tags.')); ?></p>
                                <?php endif; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p><?php echo esc_html(pll__('No jKITgip3jdD7VbI selected.')); ?></p>
                            <?php endif; ?>

                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'rating_author_about'): ?>
                    <section class="block block-rate-author">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Zagolovok_bloka_about'); ?></h2>
                        <section class="OEsVgiRou3Td">
                            <section class="cDuZQjGrhcf6">
                                <p><?php mcf_the_field('infa_v_bloke'); ?></p>
                                <input type="hidden" name="stars">
                                <ul class="rating rating-buttons">
                                    <?php
                                    $avg_rating = get_comments_avg_rating();
                                    for ($i = 1; $i <= 5; $i++) {
                                        $active_class = ($i <= floor($avg_rating)) ? 'active' : '';
                                        $semi_active_class = ($i == ceil($avg_rating) && $avg_rating - floor($avg_rating) > 0) ? 'ZBOfnsKwgAr' : '';

                                        echo '<li><section class="star ' . esc_attr($active_class . ' ' . $semi_active_class) . '"></section></li>';
                                    }
                                    ?>
                                </ul>
                                <section class="buttons">
                                    <a href="#comments" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_knopki'); ?></a>
                                </section>
                            </section>
                            <section class="dNZlZimGFmcI7FV">
                                <p><?= get_comments_total_votes(); ?> votes</p>
                                <p><?= get_comments_avg_rating(); ?>/5 rating</p>
                            </section>
                        </section>
                        <?php if (comments_open() || get_comments_number()) : ?>
                            <?php include get_template_directory() . '/template-parts/comments-amp.php'; ?>
                        <?php endif; ?>
                    </section>



                <?php elseif (mcf_get_row_layout() === 'Affiliate_program_news_about'): ?>
                    <section class="block block-news-previews">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Tilte_H2_about'); ?></h2>

                        <section class="wUbnokcWHf731SWN">
                            <?php
                            $category_id = get_taxonomy_field('Pokazyvat_4_poslednie_zapisi_iz_kategorii_about');
                            if ($category_id) {

                                $args = [
                                    'post_type' => 'post',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'category',
                                            'field'    => 'term_id',
                                            'terms'    => $category_id,
                                        ],
                                    ],
                                    'posts_per_page' => 4,
                                ];

                                $query = new WP_Query($args);
                                if ($query->have_posts()) {
                                    while ($query->have_posts()) {
                                        $query->the_post(); ?>
                                        <a href="<?php the_permalink(); ?>" class="item">
                                            <section class="PpCWpAb2C2V9">
                                                <?= the_post_thumbnail(array(563, 303)); ?>
                                            </section>
                                            <section class="item-info">
                                                <section class="DvyQMDA7IB7E"><?php the_title() ?></section>
                                                <section class="LiCcFhEjYWS"><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></section>
                                            </section>
                                        </a>
                                    <?php }
                                } else { ?>
                                    <p>Нет записей в выбранной категории.</p>
                                <?php }

                                wp_reset_postdata();
                            } else { ?>
                                <p>Категория для отображения записей не выбрана.</p>
                            <?php } ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Faq_about_author'): ?>
                    <section class="block block-faq">
                        <h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_about_author'); ?></h2>
                        <section class="aLhNneSpZ1O5w">
                            <?php if (mcf_have_rows('add_Faq_about_author')): ?>
                                <?php while (mcf_have_rows('add_Faq_about_author')): mcf_the_row(); ?>
                                    <amp-accordion animate expand-single-section class="faq-item">
                                        <section>
                                            <h2 class="faq-item-title"><?php mcf_the_field('question_about_author'); ?>
                                            </h2>
                                            <div class="faq-item-info">
                                                <p><?php mcf_the_field('Answer_about_author'); ?>
                                                </p>
                                            </div>
                                        </section>
                                    </amp-accordion>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'bonus_about_author'): ?>
                   				<?php $img = mcf_get_image_field('img_bg_about_author'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
                        <h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_about_author'); ?></h2>
                        <p><?php mcf_the_field('Tekst__about_author'); ?></p>
                        <a href="<?php mcf_the_field('Ssylka_knopki_bonusov_about_author'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_about_author'); ?></a>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'Block_Author_about_author'): ?>
                    <section class="block GEoGOtPQNfqqjR">
                        <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_about_author'); ?>" class="HIQnu8tc6zhPt">
                            <?php $img = mcf_get_image_field('Izobrazhenie_Avtora_about_author'); ?>
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <section class="bLBEoxAG7i">
                            <a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_about_author'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_about_author'); ?></a>
                            <section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_about_author'); ?></section>
                            <p><?php mcf_the_field('Opisanie_Avtora_about_author'); ?></p>
                            <?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_about_author') == 1) : ?>
                                <ul class="hasMjGScosx">
                                    <li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_about_author'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>

                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php if (mcf_get_field('Show_data_Published_about_author') == 1) : ?>
            <section class="block foiLTGtp3Xgv6fDZ">
                <p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
            </section>
        <?php endif; ?>
    </section>
</section>

<?php get_template_part('footer', 'amp'); ?>
