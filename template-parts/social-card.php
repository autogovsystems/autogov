<div id="pastilla-social" class="container-fluid cardtab">

  <div class="row">
    <div class="col-12 cardtitle">
      <?php if(is_front_page()){ ?>
        <h3><a href="<?php echo  get_site_url().'/'.bp_get_activity_root_slug(); ?>"><?php _e('SOCIAL','autogov'); ?></a></h3>
        <span><?php _e('Communicate, Partner, Play','autogov'); ?></span>
      <?php }else{ ?>
        <h3><?php _e('NAVIGATOR','autogov'); ?></h3>
      <?php } ?>
    </div>
  </div>
  <!-- Tab links -->
  <div class="row tab">
      <button class="tablinks col active" data-id="groups"><?php _e('Groups','autogov'); ?></button>
      <button class="tablinks col" data-id="people"><?php _e('People','autogov'); ?></button>
      <button class="tablinks col" data-id="searchsocial"><?php _e('The game','autogov'); ?></button>
      <?php if(!is_front_page()){ ?>
        <button class="tablinks col" data-id="search"><?php _e('Search','autogov'); ?></button>
      <?php } ?>
  </div>

  <!-- Tab content -->

  <div class="row">
    <div id="tab-groups" class="tabcontent social groups col-12 active">
      <div class="row">
        <div class="col-12 cardfilter text-right mt-2">
          <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-groups">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
        <div id="filter-groups" class="collapse col-12" aria-labelledby="filter-groups">
          <div class="row">
            <div class="col-8">
              <ul class="orderby">
                <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li> |
                <li><a class="order-by" id="bymembercount" href="#"><?php _e('Más miembros','autogov'); ?></a></li>
              </ul>
            </div>
            <div class="col-4 text-right">
              <?php if(is_user_logged_in()){ ?>
                <a href="<?php echo trailingslashit( bp_get_groups_directory_permalink() . 'create'); ?>" class="button"><?php _e('Create new group','autogov') ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
         <?php
         if(function_exists('bp_has_groups')){
    if ( bp_has_groups()){ ?>
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
      <div class="row">
        <div class="col-12 cardfilter text-right mt-2">
          <button class="hamburger hamburger--squeeze" type="button" data-toggle="collapse" data-target="#filter-people">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
        <div id="filter-people" class="collapse col-12" aria-labelledby="filter-people">
          <div class="row">
            <div class="col-8">
              <ul class="orderby">
                <li><a class="order-by" id="byname" href="#"><?php _e('Alfabéticamente','autogov'); ?></a></li>
              </ul>
            </div>
            <div class="col-4 text-right">
              <?php if(is_user_logged_in()){ ?>
                <a href="<?php echo bp_loggedin_user_domain(); ?>" class="button"><?php _e('My profile','autogov') ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
       <?php
      if ( bp_has_members()){ ?>
        <!-- Tab filter -->
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
            <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="row">
    <div id="tab-searchsocial" class="tabcontent social game col-12 my-5 text-center">
      <?php get_template_part('template-parts/leaderboard-box'); ?>
    </div>
  </div>
  <?php if(!is_front_page()){ ?>
    <div class="row">
      <div id="tab-search" class="tabcontent social game col-12 my-5 text-center">
        <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
          <input type="text" name="s" placeholder="Search social"/>
          <input type="hidden" name="post_type[]" value="topic" />
          <input type="hidden" name="post_type[]" value="forum" />
          <input type="hidden" name="post_type[]" value="rtmedia_album" />
          <input type="submit" alt="Search" value="Search" />
        </form>
      </div>
    </div>
  <?php } ?>
</div>
