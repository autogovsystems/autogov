<?php

/* Clase Vontest para obtener relacionados desde objeto */
/*
- Creación de vontest (vontest_new)
- Modificación de vontest (vontest_update)
- Creación de answer (answer_new)
- Creación de un comentario en vontest (vontest_new_comment)
- Creación de un comentario en answer (answer_new_comment)
- Creación de un producto (product_new)
- Modificación de un producto (product_updated)
- Compra de un producto (product_purchase)
- Pago de voins (voins_payment)
- Recepcion de voins (voins_receive)
- Reseñas de productos (product_new_comment)
- Creación de un grupo (group_new)
- Creación de actividad en muro (activity_new)
- Creación de actividad en grupo (activity_group_new)
- Registro de usuario (user_register)
- Login de usuario (user_login)
- Votación de un usuario*
*En el administrador se podrá editar si se desea que las votaciones se vean en el log. */

class AGOVLogger {

  private $table_name;
  private $per_page;
  private $totalPage;

  function __construct(){
    global $wpdb;
    $this->table_name = $wpdb->prefix.'agovlogger';
    $this->per_page = 25;
  }

  function create_table(){
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
      log_id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      date_created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      action varchar(255) NOT NULL,
      user_id int(10) DEFAULT NULL,
      meta_data longtext,
      PRIMARY KEY  (log_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    dbDelta( $sql );
  }

  function add($action,$user_id,$meta_data = ''){
    global $wpdb;
    $date = date("Y-m-d H:i:s");
    if(gettype($meta_data) == 'array' || gettype($meta_data) == 'object'){
      $meta_data = json_encode($meta_data);
    }
    $wpdb->query("INSERT INTO $this->table_name (date_created, action, user_id,meta_data) VALUES ('$date', '$action', '$user_id', '$meta_data')"  );
  }


  function add_shortcodes_and_actions(){
    add_shortcode('AGOV_log',array($this,'show_agovlog'));
    // Receive the Request post that came from AJAX
    add_action( 'wp_ajax_agovlog-load', array($this,'load_posts') );
    // We allow non-logged in users to access our pagination
    add_action( 'wp_ajax_nopriv_agovlog-load', array($this,'load_posts') );
  }

  function show_agovlog(){
    include( locate_template( 'template-parts/log.php', false, false ) );
  }

  function get_pagination($count){
    $page = sanitize_text_field($_POST['page']);
    $cur_page = $page;

    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $this->per_page;

    // This is where the magic happens
    $no_of_paginations = ceil($count / $this->per_page);
    if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
            $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
            $start_loop = $no_of_paginations - 6;
            $end_loop = $no_of_paginations;
        } else {
            $end_loop = $no_of_paginations;
        }
    } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
            $end_loop = 7;
        else
            $end_loop = $no_of_paginations;
    }

    // Pagination Buttons logic
    $pag_container .= "
    <div class='agovlog-universal-pagination'>
        <ul class='pagination'>";

    if ($first_btn && $cur_page > 1) {
        $pag_container .= "<li p='1' class='active'><span class='first-page current'>«</span></li>";
    } else if ($first_btn) {
        $pag_container .= "<li p='1'><span>«</span></li>";
    }

    if ($previous_btn && $cur_page > 1) {
        $pre = $cur_page - 1;
        $pag_container .= "<li p='$pre' class='active'><span class='prev-page current'>‹</span></li>";
    } else if ($previous_btn) {
        $pag_container .= "<li class='inactive'><span>‹</span></li>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {

        if ($cur_page == $i)
            $pag_container .= "<li p='$i' class='selected'>{$i}</li>";
        else
            $pag_container .= "<li p='$i' class='active'>{$i}</li>";
    }

    if ($next_btn && $cur_page < $no_of_paginations) {
        $nex = $cur_page + 1;
        $pag_container .= "<li class='active' p='$nex'><span class='current'>›</span></li>";
    } else if ($next_btn) {
        $pag_container .= "<li class='inactive'><span>›</span></li>";
    }

    if ($last_btn && $cur_page < $no_of_paginations) {
        $pag_container .= "<li p='$no_of_paginations' class='active'><span>»</span></li>";
    } else if ($last_btn) {
        $pag_container .= "<li p='$no_of_paginations' class='inactive'><span>»</span></li>";
    }

    $pag_container = $pag_container . "
        </ul>
    </div>";
    return $pag_container;
  }

  function load_posts() {
    global $wpdb;
    // Set default variables
    $msg = '';
    if(isset($_POST['page'])){

        if(get_option('allow_log_votes') == 1){
          $all_log_posts = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM " . $this->table_name . " ORDER BY date_created DESC LIMIT %d, %d", $start, $this->per_page ) );
        }else{
          $all_log_posts = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM " . $this->table_name . " WHERE action != 'answer_voted' ORDER BY date_created DESC LIMIT %d, %d", $start, $this->per_page ) );
        }
        // At the same time, count the number of queried posts
        $count = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(log_id) FROM " . $this->table_name , array() ) );

        $msg .= '<table class="table table-condensed"><thead><tr><th scope="col" id="username" class="manage-column column-primary column-username">User</th><th scope="col" id="time" class="manage-column column-time">Fecha</th><th scope="col" id="entry" class="manage-column column-entry">Action</th><th scope="col" id="creds" class="manage-column column-creds">Data</th></tr></thead><tbody>';
        if($count>0){
        // Loop into all the posts
        foreach($all_log_posts as $key => $post):
            $postmessage = $this->print_line($post);
            $user_info = get_userdata($post->user_id);
            $msg .= '
            <tr>
                <td>'.$user_info->user_nicename.'</td>
                <td>'.date_i18n('M j, Y @ G:i:s',strtotime($post->date_created)).'</td>
                <td>'.$post->action.'</td>
                <td>'.$postmessage.'</td>
            </tr>';

        endforeach;

        $msg .= '</tbody><tfoot><tr><th scope="col" id="username" class="manage-column column-primary column-username">User</th><th scope="col" id="time" class="manage-column column-time">Fecha</th><th scope="col" id="entry" class="manage-column column-entry">Action</th><th scope="col" id="creds" class="manage-column column-creds">Data</th></tr></tfoot></table>';

        // Optional, wrap the output into a container
        $msg = "<div class='agovlog-universal-content'>" . $msg . "</div>";

        $pag_container = $this->get_pagination($count);

        // We echo the final output
        echo
        '<div class="agovlog-pagination-nav">' . $pag_container . '</div>'.
        '<div class="agovlog-pagination-content">' . $msg . '</div>' .
        '<div class="agovlog-pagination-nav">' . $pag_container . '</div>';
      }else{
        echo 'no hay log';
      }

    }
    // Always exit to avoid further execution
    exit();
  }

  function print_line($post){
    $msg = '';
    switch($post->action){
      case 'vontest_new':
        $msg = sprintf('Vontest created "%s"',get_the_title($post->meta_data));
      break;
      case 'vontest_update':
        $msg = sprintf('Vontest updated "%s"',get_the_title($post->meta_data));
      break;
      case 'answer_new':
        $msg = sprintf('Answer created "%s"',get_the_title($post->meta_data));
      break;
      case 'answer_update':
        $msg = sprintf('Answer updated "%s"',get_the_title($post->meta_data));
      break;
      case 'vontest_new_comment':
        $metadata = json_decode($post->meta_data);
        $msg = sprintf('Vontest comment created for "%s"',get_the_title($metadata->comment_post_ID));
      break;
      case 'answer_new_comment':
        $metadata = json_decode($post->meta_data);
        $msg = sprintf('Answer comment created for "%s"',get_the_title($metadata->comment_post_ID));
      break;
      case 'product_new':
        $msg = sprintf('Product created "%s"',get_the_title($post->meta_data));
      break;
      case 'product_updated':
        $msg = sprintf('Product updated "%s"',get_the_title($post->meta_data));
      break;
      case 'product_purchase':
        $msg = sprintf('Product purchased "%s"',get_the_title($post->meta_data));
      break;
      case 'voins_payment':
        $msg = sprintf('Voins payment via commerce','');
      break;
      case 'voins_change':
        $metadata = json_decode($post->meta_data);
        $msg = sprintf('Voins balance change: "%s"',$metadata->amount);
      break;
      case 'product_new_comment':
        $metadata = json_decode($post->meta_data);
        $msg = sprintf('Product comment created for "%s"',get_the_title($metadata->comment_post_ID));
      break;
      case 'group_new':
        $msg = sprintf('Group created "%s"',bp_get_group_name( groups_get_group($post->meta_data)));
      break;
      case 'activity_new':
        $metadata = json_decode($post->meta_data);
        $msg = 'Social activity: '.$metadata->type;
        if(!empty($metadata->action)){
          $msg .= '<br />'.stripslashes($metadata->action);
        }
        if(!empty($metadata->content)){
          $msg .= '<br />"'.stripslashes($metadata->content).'"';
        }
      break;
      case 'activity_group_new':
        $metadata = json_decode($post->meta_data);
        $msg = 'Social group activity: '.$metadata->type;
        if(!empty($metadata->action)){
          $msg .= '<br />'.stripslashes($metadata->action);
        }
        if(!empty($metadata->content)){
          $msg .= '<br />"'.stripslashes($metadata->content).'"';
        }
      break;
      case 'user_register':
        $msg = __('New user registered','autogov');
      break;
      case 'user_login':
        $msg = __('Login user','autogov');
      break;
      case 'answer_voted':
        $metadata = json_decode($post->meta_data);
        $msg = sprintf('Answer voted "%s" with %s votes ',get_the_title($metadata->answer_id),$metadata->votes);
      break;
    }
    return $msg;
  }
}
$AGOVLogger = new AGOVLogger();
