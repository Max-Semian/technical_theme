<?php
/*
Template Name: 404-amp
*/
?>
<?php get_template_part('header', 'amp'); ?>

<section class="WqpOVDTcdNifJuCq PeFOrJkT335J">
	<section class="container">
		<section class="block ywlgYNYtgKuE4vf8">
			<h1 class="DLjtepfdesOhZJ pGogQv3MnXHv"><?php mcf_the_field('404_text_h1', 'options__'); ?></h1>
			<h4 class="DLjtepfdesOhZJ pGogQv3MnXHv SQcucmBbL"><?php mcf_the_field('404_text_h4', 'options__'); ?></h4>
			<?php
            $img = mcf_get_image_field('404_img', 'options__');
            $picture_style = $img ? 'style="background-image: url(' . esc_url($img['url']) . ');"' : '';
            ?>
            <section class="teXhnMiVlLpR" <?php echo $picture_style; ?>></section>
            <a href="<?php echo home_url(); ?>" class="button HKYDfj0abmr"><?php mcf_the_field('404_btn_text', 'options__'); ?></a>
		</section>
	</section>
</section>

<?php get_template_part('footer', 'amp'); ?>
