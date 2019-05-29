<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<?php
		$current_vontest_id = get_post_meta(get_the_ID(),'_question_parent',true);
		$current_vontest = get_post($current_vontest_id); ?>
		<!-- article -->
		<article id="pastilla-politics" <?php post_class('container-fluid cardtab'); ?>>
			<div class="row tab">
					<a class="col-4" href="<?php the_permalink($current_vontest_id); ?>"><?php _e('Question','autogov'); ?></a>
					<a class="col-4 active" href="<?php the_permalink($current_vontest_id); ?>#answers"><?php _e('Answers','autogov'); ?></a>
					<a class="col-4" href="<?php the_permalink($current_vontest_id); ?>#decisions"><?php _e('Decisions','autogov'); ?></a>
			</div>
			<div id="tab-question" class="tabcontent active">
				<div class="row">
					<div class="col-10 mx-auto pt-5 pb-5">
						<div><?php _e('Answer for the vontest','autogov'); ?></div>
						<h3><?php echo $current_vontest->post_title; ?></h3>
					</div>
				</div>
				<div class="row pt-5 row-answer">
					<div class="col-3 col-md-3">
						<div>
							<a href="<?php the_permalink($current_vontest_id); ?>" class="answer-thumb"><?php the_post_thumbnail(); ?></a>
						</div>
						<div class="row vontest_author mt-3">
							<div class="avatar col-4">
								<?php echo get_avatar(get_the_author_meta('ID')); ?>
							</div>
							<div class="author col-8 align-items-center">
								<span><?php _e( 'Posted by', 'autogov' ); ?></span>
								<div><?php echo bp_core_get_userlink( get_the_author_meta('ID') ); ?></div>
							</div>
							<div class="date col-12">
								<?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?>
							</div>
						</div>
						<a href="#" class="button grey my-4 d-none"><?php _e( 'vote this answer', 'html5blank' ); ?></a>
					</div>
					<div class="col-9 col-md-9">
						<h2><a href="<?php the_permalink($current_vontest_id); ?>"><?php the_title(); ?></a></h2>
						<div><?php the_content(); ?></div>
						<?php /*<div><strong><?php _e('Resolution case','autogov'); ?>:</strong> <?php echo get_post_meta(get_the_ID(),'_resolution_case',true); ?></div>*/ ?>
						<div class="buttonset my-4 align-middle text-right">
						<a href="<?php the_permalink($current_vontest_id); ?>#answers" class="mr-2"><?php _e('< Go back','autogov'); ?></a>
						<a href="#" class="button grey d-none"><?php _e( 'vote this answer', 'html5blank' ); ?></a>
					  </div>
					</div>
					<div id="comments" class="col-12 vontest_comments_bottom">
						<?php comments_template('/comments-answer.php'); ?>
					</div>

				</div>
			</div>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->

</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
