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
