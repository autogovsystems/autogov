<?php get_header(); ?>

	<main role="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 page_title">
					<h3 class="color_economy"><?php _e('ECONOMICS','autogov'); ?></h3>
					<span><?php _e('Create, Offer, Exchange','autogov'); ?></span>
				</div>
			</div>
		</div>
		<section class="hide_collapse">
			<?php get_template_part('/template-parts/main-shop'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/economy-card'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/discover-card'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/aboutcommunity-card'); ?>
		</section>


<?php //get_sidebar(); ?>

<?php get_footer(); ?>
</main>
