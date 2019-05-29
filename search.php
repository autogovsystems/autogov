<?php get_header(); ?>

		<main role="main">
			<!-- section -->
			<section>
				<div class="container-fluid cardtab">
					<div class="row tab" id="menu-myaccount">
					  <a class="col atras <?php echo $dashboard_active; ?>" href="#" onclick="window.history.go(-1); return false;"><i class="fas fa-arrow-left"></i><?php _e(' Atrás','autogov'); ?></a>
					</div>
					<div class="row">
						<div class="card-body">
						<div class="cardtitle">
							<h3><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); ?></h3><span><?php echo get_search_query(); ?></span>
						</div>
						<div class="row search-list">
						<?php get_template_part('loop-search'); ?>
						<?php get_template_part('pagination'); ?>
					</div>
				</div>
			</div>
			</div>
			</section>
			<!-- /section -->
			<section>
				<?php get_template_part('/template-parts/discover-card'); ?>
			</section>

			<section>
				<?php get_template_part('/template-parts/aboutcommunity-card'); ?>
			</section>
		</main>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>
