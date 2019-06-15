<div id="pastilla-economy" class="container-fluid cardtab">

  <div class="row">
    <div class="col-12 cardtitle">
      <h3><?php _e('ECONOMY','autogov'); ?></h3>
      <span class="d-none"><?php _e('Create, Offer, Exchange','autogov'); ?></span>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col  active" data-id="articles"><?php _e('My Articles','autogov'); ?></button>
      <button class="tablinks col" data-id="voins"><?php _e('My Voins','autogov'); ?></button>
      <a class="col" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/orders/"><?php _e('My Orders','autogov'); ?></a>
      <a class="col" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>/edit-address/"><?php _e('My Addresses','autogov'); ?></a>
      <a class="col <?php echo $myshop_selected; ?>" href="/dashboard/"><i class="fas fa-shopping-bag"></i> <?php _e('My shop','autogov'); ?></a>
  </div>
  <!-- Tab content -->
  <div class="row">
    <div id="tab-articles" class="tabcontent market servicios col-12 active">
      <div class="row">
        <div class="col text-right my-3">
          <a href="<?php echo dokan_get_navigation_url( 'new-product' ); ?>" class="button"><?php _e('Create article','autogov') ?></a>
        </div>
      </div>
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'product', 'author' => get_current_user_id());
        $wc_query = new WP_Query($params);

        if ($wc_query->have_posts()){?>
          <!-- Tab filter -->
          <div class="row d-none">
            <div class="col-12 cardfilter text-right mt-2">
              <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-services">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
            </div>
            <div id="filter-services" class="collapse col-11" aria-labelledby="filter-services">
              <div class="row">
                <div class="col-12">
                  <ul class="orderby">
                    <li><a class="order-by" id="byrecent" href="#"><?php _e('Más recientes','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li> |
                    <li><a class="order-by" id="bysellings" href="#"><?php _e('Más vendidos','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byreviewcount" href="#"><?php _e('Más valoraciones','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byreviewbest" href="#"><?php _e('Mejor valoración media','autogov'); ?></a></li> |
                    <li><a class="order-by" id="bycheap" href="#"><?php _e('Más baratos','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byexpensive" href="#"><?php _e('Más caros','autogov'); ?></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bysellings' => get_post_meta($post->ID,'total_sales',true),'byreviewcount' => get_post_meta($post->ID,'_wc_review_count',true),'byreviewbest' => get_post_meta($post->ID,'_wc_average_rating',true),'bycheap' => get_post_meta($post->ID,'_price',true),'byexpensive' => get_post_meta($post->ID,'_price',true));
                set_query_var('orders', $orders);
              ?>  <li>
                    <div>
                    	<div class ="image">
                        <a href="<?php echo the_permalink();?>">
                          <?php $thumb = get_the_post_thumbnail($post->ID, array(200,200));
                            if($thumb){
                              echo $thumb;
                            }else{
                              echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image_product.png" />';
                            }
                          ?>
                        </a>
                		    </div>
                  		<div class="title">
                  			<a href="<?php echo dokan_edit_product_url( $post->ID ); ?>">
                  				<?php echo the_title();?>
                  			</a>
                  		</div>
                  	</div>
                  </li>
                <?php
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else { ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No articles'); ?></p>
        <?php } ?>
    </div>
  </div>
  <div class="row">
    <div id="tab-voins" class="tabcontent market productos col-12 my-3">
      <?php echo do_shortcode('[mycred_my_balance title="'.__('Current Voins:','autogov').'"]');
      echo do_shortcode('[mycred_history user_id="'.get_current_user_id().'"]'); ?>
    </div>
  </div>
</div>
