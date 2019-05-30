<?php

include('classes/class.vontest.php');

add_action( 'init', 'question_custom_posttype' );
 function question_custom_posttype(){
   // Creamos taxonomy topics
    $labels = array(
    	'name' => _x( 'Topics for vontest', 'taxonomy general name' ),
    	'singular_name' => _x( 'Topic for vontest', 'taxonomy singular name' ),
    	'search_items' =>  __( 'Search Topics for vontest' ),
    	'popular_items' => __( 'Topics for vontest populares' ),
    	'all_items' => __( 'All Topics for vontest' ),
    	'parent_item' => null,
    	'parent_item_colon' => null,
    	'edit_item' => __( 'Edit Topics for vontest' ),
    	'update_item' => __( 'Update Topics for vontest' ),
    	'add_new_item' => __( 'Añadir nuevo Topics for vontest' ),
    	'new_item_name' => __( 'Nombre del nuevo Topic for vontest' ),
    	'separate_items_with_commas' => __( 'Separar Topics for vontest por comas' ),
    	'add_or_remove_items' => __( 'Añadir o eliminar Topics for vontest' ),
    	'choose_from_most_used' => __( 'Escoger entre los Topics for vontest más utilizados' )
    );
    register_taxonomy( 'topics', 'question', array(
    	'hierarchical' => false,
    	'labels' => $labels,
    	'show_ui' => true,
    	'query_var' => true,
    	'rewrite' => array( 'slug' => 'topics' ),
    ));
    //Cramos taxonomy tags para questions
    $labels = array(
		'name'                       => _x( 'Tags for vontest', 'taxonomy general name', 'autogov' ),
		'singular_name'              => _x( 'Tag for vontest', 'taxonomy singular name', 'autogov' ),
		'search_items'               => __( 'Search Tags for vontest', 'autogov' ),
		'popular_items'              => __( 'Popular Tags for vontest', 'autogov' ),
		'all_items'                  => __( 'All Tags for vontest', 'autogov' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tags for vontest', 'autogov' ),
		'update_item'                => __( 'Update Tags for vontest', 'autogov' ),
		'add_new_item'               => __( 'Add New Tags for vontest', 'autogov' ),
		'new_item_name'              => __( 'New Tags for vontest Name', 'autogov' ),
		'separate_items_with_commas' => __( 'Separate Tags for vontest with commas', 'autogov' ),
		'add_or_remove_items'        => __( 'Add or remove Tags for vontest', 'autogov' ),
		'choose_from_most_used'      => __( 'Choose from the most used Tags for vontest', 'autogov' ),
		'not_found'                  => __( 'No Tags for vontest found.', 'autogov' ),
		'menu_name'                  => __( 'Tags for vontest', 'autogov' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'vtags' ),
	);

	register_taxonomy( 'vontest_tag', 'question', $args );
    //Creamos custom post type Questions
   $labels = array(
	'name' => _x( 'Questions', 'post type general name' ),
        'singular_name' => _x( 'Question', 'post type singular name' ),
        'add_new' => _x( 'Add Question', 'question' ),
        'add_new_item' => __( 'Add new Question' ),
        'edit_item' => __( 'Edit Question' ),
        'new_item' => __( 'Nueva Question' ),
        'view_item' => __( 'Ver Question' ),
        'search_items' => __( 'Buscar Question' ),
        'not_found' =>  __( 'No se han encontrado Questions' ),
        'not_found_in_trash' => __( 'No se han encontrado Questions en la papelera' ),
        'parent_item_colon' => ''
    );
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-format-status',
        'hierarchical' => false,
        'has_archive'=> true,
        'rewrite' => array('slug' => 'question'),
        'supports' => array( 'title', 'author', 'comments', 'thumbnail', 'excerpt' ),
        'taxonomies' => array('topics','vontest_tag'),
    );
    register_post_type('question',$args);
    //Creamos custom post type Answers
    $labels = array(
 	'name' => _x( 'Answers', 'post type general name' ),
         'singular_name' => _x( 'Answer', 'post type singular name' ),
         'add_new' => _x( 'Añadir Answer', 'answer' ),
         'add_new_item' => __( 'Añadir nueva Answer' ),
         'edit_item' => __( 'Editar Answer' ),
         'new_item' => __( 'Nueva Answer' ),
         'view_item' => __( 'Ver Answer' ),
         'search_items' => __( 'Buscar Answer' ),
         'not_found' =>  __( 'No se han encontrado Answers' ),
         'not_found_in_trash' => __( 'No se han encontrado Answers en la papelera' ),
         'parent_item_colon' => ''
     );
     $args = array( 'labels' => $labels,
         'public' => true,
         'publicly_queryable' => true,
         'show_ui' => true,
         'query_var' => true,
         'capability_type' => 'post',
         'menu_icon' => 'dashicons-format-chat',
         'hierarchical' => false,
         'has_archive'=> false,
         'rewrite' => array('slug' => 'answer'),
         'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
     );
     register_post_type('answer',$args);
     //Creamos custom post type Answers
     $labels = array(
  	    'name' => _x( 'Resolutions', 'post type general name' ),
          'singular_name' => _x( 'Resolution', 'post type singular name' ),
          'add_new' => _x( 'Add Resolution', 'answer' ),
          'add_new_item' => __( 'Add new Resolution' ),
          'edit_item' => __( 'Edit Resolution' ),
          'new_item' => __( 'New Resolution' ),
          'view_item' => __( 'See Resolution' ),
          'search_items' => __( 'Buscar Resolution' ),
          'not_found' =>  __( 'No se han encontrado Resolution' ),
          'not_found_in_trash' => __( 'No se han encontrado Resolution en la papelera' ),
          'parent_item_colon' => ''
      );
      $args = array( 'labels' => $labels,
          'public' => true,
          'publicly_queryable' => true,
          'show_ui' => true,
          'query_var' => true,
          'capability_type' => 'post',
          'menu_icon' => 'dashicons-format-chat',
          'hierarchical' => false,
          'has_archive'=> true,
          'rewrite' => array('slug' => 'resolution'),
          'supports' => array( 'title', 'editor', 'custom-fields' )
      );
      register_post_type('resolution',$args);
}

/* Añadimos preguntas a question*/
add_action( 'edit_form_after_editor', 'no_metabox_question' );
add_action( 'save_post', 'save_question', 10, 2 );

function no_metabox_question()
{
    global $post;
    if( 'question' != $post->post_type )
        return;
    $editor1 = get_post_meta( $post->ID, '_editor_what', true);
    $editor2 = get_post_meta( $post->ID, '_editor_how', true);
    $editor3 = get_post_meta( $post->ID, '_editor_when', true);
    $editor4 = get_post_meta( $post->ID, '_editor_where', true);
    $editor5 = get_post_meta( $post->ID, '_editor_why', true);
    $editor6 = get_post_meta( $post->ID, '_editor_howmuch', true);
    wp_nonce_field( plugin_basename( __FILE__ ), '_nonce_editors' );
    echo '<h2>What</h2>';
    echo wp_editor( $editor1, '_editor_what', array( 'textarea_name' => '_editor_what' ) );
    echo '<h2>How</h2>';
    echo wp_editor( $editor2, '_editor_how', array( 'textarea_name' => '_editor_how' ) );
    echo '<h2>When</h2>';
    echo wp_editor( $editor3, '_editor_when', array( 'textarea_name' => '_editor_when' ) );
    echo '<h2>Where</h2>';
    echo wp_editor( $editor4, '_editor_where', array( 'textarea_name' => '_editor_where' ) );
    echo '<h2>Why</h2>';
    echo wp_editor( $editor5, '_editor_why', array( 'textarea_name' => '_editor_why' ) );
    echo '<h2>How much</h2>';
    echo wp_editor( $editor6, '_editor_howmuch', array( 'textarea_name' => '_editor_howmuch' ) );
}

/** Register meta boxes */
function question_register_meta_boxes() {
    add_meta_box( 'question-isspecial-id', __( '¿Is special?', 'autogov' ), 'question_isspecial_callback', 'question', 'side','high' );
    add_meta_box( 'question-datevotograpy-id', __( 'Date for votograpy', 'autogov' ), 'question_datevotography_callback', 'question', 'side','high' );
    add_meta_box( 'question-votographies-id', __( 'Votographies', 'autogov' ), 'question_votographies_callback', 'question', 'side','high' );
    add_meta_box( 'question-relatedresolutions-id', __( 'Conflicted resolutions', 'autogov' ), 'question_relatedresolutions_callback', 'question', 'normal','high' );
    add_meta_box( 'question-answers-id', __( 'Answers', 'autogov' ), 'question_answers_callback', 'question', 'normal','high' );
    add_meta_box( 'question-resolutions-id', __( 'Resolutions', 'autogov' ), 'question_resolutions_callback', 'question', 'normal','high' );
    add_meta_box( 'question-resetvotes-id', __( 'Reset votes', 'autogov' ), 'question_reset_votes_callback', 'question', 'side','high' );
}
add_action( 'add_meta_boxes', 'question_register_meta_boxes' );

/** Create is special metabox */
function question_isspecial_callback( $post ) {
  $field_id_checked = get_post_meta($post->ID, '_is_special', true)?'checked="checked"':''; ?>
    <label><input type="checkbox" name="_is_special" value="yes" <?php echo $field_id_checked; ?> /><?php _e( 'Marca esta pregunta como decisión importante', 'autogov' ); ?></label>
    <p><?php _e('Checking this box means that it will come out as special.','autogov'); ?></p>
  <?php
}

/** Create date votography metabox */
function question_datevotography_callback($post) {
  $field_date_votography = get_post_meta($post->ID, '_date_votography', true); ?>
    <label><?php _e( 'Fecha', 'autogov' ); ?><input id="date_votography_view" type="datetime" name="_date_votography_view" value="<?php echo date_i18n( get_option( 'date_format' ), strtotime($field_date_votography) ); ?>" /></label>
    <input type="hidden" id="date_votography" name="_date_votography" value="<?php echo $field_date_votography; ?>" />
    <p><?php _e('This date will be the one that closes the voting and indicates the best option.','autogov'); ?></p>
    <script>
    jQuery(document).ready(function(){
        jQuery('#date_votography_view').datepicker({
          altField: "#date_votography",
          altFormat: "yy-mm-dd"
        });
    });
    </script>
  <?php
}
/** Create votographies info metabox **/
function question_votographies_callback($post){
  $votographies = get_post_meta($post->ID, '_votographies', true);
  if($votographies){
    foreach($votographies as $v){ ?>
      <div>
        <strong><?php echo $v['_date_votography']; ?></strong>
        <div><?php echo __('Participants','autogov').': '.($v['_users_voted']-1); ?></div>
        <ul class="">
          <?php
          if(!empty($v['_answers_on_votography'])){
            foreach($v['_answers_on_votography'] as $a) { ?>
              <li><?php echo $a->post_title.': '.$v['_answers_voted'][$a->ID] ?></li>
            <?php }
          }else{ ?>
            <li><?php _e('There are no answers','autogov'); ?></li>
          <?php } ?>
        </ul>
      </div>
    <?php
    }
  }
}

/** Create date related resolutions metabox */
function question_relatedresolutions_callback($post) {
  ?>
    <label><?php _e( 'Conflicted resolutions', 'autogov' ); ?>
      <?php $query_related = new WP_Query( array(
          'post_type' => 'resolution',
          'posts_per_page' => -1,
      ) );
            $currently_related_resolutions=get_post_meta( $post->ID, '_related_resolutions', true );
          if ( $query_related->have_posts() ) {
          ?>
            <select data-placeholder="<?php _e('Select decisions from other vontest','autogov'); ?>" id="vontest_related" name="vontest_related[]" multiple="multiple">
              <?php	while ( $query_related->have_posts() ) {
                $query_related->the_post();
              ?>
              <option value="<?php echo get_the_ID(); ?>" <?php if( is_array($currently_related_resolutions) && in_array(get_the_ID(),$currently_related_resolutions) ) echo 'selected="selected"'; ?>><?php the_title(); ?></option>
              <?php
              } ?>
            </select>
          <script type="text/javascript">
              jQuery(document).ready(function() {
                  $("#vontest_related").chosen({width: "100%"})
              });
          </script>
            <?php /* Restore original Post Data */
            wp_reset_postdata();
          } else {
            _e('Aun no hay decisiones para relacionar.');
          }
        ?>
  <?php
}

/** Create answers related metabox */
function question_answers_callback( $post ) {
  $current_vontest = new Vontest($post->ID);
  if($current_vontest->answers){ ?>
    <table class="wp-list-table widefat fixed striped posts">
    <?php while($current_vontest->answers->have_posts()){
      $current_vontest->answers->the_post();
      ?>
      <tr class="iedit author-other level-0 type-answer">
        <td><a href="<?php echo get_edit_post_link(get_the_ID()); ?>"><?php the_title(); ?></a></td>
      </tr>
    <?php } ?>
    </table>
<?php }
}

/** Create answers related metabox */
function question_resolutions_callback( $post ) {
  $current_vontest = new Vontest($post->ID);
  $current_vontest->get_resolutions(true);
  if($current_vontest->resolutions){ ?>
    <table class="wp-list-table widefat fixed striped posts">
    <?php while($current_vontest->resolutions->have_posts()){
      $current_vontest->resolutions->the_post();
      ?>
      <tr class="iedit author-other level-0 type-answer">
        <td><a href="<?php echo get_edit_post_link(get_the_ID()); ?>"><?php the_title(); ?></a></td>
      </tr>
    <?php } ?>
    </table>
<?php }
}

/** Create reset vontest votes button */
function question_reset_votes_callback( $post ) {
  $current_vontest = new Vontest($post->ID);
  if($current_vontest->is_active())
  { ?>
    <label for="question_reset_votes"><input type="button" id="question_reset_votes" name="question_reset_votes" data-id = "<?php echo $post->ID; ?>" value="<?php _e('Resetear los votos de esta question','autogov'); ?>"/></label>
    <?php _e('ATTENTION: This will erase all vows of this vontest and can not be undone','autogov'); ?>
    <script>
    jQuery(document).ready(function(){
      $('#question_reset_votes').click(function() {
        if (confirm('<?php _e('ATTENTION: This will erase all vows of this vontest and can not be undone','autogov'); ?>')){
          var formData = new FormData();
          formData.append('action', 'question_reset_votes');
          formData.append('vontest_id', $(this).attr("data-id") );
          $.ajax({
            type : "post",
            processData: false,
            contentType: false,
            url : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
            data : formData,
            error: function(response){
              console.log(response);
              alert("Error al resetear");
            },
            success: function(response) {
              console.log("OK");
            }
          })
        }
      });
    });
    </script>
  <?php }
  else
    _e('Can not reset votes from a vontest that is no longer active','autogov');
}

/** Register meta boxes */
function resolution_register_meta_boxes() {
    add_meta_box( 'resolutions-created-id', __( 'What question does it belong to?', 'autogov' ), 'resolution_parent_callback', 'resolution', 'side','high' );
}
add_action( 'add_meta_boxes', 'resolution_register_meta_boxes' );

function resolution_parent_callback($post){
  wp_nonce_field( plugin_basename( __FILE__ ), '_question_parent_nonce' );
  $question_parent = get_post_meta($post->ID,'_question_parent',true);
  $args = array('post_type' => 'question');
  $questions = new WP_Query( $args );
  ?>
  <select id="_question_parent" name="_question_parent">
    <?php while($questions->have_posts()){
      $questions->the_post();
      ?>
      <option value="<?php the_ID(); ?>" <?php selected(get_the_ID(),$question_parent); ?>><?php the_title(); ?></option>
    <?php }
    wp_reset_postdata();
    ?>
  </select>
  <?php if($question_parent){ ?>
    <a href="<?php the_permalink($question_parent); ?>" target="_blank"><?php echo get_the_title($question_parent); ?></a>
  <?php } ?>
<?php
}

/** Register meta box comments*/


/** Save question */
function save_question( $post_id, $post_object ){
    if( !isset( $post_object->post_type ) || 'question' != $post_object->post_type )
        return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( !isset( $_POST['_nonce_editors'] ) || !wp_verify_nonce( $_POST['_nonce_editors'], plugin_basename( __FILE__ ) ) )
        return;

    if ( isset( $_POST['_editor_what'] )  ){
        update_post_meta( $post_id, '_editor_what', $_POST['_editor_what'] );
    }

    if ( isset( $_POST['_editor_how'] )  ){
        update_post_meta( $post_id, '_editor_how', $_POST['_editor_how'] );
    }

    if ( isset( $_POST['_editor_when'] )  ){
        update_post_meta( $post_id, '_editor_when', $_POST['_editor_when'] );
    }

    if ( isset( $_POST['_editor_where'] )  ){
        update_post_meta( $post_id, '_editor_where', $_POST['_editor_where'] );
    }

    if ( isset( $_POST['_editor_why'] )  ){
        update_post_meta( $post_id, '_editor_why', $_POST['_editor_why'] );
    }

    if ( isset( $_POST['_editor_howmuch'] )  ){
        update_post_meta( $post_id, '_editor_howmuch', $_POST['_editor_howmuch'] );
    }

    if ( isset( $_POST['_is_special'] )  ){
        update_post_meta( $post_id, '_is_special', $_POST['_is_special'] );
    }else{
        delete_post_meta( $post_id, '_is_special' );
    }

    if ( isset( $_POST['_date_votography'] ) && !empty($_POST['_date_votography']) ){
        update_post_meta( $post_id, '_date_votography', $_POST['_date_votography'] );
    }else{
      $date_decision = date_i18n( get_option( 'date_format' ), date("+1 month") );
      update_post_meta( $post_id, '_date_votography', $date_decision );
    }
    if ( isset( $_POST['vontest_related'] )  ){
        update_post_meta( $post_id, '_related_resolutions', $_POST['vontest_related'] );
    }else{
        delete_post_meta( $post_id, '_related_resolutions' );
    }
}


/* ANSWERS */
/** Register meta boxes */
function answer_register_meta_boxes() {
    add_meta_box( 'question-isdecision-id', __( 'What question does it belong to?', 'autogov' ), 'answer_parent_callback', 'answer', 'side','high' );
}
add_action( 'add_meta_boxes', 'answer_register_meta_boxes' );

function answer_parent_callback($post){
  $question_parent = get_post_meta($post->ID,'_question_parent',true);
  $args = array('post_type' => 'question');
  $questions = new WP_Query( $args );
  ?>
  <select id="_question_parent" name="_question_parent">
    <?php while($questions->have_posts()){
      $questions->the_post();
      ?>
      <option value="<?php the_ID(); ?>" <?php selected(the_ID(),$question_parent); ?>><?php the_title(); ?></option>
    <?php }
    wp_reset_postdata();
    ?>
  </select>
<?php
  wp_nonce_field( plugin_basename( __FILE__ ), '_question_parent_nonce' );
}

/** Save answer */
add_action( 'save_post', 'save_answer', 10, 2 );
function save_answer( $post_id, $post_object ){
    if( !isset( $post_object->post_type ) || 'answer' != $post_object->post_type )
        return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( !isset( $_POST['_question_parent_nonce'] ) || !wp_verify_nonce( $_POST['_question_parent_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    if ( isset( $_POST['_question_parent'] ) && !empty($_POST['_question_parent']) ){
        update_post_meta( $post_id, '_question_parent', $_POST['_question_parent'] );
    }else{
      delete_post_meta( $post_id, '_question_parent' );
    }
}

/** Save resolution */
add_action( 'save_post', 'save_resolution', 10, 2 );
function save_resolution( $post_id, $post_object ){
    if( !isset( $post_object->post_type ) || 'resolution' != $post_object->post_type )
        return;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( !isset( $_POST['_question_parent_nonce'] ) || !wp_verify_nonce( $_POST['_question_parent_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    if ( isset( $_POST['_question_parent'] ) && !empty($_POST['_question_parent']) ){
        update_post_meta( $post_id, '_question_parent', $_POST['_question_parent'] );
    }else{
      delete_post_meta( $post_id, '_question_parent' );
    }
}

add_action( 'init', 'remove_comments_plugin_template',99999 );
function remove_comments_plugin_template(){
  if(class_exists('CommentPopularity/HMN_Comment_Popularity')){
    remove_filter( 'comments_template', array( CommentPopularity\HMN_Comment_Popularity::get_instance(), 'custom_comments_template' ) );
  }
}

/* COMMENTS ON QUESTION */
add_filter( 'comment_form_defaults', 'change_comment_form_defaults');
function change_comment_form_defaults( $default ) {
  if(get_post_type()=='answer'){
    $default[ 'comment_field' ] .= '
    <div id="vontest_answer_comment_type" class="row mx-0">
      <input type="radio" id="pro_comment" name="comment_type" value="pro" checked>
      <label for="pro_comment" class="col-6 text-center align-middle">'.__('Pro','autogov').'</label>
      <input type="radio" id="con_comment" name="comment_type" value="con">
      <label for="con_comment" class="col-6 text-center align-middle">'.__('Contra','autogov').'</label>
    </div>';
    }
    return $default;
}

add_filter( 'get_comment_author_IP', 'add_comment_type', 10, 3);
function add_comment_type( $comment_author_IP, $comment_ID, $comment ){
    if( doing_action( 'wp_ajax_get-comments' ) )
      echo '<strong>Tipo: '.get_comment_meta($comment_ID,'_comment_type',true).'</strong><br/>';
    return $comment_author_IP;
}

add_action ('comment_post', 'add_comment_meta_settings', 1);
function add_comment_meta_settings($comment_id) {
  if($_POST['comment_parent'] == 0){
    if(isset($_POST['comment_type'])){
      add_comment_meta($comment_id, '_comment_type', $_POST['comment_type'], true);
    }
  }else{
    add_comment_meta($comment_id,'_comment_type', get_comment_meta($_POST['comment_parent'],'_comment_type',true), true);
  }
}

function create_vontest() {
  $metas = array(
      '_date_votography' => $_POST['vontest_closingdate'],
      '_editor_what' => $_POST['_editor_what'],
      '_editor_how' => $_POST['_editor_how'],
      '_editor_when' => $_POST['_editor_when'],
      '_editor_where' => $_POST['_editor_where'],
      '_editor_why' => $_POST['_editor_why'],
      '_editor_howmuch' => $_POST['_editor_howmuch'],
      '_related_resolutions' => $_POST['vontest_related']
  );
  if(isset($_POST['vontest_related']) && $_POST['vontest_related'] != '')
    $metas['_related_resolutions'] = explode(',', $_POST['vontest_related']);

  $terms = array(
      'topics' => $_POST['vontest_topics'],
      'vontest_tag' => $_POST['vontest_tags']
  );

  $post = array(
      'post_title'    => $_POST['vontest_title'],
      'post_name'    => $_POST['vontest_title'],
      'post_excerpt'  => $_POST['vontest_excerpt'],
      'post_status'   => 'publish',
      'post_type'     => 'question',
      'meta_input'    => $metas,
      'tax_input'     => $terms
  );

  if(isset($_POST['vontest_id']) && $_POST['vontest_id']!=''){
    $post['ID'] = $_POST['vontest_id'];
    $post_id = wp_update_post($post);
    foreach ( $metas as $meta_key => $meta_value ) {
      update_post_meta( $_POST['vontest_id'], $meta_key, $meta_value );
    }
  }
  else
    $post_id = wp_insert_post($post);

  if(isset($_FILES["vontest_featuredimage"]) && $_FILES["vontest_featuredimage"]!='')
    upload_vontest_image($post_id);

  $response=get_permalink($post_id);
  echo $response;
}
add_action('wp_ajax_create_vontest', 'create_vontest');

function create_answer() {
  $current_vontest = new Vontest($_POST['vontest_id']);
  if($current_vontest->is_active())
  {
    $metas = array(
        '_question_parent' => $_POST['vontest_id'],
        '_resolution_case' => $_POST['vontest_resolution_case']
    );
    $post = array(
        'post_title'    => $_POST['vontest_title'],
        'post_content'  => $_POST['vontest_excerpt'],
        'post_status'   => 'publish',
        'post_type'     => 'answer',
        'meta_input'    => $metas,
    );
    $new_post_id = wp_insert_post($post);
    upload_vontest_image($new_post_id);
  }
  else
    exit;
}
add_action('wp_ajax_create_answer', 'create_answer');

function upload_vontest_image($post_id)
{
  $path_parts = pathinfo($_FILES["vontest_featuredimage"]["name"]);
  $extension = $path_parts['extension'];
  $newfilename = get_current_user_id() . time() . '.' . $extension;
  $uploaddir = wp_upload_dir();
  $uploadfile = $uploaddir['path'] . '/' . $newfilename;
  move_uploaded_file( $_FILES["vontest_featuredimage"]["tmp_name"] , $uploadfile );
  $filename = basename( $uploadfile );
  $wp_filetype = wp_check_filetype(basename($filename), null );
  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
      'post_content' => '',
      'post_status' => 'inherit',
      'menu_order' => $_i + 1000
  );
  $attach_id = wp_insert_attachment( $attachment, $uploadfile );
  set_post_thumbnail( $post_id, $attach_id );
}

function vote_answer() {
  $current_vontest = new Vontest($_POST["vontest_id"]);
  if($current_vontest->is_active() && get_disposable_points($_POST['vontest_id'],$_POST["answer_id"]) >= $_POST["vote_value"])
    update_user_meta( get_current_user_id(), 'answer_'.$_POST["answer_id"], $_POST["vote_value"]);
    $count = get_post_meta( $bid_id, 'draftnumber', true );
    if ( ! $count ) { $count = 0; }
    $count = $count + $_POST["vote_value"];
    update_post_meta( $_POST["answer_id"], '_votes', $count);
}
add_action('wp_ajax_vote_answer', 'vote_answer');

function get_disposable_points($vontest_id,$current_answer_id)
{
  $current_answer_points=get_user_meta(get_current_user_id(), 'answer_'.$current_answer_id,true);
  $max_points_user_answer = get_option( 'max_points_user_answer', 4 );
  $max_points_user_vontest = get_option( 'max_points_user_vontest', 10 );
  $sum=0;
  $vontest=new Vontest($vontest_id);

  foreach($vontest->answer_ids as $answer_id){
    $sum+=get_user_meta(get_current_user_id(), 'answer_'.$answer_id, true);
  }

  $remaining_vontest_user_points = $max_points_user_vontest - $sum + $current_answer_points;
  $disposable_points = min($remaining_vontest_user_points,$max_points_user_answer);

  return($disposable_points);
}

function get_total_answer_points($answer_id)
{
  $users = new WP_User_Query(array( 'meta_key' => 'answer_'.$answer_id ));

  $total=0;
  foreach($users->results as $user)
      $total += get_user_meta($user->ID, 'answer_'.$answer_id, true);

  return $total;
}
function get_users_voted_on_answer($answer_id)
{
  $users = new WP_User_Query(array( 'meta_key' => 'answer_'.$answer_id ));
  if($users){
    $emails = '';
    foreach($users->results as $user){
        $emails .= $user->user_email.',';
    }
    return $emails;
  }else{
    return false;
  }
}

function reset_votes() {
  global $wpdb;
  $args = array(
      'post_type'=> 'question'
  );
  $query = new WP_Query( $args );

  while ( $query->have_posts() ){
    $query->the_post();
    $current_vontest = new Vontest(get_the_ID());
    if ($current_vontest->is_active()){
      while($current_vontest->answers->have_posts())
      {
        $current_vontest->answers->the_post();
        $answer_key="answer_".get_the_ID();
        $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = '$answer_key'" ) );
        delete_post_meta( get_the_ID(), '_votes');
      }
      wp_reset_postdata();
    }
  }
}
add_action('wp_ajax_reset_votes', 'reset_votes');

function question_reset_votes() {
  global $wpdb;
  if(isset($_POST['vontest_id']) && $_POST['vontest_id'] != '' )
  {
    $current_vontest = new Vontest($_POST['vontest_id']);
    if ($current_vontest->is_active()){
      while($current_vontest->answers->have_posts())
      {
        $current_vontest->answers->the_post();
        $answer_key="answer_".get_the_ID();
        $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = '$answer_key'" ) );
        delete_post_meta( get_the_ID(), '_votes');
      }
      wp_reset_postdata();
    }
  }
}
add_action('wp_ajax_question_reset_votes', 'question_reset_votes');

function is_any_vontest_active ()
{
  global $wpdb;
  $args = array(
      'post_type'=> 'question'
  );
  $query = new WP_Query( $args );

  while ( $query->have_posts() ){
    $query->the_post();
    $current_vontest = new Vontest(get_the_ID());
    if ($current_vontest->is_active()){
      return true;
    }
  }
  return false;
}

add_action( 'trashed_post', 'trash_post_answers', 10 );

function trash_post_answers( $pid ) {
  if(get_post_type($pid) == 'question')
  {
    global $wpdb;
    $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'answer',
    'meta_key'         => '_question_parent',
    'meta_value'       => $pid
    );
    $query = new WP_Query( $args );

    while ( $query->have_posts() ){
      $query->the_post();
      wp_trash_post( get_the_ID());
    }
  }
}

add_action( 'untrashed_post', 'untrash_post_answers', 10 );

function untrash_post_answers( $pid ) {
  if(get_post_type($pid) == 'question')
  {
    global $wpdb;
    $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'answer',
    'meta_key'         => '_question_parent',
    'meta_value'       => $pid,
    'post_status'      => 'trash'
    );
    $query = new WP_Query( $args );

    while ( $query->have_posts() ){
      $query->the_post();
      wp_untrash_post( get_the_ID());
    }
  }
}

add_action( 'deleted_post', 'delete_post_answers', 10 );

function delete_post_answers( $pid ) {
  if(get_post_type($pid) == 'question')
  {
    global $wpdb;
    $args = array(
    'posts_per_page'   => -1,
    'post_type'        => 'answer',
    'meta_key'         => '_question_parent',
    'meta_value'       => $pid,
    'post_status'      => 'trash'
    );
    $query = new WP_Query( $args );

    while ( $query->have_posts() ){
      $query->the_post();
      $answer_key="answer_".get_the_ID();
      wp_delete_post( get_the_ID());
      $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = '$answer_key'" ) );
    }
  }
}

add_action( 'deleted_post', 'delete_answer_votes', 20 );
function delete_answer_votes( $pid ) {
  if(get_post_type($pid) == 'answer')
  {
      global $wpdb;
      $answer_key="answer_".$pid;
      $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE meta_key = '$answer_key'" ) );
  }
}

function toogle_follow_topic() {
  $term_id = $_POST['term_id'];
  $user_id = get_current_user_id();
  if($user_id){
    $queried_object = get_queried_object();
    $ftopics = get_user_meta($user_id,'following_topics',true);
    if(in_array($term_id,$ftopics)){
      $ftopics = array_diff($ftopics, array($term_id));
    }else{
      if(is_array($ftopics)){
        $ftopics[] = $term_id;
      }else{
        $ftopics = array($term_id);
      }
    }
    update_user_meta($user_id,'following_topics',$ftopics);
  }
  wp_die();
}

add_action('wp_ajax_toogle_follow_topic', 'toogle_follow_topic');
add_action('wp_ajax_nopriv_toogle_follow_topic', 'toogle_follow_topic');