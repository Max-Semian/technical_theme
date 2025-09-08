<footer class="WqpOVDTcdNifJuCq footer">
	<section class="container">
		<section class="wrapper uBhRYtPATfTyki22">
			<?php
			wp_nav_menu([
				'theme_location' => 'footer_menu',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new Walker_Footer_Groups(),
			]);
			?>
			<?php
            $languages = function_exists('pll_the_languages') 
            	? pll_the_languages(['raw' => 1, 'hide_if_no_translation' => 0]) 
            	: [];
            
            if (count($languages) > 1): ?>
            	<section class="yvcLVUuP">
            		<section class="wAXgJnAELvhM"><?php mcf_the_field('Tekst_kolonki_vybora_yazyka', 'options__'); ?></section>
            		<ul class="vBKhY0NS8">
            			<?php
            			$context = 'footer';
            			include get_template_directory() . '/template-parts/lang-switcher.php';
            			?>
            		</ul>
            	</section>
            <?php endif; ?>
		</section>
		<?php if ( mcf_have_rows('footer_logos', 'options__') ): ?>
            <ul class="jLgejisGpy7vfst">
                <?php while ( mcf_have_rows('footer_logos', 'options__') ): mcf_the_row(); ?>
                    <?php
                    $img = mcf_get_image_field('images_footer', 'options__');
                    if ( $img ) :
                    ?>
                        <li>
                            <section class="DTYhioWwXfS">
                                <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                            </section>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
	</section>
	<section class="VrREEH0i4yP">
		<section class="container">
			<?php mcf_the_field('copyright_text_footer', 'options__'); ?>
		</section>
	</section>
</footer>
</section>
<?php wp_footer(); ?>
</body>

</html>
