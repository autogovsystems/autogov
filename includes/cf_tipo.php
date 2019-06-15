<?php

add_action( 'woocommerce_product_options_general_product_data', 'tipo_woo'); //campo select para eleccion de tipo
add_action( 'woocommerce_process_product_meta', 'tipo_woo_save'); // guardado de meta de tipo
add_action( 'dokan_new_product_added', 'save_dokan_product_type', 10, 2); //guardado meta de tipo al crear producto vía dokan
add_action( 'dokan_product_updated', 'save_dokan_product_type', 10, 2); //guardado meta de tipo al editar producto vía dokan


/*metabox para tipo: servicio, producto o evento*/
function tipo_woo(){

    global $post;
    echo '<div class="options_group">';

    woocommerce_wp_select( array(
        'id'          => 'tipo',
        'value'       => get_post_meta( $post->ID, 'tipo', true ),
        'label'       => 'Tipo',
        'options'     => array( 'producto' => 'Producto', 'servicio' => 'Servicio',  'evento' => 'Evento'),
    ) );

    echo '</div>';

}

/*guardado de meta de tipo*/
function tipo_woo_save( $id ){

    if( !empty( $_POST['tipo'] ) )
        update_post_meta( $id, 'tipo', $_POST['tipo'] );

    if( !empty( $_POST['tipo'] ) )
        update_post_meta( $id, 'tipo', $_POST['tipo'] );


    if( !empty( $_POST['post_newtags'] ) ){
      $newtags = explode(",", $_POST['post_newtags']);
      $array_newtags = array();
      foreach($newtags as $nt){
        $nt_id = wp_insert_term($nt,'product_tag');
        wp_set_object_terms( $id, $nt_id, 'product_tag', true );
      }
    }

}

function save_dokan_product_type($product_id, $data)
{
    update_post_meta( $product_id, 'tipo', $_POST['tipo'] );
    if( !empty( $_POST['post_newtags'] ) ){
      $newtags = explode(",", $_POST['post_newtags']);
      $array_newtags = array();
      foreach($newtags as $nt){
        $nt_id = wp_insert_term($nt,'product_tag');
        wp_set_object_terms( $product_id, $nt_id, 'product_tag', true );
      }
    }

}
