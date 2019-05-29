<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
//do_action( 'woocommerce_account_navigation' );
global $wp,$post;
$request = $wp->request;
$active = explode('/', $request );
$dashboard_class = 'my-3';
if($post->ID == get_option('woocommerce_myaccount_page_id') && !isset($active[1])){
  $dashboard_class = 'px-0';
}?>
<?php get_template_part('/template-parts/menu-myaccount'); ?>

<div class="row">
	<div class="col-12 <?php echo $dashboard_class; ?>">
		<?php
			/**
			 * My Account content.
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
		?>
	</div>
</div>
