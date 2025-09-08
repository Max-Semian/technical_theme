<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>
  <?php get_template_part('components/css/style'); ?>
</head>

<body <?php body_class(); ?>>
  <section class="bqsnL7AjVbpXR">
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
          include get_template_directory() . '/template-parts/lang-switcher-amp.php'; ?>
          <section class="YLhDOEawQoxqDW" role="button" tabindex="0" on="tap:sidebar.toggle" aria-label="Open menu"></section>
        </section>
      </nav>
      
<!-- <amp-sidebar id="sidebar"
               layout="nodisplay"
               side="right"
               class="main-menu-mob"
               aria-label="Мобильное меню">

    <?php
    wp_nav_menu([
      'theme_location' => 'header_menu',
      'container' => false,
      'menu_class' => 'YWjjk9c4',
      'walker' => new AMP_Menu_Walker()
    ]);
    ?>
  </amp-sidebar> -->
	<amp-sidebar id="sidebar" layout="nodisplay" side="right" class="main-menu-mob" aria-label="Мобильное меню" role="menu">
  <?php
  wp_nav_menu([
    'theme_location' => 'header_menu',
    'container'      => false,
    'menu_class'     => 'YWjjk9c4',
    'menu_id'        => 'menu-header-menu-1',
    'walker'         => new AMP_Mobile_Header_Walker(),
    'depth'          => 2,
  ]);
  ?>
</amp-sidebar>

		
		<!-- <amp-sidebar id="sidebar" layout="nodisplay" side="right" class="main-menu-mob i-amphtml-layout-nodisplay i-amphtml-element i-amphtml-overlay i-amphtml-scrollable i-amphtml-built i-amphtml-layout" aria-label="Мобильное меню" i-amphtml-layout="nodisplay" role="menu" tabindex="-1" open="" i-amphtml-sidebar-opened="">
		
		   <ul id="menu-header-menu-1" class="YWjjk9c4">
		  <li>
		    <a href="https://temp301.gamehubio.com/casino-rating/">Casino Rating</a>
		  </li>
		
		  <li class="has-submenu"
		      data-amp-bind-class="submenuOpen0 ? 'has-submenu open' : 'has-submenu'">
		    <a href="https://temp301.gamehubio.com/all-slots/">All slots</a>
		    <button class="submenu-arrow"
		            on="tap:AMP.setState({submenuOpen0: !submenuOpen0})">
		      <amp-img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg"
		               width="12"
		               height="12"
		               layout="fixed"
		               alt="arrow"></amp-img>
		    </button>
		    <ul class="submenu"
		        data-amp-bind-class="submenuOpen0 ? 'submenu is-open' : 'submenu'">
		      <li><a href="https://temp301.gamehubio.com/all-slots/pirates-wild-spin/">Pirate’s Wild Spin</a></li>
		    </ul>
		  </li>
		
		  <li class="has-submenu"
		      data-amp-bind-class="submenuOpen1 ? 'has-submenu open' : 'has-submenu'">
		    <a href="https://temp301.gamehubio.com/all-casinos/">All casinos</a>
		    <button class="submenu-arrow"
		            on="tap:AMP.setState({submenuOpen1: !submenuOpen1})">
		      <amp-img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg"
		               width="12"
		               height="12"
		               layout="fixed"
		               alt="arrow"></amp-img>
		    </button>
		    <ul class="submenu"
		        data-amp-bind-class="submenuOpen1 ? 'submenu is-open' : 'submenu'">
		      <li><a href="https://temp301.gamehubio.com/all-casinos/toto-casino-6/">Toto casino</a></li>
		    </ul>
		  </li>
		
		  <li class="has-submenu"
		      data-amp-bind-class="submenuOpen2 ? 'has-submenu open' : 'has-submenu'">
		    <a href="https://temp301.gamehubio.com/all_bonuses/">All Bonuses</a>
		    <button class="submenu-arrow"
		            on="tap:AMP.setState({submenuOpen2: !submenuOpen2})">
		      <amp-img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg"
		               width="12"
		               height="12"
		               layout="fixed"
		               alt="arrow"></amp-img>
		    </button>
		    <ul class="submenu"
		        data-amp-bind-class="submenuOpen2 ? 'submenu is-open' : 'submenu'">
		      <li><a href="https://temp301.gamehubio.com/all_bonuses/bonus-reviews-10/">Vulkan Fire – Join Now for C$925 + Free Spins Daily</a></li>
		    </ul>
		  </li>
		
		  <li>
		    <a href="https://temp301.gamehubio.com/author/">Author</a>
		  </li>
		  <li>
		    <a href="https://temp301.gamehubio.com/payouts/">Payouts</a>
		  </li>
		
		  <li class="has-submenu"
		      data-amp-bind-class="submenuOpen3 ? 'has-submenu open' : 'has-submenu'">
		    <a href="https://temp301.gamehubio.com/category/blog/">Blog</a>
		    <button class="submenu-arrow"
		            on="tap:AMP.setState({submenuOpen3: !submenuOpen3})">
		      <amp-img src="/wp-content/themes/Multitheme/assets/img/drop_arrow_white_icon.svg"
		               width="12"
		               height="12"
		               layout="fixed"
		               alt="arrow"></amp-img>
		    </button>
		    <ul class="submenu"
		        data-amp-bind-class="submenuOpen3 ? 'submenu is-open' : 'submenu'">
		      <li><a href="https://temp301.gamehubio.com/blog-post-20/">Blog post</a></li>
		    </ul>
		  </li>
		</ul>
		  </amp-sidebar>
		 -->
    </header>
