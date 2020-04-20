<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

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
