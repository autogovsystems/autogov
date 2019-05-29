<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<div class="col-3">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="search-thumb">
				<?php the_post_thumbnail('woocommerce_thumbnail');?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
		<h3>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">[<?php echo get_post_type(); ?>] <?php the_title(); ?></a>
		</h3>
		<!-- /post title -->

		<!-- post details -->
		<span class="author"><i class="fas fa-user"></i><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="date"><i class="fas fa-calendar-alt"></i><?php the_time('F j, Y'); ?></span>
		<span class="comments"><i class="fas fa-comments"></i><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>
		<!-- /post details -->

		<?php //html5wp_excerpt('html5wp_index');?>
		<a class="button grey" href="<?php the_permalink(); ?>"><?php _e( 'view more', 'html5blank' ); ?></a>
		<?php //edit_post_link(); ?>

	</article>
</div>
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
