<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404" class="container-fluid cardtab">
				<img src="<?php echo get_template_directory_uri()?>/img/404.jpg; " alt="<?php _e( 'Page not found', 'html5blank' ); ?>" class="image-not-found" />
				<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
				<h2>
					<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
				</h2>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
		<section class="hide_collapse">
			<?php get_template_part('/template-parts/aboutcommunity-card'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/aboutautogov-card'); ?>
		</section>
	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
