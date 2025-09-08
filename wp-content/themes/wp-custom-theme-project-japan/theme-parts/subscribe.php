<div class="relative left-1/2 w-screen -translate-x-2/4 isolate overflow-hidden bg-gray-900 py-10 lg:py-28">
	<img
		class="absolute inset-0 -z-10 h-full w-full object-cover md:object-center"
		src="<?php bloginfo( 'template_directory' ); ?>/src/assets/images/subscribe-bg.webp"
		alt="banner"
		width="1920"
		height="520"
	/>
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="max-w-xl mx-auto lg:max-w-lg">
			<h5
				class="mb-6 text-base font-black tracking-tight text-white italic uppercase md:!text-2xl"
			>
				<?php esc_html_e( 'Want the latest news?', 'custom-theme' ); ?>
			</h5>
			<p class="mb-6 text-base text-white lg:mb-11">
				<?php
					$default_description = __(
						'Get exclusive betting news and the latest odds from top-rated sportsbooks, straight to
						your inbox and social feeds.',
						'custom-theme' 
					); 

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

					echo wp_kses(
						! empty( get_theme_mod( 'subscribe_description' ) ) ?
						get_theme_mod(
							'subscribe_description',
							$default_description
						) : $default_description,
						$allowed_html 
					);
					?>
			</p>
			<form class="flex flex-col relative mb-8 lg:flex-row" id="subscribe-form">
				<label class="sr-only" for="subscribe-email-address"
					>
					<?php esc_html_e( 'Email address', 'custom-theme' ); ?>
				</label
				><input
					class="min-w-0 flex-auto rounded-lg border-0 py-5 text-dark shadow-sm placeholder:text-grizzly pl-3.5 pr-50% sm:text-sm sm:leading-6"
					id="subscribe-email-address"
					name="email"
					type="email"
					autocomplete="email"
					required
					placeholder="<?php echo esc_attr__( 'Enter your email', 'custom-theme' ); ?>"
				/>
				<div class="mt-8 lg:w-2/4 lg:absolute lg:-right-3 lg:mt-0">
					<button
						class="main-button relative flex text-base font-black w-full"
						type="button"
						aria-expanded="false"
						id="subscribe-btn"
					>
						<div
							class="background absolute w-full h-full rounded-lg transform -skew-x-12"
						></div>
						<input name="submit" type="submit" id="submit" class="relative uppercase py-5 mx-auto italic cursor-pointer w-full" value="<?php echo esc_attr__( 'Subscribe', 'custom-theme' ); ?>">
					</button>
				</div>
			</form>
			<?php
			if ( is_active_sidebar( 'subscribe-widgets' ) ) {
				dynamic_sidebar( 'subscribe-widgets' ); 
			} 
			?>
		</div>
	</div>
</div>
