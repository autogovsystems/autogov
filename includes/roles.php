<?php
add_role( 'autometa-position', __( 'AutoMeta Position' ),
    array(
      "read" => true,
      "level_0" => true,
      "vote_on_comments" => false,
      "vote_vontest" => false,
      "show_on_game" => false,
      "can_sell" => false,
      "can_purchase" => false,
    )
);

/**
 * Avoid user with role autometa-position buy things
 */

function remove_actions_userrole() {
  $user = wp_get_current_user();
  if (in_array("autometa-position", $user->roles)){
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
  }
}
add_action( 'init', 'remove_actions_userrole');

function remove_results_from_leaderboard( $query, $class ) {
  $users_positions = get_users( [ 'role' => "autometa-position", 'fields' => 'ids' ] );
  $query = str_replace( 'DISTINCT', '', $query );
  $new_query = explode( 'ORDER BY', $query);
  return $new_query[0]." AND u.ID not IN (".implode(',',$users_positions).") ORDER BY ".$new_query[1];
}

add_filter( 'mycred_get_balance_leaderboard_sql', 'remove_results_from_leaderboard', 10, 2 );
add_filter( 'mycred_get_reference_leaderboard_sql', 'remove_results_from_leaderboard', 10, 2 );


function add_user_image_leaderboard( $content, $user ){
  $content = str_replace( '%user_profile_image%', get_avatar_url( $user->ID, array( 'size' => 150 ) ), $content );
  return $content;
}
add_filter( 'mycred_parse_tags_user', 'add_user_image_leaderboard', 10, 3 );

function replace_classes_leaderboard( $output, $args, $class ){
  $output = str_replace( '<ol class="myCRED-leaderboard list-unstyled">', '<ul class="myCRED-leaderboard list-unstyled slider">', $output );
  $output = str_replace( '</ol">', '</ul>', $output );
  return $output;
}
add_filter( 'mycred_leaderboard', 'replace_classes_leaderboard', 10, 3 );
