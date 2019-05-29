<?php get_header(); ?>
	<main role="main">
		<section>
			<?php get_template_part('/template-parts/main-politics'); ?>
		</section>
		<!-- section -->
		<section>
			<div class="container-fluid cardtab">
				<header class="cardtitle">
			<h3><?php _e( 'Tags for', 'html5blank' ); ?> <?php single_tag_title(); ?> </h3>
		</header>
			<div class="row">
			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
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
