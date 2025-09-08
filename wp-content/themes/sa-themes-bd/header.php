<!DOCTYPE html>
<html lang="ja">
    <head>
		<base href="<?php echo get_site_url(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body>
		<header>
			<div class="header-block">
				<a href="/" class="header-logo" aria-label="ホームページに戻る">
					<img src="/wp-content/uploads/2025/05/Logo.webp" alt="サイトロゴ">
				</a>
				<div class="header-menu header-menu-desctop">
					<div class="nav-menu" id="main-navigation">
						<?php $args = array(
							'theme_location' => 'main_menu',
							'menu_class' => 'list-nav',
							'container' => false,
							'walker' => new True_Walker_Nav_Menu()
						);
						wp_nav_menu($args); ?>
					</div>
				</div>
				<div class="header-search header-search-desctop">
					<?php get_search_form(); ?>
				</div>
				<button class="header-menu-burger" aria-label="メニューを開く" type="button">
					<div class="burger-button-spans">
						<span></span><span></span><span></span>
					</div>
				</button>
				<div class="header-menu header-menu-mobile">
					<div class="header-search header-search-mobile">
						<?php get_search_form(); ?>
					</div>
					<div class="nav-menu">
						<?php $args = array(
							'theme_location' => 'main_menu',
							'menu_class' => 'list-nav',
							'container' => false,
							'walker' => new True_Walker_Nav_Menu()
						);
						wp_nav_menu($args); ?>
					</div>
				</div>
			</div>
		</header>