<?php get_header(); ?>

<?php if ( is_singular( 'organization' ) ) { ?>

	<?php get_template_part( '/theme-parts/posts/single/organization' ); ?>

	<!-- Float Button Start -->

	<?php get_template_part( '/theme-parts/posts/single/fixed-button' ); ?>

	<!-- Float Button End -->


<?php } else { ?>
	
	<?php get_template_part( '/theme-parts/posts/single/default' ); ?>

<?php } ?>


<?php get_footer(); ?>
