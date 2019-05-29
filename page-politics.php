<?php get_header(); ?>

	<main role="main">
		<div class="container-fluid">
			<div class="row">
		    <div class="col-12 page_title">
		      <h3 class="color_politics"><?php _e('POLITICS','autogov'); ?></h3>
		      <span><?php _e('Propose, Discuss, Decide','autogov'); ?></span>
		    </div>
		  </div>
		</div>
		<section class="hide_collapse">
			<?php get_template_part('/template-parts/main-politics'); ?>
		</section>

		<section>
			<?php get_template_part('/template-parts/politics-card'); ?>
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
