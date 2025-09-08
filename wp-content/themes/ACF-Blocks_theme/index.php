<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package acf_blocks
 */

get_header();
?>

<main class="container main-container">
	<div class="breadcrumbs-wrapper">
		<?php get_template_part( '/template-parts/breadcrumbs' ); ?>
	</div>

	<?php the_content();?>
</main>

<?php
get_sidebar();
get_footer();
