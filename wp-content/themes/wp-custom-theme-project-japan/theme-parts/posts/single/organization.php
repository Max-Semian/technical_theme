<?php
	global $post;

	$default_single_allowed_html = array(
		'a'      => array(
			'href'   => true,
			'title'  => true,
			'target' => true,
			'rel'    => true,
		),
		'img'    => array(
			'src' => true,
			'alt' => true,
		),
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'span'   => array(
			'class' => true,
		),
		'div'    => array(
			'class' => true,
		),
		'p'      => array(),
		'ul'     => array(),
		'ol'     => array(),
		'li'     => array(),
	);

	$custom_post_type = get_post_type();

	$short_desc     = get_post_meta( get_the_ID(), "{$custom_post_type}_short_desc", true );
	$overall_rating = esc_html( get_post_meta( get_the_ID(), "{$custom_post_type}_overall_rating", true ) );
	$external_link  = esc_url( get_post_meta( get_the_ID(), "{$custom_post_type}_external_link", true ) );
	$button_title   = esc_html( get_post_meta( get_the_ID(), "{$custom_post_type}_button_title", true ) );

	if ( empty( $button_title ) ) {
		if ( get_option( "{$custom_post_type}_button_title" ) ) {
			$button_title = esc_html( get_option( "{$custom_post_type}_button_title" ) );
		} else {
			$button_title = esc_html__( 'Follow', 'custom-theme' );
		}
	}

	?>

<main class="pt-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

	<div class="pb-10">

		<?php get_template_part( '/theme-parts/breadcrumbs' ); ?>


		<!-- Post Header Start -->

		<div class="py-12 flex flex-col justify-between items-center gap-10 lg:!flex-row">
			<div class="relative aspect-h-1 aspect-w-1 bg-gray-200 w-32 h-32 lg:aspect-none">
				<?php
					$post_title_attr = the_title_attribute( 'echo=0' );
		
				if ( wp_get_attachment_image( get_post_thumbnail_id() ) ) {
					echo wp_get_attachment_image(
						get_post_thumbnail_id(),
						array( 128, 128 ),
						'',
						array(
							'class' => 'h-full w-full object-cover object-center',
							'alt'   => $post_title_attr,
						) 
					);
				} 
				?>
		
				<div class="absolute -right-4 -top-4 flex items-center gap-1 py-1 px-2 bg-white rounded-2xl shadow">
					<span class="font-bold text-base text-dark">
						<?php echo esc_html( number_format( (float) $overall_rating, 1, '.', ',' ) ); ?>
					</span>
					<div class="star active">
						<svg
							width="16"
							height="16"
							viewbox="0 0 12 12"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
						>
							<path
								d="M5.30345 0.963523C5.45313 0.502869 6.10483 0.502872 6.25451 0.963528L7.15601 3.7381C7.22294 3.94411 7.41492 4.08359 7.63154 4.08359H10.5489C11.0333 4.08359 11.2347 4.7034 10.8428 4.9881L8.48262 6.70288C8.30737 6.8302 8.23405 7.05588 8.30098 7.26189L9.20249 10.0365C9.35216 10.4971 8.82492 10.8802 8.43307 10.5955L6.07287 8.88071C5.89763 8.75339 5.66033 8.75339 5.48509 8.88071L3.12487 10.5955C2.73302 10.8802 2.20578 10.4971 2.35545 10.0365L3.25698 7.2619C3.32392 7.05588 3.25059 6.8302 3.07535 6.70288L0.715164 4.9881C0.323307 4.7034 0.524694 4.08359 1.00906 4.08359H3.92639C4.14301 4.08359 4.33498 3.94412 4.40192 3.7381L5.30345 0.963523Z"
								fill="currentColor"
							></path>
						</svg>
					</div>
				</div>
			</div>

			<div class="flex-1 text-center lg:!text-left">
				<!-- Title Start -->
			
				<h1 class="font-bold text-4xl">
					<?php the_title(); ?>
				</h1>
			
				<!-- Title End -->
			
				<?php if ( $short_desc ) { ?>
			
					<!-- Short Description of the post Start -->
			
					<div class="text-base text-grizzly-light mt-4">
						<?php echo wp_kses( $short_desc, $default_single_allowed_html ); ?>
					</div>
			
					<!-- Short Description of the post End -->
			
				<?php } ?>
								
			</div>

			<?php if ( $external_link ) { ?>

				<!-- Button Start -->
				
				<div>
					<a 
						href="<?php echo esc_url( $external_link ); ?>" 
						title="<?php echo esc_attr( $button_title ); ?>" 
						class="main-button relative flex items-center justify-center text-center text-base font-bold rounded-lg py-4 px-10 no-underline xl:!text-sm"
						rel="nofollow" 
						target="_blank"
					>
						<div
							class="background absolute w-full h-full rounded-lg transform -skew-x-12"
						></div>
						<span class="relative uppercase italic">
							<?php echo esc_html( $button_title ); ?> 
						</span>
					</a>
				</div>
					
				<!-- Button End -->

			<?php } ?>
		</div>

		<!-- Post Header End -->

		<div class="main-blocks [&>*]:my-7">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif; 
			?>
		</div>

	</div>
	
	<!-- Comments Start -->

	<?php
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>

	<!-- Comments End -->

	<!-- Start subscribe block-->

	<?php get_template_part( 'theme-parts/subscribe' ); ?>

	<!-- End subscribe block-->

</main>
