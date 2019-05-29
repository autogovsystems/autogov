<?php
/**
 * Dokan Seller registration form
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<div class="split-row form-row-wide">
    <p class="form-row form-group">
        <label for="first-name"><?php _e( 'First Name', 'dokan-lite' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="fname" id="first-name" value="<?php if ( ! empty( $postdata['fname'] ) ) echo esc_attr($postdata['fname']); ?>" required="required" />
    </p>

    <p class="form-row form-group">
        <label for="last-name"><?php _e( 'Last Name', 'dokan-lite' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text form-control" name="lname" id="last-name" value="<?php if ( ! empty( $postdata['lname'] ) ) echo esc_attr($postdata['lname']); ?>" required="required" />
    </p>
</div>

<input type="hidden" class="input-text form-control" name="shopname" id="company-name" value="<?php if ( ! empty( $postdata['shopname'] ) ) echo esc_attr($postdata['shopname']); ?>" required="required" />
<input type="hidden" class="input-text form-control" name="shopurl" id="seller-url" value="<?php if ( ! empty( $postdata['shopurl'] ) ) echo esc_attr($postdata['shopurl']); ?>" required="required" />
<input type="hidden" id="default-url" value="<?php echo home_url() . '/' . dokan_get_option( 'custom_store_url', 'dokan_general', 'store' ) . '/'; ?>">

<p class="form-row form-group form-row-wide">
    <label for="shop-phone"><?php _e( 'Phone Number', 'dokan-lite' ); ?></label>
    <input type="text" class="input-text form-control" name="phone" id="shop-phone" value="<?php if ( ! empty( $postdata['phone'] ) ) echo esc_attr($postdata['phone']); ?>" />
</p>
<?php

    $show_toc = dokan_get_option( 'enable_tc_on_reg', 'dokan_general' );

    if ( $show_toc == 'on' ) {
        $toc_page_id = dokan_get_option( 'reg_tc_page', 'dokan_pages' );
        if ( $toc_page_id != -1 ) {
            $toc_page_url = get_permalink( $toc_page_id );
?>
        <p class="form-row form-group form-row-wide">
            <input class="tc_check_box" type="checkbox" id="tc_agree" name="tc_agree" required="required">
            <label style="display: inline" for="tc_agree"><?php echo sprintf( __( 'I have read and agree to the <a target="_blank" href="%s">Terms &amp; Conditions</a>.', 'dokan-lite' ), $toc_page_url ); ?></label>
        </p>
        <?php } ?>
    <?php } ?>
<?php  do_action( 'dokan_seller_registration_field_after' ); ?>

<?php do_action( 'dokan_reg_form_field' ); ?>
<div class="hidden_dokan_role">
  <p class="form-row form-group user-role">
      <label class="radio">
          <input type="radio" name="role" value="seller" checked="checked">
          <?php _e( 'I am a vendor', 'dokan-lite' ); ?>
      </label>
      <?php do_action( 'dokan_registration_form_role', $role ); ?>
  </p>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
    $('#reg_username',).keyup(function () {
      $('#company-name').val($('#reg_username').val());
      $('#seller-url').val($('#company-name').val());
    });
    $('#company-name').val($('#reg_username').val());
    $('#seller-url').val($('#company-name').val());
});
</script>
