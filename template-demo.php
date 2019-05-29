<?php /* Template Name: Demo Page Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>



				<div class="container">
					<div class="row">
						<div class="col">
							<div class="text-center p-3"><i class="fas fa-exclamation-circle"></i> <?php _e( 'Sorry, nothing to display.', 'autogov' ); ?></div>
						</div>
					</div>
				</div>


		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
