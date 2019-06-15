<?php get_header(); ?>

	<main role="main">


	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<div id="container" class="container-fluid">
			<div class="row">
				<div class="col-8">
					<!-- post title -->
					<h1>
						<?php the_title(); ?>
					</h1>
				</div>
				<div class="col-4 text-right">
					<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
				</div>
			</div>
		</div>
		<!-- /post title -->
		<div id="container" class="container-fluid cardtab">
			<div class="row">
				<div class="col-12">

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail(); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post details -->

					<?php /* <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span> */ ?>
					<!-- /post details -->

			<div class="row p-3 m-3 mt-5 resolution">
				<div class="col-8">
					<a href="<?php echo home_url(); ?>">
					<?php $logo = get_option('logo_comunidad');
					if($logo){
						echo '<img src="'.$logo.'" alt="Logo" class="logo-img">';
					}else{
						echo '<img src="'.get_template_directory_uri().'/img/default-logo-community.png" alt="Logo" class="logo-img">';
					}
					 ?>
					</a>
				</div>
				<p class="col-4 text-right">
					<strong><?php the_title(); ?></strong><br/>
					<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
				</p>
				<div class="col-12"><hr/></div>
				<div class="col-12 py-5">
					<?php $vontest_parent = get_post_meta(get_the_ID(),'_question_parent',true); ?>
					<small><?php _e( 'Resolution for:', 'html5blank' ); ?> <?php echo get_the_title($vontest_parent); ?></small>
				<?php the_content(); // Dynamic Content ?>
				</div>
				<div class="col-12">
				<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
				</div>
			</div>

			<?php //the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
			<?php $vontest_parent = get_post_meta(get_the_ID(),'_question_parent',true);
			if($vontest_parent){ ?>
			<div class="row vontest_comments_bottom" style="padding-top:1em; padding-bottom: 1em; min-height: auto;">
				<div class="col-12">
					<h3><?php _e('Vontest parent','autogov'); ?></h3>

					<p><a href="<?php the_permalink($vontest_parent); ?>"><?php echo get_the_title($vontest_parent); ?></a>
						<?php //_e( 'Categorised in: ', 'html5blank' ); the_category(', '); // Separated by commas ?></p>

					<p><?php //_e( 'This post was written by ', 'html5blank' ); the_author(); ?></p>
				</div>
			</div>

			<?php }
			//comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>
	</section>
	<!-- /section -->
			</div>
		</div>
	</div>
	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>


</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
