<?php
global $wp, $post;
$request = $wp->request;
$active = explode('/', $request );
$myshop_selected = '';
$active_menu = '';
$dashboard_active = '';
$is_dashboard = FALSE;
if ( $active[0] == 'dashboard' && isset($active[1]) ) {
  $active_menu = implode( '/', $active );
      if ( $active_menu == 'dashboard/new-product' ) {
          $active_menu = 'dashboard/products';
      }
      if ( get_query_var( 'edit' ) && is_singular( 'product' ) ) {
          $active_menu = 'dashboard/products';
      }
}elseif($active[0] == 'dashboard'){
	$active_menu = 'dashboard';
}elseif($post->ID == get_option('woocommerce_myaccount_page_id') && !isset($active[1])){
  $dashboard_active = 'is-active';
  $is_dashboard = TRUE;
}
if(in_array($active_menu,array('dashboard','dashboard/products','dashboard/orders','dashboard/settings/store','dashboard/settings/payment','dashboard/withdraw'))){
	$myshop_selected = 'is-active';
}
?>
<?php /* <div class="row tab" id="menu-myaccount">
			<a class="col <?php echo $dashboard_active; ?>" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('Dashboard','autogov'); ?></a>
			<a class="col <?php echo $active_menu!=='dashboard/orders'?wc_get_account_menu_item_classes( 'orders' ):'';  ?>" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/orders/"><?php _e('Orders','autogov'); ?></a>
			<a class="col <?php echo wc_get_account_menu_item_classes( 'edit-address' ); ?>" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/edit-address/"><?php _e('Addresses','autogov'); ?></a>
			<a class="col <?php echo wc_get_account_menu_item_classes( 'edit-account' ); ?>" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/edit-account/"><?php _e('My Account','autogov'); ?></a>
      <a class="col" href="<?php echo bp_loggedin_user_domain(); ?>profile/edit/" target="_blank"><?php _e('Social profile','autogov'); ?></a>
			<a class="col <?php echo $myshop_selected; ?>" href="/dashboard/"><?php _e('My shop','autogov'); ?></a>
			<a class="col" href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','autogov'); ?></a>
</div> */ ?>
<?php if(!$is_dashboard){ ?>
<div class="row tab" id="menu-myaccount">
  <div class="col-12">
    <a class="atras <?php echo $dashboard_active; ?>" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?> "><i class="fas fa-arrow-left"></i><?php _e(' Atrás','autogov'); ?></a>
  </div>
</div>
<?php
}
