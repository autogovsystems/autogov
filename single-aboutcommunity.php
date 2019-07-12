<?php get_header(); ?>

	<main role="main">
		<div id="container" class="container-fluid cardtab">
			<div class="row">
				<div class="col-12">
	<!-- section -->
			<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post title -->
			<h1 class="my-5">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /post title -->

			<?php the_content(); // Dynamic Content ?>
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
			</div>
		</div>
	</div>
</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
