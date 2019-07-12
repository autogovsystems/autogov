<div class="row">
  <div class="col col-md-3 mb-3">
    <?php $openvontests = new WP_Query( array( 'meta_key' => 'color', 'meta_value' => 'blue' ) );
    echo $openvontests->found_posts; ?>
    <?php 
      print_card_statistics(array('title'=>__('Open vontest'),'number'=>'')); ?>
  </div>
  <div class="col col-md-3 mb-3">
    FALTA
    <?php $usercount = count_users();
      print_card_statistics(array('title'=>__('Closed vontest'),'number'=>'')); ?>
  </div>
  <div class="col col-md-3 mb-3">
    FALTA
    <?php
      print_card_statistics(array('title'=>__('Answers published'),'number'=>do_shortcode('[mycred_total_points]'))); ?>
  </div>
  <div class="col col-md-3 mb-3">
    FALTA
    <?php
      print_card_statistics(array('title'=>__('Votes given'),'number'=>do_shortcode('[mycred_total_points]'))); ?>
  </div>
  <div class="col col-lg-6 mb-3">
    OK
    <?php
      print_card_statistics(array('title'=>__('Voins active'),'number'=>do_shortcode('[mycred_total_points]'))); ?>
  </div>
  <div class="col col-lg-6 mb-3">
    OK
    <?php
      print_card_statistics(array('title'=>__('Applauds given'),'number'=>do_shortcode('[mycred_total_points type="applauds"]'))); ?>
  </div>

  <div class="col col-lg-6 mb-3">
    FALTA
    <?php
      print_card_statistics(array('title'=>__('Purchases made'),'number'=>do_shortcode('[mycred_total_points]'))); ?>
  </div>
  <div class="col col-lg-6 mb-3">
    FALTA
    <?php
      print_card_statistics(array('title'=>__('Products available'),'number'=>do_shortcode('[mycred_total_points]'))); ?>
  </div>

  <div class="col col-lg-12 mb-3">
    OK
    <?php $usercount = count_users();
      print_card_statistics(array('title'=>__('Users','autogov'),'number'=>$usercount['total_users'])); ?>
  </div>
</div>
