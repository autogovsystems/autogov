<div id="pastilla-politics" class="container-fluid cardtab">
  <div class="row">
    <div class="col-12 cardtitle">
      <?php if(is_front_page()){ ?>
        <h3><?php _e('POLITICS','autogov'); ?></h3>
        <span><?php _e('Propose, Discuss, Decide','autogov'); ?></span>
      <?php }else{ ?>
        <h3><?php _e('POLITICS','autogov'); ?></h3>
        <span class="d-none"><?php _e('A Vontest = 1 Ques-on, Unlimited Answers, Evalua-on of the Answers, and a Voted Desicion','autogov'); ?></span>
      <?php } ?>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col-4 active" data-id="questions"><?php _e('My Questions','autogov'); ?></button>
      <button class="tablinks col-4" data-id="answers"><?php _e('My Answers','autogov'); ?></button>
      <button class="tablinks col-4" data-id="topics"><?php _e('My topics','autogov'); ?></button>
  </div>
  <!-- Tab content -->
  <div class="row">
  <div id="tab-questions" class="tabcontent market servicios col-12 active">
    <div class="row">
      <div class="col-12 text-right my-3">
        <a href="/createvontest" class="button"><?php _e('Create vontest','autogov') ?></a>
      </div>
    </div>
        <?php $params = array('posts_per_page' => -1, 'post_type' => 'question', 'author' => get_current_user_id());
        $wc_query = new WP_Query($params);

        if ($wc_query->have_posts()){?>
          <!-- Tab filter -->
          <ul class="slider">
            <?php while ($wc_query->have_posts()){
                $wc_query->the_post();
                $orders=array('byrecent' => get_post_time( 'U'),'byname' => get_the_title(),'bycomments' => get_comments_number(),'byvotographydate' => get_post_meta($post->ID,'_date_votography',true));
                set_query_var('orders', $orders);
                get_template_part('template-parts/my-questions-box');
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

        <?php $params = array('posts_per_page' => -1, 'post_type' => 'answer', 'author' => get_current_user_id());
        $wc_query = new WP_Query($params);
        if ($wc_query->have_posts()) { ?>
          <!-- Tab filter -->
          <div class="row d-none">
            <div class="col-12 cardfilter text-right mt-2">
              <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-answers">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
            </div>
            <div id="filter-answers" class="collapse col-11" aria-labelledby="filter-answers">
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
    <div id="tab-topics" class="tabcontent market categories col-12">
      <?php
        $taxonomy     = 'topics';
        $orderby      = 'name';
        $show_count   = 0;
        $pad_counts   = 0;
        $hierarchical = 1;
        $title        = '';
        $empty        = 0;
        $user_id = get_current_user_id();
        $my_topics = get_user_meta($user_id,'following_topics',true);
        $args = array(
               'taxonomy'     => $taxonomy,
               'orderby'      => $orderby,
               'show_count'   => $show_count,
               'pad_counts'   => $pad_counts,
               'hierarchical' => $hierarchical,
               'title_li'     => $title,
               'hide_empty'   => $empty,
               'term_taxonomy_id'   => $my_topics
        );

        $get_all_categories = get_categories( $args );
        ?>
        <?php
        if($get_all_categories && $my_topics){ ?>
          <ul class="slider">
        <?php foreach ($get_all_categories as $cat) {
          if($cat->category_parent == 0) {
              $thumbnail_id = get_term_meta( $cat->term_id, 'category-image-id', true ); ?>
              <li>
                  <div <?php if(is_tax('topics',$cat->term_id)){ ?> class="active" <?php } ?>>
                    <div class ="image">
                      <a href="<?php echo get_term_link($cat->slug, 'topics');?>">
                        <?php $thumb = wp_get_attachment_url( $thumbnail_id );
                        if(!$thumb){ $thumb = get_stylesheet_directory_uri().'/img/default_image_topics.png'; } ?>
                        <img src="<?php echo $thumb; ?>" alt="<?php echo $cat->name; ?>" />
                      </a>
                    </div>
                    <div class="title">
                      <a href="<?php echo get_term_link($cat->slug, 'topics');?>">
                        <?php echo $cat->name;?>
                      </a>
                    </div>
                  </div>
              </li>
          <?php }
        } ?>
      </ul>
    <?php }else{  ?>
      <p class="text-center mb-5 mt-5"><?php _e( 'No topics yet'); ?></p>
    <?php } ?>
      </div>
  </div>
</div>
