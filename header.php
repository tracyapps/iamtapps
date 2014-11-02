<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package iamtapps
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<svg id="bgtexture" xmlns='http://www.w3.org/2000/svg' width='8' height='8'>
	<rect width='8' height='8' fill='rgba(0,0,0,0.6)'/>
	<path d='M0 0L8 8ZM8 0L0 8Z' stroke-width='1' stroke='rgba(0,0,0,0.15)'/>
</svg>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'iamtapps' ); ?></a>

	<header id="masthead" class="site-header grid wider" role="banner">
		<div class="site-branding unit whole textcenter">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'iamtapps' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
