<!doctype html>
<?php
  $lang = get_bloginfo('language');
  
  // Get header button fields
  $header_login_link = get_field('header-login-link', 'option');
  $header_login_text = get_field('header-login-text', 'option');
  $header_reg_link = get_field('header-reg-link', 'option');
  $header_reg_text = get_field('header-reg-text', 'option');
?>
<html lang="<?php echo $lang; ?>">
<head itemscope="" itemtype="http://schema.org/WPHeader">
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Vela+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/inter.css">
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/montserrat.css">
  <?php wp_head(); ?>
<meta name="google-site-verification" content="ZjNL2acmVL6Dxs5ibyfb6r_z3domNzmg3K1ft5hyW5E" />
	<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "omk8z3nw8w");
</script>
</head>
<?php 
 $cbg = get_field('bg-color');
 $c1 = get_field('global_color-1');
 $c2 = get_field('global_color-2');
 $c3 = get_field('global_s_color-1');
 $c5 = get_field('global_s_color-3');
 $c6 = get_field('global_s_color-4');
 $c7 = get_field('global_s_color-5');
 $c8 = get_field('grad-1-1');
 $c9 = get_field('grad-1-2');
 $c10 = get_field('grad-2-1');
 $c11 = get_field('grad-2-2');
?>

<body id="top" <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<?php 
	  $header_reg_link = get_field('header-reg-link', 'option');
	  $header_reg_text = get_field('header-reg-text', 'option');
	  $header_login_link = get_field('header-login-link', 'option');
	  $header_login_text = get_field('header-login-text', 'option');
	?>
<header>
  <div class="container top-header">
    <div class="row between align-center">
    <div class="header-logo header__col-1">
      <?php 
       $dark_logo = get_field('black_logo');
       
       if($dark_logo) {
        // Темный режим - используем светлый логотип
        ?>
        <a href="/" class="custom-logo-link" rel="home" aria-current="page">
          <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/new-logo-light.png" class="custom-logo" alt="Bet on game" decoding="async">
        </a>
       <?php } else {
        // Светлый режим - используем темный логотип
        ?>
        <a href="/" class="custom-logo-link" rel="home" aria-current="page">
          <img alt="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/new-logo-dark.png" class="custom-logo" alt="Bet on game" decoding="async">
        </a>
       <?php }
      ?>
      
      <div class="header-flag row align-center ds-hide"> 
       <span>RU</span> <img alt="flag" src="<?php echo get_template_directory_uri();?>/assets/img/flag.svg">
      </div>
    </div>
    <div class="header__col-2 row between">
      <div class="header-btn-group row">
        <a href="<?php if($header_login_link){echo $header_login_link;}?>" class="btn btn__violet"><?php if($header_login_text){echo $header_login_text;}?></a>
        <a href="<?php if($header_reg_link){echo $header_reg_link;}?>" class="btn btn__blue"><?php if($header_reg_text){echo $header_reg_text;}?></a>
        <div class="btn-mob-menu row align-center ds-hide">
        <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M23 9.7107H1C0.448 9.7107 0 9.2627 0 8.7107C0 8.1587 0.448 7.7107 1 7.7107H23C23.552 7.7107 24 8.1587 24 8.7107C24 9.2627 23.552 9.7107 23 9.7107ZM23 2.04395H1C0.448 2.04395 0 1.59595 0 1.04395C0 0.491945 0.448 0.0439453 1 0.0439453H23C23.552 0.0439453 24 0.491945 24 1.04395C24 1.59595 23.552 2.04395 23 2.04395ZM23 17.3772H1C0.448 17.3772 0 16.9292 0 16.3772C0 15.8252 0.448 15.3772 1 15.3772H23C23.552 15.3772 24 15.8252 24 16.3772C24 16.9292 23.552 17.3772 23 17.3772Z" fill="#0B1328"/>
        </svg>
      </div>
      <div class="btn-mob-menu-close row align-center ds-hide">
        <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.80368 21.4563C4.64473 21.4563 4.48935 21.4092 4.35718 21.3209C4.22502 21.2326 4.122 21.1071 4.06117 20.9603C4.00034 20.8134 3.98443 20.6519 4.01545 20.496C4.04646 20.3401 4.12302 20.1969 4.23542 20.0845L19.0846 5.23538C19.2353 5.08467 19.4397 5 19.6528 5C19.866 5 20.0704 5.08467 20.2211 5.23538C20.3718 5.38609 20.4565 5.59049 20.4565 5.80363C20.4565 6.01677 20.3718 6.22117 20.2211 6.37188L5.37193 21.221C5.29737 21.2957 5.20879 21.355 5.11127 21.3954C5.01376 21.4357 4.90922 21.4564 4.80368 21.4563Z" fill="white"/>
        <path d="M19.6528 21.4563C19.5472 21.4564 19.4427 21.4357 19.3452 21.3954C19.2477 21.355 19.1591 21.2957 19.0845 21.221L4.23538 6.37188C4.08467 6.22117 4 6.01677 4 5.80363C4 5.59049 4.08467 5.38609 4.23538 5.23538C4.38609 5.08467 4.59049 5 4.80363 5C5.01677 5 5.22117 5.08467 5.37188 5.23538L20.221 20.0845C20.3334 20.1969 20.41 20.3401 20.441 20.496C20.472 20.6519 20.4561 20.8134 20.3953 20.9603C20.3344 21.1071 20.2314 21.2326 20.0993 21.3209C19.9671 21.4092 19.8117 21.4563 19.6528 21.4563Z" fill="white"/>
        </svg>
      </div>
      </div>
      <div class="header-flag row align-center mobile-hide"> 
       <span>RU</span> <img alt="flag" src="<?php echo get_template_directory_uri();?>/assets/img/flag.svg">
      </div>
    </div> 
   </div>
  </div>
  <div class="container bottom-header" id="bottom-header">
    <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-1',
          'container' => 'nav',
          'container_id' => '',
          'container_class' => '',
          'menu_class' => 'header-main-nav row between',
          'depth' => 2,
        ));
    ?>
  </div>
</header>
