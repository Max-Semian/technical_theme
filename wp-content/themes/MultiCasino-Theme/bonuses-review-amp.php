<?php
/*
Template Name: bonuses review - amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>

		<?php if (mcf_have_rows('add_block_template_single_bonus')): ?>
			<?php while (mcf_have_rows('add_block_template_single_bonus')): mcf_the_row(); ?>
				<?php if (mcf_get_row_layout() === 'main_block_template_single_bonus'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-6">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev"><?php the_title() ?></h1>
							<?php $img = mcf_get_image_field('img__single_bonus_lvl_1'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
							<?php mcf_the_field('Text_single_bonus_lvl_1'); ?>
						</section>
						<?php $img = mcf_get_image_field('img__single_bonus_lvl_1'); ?>
						<?php if ($img) : ?>
							<img src="<?php echo esc_url($img['url']); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Vyvod_zapisey_block_1_po_tegu_single_bonus'): ?>

					<section class="block qvrXFiQUJ">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('title_single_bonus_lvl_2'); ?></h2>

						<?php
						$tag_field_value = get_taxonomy_field('Po_kakomu_tegu_vyvodit_single_bonus_lvl_2');

						if (!is_array($tag_field_value)) {
							$tag_field_value = [$tag_field_value];
						}

						$tag_ids_string = implode(',', $tag_field_value);
						$button_text = mcf_get_field('Nazvanie_knopki__single_bonus_lvl_2');
						?>

						<section class="xlmIFg1nKX5ao" id="bonuses-block-1">
							<?php
							$posts_per_page = 3;

							$args = [
								'post_type' => ['post', 'page'],
								'tax_query' => [
									[
										'taxonomy' => 'post_tag',
										'field' => 'term_id',
										'terms' => $tag_field_value,
									],
								],
								'posts_per_page' => $posts_per_page,
								'paged' => 1,
							];

							$query = new WP_Query($args);

							if ($query->have_posts()) {
								while ($query->have_posts()) {
									$query->the_post();
									$raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
									$rating = max(0, min(5, intval(round($raw_rating))));
							?>
									<section class="ZAOYv1NRyNdr">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
										<section class="wOFCI2kSjym6B">
											<ul class="rating">
												<?php for ($i = 1; $i <= 5; $i++): ?>
													<li>
														<section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
													</li>
												<?php endfor; ?>
											</ul>
											<a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
											<?php mcf_the_field('Lid_bonusa_template_review_'); ?>
											<section class="buttons">
												<a href="<?php mcf_the_field('URL_BTN_bonus_template_review_'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Nazvanie_knopki_GET_BONUS'); ?></a>
											</section>
										</section>
									</section>
							<?php
								}
							}

							wp_reset_postdata();
							?>
						</section>

<!-- 						<section class="rEHnqyaLPAcb">
							<a href="#" class="UUoOFZTKQLWyzx" id="load-more-btn-block-1"><?php echo esc_html($button_text); ?></a>
						</section> -->

						<script>
							var bonusBlock1Data = {
								ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
								tag_ids: "<?php echo esc_js($tag_ids_string); ?>",
								posts_per_page: <?php echo intval($posts_per_page); ?>,
							};
						</script>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Vyvod_zapisey_block_2_po_tegu_single_bonus'): ?>

					<?php
					$tag_ids_block2 = get_taxonomy_field('Po_kakomu_tegu_vyvodit_single_bonus_lvl_3_0');
					$tag_ids_block2 = is_array($tag_ids_block2) ? $tag_ids_block2 : [$tag_ids_block2];
					$tag_ids_block2_string = implode(',', $tag_ids_block2);

					$btn_text_block2 = mcf_get_field('Nazvanie_knopki__single_bonus_lvl_3_0');
					?>

					<section class="block qvrXFiQUJ">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('title_single_bonus_lvl_3_0'); ?></h2>

						<section class="xlmIFg1nKX5ao" id="bonuses-block-2">
							<?php
							if ($tag_ids_block2) {
								$args = [
									'post_type' => ['post', 'page'],
									'tax_query' => [
										[
											'taxonomy' => 'post_tag',
											'field'    => 'term_id',
											'terms'    => $tag_ids_block2,
										],
									],
									'posts_per_page' => 3,
									'paged' => 1,
								];

								$query = new WP_Query($args);

								if ($query->have_posts()) {
									while ($query->have_posts()) {
										$query->the_post();
										$raw_rating = mcf_get_field('Reyting_Bonusa_template_review_bonus');
										$rating = max(0, min(5, intval(round($raw_rating))));
										$name_btn = mcf_get_field('Nazvanie_knopki_GET_BONUS');
										$url_btn = mcf_get_field('URL_BTN_bonus_template_review_');
							?>
										<section class="ZAOYv1NRyNdr">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail([79, 79]); ?></a>
											<section class="wOFCI2kSjym6B">
												<ul class="rating">
													<?php for ($i = 1; $i <= 5; $i++): ?>
														<li>
															<section class="star<?php echo ($i <= $rating) ? ' active' : ''; ?>"></section>
														</li>
													<?php endfor; ?>
												</ul>
												<a href="<?php the_permalink(); ?>" class="DvyQMDA7IB7E"><?php the_title(); ?></a>
												<?php mcf_the_field('Lid_bonusa_template_review_'); ?>
												<section class="buttons">
													<a href="<?php echo esc_url($url_btn); ?>" class="button HKYDfj0abmr"><?php echo esc_html($name_btn); ?></a>
												</section>
											</section>
										</section>
							<?php
									}
								} else {
									echo '<p>Записей с выбранными тегами нет.</p>';
								}

								wp_reset_postdata();
							} else {
								echo '<p>Теги не выбраны.</p>';
							}
							?>
						</section>

						<section class="rEHnqyaLPAcb">
							<a href="#" class="UUoOFZTKQLWyzx" id="load-more-btn-block-2"><?php echo esc_html($btn_text_block2); ?></a>
						</section>
					</section>

					<script>
						var bonusBlock2Data = {
							ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
							tag_ids: "<?php echo esc_js($tag_ids_block2_string); ?>",
							posts_per_page: 3
						};
					</script>


				<?php elseif (mcf_get_row_layout() === 'Block_TEXT_single_bonus'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J img-right">
							<section class="text">
								<?php mcf_the_field('Text__single_bonus_lvl_4'); ?>
							</section>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_FAQ_single_bonus'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_template_single_bonus_lvl_5'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_Faq_template__single_bonus_lvl_5')): ?>
								<?php while (mcf_have_rows('add_Faq_template__single_bonus_lvl_5')): mcf_the_row(); ?>
									<amp-accordion animate expand-single-section class="faq-item">
										<section>
											<h2 class="faq-item-title"><?php mcf_the_field('question_template_single_bonus_lvl_5'); ?></h2>
											<div class="faq-item-info">
												<p><?php mcf_the_field('Answer_template_single_bonus_lvl_5'); ?></p>
											</div>
										</section>
									</amp-accordion>
								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>

				<?php elseif (mcf_get_row_layout() === 'Affiliate_program_news_single_bonus'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Tilte_H2_template_single_bonus_lvl_6'); ?></h2>
						<section class="wUbnokcWHf731SWN">
							<?php
							$category_id = get_taxonomy_field('Pokazyvat_4_poslednie_zapisi_iz_kategorii__template_single_bonus');
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


				<?php elseif (mcf_get_row_layout() === 'Welcome_bonus_single_bonus'): ?>
								<?php $img = mcf_get_image_field('img_bg_template__single_bonus_lvl_7'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_template__single_bonus_lvl_7'); ?></h2>
						<p><?php mcf_the_field('Tekst__template_single_bonus_lvl_7'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template__single_bonus_lvl_7'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template__single_bonus_lvl_7'); ?></a>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_Author_single_bonus'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_single_bonus_lvl_8'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_single_bonus_lvl_8'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_single_bonus_lvl_8'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_single_bonus_lvl_8'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_single_bonus_lvl_8'); ?></section>
							<?php mcf_the_field('Opisanie_Avtora_template_single_bonus_lvl_8'); ?>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_single_bonus_lvl_8') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_single_bonus_lvl_8'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php if (mcf_get_field('Show_data_template_single_bonus') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_template_part('footer', 'amp'); ?>
