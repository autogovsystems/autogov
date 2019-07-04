<div class="container-fluid cardtab">
  <div class="row cardtitle">
        <div class="col-11">
          <h3><?php _e('DISCOVER','autogov'); ?></h3>
          <span><?php _e('Other stuff that might interest you','autogov'); ?></span>
        </div>
        <div class="col-1 text-right">
          <a data-toggle="collapse" href="#discovercollapse" class="ml-auto collapsed"><i class="fas fa-plus"></i></a>
          <script>
          jQuery(document).ready(function(){
            jQuery('#discovercollapse').on('shown.bs.collapse', function () {
              jQuery('#discovercollapse .tablinks.active').click();
            });
          });
          </script>
        </div>
  </div>
  <div id="discovercollapse" class="collapse">
    <!-- Tab links -->
    <div class="row tab">
        <button class="tablinks col-4 active" data-id="newest"><?php _e('+ NEW','autogov'); ?></button>
        <button class="tablinks col-4" data-id="votest"><?php _e('+ VOTED','autogov'); ?></button>
        <button class="tablinks col-4" data-id="important"><?php _e('+ IMPORTANT','autogov'); ?></button>
    </div>
    <!-- Tab content -->
    <div class="row">
      <div id="tab-newest" class="tabcontent market servicios col-12 active">
            <?php $params = array('posts_per_page' => -1, 'post_type' => array('product','question','forum'), 'orderby' => 'date', 'order' => 'DESC');
            $wc_query = new WP_Query($params);

            if ($wc_query->have_posts()){?>
              <ul class="slider">
                <?php
                $array_link = array();
                while ($wc_query->have_posts()){
                        $wc_query->the_post();
                        if(!in_array(get_the_permalink(),$array_link)){
                          if(get_post_type() == 'forum'){
                            get_template_part('template-parts/forum-box');
                          }else{
                            get_template_part('template-parts/default-box');
                          }
                          $array_link[] = get_the_permalink();
                        }
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
      <div id="tab-votest" class="tabcontent market productos col-12">

            <?php $params = array('posts_per_page' => -1, 'post_type' => 'answer',
            'orderby' => 'meta_value_num','meta_key'=> '_votes' /*NOTA: este es el campo donde se guarden los votos, a no ser que se haga la query en los usuarios */
            );
            $wc_query = new WP_Query($params);
            if ($wc_query->have_posts()) { ?>
              <ul class="slider">
                <?php while ($wc_query->have_posts()){
                        $wc_query->the_post();
                        get_template_part('template-parts/default-box');
                  }
                  wp_reset_postdata();
                ?>
              </ul>
            <?php }else{  ?>
              <p class="text-center mb-5 mt-5"><?php _e( 'No answers'); ?></p>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <div id="tab-important" class="tabcontent market eventos col-12">
            <?php $params = array('posts_per_page' => -1, 'post_type' => 'product', 'meta_key' => 'total_sales', 'orderby' => 'meta_value_num');
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
            <?php }else{  ?>
              <p class="text-center mb-5 mt-5"><?php _e( 'No events'); ?></p>
            <?php } ?>
      </div>
    </div>
  </div>
</div>
