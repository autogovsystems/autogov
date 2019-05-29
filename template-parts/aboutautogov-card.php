<div id="pastilla-aboutautogov" class="container-fluid cardtab">

  <div class="row">
    <div class="col-12 cardtitle">
      <h3><?php _e('ABOUT AUTOGOV','autogov'); ?></h3>
      <span><?php _e('And other Meta stuff','autogov'); ?></span>
    </div>
  </div>
  <div class="row tab" style="border-bottom:0;"></div>
  <!-- Tab content -->
  <div class="row">
  <div id="tab-aboutautogov" class="tabcontent col-12 active">
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'aboutautogov');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()){ ?>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                    $wc_query->the_post();
                    get_template_part('template-parts/default-box');
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else { ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No info about autogov'); ?></p>
        <?php } ?>
    </div>
  </div>
</div>
