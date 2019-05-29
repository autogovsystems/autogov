<div id="pastilla-politics" class="container-fluid cardtab">

  <div class="row cardtitle">
    <div class="col-11">
      <h3><?php _e('NAVIGATOR','autogov'); ?></h3>
    </div>
    <div class="col-1 text-right">
      <a data-toggle="collapse" href="#mainpolitics" class="ml-auto collapsed"><i class="fas fa-plus"></i></a>
      <script>
      jQuery(document).ready(function(){
        jQuery('#mainpolitics').on('shown.bs.collapse', function () {
          jQuery('#mainpolitics .tablinks.active').click();
        });
      });
      </script>
    </div>
  </div>
  <div id="mainpolitics" class="collapse">
    <!-- Tab links -->
    <div class="row tab">
        <button class="tablinks col-4 active" data-id="topics"><?php _e('Topics','autogov'); ?></button>
        <button class="tablinks col-4" data-id="vtags"><?php _e('Tags','autogov'); ?></button>
        <button class="tablinks col-4" data-id="searchvontest"><?php _e('Search','autogov'); ?></button>
    </div>
    <!-- Tab content -->

    <div id="tab-topics" class="tabcontent market categories col-12 active">

      <?php
        $taxonomy     = 'topics';
        $orderby      = 'name';
        $show_count   = 0;
        $pad_counts   = 0;
        $hierarchical = 1;
        $title        = '';
        $empty        = 0;

        $args = array(
               'taxonomy'     => $taxonomy,
               'orderby'      => $orderby,
               'show_count'   => $show_count,
               'pad_counts'   => $pad_counts,
               'hierarchical' => $hierarchical,
               'title_li'     => $title,
               'hide_empty'   => $empty
        );

        $get_all_categories = get_categories( $args );
        ?>

        <ul class="slider">
        <?php
        foreach ($get_all_categories as $cat) {

          if($cat->category_parent == 0) {
              $thumbnail_id = get_term_meta( $cat->term_id, 'category-image-id', true ); ?>

              <li>
                  <div <?php if(is_tax('topics',$cat->term_id)){ ?> class="active" <?php } ?>>
                    <div class ="image">
                      <a href="<?php echo get_term_link($cat->slug, 'topics');?>">
                        <?php $thumb = wp_get_attachment_url( $thumbnail_id );
                        if(!$thumb){ $thumb = get_stylesheet_directory_uri().'/img/default_image.png'; } ?>
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
        }

      /* código para subcategorías

        $category_id = $cat->term_id;
        $args2 = array(
                'taxonomy'     => $taxonomy,
                'child_of'     => 0,
                'parent'       => $category_id,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
        );
        $sub_cats = get_categories( $args2 );
        if($sub_cats) {
            foreach($sub_cats as $sub_category) {
                echo  $sub_category->name ;
            }
        }*/

        ?>
        </ul>
      </div>

    <div id="tab-vtags" class="tabcontent market tags col-12">

          <?php $terms = get_terms(array('taxonomy' => 'vontest_tag', 'hide_empty' => false)); ?>
          <?php if($terms){ ?>
          <ul class="slider">
            <?php foreach ( $terms as $term ) {
              $thumbnail_id = get_term_meta( $term->term_id, 'category-image-id', true );
              ?>
              <li>
                  <div class ="image">
                    <a href="<?php echo get_term_link($term->term_id, 'vontest_tag');?>">
                      <?php
                      $term_image = wp_get_attachment_url( $thumbnail_id );
                      if(!$term_image){ $term_image = get_stylesheet_directory_uri().'/img/default_image.png'; } ?>
                        <img src="<?php echo $term_image; ?>" alt="<?php echo $term->name; ?>" />
                    </a>
                  </div>
                  <div class="title">
                    <a href="<?php echo get_term_link($term->term_id, 'vontest_tag');?>">
                      <?php echo $term->name;?>
                    </a>
                  </div>
              </li>
            <?php } ?>
          </ul>
        <?php }else{ ?>
          <p class="text-center mb-5 mt-5"><?php _e( 'No tags'); ?></p>
        <?php } ?>
    </div>

    <div id="tab-searchvontest" class="tabcontent market search col-12 p-5 text-center">
      <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
        <input type="text" name="s" placeholder="Search Vontest"/>
        <input type="hidden" name="post_type[]" value="question" />
        <input type="hidden" name="post_type[]" value="answer" />
        <input type="submit" alt="Search" value="Search" />
      </form>
    </div>
  </div>
</div>
