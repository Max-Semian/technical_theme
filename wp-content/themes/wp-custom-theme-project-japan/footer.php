<!-- Start footer-->

<footer>
	<div class="py-10 lg:!py-20 mx-auto max-w-7xl px-4 sm:!px-6 lg:!px-8">
		<div class="flex flex-1 flex-col items-start lg:!flex-row">
			<div class="flex justify-between items-center basis-full w-full md:!basis-2/6">
				<?php get_template_part( 'theme-parts/logo' ); ?>
				<div class="lg:hidden">
					<button
						class="hamburger-btn inline-flex items-center justify-center rounded-md -m-2.5 p-2.5"
						type="button"
					>
						<span class="sr-only">Open main menu</span
						><svg
							class="h-8 w-8"
							fill="none"
							viewbox="0 0 24 24"
							stroke-width="1.5"
							stroke="currentColor"
							aria-hidden="true"
						>
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
							></path>
						</svg>
					</button>
				</div>
			</div>
			<?php if ( ! empty( get_theme_mod( 'footer_description' ) ) ) { ?>
				<div class="my-6 basis-full lg:!mt-0 lg:!mb-6 xl:!mb-0">
					<p class="text-sm">
						<?php
							$allowed_html = array(
								'a'      => array(
									'href'   => true,
									'title'  => true,
									'target' => true,
								),
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'span'   => array(),
								'p'      => array(),
							);
							echo wp_kses( get_theme_mod( 'footer_description' ), $allowed_html );
				
							?>
					</p>
				</div>
			<?php } ?>
		</div>
		<div class="divide-y divide-dark-grizzly">
			<?php
				wp_nav_menu( 
					array( 
						'theme_location' => 'footer',
						'depth'          => 1,
						'container'      => null,
						'menu_class'     => 'flex-1 flex-wrap gap-2 justify-around items-center my-6 hidden lg:!flex xl:!justify-between xl:!mt-11',
						'walker'         => new Footer_Walker_Nav_Menu(),
						// 'fallback_cb'       => 'theme_walker_nav_menu::fallback',
					) 
				); 
				?>
			<p class="text-sm text-center pt-6">
				<?php echo esc_html( gmdate( 'Y' ) ); ?> 
				<?php esc_html_e( '&copy;' ); ?> 
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
				<?php esc_html_e( 'All Rights Reserved', 'custom-theme' ); ?>
			</p>
		</div>
	</div>
</footer>

<!-- End footer-->

<!-- Back to Top Start -->

<button class="main-button fixed z-10 right-4 sm:right-6 lg:right-8 bottom-8 w-10 h-10 p-2 border-none rounded-full duration-200 invisible opacity-0" id="back-to-top">
	<svg
		xmlns="http://www.w3.org/2000/svg"
		fill="none"
		viewBox="0 0 24 24"
		stroke="currentColor"
	>
	<path
		stroke-linecap="round"
		stroke-linejoin="round"
		stroke-width="2"
		d="M7 11l5-5m0 0l5 5m-5-5v12"
	/>
	</svg>
</button>

<!-- Back to Top End -->

<?php wp_footer(); ?>

</body>

</html>
