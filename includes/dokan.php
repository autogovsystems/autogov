<?php
remove_action( 'woocommerce_account_dashboard', 'dokan_set_go_to_vendor_dashboard_btn' );
remove_filter( 'woocommerce_get_item_data', 'dokan_product_seller_info', 10 );

add_action( 'user_register', 'user_product_autopublish', 10, 1 );

function user_product_autopublish( $user_id ) {
    update_user_meta($user_id, 'dokan_publishing', 'yes');
    update_user_meta($user_id, 'dokan_enable_selling', 'yes');
}

//nueva función que acepta solicitudes de withdraw automáticamente
function update_user_balance($current_user, $amount, $method)
{
    //withdraw status
    // 0 -> pending
    // 1 -> active
    // 2 -> cancelled

    global $wpdb;
    $wpdb->dokan_withdraw = $wpdb->prefix . 'dokan_withdraw';
    $wpdb->dokan_vendor_balance = $wpdb->prefix . 'dokan_vendor_balance';

    //get user's last withdraw request
    $query_withdraw = $wpdb->get_results( "SELECT MAX(id) AS id, date FROM $wpdb->dokan_withdraw WHERE user_id = $current_user->ID" );
    $withdraw_id = $query_withdraw[0]->id;
    $withdraw_date = $query_withdraw[0]->date;

    //mark withdraw request as accepted
    $wpdb->update( $wpdb->dokan_withdraw,
    array(
      'status' => '1'
    ),
    array( 'id' => $withdraw_id )
  	);

  	//update dokan vendor balance
  	$wpdb->insert( $wpdb->dokan_vendor_balance,
    array(
      'vendor_id' => $current_user->ID,
      'trn_id' => $withdraw_id,
      'trn_type' => 'dokan_withdraw',
      'perticulars' => 'Approve withdraw request',
      'debit' => 0,
      'credit' => $amount,
      'status' => 'approved',
      'trn_date' => $withdraw_date,
      'balance_date' => date('Y-m-d H:i:s')
    )
  	);

  	//update mycred balance
  	mycred_add( 'dokan_withdraw', $current_user->ID, $amount, 'Dokan withdraw', $withdraw_id);
}
//dokan_after_withdraw_request located at function 'insert_withdraw_info' on /plugins/dokan-lite/classes/template-withdraw.php
add_action( 'dokan_after_withdraw_request', 'update_user_balance', 10, 3 );



//antigua función que transfería los voins cuando el admin aceptaba el request de withdraw
/*function update_user_balance($status, $user_id, $row_id)
{
    //withdraw status
    // 0 -> pending
    // 1 -> active
    // 2 -> cancelled

    global $wpdb;
    //obtain withdrawed amount
    $query_amount = $wpdb->get_results( "SELECT amount FROM wp_dokan_withdraw WHERE id = $row_id" );
    $amount = $query_amount[0]->amount;
    //update balance
    if($status==1)
    	mycred_add( 'dokan_withdraw', $user_id, $amount, 'Dokan withdraw', $row_id);
}

//'dokan_withdraw_status_updated' located at function 'update_status' on /plugins/dokan-lite/classes/withdraw.php
add_action( 'dokan_withdraw_status_updated', 'update_user_balance', 10, 3 );
*/

add_filter( 'dokan_get_dashboard_nav', 'prefix_dokan_add_seller_nav' );
function prefix_dokan_add_seller_nav( $urls ) {
   $urls = array(
      "dashboard"=> array(
        "title" => "Dashboard",
        "icon"=> "",
        "url"=> "/dashboard/",
        "pos"=> 10,
        "permission"=> "dokan_view_overview_menu"
      ),
      "products"=> array(
        "title" => "Products",
        "icon"=> "",
        "url"=> "/dashboard/products/",
        "pos"=> 30,
        "permission"=> "dokan_view_product_menu",
      ),
      "orders"=> array(
        "title"=> "Orders",
        "icon"=> "",
        "url"=> "/dashboard/orders/",
        "pos"=> 50,
        "permission"=> "dokan_view_order_menu",
      ),
      "withdraw"=> array(
        "title"=> "Withdraw",
        "icon"=> "",
        "url"=> "/dashboard/withdraw/",
        "pos"=> 70,
        "permission"=> "dokan_view_withdraw_menu"
      ),
       "settings/store" => array(
         "title" => "Store",
         "icon" => "",
         "url" => "/dashboard/settings/store/",
         "pos" => 50,
         "permission" => "dokan_view_store_settings_menu"
       ),
       "settings/payment" => array(
         "title" => "Payment",
         "icon" => "",
         "url" => "/dashboard/settings/payment/",
         "pos" => 60,
         "permission" => "dokan_view_store_payment_menu"
       ),
    );
    return $urls;
}
add_filter( 'dokan_color_skin', 'dokan_color_custom_skin' );
function dokan_color_custom_skin($a){
  var_dump($a);
}
add_filter('dokan_dashboard_nav_common_link','dokan_common_links_navigator');
function dokan_common_links_navigator($common_links){
  $common_links = '<li class="withdraw"><a href="' . dokan_get_store_url( dokan_get_current_user_id() ) .'" title="' . __( 'Visit Store', 'dokan-lite' ) . '" target="_blank">' . __( 'Visit Store', 'dokan-lite' ) . '</a></li>';
  return $common_links;
}
add_filter('dokan_seller_registration_required_fields','dokan_remove_required_fields');
function dokan_remove_required_fields($array){
  unset($array['shopname']);
  unset($array['phone']);
  return $array;
}
