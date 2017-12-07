<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
