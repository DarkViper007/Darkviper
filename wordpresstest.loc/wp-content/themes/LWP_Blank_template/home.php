<?php 

/**
 * Template Name: Homepage template test
 */
?>
<?php get_header(); 

// global $lwp;


?>
<section>

			<h1><?php _e( 'Latest Posts', THEME_OPT );
// 			echo'<pre>';
// var_dump($lwp['opt-slides']);
// echo'</pre>';
			 ?></h1>
	
			<?php get_template_part('loop'); ?>

		</section>

<?php get_footer(); ?>
