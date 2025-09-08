        <footer>
            <div class="footer-block">
				<a href="/"class="footer-logo" aria-label="ホームページに戻る"><img src="/wp-content/uploads/2025/05/Logo.webp" alt="サイトロゴ"></a>
				<div class="footer-lists">
					<?php if (has_nav_menu('footer_menu_one')) { ?>
						<div class="footer-list-one footer-list">
							<div class="footer-list-title"><?php echo get_field('footer_title_menus', 'option')['menu_1']; ?></div>
							<div class="footer-list-menu">
								<?php $args = array(
									'theme_location' => 'footer_menu_one',
									'menu_class' => 'list-nav',
									'container' => false,
									'walker' => new True_Walker_Nav_Menu()
								);
								wp_nav_menu($args); ?>
							</div>
						</div>
					<?php }
					if (has_nav_menu('footer_menu_two')) { ?>
						<div class="footer-list-two footer-list">
							<div class="footer-list-title"><?php echo get_field('footer_title_menus', 'option')['menu_2']; ?></div>
							<div class="footer-list-menu">
								<?php $args = array(
									'theme_location' => 'footer_menu_two',
									'menu_class' => 'list-nav',
									'container' => false,
									'walker' => new True_Walker_Nav_Menu()
								);
								wp_nav_menu($args); ?>
							</div>
						</div>
					<?php }
					if (has_nav_menu('footer_menu_three')) { ?>
						<div class="footer-list-three footer-list">
							<div class="footer-list-title"><?php echo get_field('footer_title_menus', 'option')['menu_3']; ?></div>
							<div class="footer-list-menu">
								<?php $args = array(
									'theme_location' => 'footer_menu_three',
									'menu_class' => 'list-nav',
									'container' => false,
									'walker' => new True_Walker_Nav_Menu()
								);
								wp_nav_menu($args); ?>
							</div>
						</div>
					<?php }
					if (has_nav_menu('footer_menu_four')) { ?>
						<div class="footer-list-four footer-list">
							<div class="footer-list-title"><?php echo get_field('footer_title_menus', 'option')['menu_4']; ?></div>
							<div class="footer-list-menu">
								<?php $args = array(
									'theme_location' => 'footer_menu_four',
									'menu_class' => 'list-nav',
									'container' => false,
									'walker' => new True_Walker_Nav_Menu()
								);
								wp_nav_menu($args); ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="footer-bottom-block">
					<div class="footer-bottom-left">
						<div class="footer-bottom-description"><?php echo get_field('footer_text_nad_images', 'option'); ?></div>
						<div class="footer-bottom-logos">
							<?php if (get_field('footer_logos_images', 'option')) {
								foreach (get_field('footer_logos_images', 'option') as $item) { ?>
									<?php if ($item['link']) { ?>
										<a href="<?php echo $item['link']; ?>" target="_blank"><img src="<?php echo $item['img']; ?>" alt="<?php echo !empty($item['alt']) ? $item['alt'] : 'ロゴ'; ?>"></a>
									<?php } else { ?>
										<img src="<?php echo $item['img']; ?>" alt="<?php echo !empty($item['alt']) ? $item['alt'] : 'ロゴ'; ?>">
									<?php }
								}
							} ?>
						</div>
					</div>
					<div class="footer-bottom-right"><?php echo get_field('footer_text_right', 'option'); ?></div>
				</div>
			</div>
        </footer>
	<?php wp_footer(); ?>
    </body>
</html>