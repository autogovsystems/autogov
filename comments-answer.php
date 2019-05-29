<div class="comments row">
	<?php if (post_password_required()) : ?>
		<div class="col-12">
			<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?></p>
		</div>
	<?php return; endif; ?>

<?php if (have_comments()){ ?>
	<div class="col-12 mx-auto">
		<!--<h3><?php comments_number(); ?></h3>-->
		<?php
		$args = array('type'=>'comment',
		'callback'=>'html5blankcomments');
		$comment_pro = array('type'=>'comment', 'callback'=>'comments_for_answers', 'meta_key' => '_comment_type', 'meta_value' => 'pro');
		$comment_contra = array('type'=>'comment', 'callback'=>'comments_for_answers', 'meta_key' => '_comment_type', 'meta_value' => 'con');
		 ?>
		 <div class="row">
			<div class="comments_pro col-6">
				<strong><?php _e('PRO','autogov'); ?></strong>
				<ul>
					<?php
					if ( function_exists( 'hmn_cp_the_sorted_comments' ) ) {
						hmn_cp_the_sorted_comments($comment_pro);
					} else {
						//wp_list_comments($args,$comment_pro);
					}
					 ?>
				</ul>
			</div>
			<div class="comments_con col-6">
				<strong><?php _e('CONTRA','autogov'); ?></strong>
				<ul>
					<?php
					if ( function_exists( 'hmn_cp_the_sorted_comments' ) ) {
						hmn_cp_the_sorted_comments($comment_contra);
					} else {
						//wp_list_comments($args,$comment_contra);
					}
			 		?>
				</ul>
			</div>
		</div>
	</div>
<?php }elseif ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) { var_dump(post_type_supports( get_post_type(), 'comments' ));?>
	<div class="col-12">
		<p><?php _e( 'Comments are closed here.', 'autogov' ); ?></p>
	</div>
<?php }elseif ( comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
	<div class="col-12 titular text-center ">
		<h2><?php _e( 'No comments yet.<br/><strong>Be the first!</strong>', 'html5blank' ); ?></h2>
	</div>
<?php } ?>
<?php if ( comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) && is_user_logged_in() ) { ?>
<div class="col-12 text-center">
	<a class="button grey" id="open-comment-button" data-toggle="collapse" data-target=".comment_form" href="#"><?php _e( 'Post a comment', 'autogov' ); ?></a>
</div>
<script>
jQuery(document).ready(function(){
	jQuery('.comment_form').on('show.bs.collapse', function () {
		jQuery('.titular').hide();
		jQuery('#open-comment-button').hide();
	});
});
</script>
	<div class="comment_form collapse col-12 col-md-6 mx-auto">
		<?php comment_form(); ?>
	</div>
<?php } ?>
</div>
