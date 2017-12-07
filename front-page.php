<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dobby-the-storekeeper
 */

?>

<?php get_header(); ?>

<main class="site-main">
	<?php 
		if(have_posts()){
			while(have_posts()): the_post();
				get_template_part('template-parts/content','frontpage');
			endwhile;
		}else{
			get_template_part('template-parts/content','none');
		}
	?>
</main> <!-- .site-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>