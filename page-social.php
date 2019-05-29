<?php get_header(); ?>

	<main role="main">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 page_title">
					<h3 class="color_social"><?php _e('SOCIAL','autogov'); ?></h3>
					<span><?php _e('Communicate, Partner, Play','autogov'); ?></span>
				</div>
			</div>
		</div>
		<section>
			<?php get_template_part('/template-parts/main-social'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/social-card'); ?>
		</section>

    <section>
      <?php get_template_part('/template-parts/discover-card'); ?>
    </section>

    <section>
      <?php get_template_part('/template-parts/aboutcommunity-card'); ?>
    </section>

	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
