<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <header class="site-header">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dopbby-the-storekeeper
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8">
	<title>Dobby the Storekeeper</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class();?> >
	<div id="page" class="site">
		<!-- HERO -->
		<?php if(is_front_page() ) { ?>
			<?php get_template_part('template-parts/partial-hero','full'); ?>
		<?php } else{ ?>
			<?php get_template_part('template-parts/partial-hero','page'); ?>
		<?php } ?>
		<!-- !HERO -->

		<!-- SITE-HEADER -->
		<header class="site-header">
			<?php the_title('<h1>','</h1>');?>
			<small>Version 0.4.0</small>
		</header>
		<!-- !SITE-HEADER -->