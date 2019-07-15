<div class="row">
  <div class="col-12 col-md-3 mb-4">
    <?php $openvontests = new WP_Query( array(
        'post_type' => 'question',
        'meta_key' => '_date_votography',
        'posts_per_page' => '-1',
        'meta_query' => array(
            array(
                'key' => '_date_votography',
                'value' => date("Y-m-d"),
                'compare' => '>',
                'type' => 'DATE'
                )
            )
          ) );
      print_card_statistics(array('title'=>__('Open vontest'),'number'=>$openvontests->found_posts,'icon'=>'person-booth')); ?>
  </div>
  <div class="col-12 col-md-3 mb-4">
    <?php
    $closedvontests = new WP_Query( array(
        'post_type' => 'question',
        'meta_key' => '_date_votography',
        'posts_per_page' => '-1',
        'meta_query' => array(
            array(
                'key' => '_date_votography',
                'value' => date("Y-m-d"),
                'compare' => '<=',
                'type' => 'DATE'
                )
            )
          ) );
      print_card_statistics(array('title'=>__('Closed vontest'),'number'=>$closedvontests->found_posts,'icon'=>'thumbs-up')); ?>
  </div>
  <div class="col-12 col-md-3 mb-4">
    <?php
      $answerspublish = new WP_Query( array(
        'post_type' => 'answer',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
      ) );
      print_card_statistics(array('title'=>__('Answers published'),'number'=>$answerspublish->found_posts,'icon'=>'comment-dots')); ?>
  </div>
  <div class="col-12 col-md-3 mb-4">
    <?php
      global $wpdb;
      $totalvotes = $wpdb->get_var($wpdb->prepare("SELECT SUM(meta_value) AS votes FROM ".$wpdb->prefix."usermeta WHERE meta_key LIKE 'answer_%'",ARRAY_A));
      print_card_statistics(array('title'=>__('Votes given'),'number'=>$totalvotes,'icon'=>'vote-yea')); ?>
  </div>
  <div class="col-12 col-md-6 mb-4">
    <?php
      print_card_statistics(array('title'=>__('Voins active'),'number'=>do_shortcode('[mycred_total_points]'),'icon'=>'money-bill-wave')); ?>
  </div>
  <div class="col-12 col-md-6 mb-4">
    <?php
      print_card_statistics(array('title'=>__('Applauds given'),'number'=>do_shortcode('[mycred_total_points type="applauds"]'),'icon'=>'sign-language')); ?>
  </div>

  <div class="col-12 col-md-6 mb-4">
    <?php
      $orderscompleted = wc_orders_count('completed');
      print_card_statistics(array('title'=>__('Purchases made'),'number'=>$orderscompleted,'icon'=>'comments-dollar')); ?>
  </div>
  <div class="col-12 col-md-6 mb-4">
    <?php
      $productspublish = new WP_Query( array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => '-1'
      ) );
      print_card_statistics(array('title'=>__('Products available'),'number'=>$productspublish->found_posts,'icon'=>'boxes')); ?>
  </div>

  <div class="col-12 col-md-12 mb-4">
    <?php $usercount = count_users();
      print_card_statistics(array('title'=>__('Users','autogov'),'number'=>$usercount['total_users'],'icon'=>'user')); ?>
  </div>
</div>
