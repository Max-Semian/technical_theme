<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes" />
	<?php wp_head(); ?>
</head>

<body class="theme-body sm:!overflow-y-auto overflow-x-hidden font-notoSans">
	<?php get_template_part( 'theme-parts/header/header' ); ?>
