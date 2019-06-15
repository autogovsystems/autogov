<div id="pastilla-social" class="container-fluid cardtab">

  <div class="row">
    <div class="col-12 cardtitle">
      <h3><?php _e('SOCIAL','autogov'); ?></h3>
      <span><?php _e('Communicate, Partner, Play','autogov'); ?></span>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col active" data-id="groups"><?php _e('My Groups','autogov'); ?></button>
      <button class="tablinks col" data-id="people"><?php _e('My People','autogov'); ?></button>
      <button class="tablinks col" data-id="searchsocial"><?php _e('My Game','autogov'); ?></button>
      <a class="col" href="<?php echo bp_loggedin_user_domain(); ?>profile/edit/" ><?php _e('Social profile','autogov'); ?></a>
  </div>

  <!-- Tab content -->

  <div class="row">
    <div id="tab-groups" class="tabcontent social groups col-12 active">
      <div class="row d-none">
        <div class="col-12 cardfilter text-right mt-2">
          <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-groups">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
        <div id="filter-groups" class="collapse col-11" aria-labelledby="filter-groups">
          <div class="row">
            <div class="col-8">
              <ul class="orderby">
                <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li> |
                <li><a class="order-by" id="bymembercount" href="#"><?php _e('Más miembros','autogov'); ?></a></li>
              </ul>
            </div>
            <div class="col-4 text-right">
              <a href="/groups/create/step/group-details/" class="button"><?php _e('Create new group','autogov') ?></a>
            </div>
          </div>
        </div>
      </div>
         <?php
         if(function_exists('bp_has_groups')){
    if ( bp_has_groups(array('user_id' => get_current_user_id()))){ ?>
      <ul class="slider">
      <?php while ( bp_groups()){
        bp_the_group();
        $orders=array('byname' => bp_get_group_name(),'bymembercount' => bp_get_group_total_members());
        set_query_var('orders', $orders);
        get_template_part('template-parts/group-box');
      }?>
      </ul>
    <?php }
    else{ ?>
      <div id="message" class="info">
          <p class="text-center mb-5 mt-5"><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
      </div>
    <?php }
   } ?>
    </div>
  </div>

  <div class="row">
    <div id="tab-people" class="tabcontent social people col-12">
       <?php
      if ( bp_has_members(array('user_id' => get_current_user_id()))){ ?>
        <!-- Tab filter -->
        <div class="row">
          <div class="col-12 cardfilter text-right mt-2">
            <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-people">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
          </div>
          <div id="filter-people" class="collapse col-11" aria-labelledby="filter-people">
            <div class="row">
              <div class="col-12">
                <ul class="orderby">
                  <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <ul class="slider">
        <?php while ( bp_members()){
          bp_the_member();
          $orders=array('byname' => bp_get_member_name());
          set_query_var('orders', $orders);
          get_template_part('template-parts/people-box');
        }?>
        </ul>
      <?php }
      else{ ?>
        <div id="message" class="info">
            <p class="text-center mb-5 mt-5"><?php _e( 'There were no friends found.', 'buddypress' ) ?></p>
        </div>
      <?php } ?>
    </div>
  </div>

  <div class="row">
    <div id="tab-searchsocial" class="tabcontent social game col-12 my-3">
      <?php
        echo do_shortcode('[mycred_my_balance type="applauds" title="'.__('Current Applauds:').'"]');
        echo do_shortcode('[mycred_history user_id="'.get_current_user_id().'" type="applauds"]'); ?>
    </div>
  </div>
</div>
