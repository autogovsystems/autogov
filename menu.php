<ul class="menu">
  <li><a href="<?php echo get_site_url(); ?>" class="<?php echo is_front_page()?'active':''; ?>"><?php _e('Home','autogov'); ?></a></li>

  <?php if (politics_enabled()==1){ ?>
  <li><a href="<?php echo get_site_url(); ?>/politics" class="<?php echo is_current_page_virtual('pagepoliticsagv') || get_post_type() == 'question' || get_post_type() == 'resolution' || is_current_page_virtual('createvontest') || get_post_type() == 'answer'?'active color_politics':''; ?>"><?php _e('Politics','autogov'); ?></a></li>
  <?php } ?>
  <?php if(economy_enabled()==1){ ?>
	<li><a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="<?php echo is_shop() || is_woocommerce()?'active color_economy':''; ?>"><?php _e('Economy','autogov'); ?></a></li>
  <?php } ?>
  <?php if(social_enabled()==1){ ?>
	<li><a href="<?php echo  get_site_url().'/'.bp_get_activity_root_slug(); ?>" class="<?php echo is_current_page_virtual('pagesocialagv') || is_buddypress()?'active color_social':''; ?>"><?php _e('Social','autogov'); ?></a></li>
  <?php } ?>
  <!--<li><a href="">Search</a></li>-->
	<?php $current_user = wp_get_current_user();
	if ( $current_user->exists() ) { ?>
	    <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="<?php echo is_page(get_option('woocommerce_myaccount_page_id'))?'active':''; ?>"><?php _e('Me','autogov'); ?></a></li>
      <li><a class="" href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout','autogov'); ?>"><i class="fas fa-sign-out-alt"></i></a></li>
	    <!--<li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>-->
	<?php }else{ ?>
	   <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="<?php echo is_page(get_option('woocommerce_myaccount_page_id'))?'active':''; ?>"><?php _e('Me','autogov'); ?></a></li>

	<?php }
	?>
</ul>
<button class="hamburger hamburger--squeeze" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
