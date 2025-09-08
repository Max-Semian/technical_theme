<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
    <?php get_template_part('components/css/style'); ?>
</head>

<body <?php body_class(); ?>>
    <section class="bqsnL7AjVbpXR" id="pageCont">
        <header class="header WqpOVDTcdNifJuCq">
            <nav class="container VQMJHWuociCCg">
                <section class="zdtAvIhlr27">
                    <a href="<?php echo home_url(); ?>" class="oeZeosDE65cN">
                        <?php $img = mcf_get_image_field('header_logo', 'options__'); ?>
                            <?php if ( $img ) : ?>
                                <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
                            <?php endif; ?>
                    </a>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header_menu',
                        'container' => false,
                        'menu_class' => 'main-menu-desc',
                        'walker' => new Custom_Menu_Walker()
                    ]);
                    ?>
                </section>
                <section class="zdtAvIhlr27">
                    <?php $context = 'header';
                    include get_template_directory() . '/template-parts/lang-switcher.php'; ?>
                    <section class="YLhDOEawQoxqDW" id="burg"></section>
                </section>
            </nav>
<!--             <nav class="main-menu-mob">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header_menu',
                    'container' => false,
                    'menu_class' => 'main-menu-mob',
                    'walker' => new Custom_Menu_Walker()
                ]);
                ?>
            </nav> -->

<nav class="main-menu-mob">
  <?php
  wp_nav_menu([
    'theme_location' => 'header_menu',   // твоя область меню
    'container'      => false,
    'menu_class'     => 'main-menu-mob', // класс UL как в верстке
    'walker'         => new Mobile_Header_Walker(),
    'depth'          => 2,               // верхний уровень + подменю
  ]);
  ?>
</nav>


			
		<!--     <nav class="main-menu-mob">
		  <ul id="menu-header-menu-1" class="main-menu-mob">
		    <li class=""><a href="https://temp301.gamehubio.com/casino-rating/">Casino Rating</a></li>
		
		    <li class="has-submenu">
		      <a href="https://temp301.gamehubio.com/all-slots/">All slots</a>
		      <img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg" class="submenu-arrow more">
		      <ul>
		        <li><a href="https://temp301.gamehubio.com/all-slots/pirates-wild-spin/">Pirate’s Wild Spin</a></li>
		      </ul>
		    </li>
		
		    <li class="has-submenu">
		      <a href="https://temp301.gamehubio.com/all-casinos/">All casinos</a>
		      <img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg" class="submenu-arrow more">
		      <ul>
		        <li><a href="https://temp301.gamehubio.com/all-casinos/toto-casino-6/">Toto casino</a></li>
		      </ul>
		    </li>
		
		    <li class="has-submenu">
		      <a href="https://temp301.gamehubio.com/all_bonuses/">All Bonuses</a>
		      <img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg" class="submenu-arrow more">
		      <ul>
		        <li><a href="https://temp301.gamehubio.com/all_bonuses/bonus-reviews-10/">Vulkan Fire – Join Now for C$925 + Free Spins Daily</a></li>
		      </ul>
		    </li>
		
		    <li class=""><a href="https://temp301.gamehubio.com/author/">Author</a></li>
		    <li class=""><a href="https://temp301.gamehubio.com/payouts/">Payouts</a></li>
		
		    <li class="has-submenu">
		      <a href="https://temp301.gamehubio.com/category/blog/">Blog</a>
		      <img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg" class="submenu-arrow more">
		      <ul>
		        <li><a href="https://temp301.gamehubio.com/blog-post-20/">Blog post</a></li>
		      </ul>
		    </li>
		  </ul>
		</nav> -->

        </header>
