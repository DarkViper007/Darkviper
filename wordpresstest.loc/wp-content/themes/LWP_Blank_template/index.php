<?php get_header(); ?>

	<main role="main">
		<span class="icon-left-red"></span>
		<!-- section -->
		<section>

			<h1><?php _e( 'Latest Posts', THEME_OPT ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
