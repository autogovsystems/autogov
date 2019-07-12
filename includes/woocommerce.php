<?php

define( 'SHOW_MYCRED_IN_WOOCOMMERCE', true );

function add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'add_woocommerce_support' );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'the_content', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

function add_comments_box() {
    echo comments_template();
}
add_action( 'woocommerce_after_single_product_summary', 'add_comments_box',50 );

add_filter('woocommerce_login_redirect', 'login_redirect');
function login_redirect($redirect){

 $redirect =  '/' ;
return $redirect;
}

add_action( 'woocommerce_payment_complete',  'add_log_for_paid_voins' );

 function add_log_for_paid_voins($order_id){
   $order = wc_get_order( $order_id );
   if($order->get_payment_method() == 'mycred'){
     add_to_agovlogger('voins_payment',$order->get_customer_id(),$order_id);
   }
 }

 add_action( 'woocommerce_thankyou',  'add_log_for_product_purchased' );
  function add_log_for_product_purchased($order_id){
    if ( ! $order_id )
        return;

    if( ! get_post_meta( $order_id, '_thankyou_log_done', true ) ) {
        $order = wc_get_order( $order_id );
        //$paid = $order->is_paid()?__('yes'):__('no');

        foreach ( $order->get_items() as $item_id => $item ) {
            $product = $item->get_product();
            add_to_agovlogger('product_purchase',$order->get_customer_id(),$product->get_id());
        }

        $order->update_meta_data( '_thankyou_log_done', true );
        $order->save();
    }
  }
