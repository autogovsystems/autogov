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
				<div class="col-12 tabcontent active">
			<?php if (have_posts()): ?>
				<ul class="slider">
				<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part('template-parts/default-box'); ?>
					<!-- /article -->
				<?php endwhile; ?>
			</ul>
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
