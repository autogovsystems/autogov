<?php
function forum_topic_image() {
	if ( 'topic' == get_post_type() ) {
	    global $post;
	    if ( has_post_thumbnail($post->ID) )
	        echo get_the_post_thumbnail($post->ID,'thumbnail',array('class' => 'alignleft forum-icon'));
	}
}
add_action('bbp_theme_before_topic_title','forum_topic_image');