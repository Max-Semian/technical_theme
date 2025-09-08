<?php get_header(); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
    <section class="container">
        <?php get_template_part('template-parts/breadcrumbs'); ?>
        <?php
        $paged    = max(1, get_query_var('paged'));
        $tag      = get_queried_object();

        if ($paged === 1) {
            $latest_args = array(
                'post_type'      => array('post', 'page'),
                'posts_per_page' => 1,
                'tag_id'         => $tag->term_id, // Получаем посты по тегу
            );
            $latest_query = new WP_Query($latest_args);

            if ($latest_query->have_posts()) :
                while ($latest_query->have_posts()) : $latest_query->the_post(); ?>
                    <section class="block LKrBpF7hqhS">
                        <section class="axsZfE3xNzA">
                            <h1 class="ttOKnNStIgHIN"><?php single_tag_title(); ?></h1>
                            <p class="QQcGbchqdBs65Ei"><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
                        </section>
                        <section class="qGSIltTLQmLoI">
                            <a href="<?php the_permalink(); ?>" class="cDuZQjGrhcf6">
                                <section class="PpCWpAb2C2V9">
                                    <?= the_post_thumbnail(array(566, 300)); ?>
                                </section>
                                <section class="item-info">
                                    <section class="DvyQMDA7IB7E"><?php the_title(); ?></section>
                                </section>
                            </a>
                            <section class="dNZlZimGFmcI7FV">
                                <section id="text-wrapper">
                                    <?php mcf_the_field('Lead_post'); ?>
                                </section>
                                <section class="buttons">
                                    <a href="<?php the_permalink(); ?>" class="button cBIsltsilrX">Learn more</a>
                                </section>
                            </section>
                        </section>
                    </section>
            <?php endwhile;
            endif;
            wp_reset_postdata();
        }

        if ($paged === 1) {
            $offset = 1;
        } else {
            $offset = ($paged - 1) * 6 + 1;
        }

        $main_args = array(
            'post_type'      => array('post', 'page'),
            'posts_per_page' => 6,
            'offset'         => $offset,
            'tag_id'         => $tag->term_id, // Посты по тегу
        );

        $main_query = new WP_Query($main_args);

        if ($main_query->have_posts()) : ?>
            <section class="block block-article-preview">
                <section class="bSdIfdKL2SjnS1t1">
                    <?php while ($main_query->have_posts()) : $main_query->the_post(); ?>
                        <section class="yyehIpuM8iuT">
                            <a href="<?php the_permalink(); ?>" class="KUoQCGTCNMevmC4">
                                <?= the_post_thumbnail(array(182, 182)); ?>
                            </a>
                            <section class="item-info">
                                <section class="PySWVk5ecbJI">
                                    <p class="DvyQMDA7IB7E"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                    <p class="LiCcFhEjYWS"><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
                                </section>
                                <?php mcf_the_field('Lead_post'); ?>
                                <section class="buttons">
                                    <a href="<?php the_permalink(); ?>" class="button cBIsltsilrX"><?php echo esc_html(pll__('Learn more')); ?></a>
                                </section>
                            </section>
                        </section>
                        <?php
                        $post_tags = get_the_tags();
                        if ($post_tags) : ?>
                            <ul class="jKITgip3jdD7VbI">
                                <?php foreach ($post_tags as $tag_item) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_tag_link($tag_item->term_id)); ?>">
                                            <?php echo esc_html($tag_item->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </section>

                <?php
                $count_query = new WP_Query(array(
                    'post_type'      => array('post', 'page'),
                    'tag_id'         => $tag->term_id,
                    'posts_per_page' => -1,
                ));
                $total_count = $count_query->found_posts;
                wp_reset_postdata();

                $total_pages = ceil(max(0, $total_count - 1) / 6);

                if ($total_pages > 1) {
                    $big = 999999999;
                    $links = paginate_links(array(
                        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format'    => '',
                        'current'   => $paged,
                        'total'     => $total_pages,
                        'prev_text' => 'Previous',
                        'next_text' => 'Next',
                        'type'      => 'plain',
                    ));

                    if ($links) {
                        $links = str_replace('page-numbers current', 'page-numbers active', $links);
                        echo '<section class="pagination">' . $links . '</section>';
                    }
                }
                ?>

            </section>
        <?php endif; ?>
    </section>
</section>

<?php get_footer(); ?>
