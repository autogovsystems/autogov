<?php

/* Crear virtual pages politics y social*/
add_action( 'init', 'wpse9870_init_internal' );
function wpse9870_init_internal()
{
    add_rewrite_rule( 'politics$', 'index.php?pagepoliticsagv=1', 'top' );
    add_rewrite_rule( 'social$', 'index.php?pagesocialagv=1', 'top' );
    add_rewrite_rule( 'createvontest$', 'index.php?createvontest=1', 'top' );
}

add_filter( 'query_vars', 'wpse9870_query_vars' );
function wpse9870_query_vars( $query_vars )
{
    $query_vars[] = 'pagepoliticsagv';
    $query_vars[] = 'pagesocialagv';
    $query_vars[] = 'createvontest';
    return $query_vars;
}

add_action( 'parse_request', 'wpse9870_parse_request' );
function wpse9870_parse_request( &$wp ){
    if ( array_key_exists( 'pagepoliticsagv', $wp->query_vars ) ) {
      get_template_part('page-politics');
      exit();
    }
    if ( array_key_exists( 'pagesocialagv', $wp->query_vars ) ) {
      get_template_part('page-social');
      exit();
    }
    if ( array_key_exists( 'createvontest', $wp->query_vars ) ) {
      get_template_part('create-vontest');
      exit();
    }
    return;
}
