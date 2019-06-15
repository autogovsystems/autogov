<?php get_header(); ?>
<section>
	<?php get_template_part('/template-parts/main-politics'); ?>
</section>
<div class="container-fluid cardtab">
	<main role="main">

		<!-- section -->
		<section>
			<?php $taxonomy = get_queried_object(); ?>
			<header class="cardtitle">
				<div class="row">
					<div class="col-10">
						<h3><?php _e( 'Vontests for', 'autogov' ); ?> <?php echo $taxonomy->name; ?></h3>
					</div>
					<div class="col-2 text-right">
						<?php
						$user_id = get_current_user_id();
							if($user_id){
								$queried_object = get_queried_object();
								$term_id = $queried_object->term_id;
								$ftopics = get_user_meta($user_id,'following_topics',true);
								if(!empty($ftopics) && in_array($term_id,$ftopics)){
									$style_follow = '';
									$style_unfollow = 'style="display:none"';
								}else{
									$style_follow = 'style="display:none"';
									$style_unfollow = '';

								} ?>
								<a href="#" id="follow_topic" data-term_id="<?php echo $term_id; ?>" <?php echo $style_follow; ?>><i class="fas fa-bell-slash"></i> <?php _e('Unfollow this topic','autogov'); ?></a>
								<a href="#" id="unfollow_topic" data-term_id="<?php echo $term_id; ?>" <?php echo $style_unfollow; ?>><i class="fas fa-bell"></i> <?php _e('Follow this topic','autogov'); ?></a>
							<?php
						} ?>
					</div>
				</div>
			</header>
			<div class="row">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class('col-3'); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="topic-img">
							<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h3>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3>
					<!-- /post title -->

					<!-- post details -->
					<span class="author"><i class="fas fa-user"></i><?php _e( 'Published by', 'autogov' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="date"><i class="fas fa-calendar-alt"></i><?php the_time('F j, Y'); ?></span>
					<span class="comments"><i class="fas fa-comments"></i><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'autogov' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'autogov' )); ?></span>
					<!-- /post details -->

					<?php //html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>

					<?php //edit_post_link(); ?>
					<a class="button grey" href="<?php the_permalink(); ?>"><?php _e( 'view more', 'autogov' ); ?></a>

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
		</div>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->

	</main>
</div>
<section>
	<?php get_template_part('/template-parts/discover-card'); ?>
</section>
<section>
	<?php get_template_part('/template-parts/aboutcommunity-card'); ?>
</section>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>
