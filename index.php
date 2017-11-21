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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dobby the Storekeeper</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class();?> >
	<div id="page" class="site">
		<header class="site-header">
			<?php the_title('<h1>','</h1>');?>
		</header> <!-- .site-header -->
		<main class="site-main">
			<?php 
				if(have_posts()){
					while(have_posts()): the_post();
						the_content();
					endwhile;
				}else{
					_e('No content available', 'dobbyts');
				}
			?>
		</main> <!-- .site-main -->
		<footer class="site-footer">
			<p class="site-meta"><?php echo date('Y');?></p>
		</footer> <!-- .site-footer -->
	</div> <!-- #Page -->
	<?php wp_footer();?>
</body>
</html>