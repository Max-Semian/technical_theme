<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php if (mcf_have_rows('add_block_template_main')): ?>
			<?php while (mcf_have_rows('add_block_template_main')): mcf_the_row(); ?>


				<?php if (mcf_get_row_layout() === 'Main_block_template_main'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-1">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV"><?php the_title() ?></h1>
							<?php $img = mcf_get_image_field('img_template_main_lvl_1'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
							<p><?php mcf_the_field('text_template_main_lvl_1'); ?></p>
						</section>
						<?php $img = mcf_get_image_field('img_template_main_lvl_1'); ?>
						<?php if ($img) : ?>
							<img src="<?php echo esc_url($img['url']); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_Best_online_casinos_template_main'): ?>
					<section class="block HgNEXbcXKiOWGk0V" id="best-casinos-block-1">
						<h2 class="ttOKnNStIgHIN pGogQv3MnXHv"><?php mcf_the_field('Title_template_main_lvl_2'); ?></h2>
						<section class="best-casinos-items" id="bestCasinos"></section>
						<section class="rEHnqyaLPAcb">
							<a href="#" id="best-casinos-block-1-read-more" class="UUoOFZTKQLWyzx">
								<?php mcf_the_field('Nazvanie_knopki_podgruzki'); ?>
							</a>
						</section>
						<script>
							var bestCasinosTagIds = <?php echo json_encode(get_taxonomy_field('Po_kakomu_tegu_vyvodit_luchshie_kazino')); ?>;
						</script>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_casinos_and_slots_template_main'): ?>
					<section class="block block-descriptions-tile">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_template_main_lvl_3'); ?></h2>
						<?php mcf_the_field('text_main'); ?>
						<section class="DYrIjFkwhHv9E">
							<?php if (mcf_have_rows('add_casinos_and_slots_template_main_lvl_3')): ?>
								<?php while (mcf_have_rows('add_casinos_and_slots_template_main_lvl_3')): mcf_the_row(); ?>
									<section class="item item6">
										<section class="PpCWpAb2C2V9">
											<?php $img = mcf_get_image_field('img_template_main_lvl_3'); ?>
											<?php if ($img) : ?>
												<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
											<?php endif; ?>
										</section>
										<section class="jLvRgyUi2DnKH"> <?php mcf_the_field('text_template_main_lvl_3'); ?></section>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_Guides_template_main'): ?>
					<section class="block block-descriptions-tile">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_template_main_lvl_4'); ?></h2>
						<section class="DYrIjFkwhHv9E">
							<?php if (mcf_have_rows('add_Guides_template_main_lvl_4')): ?>
								<?php while (mcf_have_rows('add_Guides_template_main_lvl_4')): mcf_the_row(); ?>
									<section class="item item1">
										<section class="PpCWpAb2C2V9 xqthmKBY5mS">
											<?php $img = mcf_get_image_field('img_template_main_lvl_4'); ?>
											<?php if ($img) : ?>
												<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
											<?php endif; ?>
										</section>
										<p><span><?php mcf_the_field('text_template_main_lvl_4'); ?></span></p>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_text_template_main'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J img-right">
							<section class="text">
								<?php mcf_the_field('text_template_main_lvl_5'); ?>
							</section>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_last_slots_template_main'): ?>
					<section class="block DOWlz7LHfQhP" id="last-slots-block-1">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_template_main_lvl_6'); ?></h2>

						<section class="slots-items" id="slotsItemsMain"></section>

						<section class="rEHnqyaLPAcb">
							<a href="#" id="last-slots-block-1-read-more" class="UUoOFZTKQLWyzx">
								<?php mcf_the_field('Nazvanie_knopki_slotov'); ?>
							</a>
						</section>

						<script>
							var lastSlotsTagIds = <?php echo json_encode(get_taxonomy_field('Po_kakomu_tegu_vyvodit_luchshie_sloty')); ?>;
						</script>
					</section>

				<?php elseif (mcf_get_row_layout() === 'Block_program_news_template_main'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_template_main_lvl_7'); ?></h2>
						<section class="wUbnokcWHf731SWN">
							<?php
							$category_id = get_taxonomy_field('iz_kakoy_rubriki_vyvodit_poslednie_4_zapisi');
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


				<?php elseif (mcf_get_row_layout() === 'Block_Welcome_Bonus_template_main'): ?>
				<?php $img = mcf_get_image_field('img_bg_template_main_lvl_8'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">

						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Title_template_main_lvl_8'); ?></h2>
						<p><?php mcf_the_field('Tekst_template_main_lvl_8'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_main_lvl_8'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_main_lvl_8'); ?></a>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Faq_template_main'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_faq_template_main_lvl_9'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_faq_template_main_lvl_9')): ?>
								<?php while (mcf_have_rows('add_faq_template_main_lvl_9')): mcf_the_row(); ?>
									<section class="faq-item">
										<section class="faq-item-title"><?php mcf_the_field('question_template_main_lvl_9'); ?></section>
										<section class="faq-item-info">
											<p><?php mcf_the_field('Answer_template_main_lvl_9'); ?></p>
										</section>
									</section>


								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Block_Author_template_main'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_main_lvl_10'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_main_lvl_10'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_main_lvl_10'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_main_lvl_10'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_main_lvl_10'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_template_main_lvl_10'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_main_lvl_10') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_main_lvl_10'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>


		<?php if (mcf_get_field('Pokazyvat_datu_publikatsii_template_Home') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_footer(); ?>
