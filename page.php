<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dobby-the-storekeeper
 */

?>

<?php get_header(); ?>

<main class="site-main">
	<?php 
		if(have_posts()){
			while(have_posts()): the_post();
				get_template_part('template-parts/content','page');
			endwhile;
		}else{
			get_template_part('template-parts/content','none');
		}
	?>
</main> <!-- .site-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
