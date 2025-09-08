<?php
/*
Template Name: payouts-amp
*/
?>
<?php get_template_part('header', 'amp'); ?>


<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>
		<?php if (mcf_have_rows('add_block_payouts')): ?>
			<?php while (mcf_have_rows('add_block_payouts')): mcf_the_row(); ?>

				<?php if (mcf_get_row_layout() === 'Main_block_LVL_1'): ?>
					<section class="block RGLItQW9aH uaQATjNZJ1 img-7">
						<section class="uxcpYpQeX">
							<h1 class="hszJpvkDljV tmBOreAB78Ev"><?php the_title(); ?></h1>
							<?php $img = mcf_get_image_field('img_lvl_1payouts'); ?>
                                <?php if ( $img ) : ?>
                                    <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                                <?php endif; ?>
							<?php mcf_the_field('text_lvl_1payouts'); ?>
						</section>
						<?php if ( $img ) : ?>
                            <img src="<?php echo esc_url( $img['url'] ); ?>" class="yUjoSkN253I" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                        <?php endif; ?>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Add_Cards_lvl2_payouts'): ?>
					<?php if (mcf_have_rows('add_block_card_lvl2_payouts')): ?>
						<?php while (mcf_have_rows('add_block_card_lvl2_payouts')): mcf_the_row(); ?>
							<section class="block block-cards">
								<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_lvl2_payouts'); ?></h2>
								<section class="oDgXItgcCA">
									<?php if (mcf_have_rows('add_cards_lvl2_payouts')): ?>
										<?php while (mcf_have_rows('add_cards_lvl2_payouts')): mcf_the_row(); ?>
											<section class="CJSnXPZmF2Jl">
												<section class="qKYJ6WZYW">
													<?php $img = mcf_get_image_field('img_lvl2_payouts'); ?>
													<?php if ($img) : ?>
														<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
													<?php endif; ?>
												</section>
												<section class="gPFbemecT"><?php mcf_the_field('card_name_lvl2_payouts'); ?></section>
												<section class="pnfEbXUsU0Dsl">
													<p><?php mcf_the_field('card_text_lvl2_payouts'); ?> </p>
												</section>
												<?php if (mcf_get_field('show_btn_cards_lvl2_payouts') == 1) : ?>
													<section class="buttons">
														<a href="<?php mcf_the_field('url_btn_lvl2_payouts'); ?>" class="button EoXFIVifwrJ"><?php mcf_the_field('name_btn_lvl2_payouts'); ?></a>
													</section>
												<?php endif; ?>
											</section>
										<?php endwhile; ?>
									<?php endif; ?>
								</section>
							</section>
						<?php endwhile; ?>
					<?php endif; ?>


				<?php elseif (mcf_get_row_layout() === 'block_Text_lvl_3_payouts'): ?>
					<section class="block wOFCI2kSjym6B">
						<section class="vjUy54vJFJ5J">
							<section class="text">
								<?php mcf_the_field('Text_lvl_3_payouts'); ?>
							</section>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'FAQ_lvl_4_payouts'): ?>
					<section class="block block-faq">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Title_Faq_lvl_4_payouts'); ?></h2>
						<section class="aLhNneSpZ1O5w">
							<?php if (mcf_have_rows('add_Faq_payouts')): ?>
								<?php while (mcf_have_rows('add_Faq_payouts')): mcf_the_row(); ?>
									<amp-accordion animate expand-single-section class="faq-item">
										<section>
											<h2 class="faq-item-title"><?php mcf_the_field('question_payouts'); ?></h2>
											<div class="faq-item-info">
												<p>
													<?php mcf_the_field('Answer_payouts'); ?>
												</p>
											</div>
										</section>
									</amp-accordion>
								<?php endwhile; ?>
							<?php endif; ?>
						</section>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Affiliate_program_news_payouts'): ?>
					<section class="block block-news-previews">
						<h2 class="ttOKnNStIgHIN"><?php mcf_the_field('Tilte_H2_payouts'); ?></h2>
						<h3 class="fBkRfgAkHYF"><?php mcf_the_field('Text_H3_payouts'); ?></h3>
						<section class="wUbnokcWHf731SWN">


							<?php
							$category_id = get_taxonomy_field('Pokazyvat_4_poslednie_zapisi_iz_kategorii__payouts');
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


				<?php elseif (mcf_get_row_layout() === 'Block_Bonus_payouts'): ?>
								<?php $img = mcf_get_image_field('img_bg_welcom_bonus_payouts'); ?>
<section class="block LVLjdiAjoH6MXRu"
    style="background: var(--color-block-banner-bg) 
           <?php if ( $img ) : ?>
               url('<?php echo esc_url( $img['url'] ); ?>')
           <?php endif; ?>
           no-repeat top center / cover;">
						<h2 class="UoPVXK3PDwK"><?php mcf_the_field('Title_H2_template_payouts'); ?></h2>
						<p><?php mcf_the_field('text_welcom_bonus_payouts'); ?></p>
						<a href="<?php mcf_the_field('url_btn_welcom_bonus_payouts'); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('Text_btn_welcom_bonus_payouts'); ?></a>
					</section>


				<?php elseif (mcf_get_row_layout() === 'Author'): ?>
					<section class="block GEoGOtPQNfqqjR">
						<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_payouts'); ?>" class="HIQnu8tc6zhPt">
							<?php $img = mcf_get_image_field('Izobrazhenie_Avtora_payouts'); ?>
							<?php if ($img) : ?>
								<img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
							<?php endif; ?>
						</a>
						<section class="bLBEoxAG7i">
							<a href="<?php mcf_the_field('Ssylka_na_stranitsu_avtora_payouts'); ?>" class="cmer0XjP"><?php mcf_the_field('Imya_Avtora_payouts'); ?></a>
							<section class="sKPwbZJxN3"><?php mcf_the_field('Dolzhnost_Avtora_payouts'); ?></section>
							<p><?php mcf_the_field('Opisanie_Avtora_payouts'); ?></p>
							<?php if (mcf_get_field('Pokazyvat_Knopku_Linkedin_blog_payouts') == 1) : ?>
								<ul class="hasMjGScosx">
									<li><a href="<?php mcf_the_field('Ssylka_na_Linkedin_payouts'); ?>" class="DQsWMUsDfw">Linkedin</a></li>
								</ul>
							<?php endif; ?>
						</section>
					</section>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>


		<?php if (mcf_get_field('Pokazyvat_datu_publikatsii_payouts') == 1) : ?>
			<section class="block foiLTGtp3Xgv6fDZ">
				<p><?php echo esc_html(pll__('Published')); ?> <?php echo get_the_date('d.m.Y'); ?></p>
			</section>
		<?php endif; ?>

	</section>
</section>


<?php get_template_part('footer', 'amp'); ?>
