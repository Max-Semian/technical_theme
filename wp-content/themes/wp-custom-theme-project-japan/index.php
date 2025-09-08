<?php get_header(); ?>

<main class="pt-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
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

<?php get_footer(); ?>
