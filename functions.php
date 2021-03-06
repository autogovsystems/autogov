<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*
------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here
// Integración withdraw Voins MyCRED - Dokan
add_filter( 'dokan_withdraw_methods', 'add_mycred_to_dokan_withdraw' );
function add_mycred_to_dokan_withdraw( $methods ) {
	$methods['voins'] = array(
		'title'    => __( 'Voins', 'dokan-lite' ),
		'callback' => 'dokan_withdraw_method_dokan',
	);
	return $methods;
}
add_filter( 'dokan_get_seller_active_withdraw_methods', 'dokan_get_seller_mycred_withdraw_methods' );
function dokan_get_seller_mycred_withdraw_methods( $active_payment_methods ) {
	$voins = 'voins';
	array_push( $active_payment_methods, $voins );
	return $active_payment_methods;
}
/*
------------------------------------*\
	Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {

	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 700, '', true ); // Large Thumbnail
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
	add_image_size( 'small', 120, '', true ); // Small Thumbnail
	add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	/*
	add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
	));*/

	// Add Support for Custom Header - Uncomment below if you're going to use
	/*
	add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
	));*/

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Localisation Support
	load_theme_textdomain( 'autogov', get_template_directory() . '/languages' );

	// forum topic featured image
	add_post_type_support( 'topic', array( 'thumbnail' ) );

}

/*
------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function autogov_nav() {
}

function wpse_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}
	return array(
		'index.php', // Dashboard
		'datos_generales', // Datos Generales
		'edit.php', // Posts
		'edit.php?post_type=page', // Pages
		'upload.php', // Media
		'separator2', // Second separator
		'edit.php?post_type=aboutcommunity', // About this community
		'edit.php?post_type=aboutautogov', // About Autogov
		'separator1', // First separator
		'edit.php?post_type=question',
		'edit.php?post_type=answer',
		'edit.php?post_type=resolution',
		'separator-woocommerce',
		'woocommerce',
		'edit.php?post_type=product', // Pages
		'dokan', // Datos Generales
		'mycred',
		'separator-buddypress',
		'users.php', // Users
		'mycred_applauds',
		'edit.php?post_type=forum',
		'edit.php?post_type=topic',
		'edit.php?post_type=reply',
		'bp-groups',
		'bp-activity',
		'edit-comments.php', // Comments
		'edit.php?post_type=bp-email',
		'rtmedia-settings',
		'separator-last', // Last separator
		'options-general.php', // Settings
		'themes.php', // Appearance
		'tools.php', // Tools
		'plugins.php', // Plugins

	);
}
add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {

		wp_deregister_script( 'jquery-core' );
		wp_register_script( 'jquery-core', get_template_directory_uri() . '/vendor/md-bootstrap/js/jquery-3.3.1.min.js', array(), '3.1.1' );

		wp_register_script( 'conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0' ); // Conditionizr
		wp_enqueue_script( 'conditionizr' ); // Enqueue it!

		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1' ); // Modernizr
		wp_enqueue_script( 'modernizr' ); // Enqueue it!

		wp_register_script( 'bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '1.0.0' ); // Custom scripts
		wp_enqueue_script( 'bootstrap-popper' ); // Enqueue it!

		wp_register_script( 'slickjs', get_template_directory_uri() . '/vendor/flickity/flickity.pkgd.min.js', array( 'jquery' ), '1.0.0' ); // Custom scripts
		wp_enqueue_script( 'slickjs' ); // Enqueue it!

		wp_register_script( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '1.0.0' ); // Custom scripts
		wp_enqueue_script( 'bootstrap' ); // Enqueue it!

		wp_register_script( 'md-bootstrap', get_template_directory_uri() . '/vendor/md-bootstrap/js/mdb.min.js', array( 'jquery' ), '1.0.0', true ); // Custom scripts
		wp_enqueue_script( 'md-bootstrap' ); // Enqueue it!

		wp_register_script( 'jquery-chosen', get_template_directory_uri() . '/vendor/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.0.0', true ); // Custom scripts
		wp_enqueue_script( 'jquery-chosen' ); // Enqueue it!

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_register_style( 'jquery-ui-2', 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
		wp_enqueue_style( 'jquery-ui-2' );
		wp_enqueue_style( 'jquery-ui-datepicker' );

		wp_register_script( 'html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0' ); // Custom scripts
		wp_enqueue_script( 'html5blankscripts' ); // Enqueue it!

	} elseif ( is_admin() ) {
		wp_register_script( 'jquery-chosen', get_template_directory_uri() . '/vendor/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.0.0', true ); // Custom scripts
		wp_enqueue_script( 'jquery-chosen' ); // Enqueue it!
	}

}
function load_custom_wp_admin_style() {
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_register_style( 'jquery-ui-2', 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_style( 'jquery-ui-2' );
	wp_enqueue_style( 'jquery-ui-datepicker' );
	wp_register_style( 'jquery-chosen', get_template_directory_uri() . '/vendor/chosen/chosen.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'jquery-chosen' ); // Enqueue it!
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
	 /*
	if (is_page('pagenamehere')) {
		wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
		wp_enqueue_script('scriptname'); // Enqueue it!
	}*/

	// if(is_front_page())
	// {
		// wp_register_script('tabs_market', get_template_directory_uri() . '/js/tabs_market.js', array(), '1.0.0'); // Conditional script(s)
		// wp_enqueue_script('tabs_market'); // Enqueue it!
	// }
}

// Load HTML5 Blank styles
function html5blank_styles() {
	wp_register_style( 'normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'normalize' ); // Enqueue it!

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'bootstrap' ); // Enqueue it!

	wp_register_style( 'mdbootstrap', get_template_directory_uri() . '/vendor/md-bootstrap/css/mdb.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'mdbootstrap' ); // Enqueue it!

	wp_register_style( 'jquery-chosen', get_template_directory_uri() . '/vendor/chosen/chosen.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'jquery-chosen' ); // Enqueue it!

	wp_register_style( 'flickity', get_template_directory_uri() . '/vendor/flickity/flickity.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'flickity' ); // Enqueue it!

	wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.9.0/css/all.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'fontawesome' ); // Enqueue it!

	wp_register_style( 'html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'html5blank' ); // Enqueue it!

}

// Register HTML5 Blank Navigation
function register_html5_menu() {
	/*
	register_nav_menus(array( // Using array to specify more menus if needed
		'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
		'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
		'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
	));*/
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}

function is_current_page_virtual( $to_check ) {
	global $wp;
	if ( array_key_exists( $to_check, $wp->query_vars ) ) {
		return true;
	}
	return false;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers WordPress Theme
function add_slug_to_body_class( $classes ) {
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > -1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// If Dynamic Sidebar Exists
/*
if (function_exists('register_sidebar'))
{
	// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' => __('Widget Area 1', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Widget Area 2', 'html5blank'),
		'description' => __('Description for this widget-area...', 'html5blank'),
		'id' => 'widget-area-2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}*/

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action(
		'wp_head',
		array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style',
		)
	);
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
	 global $wp_query;
	$big = 999999999;
	echo paginate_links(
		array(
			'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format'  => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total'   => $wp_query->max_num_pages,
		)
	);
}

// Custom Excerpts
function html5wp_index( $length ) {
	// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<p>' . $output . '</p>';
	echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article( $more ) {
	global $post;
	return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'View Article', 'html5blank' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
	 $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar( $avatar_defaults ) {
	$myavatar                     = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[ $myavatar ] = 'Custom Gravatar';
	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
	if ( ! is_admin() ) {
		if ( is_singular() and comments_open() and ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
// Custom comment title
add_filter(
	'comment_form_defaults',
	function( $d ) {
		global $post;
		if ( get_post_type( $post ) == 'question' ) {
			$d['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '<i class="fa fa-question-circle tips inline" title="' . __( 'Add comment for the question', 'autogov' ) . '" data-placement="left" aria-hidden="true"></i></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
		} elseif ( get_post_type( $post ) == 'answer' ) {
			$d['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '<i class="fa fa-question-circle tips inline" title="' . __( 'Add comment fot the answer', 'autogov' ) . '" data-placement="left" aria-hidden="true"></i></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
		}
		return $d;
	}
);
// Custom Comments Callback
function comments_for_question( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag; ?> <?php comment_class( array( empty( $args['has_children'] ) ? '' : 'parent' ) ); ?> id="comment-<?php comment_ID(); ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-body row">
	<?php endif; ?>
	<div class="comment-author vcard col-2">
	<a href="<?php echo bp_core_get_userlink( $user->ID, false, true ); ?>">
		<?php
		if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment );}
		?>
	</a>
	<?php
	$user = get_user_by( 'email', get_comment_author_email() );
	printf( __( '<cite class="fn">%s</cite>' ), bp_core_get_userlink( $user->ID ) );
	?>
	<?php echo '<br />'; ?>
	<?php
	printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() )
	?>
	</a>
	<?php
	edit_comment_link( __( '(Edit)' ), '  ', '' );
	?>
	<?php if ( $comment->comment_approved == '0' ) : ?>
	  <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
	  <br />
  <?php endif; ?>
  </div>

	<div class="comment-meta commentmetadata 
	<?php
	if ( $args['has_children'] ) {
		?>
		col-8
		<?php
	} else {
		?>
		col-10<?php } ?>">
	<?php comment_text(); ?>
	<?php hmn_cp_the_comment_upvote_form(); ?>
	<?php if ( is_user_logged_in() ) { ?>
		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		</div>
	<?php } ?>
	  </div>
	<?php if ( 'div' != $args['style'] ) : ?>
	   </div>
	<?php endif; ?>
	<?php
	/*
	if($args['has_children']){ ?>
	</div>
	</div>
	<?php }*/
	?>
	<?php
}


// Custom Comments Callback
function comments_for_answers( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag; ?> <?php comment_class( array( empty( $args['has_children'] ) ? '' : 'parent' ) ); ?> id="comment-<?php comment_ID(); ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-body row">
	<?php endif; ?>
	<?php
	/*
	if($args['has_children']){ ?>
	<div class="col-12 ml-auto">
	  <div class="row">
	<?php }*/
	?>

	<div class="comment-meta commentmetadata col-12">
	<div class="comment-author vcard">
		<div>
		<?php
		$user = get_user_by( 'email', get_comment_author_email() );
		printf( __( '<cite class="fn">%s</cite>' ), bp_core_get_userlink( $user->ID ) );
		?>
	  <?php hmn_cp_the_comment_author_karma(); ?></div>
	  <div>
	  <?php
		printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() )
		?>
		</a>
		<?php
		edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>
	  </div>
	  <?php if ( $comment->comment_approved == '0' ) : ?>
		  <div><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em></div>
	  <?php endif; ?>
	</div>
	<?php comment_text(); ?>
	<?php hmn_cp_the_comment_upvote_form(); ?>
	<?php if ( is_user_logged_in() ) { ?>
		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		</div>
	<?php } ?>
	  </div>
	<?php if ( 'div' != $args['style'] ) : ?>
	   </div>
	<?php endif; ?>
	</<?php echo $tag; ?>>
	<?php
	/*
	if($args['has_children']){ ?>
	</div>
	</div>
	<?php }*/
	?>
	<?php
}

function add_custom_tax_sort() {
	require_once 'includes/custom-taxonomy-sort/custom-taxonomy-sort.php';
}
add_action( 'init', 'add_custom_tax_sort' );

function localize_ajax() {
	wp_localize_script( 'html5blankscripts', 'frontend_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'localize_ajax' );

/*
------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'init', 'html5blank_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_print_scripts', 'html5blank_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'html5blank_styles', 50 ); // Add Theme Stylesheet
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

add_action( 'init', 'register_html5_menu' ); // Add HTML5 Blank Menu
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'html5wp_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters
add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 'html5_blank_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'html5_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode( 'html5_shortcode_demo', 'html5_shortcode_demo' ); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode( 'html5_shortcode_demo_2', 'html5_shortcode_demo_2' ); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*
------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo( $atts, $content = null ) {
	return '<div class="shortcode-demo">' . do_shortcode( $content ) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2( $atts, $content = null ) {
	// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
	return '<h2>' . $content . '</h2>';
}


function template_chooser( $template ) {
	global $wp_query;
	$post_type = get_query_var( 'post_type' );
	if ( $wp_query->is_search && $post_type == 'product' ) {
		return locate_template( 'search.php' );  // redirect to archive-search.php
	}
	return $template;
}
add_filter( 'template_include', 'template_chooser', 999 );

// Custom logo
function my_custom_login_logo() {
	$logo = get_option( 'logo_comunidad' );
	if ( $logo !== '' ) {
		$logo = get_bloginfo( 'template_url' ) . '/img/default-logo-community.png';
	}
	  echo '<style type="text/css">
          h1 a { background-image:url(' . $logo . ') !important; }
        </style>';
}
add_action( 'login_head', 'my_custom_login_logo' );

// Custom login
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
	return '[url]';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

add_filter( 'login_url', 'my_login_page', 10, 3 );
function my_login_page( $login_url, $redirect, $force_reauth ) {
	$pagina_myaccount = get_option( 'woocommerce_myaccount_page_id' );
	if ( $pagina_myaccount && $pagina_myaccount !== '' ) {
		return get_permalink( get_option( 'woocommerce_myaccount_page_id' ) . '/?redirect_to=' . $redirect );
	}
	return $login_url;
}

// Restrict section Functions
function politics_enabled() {
	return get_option( 'politics_enabled' );
}

function economy_enabled() {
	return get_option( 'economy_enabled' );
}

function social_enabled() {
	return get_option( 'social_enabled' );
}

/*
------------------------------------*\
	Includes AutoGOV
\*------------------------------------*/

// Disable all updates
require_once 'includes/disable-updates.php';

// Página de parámetros de la comunidad
require_once 'includes/datos_generales.php';

// Página donde se añade roles y se capan diversas funciones
require_once 'includes/roles.php';

// Class Email
require_once 'includes/classes/class.wpmail.php';


// woocommerce
require_once 'includes/woocommerce.php';

// Páginas de texto para autogov y comunidad
require_once 'includes/about-autogov.php';
require_once 'includes/about-community.php';

// Custom field tipo para market
require_once 'includes/cf_tipo.php';

// vontests
require_once 'includes/vontests.php';

// image tags
require_once 'includes/tax_image.php';

// buddypress
require_once 'includes/buddypress.php';

// bbpress
require_once 'includes/bbpress.php';

// virtual pages
require_once 'includes/virtual-pages.php';

// mycred
require_once 'includes/mycred.php';

// dokan
require_once 'includes/dokan.php';

// agovlogger
require_once 'includes/logger.php';

// statistics
require_once 'includes/statistics.php';

// cron
require_once 'includes/cron.php';

// tgm plugin activation
require_once 'includes/tgm.php';
