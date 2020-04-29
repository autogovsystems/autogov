<?php

/**
 * This file represents an example of the code that themes would use to register the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme autogov
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/includes/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tgm261_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function tgm261_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'WooCommerce', // The plugin name.
			'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/woocommerce-4.0.1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'BuddyPress', // The plugin name.
			'slug'               => 'buddypress', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/buddypress-5.1.2.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'BBPress', // The plugin name.
			'slug'               => 'bbpress', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/bbpress-2.6.4.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Dokan Lite', // The plugin name.
			'slug'               => 'dokan-lite', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/dokan-lite-3.0.3.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'MyCred', // The plugin name.
			'slug'               => 'mycred', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/mycred-1.8.9.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Comment Popularity', // The plugin name.
			'slug'               => 'comment-popularity', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/comment-popularity-1.5.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'rtMedia', // The plugin name.
			'slug'               => 'buddypress-media', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/buddypress-media-4.6.1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'BuddyPress Activity As Wire', // The plugin name.
			'slug'               => 'bp-activity-as-wire', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/bp-activity-as-wire-1.0.2.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		), /*
	,
		array(
			'name'               => 'Notification', // The plugin name.
			'slug'               => 'notification', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/notification.5.2.4.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Notification BBPress', // The plugin name.
			'slug'               => 'notification-bbpress', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/notification-bbpress.2.0.1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		)


		,
		array(
			'name'               => 'Dokan Pro', // The plugin name.
			'slug'               => 'dokan-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/dokan-pro-2.9.2.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'WooCommerce Bookings', // The plugin name.
			'slug'               => 'woocommerce-bookings', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/woocommerce-bookings-1.12.2.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Dokan Woocommerce Bookings', // The plugin name.
			'slug'               => 'dokan-wc-booking', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/dokan-wc-booking-1.4.4.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		)*/

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgm261',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => 'Revisa el manual de Autogov antes de empezar a instalar plugins. ¡Deben instalarse en un orden determinado!',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tgm261' ),
			'menu_title'                      => __( 'Install Plugins', 'tgm261' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'tgm261' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'tgm261' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tgm261' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'tgm261'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'tgm261'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'tgm261'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'tgm261'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'tgm261'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'tgm261'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'tgm261'
			),
			'update_link'                     => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'tgm261'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'tgm261'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'tgm261' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tgm261' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'tgm261' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'tgm261' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'tgm261' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'tgm261' ),
			'dismiss'                         => __( 'Dismiss this notice', 'tgm261' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'tgm261' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgm261' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );

	/*plugin autoconfig*/
	function after_activated_plugin( $plugin, $network_wide ) {

		switch ( $plugin ) {
			case 'buddypress/bp-loader.php':
				update_option( '_bp_theme_package_id', 'legacy' );
				update_option( 'bp-disable-profile-sync', 0 );
				update_option( 'bp-disable-avatar-uploads', 0 );
				update_option( 'bp-disable-cover-image-uploads', 0 );
				update_option( 'bp-disable-group-avatar-uploads', 0 );
				update_option( 'bp-disable-group-cover-image-uploads', 0 );
				update_option( 'bp-disable-account-deletion', 0 );
				update_option( 'bp-disable-blogforum-comments', 0 );
				update_option( 'bp_restrict_group_creation', 0 );
				// establezco valores por defecto de votaciones: máx 10 puntos por vontest y 4 por respuesta
				break;
			case 'buddypress-media/index.php':
				// el rtmedia tiene la configuración por defecto
				// aqui hacía la config de componentes del buddypress, pero da mil problemas. Lo dejo comentado por si en el futuro se revisa. Se deberán activar todos los componentes a mano durante la instalación.
				/*
				$components = array();
				$components['xprofile']=1;
				$components['settings']=1;
				$components['friends']=1;
				$components['messages']=1;
				$components['activity']=1;
				$components['notifications']=1;
				$components['groups']=1;
				$components['members']=1;
				update_option('bp-active-components',$components);*/
				// creación y vinculación de la página Groups
				/*
				$post_info = array(
					'post_title' => 'Groups',
					'post_name' => 'groups',
					'post_content' => '',
					'post_status' => 'publish',
					'post_date' => date('Y-m-d H:i:s'),
					'post_author' => 1,
					'post_type' => 'page'
				);
				$groups_page_id=wp_insert_post($post_info);
				$bp_pages = get_option('bp-pages');
				$bp_pages['groups'] = $groups_page_id;
				update_option('bp-pages',$bp_pages);*/
				break;
			case 'bbpress/bbpress.php':
				// son todas configuraciones por defecto
				// lo que sí hay que hacer manualmente es crear un nuevo forum de tipo categoría y asignarlo para los grupos de buddypress
				// documentacion en https://codex.buddypress.org/getting-started/installing-group-and-sitewide-forums/#c-set-up-group-forums-only
				break;
			case 'comment-popularity/comment-popularity.php':
				break;
			case 'mycred/mycred.php':
				// los tipos de punto (voins, applauds) se deberán crear a mano siguiendo el wizard
				// posteriormente se deberán activar los addons de Banking y Gateway para los Voin.
				break;
			case 'woocommerce/woocommerce.php':
				// seguir el wizard :D
				break;
			case 'dokan-lite/dokan.php':
				// selling options
				$selling_options                           = get_option( 'dokan_selling' );
				$selling_options['commission_type']        = 'flat';
				$selling_options['admin_percentage']       = '0';
				$selling_options['disable_product_popup']  = 'on';
				$selling_options['disable_welcome_wizard'] = 'on';
				update_option( 'dokan_selling', $selling_options );
				// withdraw options
				$withdraw_options                               = get_option( 'dokan_withdraw' );
				$withdraw_options['withdraw_methods']['paypal'] = '';
				$withdraw_options['withdraw_methods']['bank']   = '';
				$withdraw_options['withdraw_methods']['voins']  = 'voins';
				$withdraw_options['withdraw_limit']             = '0';
				update_option( 'dokan_withdraw', $withdraw_options );
				// opciones de woocommerce
				update_option( 'woocommerce_registration_generate_username', 'no' );

				update_user_meta( 1, 'dokan_publishing', 'yes' );
				update_user_meta( 1, 'dokan_enable_selling', 'yes' );

		}
	}

	add_action( 'activated_plugin', 'after_activated_plugin', 10, 2 );
}

add_action( 'after_switch_theme', 'mytheme_setup_options' );

function mytheme_setup_options() {
	update_option( 'politics_enabled', 1 );
	update_option( 'economy_enabled', 1 );
	update_option( 'social_enabled', 1 );
	update_option( 'max_points_user_vontest', 10 );
	update_option( 'max_points_user_answer', 4 );
}
