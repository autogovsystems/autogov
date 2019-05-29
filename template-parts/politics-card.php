<div id="pastilla-politics" class="container-fluid cardtab">
  <div class="row">
    <div class="col-12 cardtitle">
      <?php if(is_front_page()){ ?>
        <h3><?php _e('POLITICS','autogov'); ?></h3>
        <span><?php _e('Propose, Discuss, Decide','autogov'); ?></span>
      <?php }else{ ?>
        <h3><?php _e('VONTEST','autogov'); ?></h3>
        <span><?php _e('A Vontest = 1 Ques-on, Unlimited Answers, Evalua-on of the Answers, and a Voted Desicion','autogov'); ?></span>
      <?php } ?>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col-3 active" data-id="questions"><?php _e('Questions','autogov'); ?></button>
      <button class="tablinks col-3" data-id="answers"><?php _e('Answers','autogov'); ?></button>
      <button class="tablinks col-3" data-id="specials"><?php _e('Specials','autogov'); ?></button>
      <button class="tablinks col-3" data-id="resolutions"><?php _e('Resolutions','autogov'); ?></button>
  </div>
  <!-- Tab content -->
  <div class="row">
  <div id="tab-questions" class="tabcontent market servicios col-12 active">
    <div class="row">
      <div class="col-12 cardfilter text-right mt-2">
        <a href="#" data-toggle="collapse" data-target="#filter-questions"><i class="fas fa-bars"></i></a>
      </div>
      <div id="filter-questions" class="collapse col-12" aria-labelledby="filter-questions">
        <div class="row">
          <div class="col-8">
            <ul class="orderby">
              <li><a class="order-by" id="byrecent" href="#"><?php _e('Más recientes','autogov'); ?></a></li> |
              <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li> |
              <li><a class="order-by" id="bycomments" href="#"><?php _e('Más comentados','autogov'); ?></a></li> |
              <li><a class="order-by" id="byvotographydate" href="#"><?php _e('Próximos a finalizar','autogov'); ?></a></li> |
            </ul>
          </div>
          <div class="col-4 text-right">
            <a href="<?php echo get_site_url(); ?>/createvontest" class="button"><?php _e('Create vontest','autogov') ?></a>
          </div>
        </div>
      </div>
    </div>
        <?php
        $params = array('posts_per_page' => -1, 'post_type' => 'question',
          'meta_query' => array(
            array(
            'key' => '_date_votography',
            'value' => date('Y-m-d'),
            'type' => 'date',
            'compare' => '>='
            )
          )
        );
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()){?>
          <!-- Tab filter -->
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bycomments' => get_comments_number(),'byvotographydate' => get_post_meta($post->ID,'_date_votography',true));
                set_query_var('orders', $orders);
                get_template_part('template-parts/vontest-box');
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else { ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No questions'); ?></p>
        <?php } ?>
    </div>
  </div>
  <div class="row">
  <div id="tab-answers" class="tabcontent market productos col-12">

        <?php $params = array('posts_per_page' => -1, 'post_type' => 'answer');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()) { ?>
          <!-- Tab filter -->
          <div class="row">
            <div class="col-12 cardfilter text-right mt-2">
              <a href="#" data-toggle="collapse" data-target="#filter-answers"><i class="fas fa-bars"></i></a>
            </div>
            <div id="filter-answers" class="collapse col-12" aria-labelledby="filter-answers">
              <div class="row">
                <div class="col-12">
                  <ul class="orderby">
                    <li><a class="order-by" id="byrecent" href="#"><?php _e('Más recientes','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li> |
                    <li><a class="order-by" id="bycomments" href="#"><?php _e('Más comentados','autogov'); ?></a></li> |
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bycomments' => get_comments_number());
                set_query_var('orders', $orders);
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
    <div id="tab-specials" class="tabcontent market eventos col-12">
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'question', 'meta_key' => '_is_special', 'meta_value' => 'yes');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()){?>
          <div class="row">
            <div class="col-12 cardfilter text-right mt-2">
              <a href="#" data-toggle="collapse" data-target="#filter-specials"><i class="fas fa-bars"></i></a>
            </div>
            <div id="filter-specials" class="collapse col-12" aria-labelledby="filter-specials">
              <div class="row">
                <div class="col-12">
                  <ul class="orderby">
                    <li><a class="order-by" id="byrecent" href="#"><?php _e('Más recientes','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title());
                set_query_var('orders', $orders);
                get_template_part('template-parts/vontest-box');
              }
              wp_reset_postdata();
            ?>
          </ul>
        <?php }else{  ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No specials'); ?></p>
        <?php } ?>
  </div>
</div>
<div class="row">
  <div id="tab-resolutions" class="tabcontent market eventos col-12">
        <?php $params = array('posts_per_page' => 20, 'post_type' => 'resolution');
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()){?>
          <?php /*<div class="row">
            <div class="col-12 cardfilter text-right mt-2">
              <a href="#" data-toggle="collapse" data-target="#filter-resolutions"><i class="fas fa-bars"></i></a>
            </div>
            <div id="filter-resolutions" class="collapse col-12" aria-labelledby="filter-resolutions">
              <div class="row">
                <div class="col-12">
                  <ul class="orderby">
                    <li><a class="order-by" id="byrecent" href="#"><?php _e('Más recientes','autogov'); ?></a></li> |
                    <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>*/ ?>
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                //$orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title());
                //set_query_var('orders', $orders);
                get_template_part('template-parts/default-box');
              }
              wp_reset_postdata();
              $count_posts = wp_count_posts('resolution');
	            if($count_posts->publish>20){
              ?>
              <li>
                  <div>
                  	<div class ="image">
              			<a href="<?php ?>/resolution">
              				<?php
                          echo '<img src="'.get_stylesheet_directory_uri().'/img/default_image.png" />';
                      ?>
              			</a>
              		</div>
              		<div class="title">
              			<a href="<?php ?>/resolution">
              				<?php _e("Ver todos",'autogov');?>
              			</a>
              		</div>
              	</div>
              </li>
            <?php } ?>
          </ul>
        <?php }else{  ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No resolutions'); ?></p>
        <?php } ?>
  </div>
</div>
</div>
