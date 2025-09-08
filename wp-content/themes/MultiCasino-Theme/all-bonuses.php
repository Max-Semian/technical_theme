<?php
/*
Template Name: all bonuses
*/
?>
<?php get_header(); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>

		<!--  -->
		<?php if (mcf_have_rows('add_block_template_all_bonuses')): ?>

			<?php while (mcf_have_rows('add_block_template_all_bonuses')): mcf_the_row(); ?>

				<?php if (mcf_get_row_layout() === 'Main_block_template_all_bonuses'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-5">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev"><?php the_title() ?></h1>
							<?php $img = mcf_get_image_field('Img_template_all_bonuses_lvl_1'); ?>
                            <?php if ( $img ) : ?>
                                <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                            <?php endif; ?>
							<?php mcf_the_field('text__template_all_bonuses_lvl_1'); ?>
						</section>
						<?php if ( $img ) : ?>
                            <img src="<?php echo esc_url( $img['url'] ); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                        <?php endif; ?>
					</section>

				<?php elseif (mcf_get_row_layout() === 'block_all_bonus_template_all_bonuses'): ?>
		    <?php
    // --- ГАРД от дублей ---
    global $__rendered_blocks2;
    if (!isset($__rendered_blocks2)) {
        $__rendered_blocks2 = [];
    }

    $layout_key = 'main_block_template_all_casinos';

    if (in_array($layout_key, $__rendered_blocks2, true)) {
        continue; // КОММЕНТАРИЙ: блок уже выводили -> пропускаем
    }
    $__rendered_blocks2[] = $layout_key;
    // -----------------------
    ?>
					<section class="block qvrXFiQUJ">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Tilte_template_all_bonuses_lvl_2'); ?></h2>

						<?php
						$tag_ids = get_taxonomy_field('Dobavit_stranitsy_dlya_vyvoda_bonusov_s_tegom');
						if ($tag_ids) {
							$tags = get_terms([
								'taxonomy'   => 'post_tag',
								'include'    => $tag_ids,
								'hide_empty' => false,
							]);
						?>

							<ul class="UlFLiWpCNEa" id="linksFilters">
								<?php foreach ($tags as $index => $tag): ?>
									<li <?php if ($index === 0) echo 'class="active"'; ?> data-tag-id="<?php echo esc_attr($tag->term_id); ?>">
										<a href="#"><?php echo esc_html($tag->name); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>

							<section class="xlmIFg1nKX5ao" id="bonusesItems"></section> <!-- Пустой контейнер для ajax -->

							<section class="rEHnqyaLPAcb">
								<a href="#" id="js-ajax-bonuses-template" class="UUoOFZTKQLWyzx"><?php mcf_the_field('Nazvanie_knopki_podgruzit_eschyo_template_all_bonuses'); ?></a>
							</section>

						<?php
						} else {
							echo '<p>Теги не выбраны.</p>';
						}
						?>
					</section>



				<?php elseif (mcf_get_row_layout() === 'block_text_template_all_bonuses'): ?>

					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J img-right">
							<section class="text">
								<?php mcf_the_field('text__template_all_bonuses_lvl_3'); ?>
							</section>

						</section>
					</section>



				<?php elseif (mcf_get_row_layout() === 'faq_template_all_bonuses'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_template_all_bonuses_lvl_4'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_Faq_template_all_bonuses_lvl_4')): ?>
								<?php while (mcf_have_rows('add_Faq_template_all_bonuses_lvl_4')): mcf_the_row(); ?>
									<section class="faq-item">
										<section class="faq-item-title"><?php mcf_the_field('question_template_all_bonuses_lvl_4'); ?>
										</section>
										<section class="faq-item-info">
											<p><?php mcf_the_field('Answer_template_all_bonuses_lvl_4'); ?>
											</p>
										</section>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>

						</section>
					</section>



				<?php elseif (mcf_get_row_layout() === 'Affiliate_program_news_template_all_bonuses'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Tilte_H2_template_all_bonuses_lvl_5'); ?></h2>

						<section class="wUbnokcWHf731SWN">
							<?php
							$category_id = get_taxonomy_field('Pokazyvat_4_poslednie_zapisi_iz_kategorii__template_all_bonuses_lvl_5');
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



				<?php elseif (mcf_get_row_layout() === 'bonus_template_all_bonuses'): ?>
								<?php $img = mcf_get_image_field('img_bg_template_all_bonuses_lvl_5'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_template_all_bonuses_lvl_5'); ?></h2>
						<p><?php mcf_the_field('Tekst__template_all_bonuses_lvl_5'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_all_bonuses_lvl_5'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_all_bonuses_lvl_5'); ?></a>
					</section>

				<?php elseif (mcf_get_row_layout() === 'Block_Author_template_all_bonuses'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_payouts'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_payouts'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_payouts'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_payouts'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_payouts'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_template_payouts'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_payouts') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_payouts'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>


				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php if (mcf_get_field('Show_data_Published_template_all_bonuses') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_footer(); ?>
