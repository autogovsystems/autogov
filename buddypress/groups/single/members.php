<?php
/**
 * BuddyPress - Groups Members
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 3.0.0
 */

?>

<?php if ( bp_group_has_members( bp_ajax_querystring( 'group_members' ) ) ) : ?>

	<?php

	/**
	 * Fires before the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_content' ); ?>

	<style>
	.grid-container{
	display: grid;
  grid-gap: 1rem;
  grid-template-columns: 165px 165px 165px 165px 165px 165px;
  grid-template-rows: 170px;
}
</style>
	<div id="pag-top">

		<?php bp_group_total_members();?> <?php _e('Members','autogov'); ?>

	</div>

	<?php

	/**
	 * Fires before the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_group_members_list' ); ?>

	
		<div class="grid-container">
		<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<div>
				<div class="member-avatar">
					<a href="<?php bp_group_member_domain(); ?>">

						<?php bp_group_member_avatar(); ?>

					</a>
				</div>
				<div class="member-link">
					<h5><?php bp_group_member_link(); ?></h5>
				</div>
				
				<?php

				/**
				 * Fires inside the listing of an individual group member listing item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_group_members_list_item' ); ?>
			</div>
				
			

		<?php endwhile; ?>
		</div>

	

	<?php

	/**
	 * Fires after the display of the group members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-count-bottom">

			

		</div>
		
	</div>

	<?php

	/**
	 * Fires after the display of the group members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_group_members_content' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'No members were found.', 'buddypress' ); ?></p>
	</div>

<?php endif;