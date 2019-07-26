<?php

include('classes/class.logger.php');

if(!get_option('agovlogger_table_created')){
  $AGOVLogger->create_table();
  update_option('agovlogger_table_created',true);
}

$AGOVLogger->add_shortcodes_and_actions();

function add_to_agovlogger($action,$user_id,$meta_data = ''){
  global $AGOVLogger;
  $AGOVLogger->add($action,$user_id,$meta_data);
}

add_action('mycred_update_user_balance','voins_update_user_balance',10,4);
function voins_update_user_balance($user_id, $current_balance, $amount, $type){
  if($type == 'mycred_default'){
    $meta_data = array(
      'current_balance' => $current_balance,
      'amount' => $amount,
      'type' => $type
    );

    add_to_agovlogger('voins_change',$user_id,$meta_data);
  }
}

add_action( 'user_register', 'log_registration_save', 10, 1 );
function log_registration_save( $user_id ) {
  add_to_agovlogger('user_register',$user_id);
}

//add_action( 'wp_login', 'log_login_save', 10, 2 );
//function log_login_save( $user_id, $user ) {
  //add_to_agovlogger('user_login',$user->ID);
//}

add_action( 'groups_group_create_complete', 'log_group_create' );
function log_group_create($group_id){
  add_to_agovlogger('group_new',get_current_user_id(),$group_id);
}

add_action( 'bp_activity_add', 'log_bp_activity' );
function log_bp_activity($r){
  if($r['type']=='created_group'){return;}
    $idtolog = 'activity_new';
  if($r['component'] == 'groups'){
    $idtolog = 'activity_group_new';
  }
  $r['action'] = addslashes($r['action']);
  $r['content'] = addslashes($r['content']);
  add_to_agovlogger($idtolog,$r['user_id'],$r);
}
