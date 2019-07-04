<?php get_header(); ?>

	<main role="main">

		<?php if(politics_enabled()==1){?>
		<section>
			<?php get_template_part('/template-parts/politics-card'); ?>
		</section>
		<?php } ?>

		<?php if(economy_enabled()==1){ ?>
		<section>
			<?php get_template_part('/template-parts/economy-card'); ?>
		</section>
		<?php } ?>

		<?php if(social_enabled()==1){ ?>
		<section>
			<?php get_template_part('/template-parts/social-card'); ?>
		</section>
		<?php } ?>

		<section class="hide_collapse">
			<?php get_template_part('/template-parts/discover-card'); ?>
		</section>

		<section class="hide_collapse">
			<?php get_template_part('/template-parts/aboutcommunity-card'); ?>
		</section>

		<section>
			<?php //get_template_part('/template-parts/aboutautogov-card'); ?>
		</section>

	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
