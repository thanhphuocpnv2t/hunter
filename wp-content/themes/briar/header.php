<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="page-content">
 *
 * @package Briar
 * @since 1.0
 */
global $wp;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php $dir_temp = get_template_directory_uri(); ?>
	<!--styles-->
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/normalize.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/animate.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/slick.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/slick-theme.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/colorbox.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/common/css/hamburger_menu.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $dir_temp; ?>/css/style.css" type="text/css">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="container" class="container">
		<header class="header head_gallery">
			<div class="inner_sm">
				<a href="<?php echo home_url( '/' ); ?>" class="logo">logo</a>
				<nav class="nav_menu">
					<ul>
						<?php if(is_home()){ ?>
							<li class="active"><a href="#main">home</a></li>
							<li><a href="#about_us">about</a></li>
						<?php }else{ ?>
							<li class="<?php echo (get_page_uri() == '/')?'active':''; ?>"><a href="/">home</a></li>
							<li class="<?php echo (get_page_uri() == 'about')?'active':''; ?>"><a href="<?php echo home_url( '/about' ); ?>">about</a></li>
						<?php } ?>
						<li class="drop_down"><span class="drop">gallery</span>
							<ul class="drop_down_lst">
								<li class="<?php echo (get_page_uri() == 'exteriors')?'active':''; ?>"><a href="<?php echo home_url( '/exteriors' ); ?>">Exteriors</a></li>
								<li class="<?php echo (get_page_uri() == 'interiors')?'active':''; ?>"><a href="<?php echo home_url( '/interiors' ); ?>">Interiors</a></li>
								<li class="<?php echo (get_page_uri() == 'animations')?'active':''; ?>"><a href="<?php echo home_url( '/animations' ); ?>">Animations</a></li>
							</ul>
						</li>
						<?php if(is_home()){ ?>
							<li><a href="#contact">contact</a></li>
						<?php }else{ ?>
							<li class="<?php echo (get_page_uri() == 'contact')?'active':''; ?>"><a href="<?php echo home_url( '/contact' ); ?>">contact</a></li>
						<?php } ?>
					</ul>
					<div class="search_form">
						<form action="<?php echo home_url( '/exteriors' ); ?>" method="get">
							<input type="text" name="key" class="search_btn"><span class="search_ar"></span>
						</form>
					</div>
				</nav>
				<div class="hamburger hamburger--vortex js-hamburger">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</header>
		
	
