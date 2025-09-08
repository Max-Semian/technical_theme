<?php
/*
Template Name: all-slots
*/
?>
<?php get_header(); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>
		<?php if (mcf_have_rows('add_block_template_all_slots')): ?>
			<?php while (mcf_have_rows('add_block_template_all_slots')): mcf_the_row(); ?>

				<?php if (mcf_get_row_layout() === 'Main_Block_template_all_slots'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-3">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev"><?php the_title() ?></h1>
							<?php $img = mcf_get_image_field('img_template_all_slots_lvl_1'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
							<?php mcf_the_field('text_template_all_slots_lvl_1'); ?>
						</section>
						<?php $img = mcf_get_image_field('img_template_all_slots_lvl_1'); ?>
						<?php if ($img) : ?>
							<img src="<?php echo esc_url($img['url']); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
					</section>

				<?php elseif (mcf_get_row_layout() === 'block_All_Slots_template_all_slots'): ?>
					<section class="block DOWlz7LHfQhP" id="slots-block-1">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_All_Slots_template_all_slots_lvl_2'); ?></h2>

						<?php
						$slot_tag_ids = get_taxonomy_field('Po_kakim_tegam-metkam_vyvodit_i_filtrovat_Sloty');
						if ($slot_tag_ids) {
							$tags = get_terms([
								'taxonomy'   => 'post_tag',
								'include'    => $slot_tag_ids,
								'hide_empty' => false,
							]);
						?>

							<section class="slots-filters" id="slotsFilters">
								<section class="vRdVDEFewQoUj">
									<form name="search" action="#" method="get">
										<input type="text" name="query" placeholder="Search for game">
									</form>
								</section>
								<section class="MfvbxwyX3eoL">
									<section class="DqjtwIDqBeZ">
										<section class="ZncnzyzgcB">Provider:</section>
										<section class="filter-item">
											<section class="filter-item-default">
												<span id="filterChose">ALL</span>
											</section>
											<ul class="filter-item-variants">
												<li class="active" data-tag-id="0"><a href="#">ALL</a></li>

												<?php foreach ($tags as $tag): ?>
													<li data-tag-id="<?php echo esc_attr($tag->term_id); ?>">
														<a href="#"><?php echo esc_html($tag->name); ?></a>
													</li>
												<?php endforeach; ?>
											</ul>
										</section>

									</section>
								</section>
							</section>

							<section class="slots-items"></section>

							<section class="rEHnqyaLPAcb">
								<a href="#" id="slots-block-1-read-more" class="UUoOFZTKQLWyzx">Load more</a>
							</section>

							<script>
								var slotsTagIds = <?php echo json_encode($slot_tag_ids); ?>; // ✅ Переменная с правильным именем
							</script>

						<?php } else { ?>
							<p>Теги не выбраны.</p>
						<?php } ?>
					</section>

				<?php elseif (mcf_get_row_layout() === 'Block_Guides_template_all_slots'): ?>
					<section class="block block-descriptions-tile">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Guides_template_all_slots_lvl_3'); ?></h2>
						<section class="DYrIjFkwhHv9E">

							<?php if (mcf_have_rows('add_Guides_template_all_slots_lvl_3')): ?>
								<?php while (mcf_have_rows('add_Guides_template_all_slots_lvl_3')): mcf_the_row(); ?>
									<section class="item item1">
										<section class="PpCWpAb2C2V9 xqthmKBY5mS"> <?php $img = mcf_get_image_field('img_template_all_slots_lvl_3'); ?>
											<?php if ($img) : ?>
												<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
											<?php endif; ?>
										</section>
										<p><span><?php mcf_the_field('text_template_all_slots_lvl_3'); ?></span></p>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>

						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_Affiliate_program_news_template_all_slots'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('title_Affiliate_program_news_template_all_slots_lvl_4'); ?></h2>
						<section class="wUbnokcWHf731SWN">
							<?php
							$category_id = get_taxonomy_field('Pokazyvat_4_poslednie_zapisi_iz_kategorii_?');
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
				<?php elseif (mcf_get_row_layout() === 'block_Faq_template_all_slots'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_template_all_slots_lvl_5'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_Faq_template_all_slots_lvl_5')): ?>
								<?php while (mcf_have_rows('add_Faq_template_all_slots_lvl_5')): mcf_the_row(); ?>


									<section class="faq-item">
										<section class="faq-item-title"><?php mcf_the_field('question_template_all_slots_lvl_5'); ?></section>
										<section class="faq-item-info">
											<p><?php mcf_the_field('Answer_template_all_slots_lvl_5'); ?></p>
										</section>
									</section>
								<?php endwhile; ?>
							<?php endif; ?>


						</section>
					</section>
				<?php elseif (mcf_get_row_layout() === 'block_text_template_all_slots'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J UXYZNOK9pFtyGL">
							<section class="text">
								<?php mcf_the_field('text_template_all_slots_lvl_5'); ?>
							</section>
						</section>
					</section>





				<?php elseif (mcf_get_row_layout() === 'block_Welcome_Bonus_template_all_slots'): ?>
									<?php $img = mcf_get_image_field('img_bg_template_all_slots_lvl_6'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_template_all_slots_lvl_6'); ?></h2>
						<p><?php mcf_the_field('Tekst_template_all_slots_lvl_6'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_all_slots_lvl_6'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_all_slots_lvl_6'); ?></a>
					</section>
				<?php elseif (mcf_get_row_layout() === 'Block_Author_template_all_slots'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_all_slots_lvl_7'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_all_slots_lvl_7'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_all_slots_lvl_7'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_all_slots_lvl_7'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_all_slots_lvl_7'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_template_all_slots_lvl_7'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_all_slots_lvl_7') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_all_slots_lvl_7'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>


		<?php if (mcf_get_field('Pokazyvat_datu_publikatsii_slotov_?') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_footer(); ?>
