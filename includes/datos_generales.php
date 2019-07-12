<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('admin_menu', 'datos_generales');
function datos_generales() {
    add_menu_page('datos_generales', __('Community Parameters','autogov'), 'manage_options', 'datos_generales', 'render_menu', 'dashicons-admin-settings', 2);
}

function render_menu() {
    $fieldstosave = array('public_community','open_register','max_points_user_vontest','max_points_user_answer','logo_comunidad','politics_enabled','economy_enabled','social_enabled','allow_log_votes');
    if(isset($_POST['save']) && $_POST['save']){
      foreach($fieldstosave as $f){
        if(isset($_POST[$f])){
            $opt_val = $_POST[$f];
            $opt_name = $f;
            update_option( $opt_name, $opt_val );
        }else{
          delete_option($f);
        }
      }
    } ?>
    <div class="wrap">
        <form name="form1" method="post" action="">

          <h2><?php _e('Community Parameters','autogov'); ?></h2>
          <table class="form-table">
              <tbody>
                  <tr>
                      <th><label for="comunidad_publica"><?php _e('Public community','autogov'); ?></label></th>
                      <td><input type="checkbox" name="public_community" value="1" <?php checked(1, get_option('public_community'), true); ?> /> </td>
                  </tr>
                  <tr>
                      <th><label for="registro_abierto"><?php _e('Open register','autogov'); ?></label></th>
                      <td><input type="checkbox" name="open_register" value="1" <?php checked(1, get_option('open_register'), true); ?> /> </td>
                  </tr>
                  <tr>
                      <th><label for="logo_comunidad"><?php _e('Community Logo','autogov'); ?></label></th>
                      <td>
                        <input type="hidden" name="logo_comunidad" id="logo_comunidad" value="<?php echo get_option('logo_comunidad');?>">
                        <img id="logo_img" width="150" src="<?php echo get_option('logo_comunidad');?>"><br>
                        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="<?php _e('Add or change logo','autogov'); ?>">
                      </td>
                  </tr>
                  <tr>
                    <th><label for="politics_enabled"> <?php _e('Habilitar politics','autogov'); ?> </label></th>
                    <td> <input type="checkbox" name="politics_enabled" value="1" <?php checked(1, get_option('politics_enabled'), true);?>/>   </td>
                  </tr>
                  <tr>
                    <th><label for="economy_enabled"> <?php _e('Habilitar economy','autogov'); ?> </label></th>
                    <td> <input type="checkbox" name="economy_enabled" value="1" <?php checked(1, get_option('economy_enabled'), true);?>/>   </td>
                  </tr>
                  <tr>
                    <th><label for="social_enabled"> <?php _e('Habilitar social','autogov'); ?> </label> </th>
                    <td> <input type="checkbox" name="social_enabled" value="1" <?php checked(1, get_option('social_enabled'), true);?>/>   </td>
                  </tr>
                  <tr>
                      <th><label for="allow_log_votes"><?php _e('Log votes','autogov'); ?></label><span></span></th>
                      <td><input type="checkbox" name="allow_log_votes" value="1" <?php checked(1, get_option('allow_log_votes'), true); ?> /> </td>
                  </tr>
                  <tr>
                      <th><label for="max_points_user_vontest"><?php _e('Maximum user points in each vontest (can not be modified if there is any active vontest)','autogov'); ?></label></th>
                      <td><input type="text" name="max_points_user_vontest" value="<?php echo get_option('max_points_user_vontest') ?>" class="small-text" <?php if(is_any_vontest_active()) echo 'disabled="disabled"'; ?> /></td>
                  </tr>
                  <tr>
                      <th><label for="max_points_user_answer"><?php _e('Maximum user points in each response (can not be modified if there is any active vontest)','autogov'); ?></label></th>
                      <td><input type="text" name="max_points_user_answer" value="<?php echo get_option('max_points_user_answer') ?>" class="small-text" <?php if(is_any_vontest_active()) echo 'disabled="disabled"'; ?>/></td>
                  </tr>
                  <tr>
                      <th><label for="reset_votes"><?php _e('General reset of votes','autogov'); ?></label></th>
                      <td><input type="button" id="reset_votes" name="reset_votes" value="<?php _e('Delete all votes','autogov'); ?>"/> <?php _e('ATTENTION: This will erase all active vontest votes and can not be undone','autogov'); ?></td>
                  </tr>
                  <script type="text/javascript">
                  jQuery(document).ready(function($){
                      $('#upload-btn').click(function(e) {
                          e.preventDefault();
                          var image = wp.media({
                              title: 'Logo',
                              multiple: false
                          }).open()
                          .on('select', function(e){
                              var uploaded_image = image.state().get('selection').first();
                              var image_url = uploaded_image.toJSON().url;
                              $('#logo_comunidad').val(image_url);
                              $('#logo_img').attr("src", image_url);
                          });
                      });

                      $('#reset_votes').click(function() {
                        if (confirm('<?php _e('ATTENTION: This will erase all active vontest votes and can not be undone','autogov'); ?>')){
                          $.ajax({
                            type : "post",
                            url : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                            data : {
                                action: "reset_votes"
                            },
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
                </tbody>
          </table>
          <input type="hidden" name="save" value="1">
          <input type="submit" class="button button-primary button-large" value="<?php _e('Save options','autogov'); ?>">
        </form>
    </div>
    <?php
}

function redirect_public_community(){
  global $post;
  $is_public = get_option('public_community');
  $mi_account_page = get_option('woocommerce_myaccount_page_id');
  if ((!is_user_logged_in() && $is_public !== '1') ) {
    if((isset($post) && (string)$post->ID!==$mi_account_page) || !isset($post)){
  	   header('Location:'.get_permalink( get_option('woocommerce_myaccount_page_id') ));
       exit();
    }
  }
}
