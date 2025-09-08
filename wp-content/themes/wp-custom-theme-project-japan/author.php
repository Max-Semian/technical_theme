<?php get_header(); ?>

<main class="pt-20 pb-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
	<div class="main-content [&>*]:my-7">
		<!-- Title Box Start -->
	
		<div class="flex flex-col gap-6 md:!gap-10 md:!flex-row">
			<div class="basis-full md:!basis-1/4">
				<?php
					echo get_avatar( get_the_author_meta( 'user_email' ), '200' );
				?>
			</div>

			<div class="basis-full">
				<h1 class="mb-4"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h1>
				<?php if ( get_the_author_meta( 'description' ) ) { ?>
					<p class="text-base text-grizzly-light md:!text-xl">
						<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
					</p>
				<?php } ?>
			</div>
		</div>
	
		<!-- Title Box End -->

		<div class="[&>*]:my-10">
			<?php
				$author_id = get_the_author_meta( 'ID' );

				$custom_posts_query = new WP_Query(
					array(
						'post_type'      => 'page',
						'author'         => $author_id,
						'posts_per_page' => -1, // Display all posts
					)
				);

				if ( $custom_posts_query->have_posts() ) {
					while ( $custom_posts_query->have_posts() ) {

						$custom_posts_query->the_post();
						?>

						<div class="post-item">
							<div class="text-xs text-grizzly-light">
								<span>
									<?php echo get_the_date(); ?>
								</span>
							</div>
							<h5 class="my-3">
								<a class="no-underline duration-200" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_title(); ?>
								</a>
							</h5>
							<p class="font-base text-grizzly-light">
								<?php echo esc_html( wp_trim_words( get_the_excerpt(), 48, ' ...' ) ); ?>
							</p>
						</div>

						<?php 
					}

					// Reset the custom query
					wp_reset_postdata();
				} else { 
					?>
					<!-- Posts not found Start -->

					<div class="text-center">
						<h2><?php esc_html_e( 'Posts not found', 'custom-theme' ); ?></h2>
						<p>
							<?php esc_html_e( 'No posts has been found. Please return to the homepage.', 'custom-theme' ); ?>
						</p>
					</div>

					<!-- Posts not found End -->
					<?php 
				}
				?>

		</div>

	</div>
</main>

<?php get_footer(); ?>
