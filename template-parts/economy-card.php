<div id="pastilla-economy" class="container-fluid cardtab">

  <div class="row">
    <div class="col-12 cardtitle">
      <h3><?php _e('ECONOMY','autogov'); ?></h3>
      <span><?php _e('Create, Offer, Exchange','autogov'); ?></span>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col-4 active" data-id="servicios"><?php _e('Servicios','autogov'); ?></button>
      <button class="tablinks col-4" data-id="productos"><?php _e('Productos','autogov'); ?></button>
      <button class="tablinks col-4" data-id="eventos"><?php _e('Eventos','autogov'); ?></button>
  </div>
  <!-- Tab content -->
  <div class="row">
  <div id="tab-servicios" class="tabcontent market servicios col-12 active">
    <!-- Tab filter -->
    <div class="row">
      <div class="col-12 cardfilter text-right mt-2">
        <a href="#" data-toggle="collapse" data-target="#filter-services"><i class="fas fa-bars"></i></a>
      </div>
      <div id="filter-services" class="collapse col-12" aria-labelledby="filter-services">
        <div class="row">
          <div class="col-8">
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
          <div class="col-4 text-right">
            <a href="<?php echo dokan_get_navigation_url( 'new-product' ); ?>" class="button"><?php _e('Create article','autogov') ?></a>
          </div>
        </div>
      </div>
    </div>
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'product', 'meta_key' => 'tipo', 'meta_value' => 'servicio');
        $wc_query = new WP_Query($params);

        if ($wc_query->have_posts()){?>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bysellings' => get_post_meta($post->ID,'total_sales',true),'byreviewcount' => get_post_meta($post->ID,'_wc_review_count',true),'byreviewbest' => get_post_meta($post->ID,'_wc_average_rating',true),'bycheap' => get_post_meta($post->ID,'_price',true),'byexpensive' => get_post_meta($post->ID,'_price',true));
                set_query_var('orders', $orders);
                get_template_part('template-parts/default-box');
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else { ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No services'); ?></p>
        <?php } ?>
    </div>
  </div>
  <div class="row">
  <div id="tab-productos" class="tabcontent market productos col-12">
    <!-- Tab filter -->
    <div class="row">
      <div class="col-12 cardfilter text-right mt-2">
        <a href="#" data-toggle="collapse" data-target="#filter-products"><i class="fas fa-bars"></i></a>
      </div>
      <div id="filter-products" class="collapse col-12" aria-labelledby="filter-products">
        <div class="row">
          <div class="col-8">
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
          <div class="col-4 text-right">
            <a href="<?php echo dokan_get_navigation_url( 'new-product' ); ?>" class="button"><?php _e('Create article','autogov') ?></a>
          </div>
        </div>
      </div>
    </div>
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'product', 'meta_key' => 'tipo', 'meta_value' => 'producto');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()) { ?>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                  $wc_query->the_post();
                  $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bysellings' => get_post_meta($post->ID,'total_sales',true),'byreviewcount' => get_post_meta($post->ID,'_wc_review_count',true),'byreviewbest' => get_post_meta($post->ID,'_wc_average_rating',true),'bycheap' => get_post_meta($post->ID,'_price',true),'byexpensive' => get_post_meta($post->ID,'_price',true));
                  set_query_var('orders', $orders);
                  get_template_part('template-parts/default-box');
            }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else{  ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No Products'); ?></p>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="row">
    <div id="tab-eventos" class="tabcontent market eventos col-12">
      <!-- Tab filter -->
      <div class="row">
        <div class="col-12 cardfilter text-right mt-2">
          <a href="#" data-toggle="collapse" data-target="#filter-events"><i class="fas fa-bars"></i></a>
        </div>
        <div id="filter-events" class="collapse col-12" aria-labelledby="filter-events">
          <div class="row">
            <div class="col-8">
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
            <div class="col-4 text-right">
              <a href="<?php echo dokan_get_navigation_url( 'new-product' ); ?>" class="button"><?php _e('Create article','autogov') ?></a>
            </div>
          </div>
        </div>
      </div>
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'product', 'meta_key' => 'tipo', 'meta_value' => 'evento');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()){?>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bysellings' => get_post_meta($post->ID,'total_sales',true),'byreviewcount' => get_post_meta($post->ID,'_wc_review_count',true),'byreviewbest' => get_post_meta($post->ID,'_wc_average_rating',true),'bycheap' => get_post_meta($post->ID,'_price',true),'byexpensive' => get_post_meta($post->ID,'_price',true));
                set_query_var('orders', $orders);
                get_template_part('template-parts/default-box');
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else{  ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No events'); ?></p>
        <?php } ?>
  </div>
</div>
</div>
