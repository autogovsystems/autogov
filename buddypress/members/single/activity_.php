<?php
/**
 * BuddyPress - Users Activity
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 3.0.0
 */

/**
 * Fires before the display of the member activities list.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_activity_content' ); ?>

<div class="activity" aria-live="polite" aria-atomic="true" aria-relevant="all">

	<?php bp_get_template_part( 'activity/activity-loop' ) ?>

</div><!-- .activity -->

<?php

/**
 * Fires after the display of the member activities list.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_activity_content' );
