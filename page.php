<?php
global $wp;
$request = explode( '/', $wp->request );
$is_dokan_dashboard = FALSE;
if ( $request[0] == 'dashboard' ){
	$is_dokan_dashboard = TRUE;
}
get_header();
?>
<?php if(!is_buddypress()){ ?>
	<main role="main">
		<div id="container" class="container-fluid<?php  if(!bp_current_component() ){?> cardtab<?php } ?>">
			<div class="row">
				<div class="col-12 <?php if($is_dokan_dashboard){ echo 'px-0'; } ?>">
		<!-- section -->
		<section>

			<h1><?php //the_title(); ?></h1>
<?php } ?>
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

<?php //get_sidebar();
 if(!is_buddypress()){
				?>
			</section>
				<!-- /section -->
			</div>
		</div>
	</div>
</main>

<?php }
get_footer(); ?>
