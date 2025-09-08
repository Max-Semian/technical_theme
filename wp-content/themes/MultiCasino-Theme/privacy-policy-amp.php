<?php
/*
Template Name: privacy-policy-amp
*/
?>
<?php get_template_part('header', 'amp'); ?>


<section class="WqpOVDTcdNifJuCq PeFOrJkT335J FzUsozfyOheIb5Ic">
	<section class="container">
		<?php get_template_part('template-parts/breadcrumbs'); ?>
		<section class="block wOFCI2kSjym6B">
			<section class="vjUy54vJFJ5J">
				<?php if ( mcf_get_field('published_or_updated') ) : ?>
                    <section class="wBevOOSaC">
                        <p><?php mcf_the_field('published_or_updated'); ?></p>
                    </section>
                <?php endif; ?>
				<section class="text">
					<?php the_content(); ?>
				</section>
			</section>
		</section>
	</section>
</section>


<?php get_template_part('footer', 'amp'); ?>
