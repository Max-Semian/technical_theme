<?php
/*
Template Name: casino-rating - amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>
		<?php if (mcf_have_rows('add_block_template_casinorating')): ?>
			<?php while (mcf_have_rows('add_block_template_casinorating')): mcf_the_row(); ?>

				<?php if (mcf_get_row_layout() === 'Main_Block_template_casinorating'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-2">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev">Top 10 Best Online Casinos of 2024</h1>
							<?php $img = mcf_get_image_field('img_template_casinorating_lvl_1'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
							<h3 class="LLKxLCxyYb8TY"><?php the_title() ?></h3>
							<?php mcf_the_field('text_template_casinorating_lvl_1'); ?>
						</section>
						<?php $img = mcf_get_image_field('img_template_casinorating_lvl_1'); ?>
						<?php if ($img) : ?>
							<img src="<?php echo esc_url($img['url']); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>

					</section>


				<?php elseif (mcf_get_row_layout() === 'Recommended_online_casinos_template_casinorating'): ?>
                    <section class="block HgNEXbcXKiOWGk0V" id="casinos-block-2">
                        <h2 class="ttOKnNStIgHIN pGogQv3MnXHv">
                            <?php mcf_the_field('Title_rec_online_casinos_template_casinorating_lvl_2'); ?>
                        </h2>
                
                        <section class="best-casinos-items">
                            <?php
                            $args = [
                                'post_type'      => ['post', 'page'],
                                'posts_per_page' => 10,
                                'post_status'    => 'publish',
                                'tax_query'      => [[
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'term_id',
                                    'terms'    => array_map('intval', (array)get_taxonomy_field('Po_kakomu_tegu_vyvodit_kazino')),
                                ]],
                            ];
                
                            render_amp_posts_block($args, 'casino');
                            ?>
                        </section>
                    </section>


				<?php elseif (mcf_get_row_layout() === 'block_casinos_and_slots_template_casinorating'): ?>
					<section class="block block-descriptions-tile">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_casinos_and_slots_template_casinorating_lvl_3'); ?></h2>
						<h3 class="fBkRfgAkHYF"><?php mcf_the_field('Title_casinos_and_slots_H3'); ?></h3>
						<h4 class="NWXPgFVXJ"><?php mcf_the_field('Title_casinos_and_slots_H4'); ?></h4>
						<section class="DYrIjFkwhHv9E">
							<?php if (mcf_have_rows('add_casinos_and_slots_template_casinorating_lvl_3')): ?>
								<?php while (mcf_have_rows('add_casinos_and_slots_template_casinorating_lvl_3')): mcf_the_row(); ?>
									<section class="item item1">
										<section class="PpCWpAb2C2V9"><?php $img = mcf_get_image_field('img_template_casinorating_lvl_3'); ?>
											<?php if ($img) : ?>
												<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
											<?php endif; ?>
										</section>
										<section class="jLvRgyUi2DnKH"><?php mcf_the_field('text_template_casinorating_lvl_3'); ?></section>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_Slots_template_casinorating'): ?>
                    <section class="block DOWlz7LHfQhP" id="slots-block-2">
                        <h2 class="ttOKnNStIgHIN pGogQv3MnXHv">
                            <?php mcf_the_field('Title_Slots_template_casinorating_lvl_4'); ?>
                        </h2>
                
                        <section class="slots-items">
                            <?php
                            $args = [
                                'post_type'      => ['post', 'page'],
                                'posts_per_page' => 15,
                                'post_status'    => 'publish',
                                'tax_query'      => [[
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'term_id',
                                    'terms'    => array_map('intval', (array)get_taxonomy_field('Po_kakomu_tegu_vyvodit_kazino_0')),
                                ]],
                            ];
                
                            render_amp_posts_block($args, 'slot');
                            ?>
                        </section>
                    </section>


				<?php elseif (mcf_get_row_layout() === 'Block_Welcome_Bonus_template_casinorating'): ?>
									<?php $img = mcf_get_image_field('img_bg_template_casinorating_lvl_5'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Title_Welcome_Bonus_template_casinorating_lvl_5'); ?></h2>
						<p><?php mcf_the_field('text_template_casinorating_lvl_5'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_casinorating_lvl_5'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_casinorating_lvl_5'); ?></a>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_Program_News_template_casinorating'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Program_News_template_casinorating_lvl_6'); ?></h2>
						<section class="wUbnokcWHf731SWN">

							<?php
							$category_id = get_taxonomy_field('iz_kakoy_rubriki_poluchit_poslednie_4_zapisi');
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


				<?php elseif (mcf_get_row_layout() === 'block_text_template_casinorating'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J img-right">
							<section class="text">
								<?php mcf_the_field('text_template_casinorating_lvl_7'); ?>
							</section>
						</section>

					</section>


				<?php elseif (mcf_get_row_layout() === 'Faq_template_casinorating'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_template_casinorating_lvl_7'); ?></h2>
						<section class="aLhNneSpZ1O5w">

							<?php if (mcf_have_rows('add_Faq_template_casinorating_lvl_7')): ?>
								<?php while (mcf_have_rows('add_Faq_template_casinorating_lvl_7')): mcf_the_row(); ?>
									<amp-accordion animate expand-single-section class="faq-item">
										<section>
											<h2 class="faq-item-title"><?php mcf_the_field('question_template_casinorating_lvl_7'); ?></h2>
											<div class="faq-item-info">
												<p><?php mcf_the_field('Answer_template_casinorating_lvl_7'); ?></p>
											</div>
										</section>
									</amp-accordion>

								<?php endwhile; ?>
							<?php else: ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_Author_template_casinorating'): ?>

					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_casinorating_lvl_8'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_casinorating_lvl_8'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_casinorating_lvl_8'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_casinorating_lvl_8'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_casinorating_lvl_8'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_template_casinorating_lvl_8'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_casinorating_lvl_8') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_casinorating_lvl_8'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>


		<?php if (mcf_get_field('Pokazyvat_datu_publikatsii_casinorating') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_template_part('footer', 'amp'); ?>
