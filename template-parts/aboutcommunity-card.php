<div id="pastilla-aboutautogov" class="container-fluid cardtab">

  <div class="row cardtitle">
    <div class="col-11">
      <h3><?php _e('ABOUT THIS COMMUNITY','autogov'); ?></h3>
      <span><?php _e('Who we are and how come','autogov'); ?></span>
    </div>
    <div class="col-1 text-right">
      <a data-toggle="collapse" href="#aboutcommunitycollapse" class="ml-auto collapsed"><i class="fas fa-plus"></i></a>
      <script>
      jQuery(document).ready(function(){
        jQuery('#aboutcommunitycollapse').on('shown.bs.collapse', function () {
          jQuery('#aboutcommunitycollapse .tablinks.active').click();
        });
      });
      </script>
    </div>
  </div>
  <div class="row tab" style="border-bottom:0;"></div>
  <div id="aboutcommunitycollapse" class="collapse">
  <!-- Tab links -->
    <?php /* $terms = get_terms( array(
        'taxonomy' => 'aboutcommunity',
        'hide_empty' => true,
        'parent' => 0
    ) );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
      $terms_to_consult = array();
      ?>
      <div class="row tab">
        <?php
          $first = 'active';
          foreach ( $terms as $term ) {
          $terms_to_consult[] = $term;
          ?>
          <button class="tablinks col-4 <?php echo $first; ?>" data-id="<?php echo $term->slug ?>"><?php echo $term->name ?></button>
        <?php
          $first = '';
        } ?>
      </div>
      <!-- Tab content -->
      <?php $first = 'active';
      foreach($terms_to_consult as $term){ ?>
      <div class="row">
        <div id="tab-<?php echo $term->slug; ?>" class="tabcontent col-12 <?php echo $first; ?>">
            <?php $params = array(
              'posts_per_page' => -1,
              'post_type' => 'aboutcommunity',
              'tax_query' => array(
            		array(
            			'taxonomy' => 'aboutcommunity',
            			'field'    => 'slug',
            			'terms'    => $term->slug,
            		),
            	));
            $wc_query = new WP_Query($params);
            if ($wc_query->have_posts()){?>
              <ul class="slider">
                <?php while ($wc_query->have_posts()){
                        $wc_query->the_post();
                        get_template_part('template-parts/default-box');
                  }
                  wp_reset_postdata();
                ?>
              </ul>
            <?php }else { ?>
              <p class="text-center mb-5 mt-5"><?php _e( 'No info'); ?></p>
            <?php } ?>
        </div>
      </div>
    <?php $first = '';
    } ?>

    <?php }else{ ?>
      <div class="row tab" style="border-bottom:0;"></div>
      <p class="text-center mb-5 mt-5"><?php _e( 'No info about this community. Please create categories for community'); ?></p>
    <?php }*/ ?>
    <div class="row">
      <div id="tab-aboutcommunity" class="tabcontent col-12 active">
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'aboutcommunity');
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
          <p class="text-center mb-5 mt-5"><?php _e( 'No info about this community'); ?></p>
        <?php } ?>
      </div>
  </div>
</div>
