<?php if ( function_exists( 'bcn_display' ) && ! is_front_page() ) { ?>
	<div class="text-grizzly text-lg">
		<div class="py-2 bcn-breadcrumbs">
			<?php bcn_display(); ?>
		</div>
	</div>
<?php } ?>
