<?php /* Template Name: Social Template */

	get_header(); ?>

	<main role="main">

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

<?php get_footer(); ?>
