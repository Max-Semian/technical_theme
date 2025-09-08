<?php $site_name = get_bloginfo( 'name' ); ?>

<div class="flex items-center min-w-fit h-fit no-underline">
	<div class="-m-1.5 p-1.5">
		<span class="sr-only"><?php echo esc_html( $site_name ); ?></span>
		<?php the_custom_logo(); ?>
	</div>
	<a href="<?php echo esc_url( site_url() ); ?>">
		<p class="text-white uppercase font-bold ml-3"><?php echo esc_html( $site_name ); ?></p>
	</a>
</div>
