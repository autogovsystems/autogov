<?php
// Add function to register event to WordPress init
add_action( 'init', 'register_daily_revision_votographies_event');
function register_daily_revision_votographies_event() {
	if( !wp_next_scheduled( 'send_mail_votography' ) ) {
		wp_schedule_event( time(), 'daily', 'send_mail_votography' );
	}
}

add_action( 'send_mail_votography', 'send_mail_votography' );
function send_mail_votography() {
  $start = date('Y-m-d');
  $end = date('Y-m-d', strtotime($start. ' + 1 days'));;
	$args = array(
		'post_type' => 'question',
		'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => '_date_votography',
            'value' => $end,
            'type' => 'DATE'
        ),
		)
	);
	$posts = new WP_Query( $args );
  if($posts->have_posts()){
		$links_question = '';
		while ( $posts->have_posts() ){
			$posts->the_post();
			$links_question .= '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
	 	}
		wp_reset_postdata();
		$all_users = get_users();
		$emails = '';
		foreach ($all_users as $user) {
			$emails .= esc_html($user->user_email).',';
		}
		$email = WP_Mail::init()
			->to('noreply@autogov.systems')
			->bcc($emails)
			->subject(__('Vontests close to his votography. ','autogov'))
			->template(get_template_directory() .'/emails/vontest_to_close.php', [
					'list_vontests' => $links_question
			])
			->send();
	}
}
