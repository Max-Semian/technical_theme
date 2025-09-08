<?php get_header(); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
    <section class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>


        <section class="block iZnMUmGk">
            <section class="SuZhockAv7dz">
                <?= the_post_thumbnail(array(1209, 463)); ?>

                <section class="wjhfi2jBc">
                    <h1 class="ttOKnNStIgHIN"><?php the_title(); ?></h1>
                </section>
            </section>
            <section class="RPNnByOkHonuAh44">

                <?php if (mcf_get_field('show_date_post') == 1) : ?>
                    <p class="vqAqZHrZH1UA"><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
                <?php endif; ?>

                <?php
                $post_tags = get_the_tags();
                if ($post_tags) :
                ?>
                    <ul class="jKITgip3jdD7VbI">
                        <?php foreach ($post_tags as $tag) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>
        </section>


        <?php if (mcf_have_rows('page_conternt_post')): ?>
            <?php while (mcf_have_rows('page_conternt_post')): mcf_the_row(); ?>
                <?php if (mcf_get_row_layout() === 'text_block_post'): ?>
                    <section class="block wOFCI2kSjym6B">
                        <section class="vjUy54vJFJ5J">
                            <section class="text">
                                <?php mcf_the_field('content_post'); ?>
                            </section>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'banner_bonus_post'): ?>
                    				<?php $img = mcf_get_image_field('img_bg_banner_bonus_post'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
    
                        <h2 class="UoPVXK3PDwK">
                            <?php mcf_the_field('title_text_bonus_post'); ?>
                        </h2>
                        <p>
                            <?php mcf_the_field('text_banner_bonus_post'); ?>
                        </p>
                        <a href="<?php mcf_the_field('url_btn_banner_bonus_post'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('text_btn_banner_bonus_post'); ?></a>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'four_last_added_posts_post'): ?>
                    <?php
                    $block_title = mcf_get_field('title_text_last_added_post');
                    $block_category = get_taxonomy_field('choose_categories_post');
                    ?>

                    <section class="block block-news-previews">
                        <?php if ($block_title) : ?>
                            <h2 class="ttOKnNStIgHIN"><?php echo esc_html($block_title); ?></h2>
                        <?php endif; ?>
                        <section class="wUbnokcWHf731SWN">
                            <?php
                            $category_id = get_taxonomy_field('choose_categories_post');
                            if ($category_id) {
                                // Настройка аргументов WP_Query
                                $args = [
                                    'post_type' => 'post',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'category',
                                            'field'    => 'term_id',
                                            'terms'    => $category_id,
                                        ],
                                    ],
                                    'posts_per_page' => 4, // Задаем количество записей для отображения
                                ];
                                // Создание запроса
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
                                // Сброс данных запроса
                                wp_reset_postdata();
                            } else { ?>
                                <p>Категория для отображения записей не выбрана.</p>
                            <?php } ?>
                        </section>
                    </section>


                <?php elseif (mcf_get_row_layout() === 'author_block_post'): ?>
                    <section class="block GEoGOtPQNfqqjR">
                        <a href="<?php mcf_the_field('link_page_author_post'); ?>" class="HIQnu8tc6zhPt">
                            <?php $img = mcf_get_image_field('img_author_post'); ?>
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>
                        </a>
                        <section class="bLBEoxAG7i">
                            <a href="<?php mcf_the_field('link_page_author_post'); ?>" class="cmer0XjP"><?php mcf_the_field('name_author_post'); ?></a>

                            <section class="sKPwbZJxN3"><?php mcf_the_field('place_author_post'); ?></section>
                            <p><?php mcf_the_field('descr_author_post'); ?></p>
                            <?php if (mcf_get_field('show_btn_social_post') == 1) : ?>
                                <ul class="hasMjGScosx">
                                    <li><a href=" <?php mcf_the_field('link_social_post'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
                                </ul>
                            <?php endif; ?>
                        </section>
                    </section>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
</section>

<?php get_footer(); ?>
