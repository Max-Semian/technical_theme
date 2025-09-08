<?php
/*
Template Name: all-casinos-amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>
		<?php if (mcf_have_rows('add_block_template_all_casinos')): ?>
			<?php while (mcf_have_rows('add_block_template_all_casinos')): mcf_the_row(); ?>


				<?php if (mcf_get_row_layout() === 'main_block_template_all_casinos'): ?>
				    <?php
    // --- ГАРД от дублей ---
    global $__rendered_blocks;
    if (!isset($__rendered_blocks)) {
        $__rendered_blocks = [];
    }

    $layout_key = 'main_block_template_all_casinos';

    if (in_array($layout_key, $__rendered_blocks, true)) {
        continue; // КОММЕНТАРИЙ: блок уже выводили -> пропускаем
    }
    $__rendered_blocks[] = $layout_key;
    // -----------------------
    ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-4">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev"><?php the_title() ?></h1>
							<?php $img = mcf_get_image_field('img_template_all_casinos_lvl_1'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
							<?php mcf_the_field('text_template_all_casinos_lvl_1'); ?>
						</section>
						<?php $img = mcf_get_image_field('img_template_all_casinos_lvl_1'); ?>
						<?php if ($img) : ?>
							<img src="<?php echo esc_url($img['url']); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr($img['alt']); ?>" />
						<?php endif; ?>
					</section>

				<?php elseif (mcf_get_row_layout() === 'block_all_casinos_template_all_casinos'): ?>
				    <?php
    // --- ГАРД от дублей ---
    global $__rendered_blocks2;
    if (!isset($__rendered_blocks2)) {
        $__rendered_blocks = [];
    }

    $layout_key = 'main_block_template_all_casinos';

    if (in_array($layout_key, $__rendered_blocks2, true)) {
        continue; // КОММЕНТАРИЙ: блок уже выводили -> пропускаем
    }
    $__rendered_blocks2[] = $layout_key;
    // -----------------------
    ?>
                    <section class="block HgNEXbcXKiOWGk0V" id="casinos-block-1">
                        <h2 class="ttOKnNStIgHIN">
                            <?php mcf_the_field('title_template_all_casinos_lvl_2'); ?>
                        </h2>
                
                        <section class="best-casinos-items">
                            <?php
                            $tag_ids = get_taxonomy_field('Po_kakim_tegam-metkam_vyvodit_Kazino');
                            $tag_ids = array_map('intval', (array)$tag_ids);
                
                            if (!empty($tag_ids)) {
                                $args = [
                                    'post_type'      => ['post', 'page'],
                                    'posts_per_page' => 10,
                                    'post_status'    => 'publish',
                                    'tax_query'      => [[
                                        'taxonomy' => 'post_tag',
                                        'field'    => 'term_id',
                                        'terms'    => $tag_ids,
                                        'operator' => 'IN',
                                    ]],
                                ];
                
                                render_amp_posts_block($args, 'casino');
                            } else {
                                echo '<p>Теги не выбраны.</p>';
                            }
                            ?>
                        </section>
                    </section>


				<?php elseif (mcf_get_row_layout() === 'block_best_casino_bonuses_template_all_casinos'): ?>
    <?php
    // --- ГАРД от дублей ---
    global $__rendered_blocks3;
    if (!isset($__rendered_blocks3)) {
        $__rendered_blocks3 = [];
    }

    $layout_key = 'main_block_template_all_casinos';

    if (in_array($layout_key, $__rendered_blocks3, true)) {
        continue; // КОММЕНТАРИЙ: блок уже выводили -> пропускаем
    }
    $__rendered_blocks3[] = $layout_key;
    // -----------------------
    ?>
					<?php
					$tag_ids_block3 = get_taxonomy_field('Po_kakim_tegam-metkam_vyvodit_bonusy');
					$tag_ids_block3 = is_array($tag_ids_block3) ? $tag_ids_block3 : [$tag_ids_block3];
					$tag_ids_block3_string = implode(',', $tag_ids_block3);

					$btn_text_block3 = mcf_get_field('nazvanie_knopki_podgruzit_eschyo_dlya_bonusov');
					?>
					<section class="block qvrXFiQUJ">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('title_template_all_casinos_lvl_3'); ?></h2>

						<section class="xlmIFg1nKX5ao" id="bonuses-block-3">
							<?php
							if ($tag_ids_block3) {
								$args = [
									'post_type' => ['post', 'page'],
									'tax_query' => [
										[
											'taxonomy' => 'post_tag',
											'field' => 'term_id',
											'terms' => $tag_ids_block3,
										],
									],
									'posts_per_page' => 5,
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
								} else {
									echo '<p>Записей с выбранными тегами нет.</p>';
								}

								wp_reset_postdata();
							} else {
								echo '<p>Теги не выбраны.</p>';
							}
							?>
						</section>

<!-- 						<section class="rEHnqyaLPAcb">
							<a href="#" class="UUoOFZTKQLWyzx" id="load-more-btn-block-3"><?php echo esc_html($btn_text_block3); ?></a>
						</section> -->
					</section>

					<script>
						var bonusBlock3Data = {
							ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
							tag_ids: "<?php echo esc_js($tag_ids_block3_string); ?>",
							posts_per_page: 5
						};
					</script>



				<?php elseif (mcf_get_row_layout() === 'block_text_template_all_casinos'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J img-right">
							<section class="text">
								<?php mcf_the_field('text_template_all_casinos_lvl_4'); ?>
							</section>

						</section>
					</section>



				<?php elseif (mcf_get_row_layout() === 'block_faq_template_all_casinos'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_template_all_casinos_lvl_5'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_Faq_template_all_casinos_lvl_5')): ?>
								<?php while (mcf_have_rows('add_Faq_template_all_casinos_lvl_5')): mcf_the_row(); ?>
									<amp-accordion animate expand-single-section  class="faq-item">
										<section>
										<h2 class="faq-item-title"><?php mcf_the_field('question_template_all_casinos_lvl_5'); ?></h2>
										<div class="faq-item-info">
											<p><?php mcf_the_field('Answer_template_all_casinos_lvl_5'); ?></p>
											</div>
										</section>
							</amp-accordion>
								<?php endwhile; ?>
							<?php endif; ?>


						</section>
					</section>
				<?php elseif (mcf_get_row_layout() === 'Block_comments_template_all_casinos'): ?>
					<section class="block yMSFpu0QsG">

						<?php if (comments_open() || get_comments_number()) :
							comments_template();
						endif;
						?>
					</section>


				<?php elseif (mcf_get_row_layout() === 'block_Welcome_bonus_template_all_casinos'): ?>
									<?php $img = mcf_get_image_field('img_bg_template_all_casinos_lvl_7'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Zagolovok_template_all_casinos_lvl_7'); ?></h2>
						<p><?php mcf_the_field('text_template_all_casinos_lvl_7'); ?></p>
						<a href="<?php mcf_the_field('Ssylka_knopki_bonusov_template_all_casinos_lvl_7'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Tekst_Knopki_template_all_casinos_lvl_7'); ?></a>
					</section>

				<?php elseif (mcf_get_row_layout() === 'Block_Author_template_all_casinos'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_all_casinos_lvl_8'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_template_all_casinos_lvl_8'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_template_all_casinos_lvl_8'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_template_all_casinos_lvl_8'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_template_all_casinos_lvl_8'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_template_all_casinos_lvl_8'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_template_all_casinos_lvl_8') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_template_all_casinos_lvl_8'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>



		<?php if (mcf_get_field('Pokazyvat_datu_publikatsii_stranitsy_kazino') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>
	</section>
</section>

<?php get_template_part('footer', 'amp'); ?>
