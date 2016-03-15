<?php
 global $affiliates_options, $affiliates_version, $IXAP0, $IXAP1; if ( !isset( $IXAP1 ) ) { $IXAP1 = array(); } if ( !isset( $IXAP0 ) ) { $IXAP0 = AFFILIATES_EXT_VERSION; } add_action( 'init', 'affiliates_pro_version_check' ); function affiliates_pro_version_check() { global $IXAP0, $IXAP1; $IXAP2 = get_option( 'affiliates_pro_plugin_version', null ); $IXAP0 = AFFILIATES_EXT_VERSION; if ( strcmp( $IXAP2, $IXAP0 ) < 0 ) { if ( affiliates_pro_update( $IXAP2 ) ) { update_option( 'affiliates_pro_plugin_version', $IXAP0 ); } else { $IXAP1[] = '<div class="error">Updating Affiliates Ext FAILED.</div>'; } } } function affiliates_pro_admin_notices() { global $IXAP1; if ( !empty( $IXAP1 ) ) { foreach ( $IXAP1 as $IXAP3 ) { echo $IXAP3; } } } add_action( 'admin_notices', 'affiliates_pro_admin_notices' ); function affiliates_pro_activate( $IXAP4 = false ) { if ( is_multisite() && $IXAP4 ) { $IXAP5 = affiliates_get_blogs(); foreach ( $IXAP5 as $IXAP6 ) { switch_to_blog( $IXAP6 ); wp_cache_reset(); affiliates_pro_setup(); restore_current_blog(); } } else { affiliates_pro_setup(); } } function affiliates_pro_setup() { global $affiliates_db, $wpdb; if ( affiliates_pro_check_dependencies() ) { $IXAP7 = null; $IXAP8 = null; if ( ! empty( $wpdb->charset ) ) { $IXAP7 = $wpdb->charset; } if ( ! empty( $wpdb->collate ) ) { $IXAP8 = $wpdb->collate; } $affiliates_db->create_tables( $IXAP7, $IXAP8 ); } } function affiliates_pro_wpmu_new_blog( $IXAP6, $IXAP9 ) { if ( is_multisite() ) { if ( affiliates_is_sitewide_plugin() ) { switch_to_blog( $IXAP6 ); wp_cache_reset(); affiliates_pro_setup(); restore_current_blog(); } } } function affiliates_pro_delete_blog( $IXAP6, $IXAP10 = false ) { if ( is_multisite() ) { if ( affiliates_is_sitewide_plugin() ) { switch_to_blog( $IXAP6 ); wp_cache_reset(); affiliates_pro_cleanup( $IXAP10 ); restore_current_blog(); } } } register_activation_hook( AFFILIATES_PRO_FILE, 'affiliates_pro_activate' ); add_action( 'wpmu_new_blog', 'affiliates_pro_wpmu_new_blog', 11, 2 ); add_action( 'delete_blog', 'affiliates_pro_delete_blog', 10, 2 ); function affiliates_pro_update( $IXAP2 ) { return true; } remove_action( 'deactivate_' . plugin_basename( AFFILIATES_PRO_FILE ), 'affiliates_deactivate' ); register_deactivation_hook( AFFILIATES_PRO_FILE, 'affiliates_pro_deactivate' ); function affiliates_pro_deactivate( $IXAP4 = false ) { if ( is_multisite() && $IXAP4 ) { if ( get_option( 'aff_delete_network_data', false ) ) { $IXAP5 = affiliates_get_blogs(); foreach ( $IXAP5 as $IXAP6 ) { switch_to_blog( $IXAP6 ); wp_cache_reset(); affiliates_pro_cleanup( true ); restore_current_blog(); } } } else { affiliates_pro_cleanup(); } affiliates_deactivate( $IXAP4 ); } function affiliates_pro_cleanup( $IXAP11 = false ) { global $affiliates_db; $IXAP12 = get_option( 'aff_delete_data', false ) || $IXAP11; if ( $IXAP12 ) { $affiliates_db->drop_tables(); delete_option( 'affiliates_pro_plugin_version' ); delete_option( Affiliates_Referral::IXAP13 ); delete_option( Affiliates_Referral::IXAP14 ); } } add_action( 'init', 'affiliates_pro_init' ); function affiliates_pro_init() { global $IXAP1; load_plugin_textdomain( AFFILIATES_PRO_PLUGIN_DOMAIN, null, AFFILIATES_PLUGIN_NAME . '/lib/ext/languages' ); affiliates_pro_check_dependencies(); } function affiliates_pro_check_dependencies() { global $IXAP1; $IXAP15 = true; $active_plugins = get_option( 'active_plugins', array() ); $IXAP16 = in_array( 'affiliates/affiliates.php', $active_plugins ); if ( is_multisite() ) { $IXAP17 = get_site_option( 'active_sitewide_plugins', array() ); $IXAP16 = $IXAP16 || key_exists( 'affiliates/affiliates.php', $IXAP17 ); } if ( $IXAP16 ) { $IXAP1[] = "<div class='error'>" . __( 'The <a href="http://www.itthinx.com/plugins/affiliates" target="_blank">Affiliates</a> plugin must be deactivated or removed.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</div>"; include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); deactivate_plugins( AFFILIATES_PLUGIN_BASENAME ); $IXAP15 = false; } if ( function_exists( 'fake_bcadd' ) ) { if ( isset( $_GET['page'] ) ) { if ( ( "affiliates-admin-options" == $_GET['page'] ) || ( "affiliates-admin-settings" == $_GET['page'] ) ) { $IXAP1[] = "<div class='error'>" . __( 'You are running PHP with <a target="_blank" href="http://www.php.net/manual/en/book.bc.php">BCMath Arbitrary Precision Mathematics</a> disabled. Your <strong>Affiliates</strong> plugin will use substitute functions, but you should seriously consider getting BCMath enabled to avoid loss of precision.', AFFILIATES_PRO_PLUGIN_DOMAIN ) . "</div>"; } } } return $IXAP15; } if ( !function_exists( 'bcadd' ) ) { include_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/includes/fake_bcmath.php' ); } require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/interfaces.php' ); require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/abstract/abstract.php' ); require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/wordpress/wordpress.php' ); require_once( AFFILIATES_CORE_LIB . '/class-affiliates-utility.php' ); require_once( AFFILIATES_CORE_LIB . '/class-affiliates-pagination.php' ); require_once( AFFILIATES_CORE_LIB . '/class-affiliates-date-helper.php'); require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/wordpress/class-affiliates-affiliate-stats-widget.php' ); add_action( 'widgets_init', 'affiliates_pro_widgets_init' ); require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/includes/class-affiliates-notifications.php' ); function affiliates_pro_widgets_init() { register_widget( 'Affiliates_Affiliate_Stats_Widget' ); } add_action( 'admin_init', 'affiliates_pro_admin_init' ); function affiliates_pro_admin_init() { global $IXAP0; wp_register_style( 'smoothness', AFFILIATES_CORE_URL . '/css/smoothness/jquery-ui-1.8.16.custom.css', array(), $IXAP0 ); wp_register_style( 'affiliates_pro_admin', AFFILIATES_PRO_PLUGIN_URL . 'css/affiliates_pro_admin.css', array(), $IXAP0 ); } add_action( 'affiliates_admin_menu', 'affiliates_pro_affiliates_admin_menu' ); function affiliates_pro_affiliates_admin_menu( $IXAP18 ) { foreach ( $IXAP18 as $IXAP19 ) { add_action( 'admin_print_styles-' . $IXAP19, 'affiliates_pro_admin_print_styles' ); add_action( 'admin_print_scripts-' . $IXAP19, 'affiliates_pro_admin_print_scripts' ); } } add_filter( 'affiliates_add_submenu_page_function', 'affiliates_pro_affiliates_add_submenu_page_function' ); function affiliates_pro_affiliates_add_submenu_page_function( $IXAP20 ) { if ( $IXAP20 == 'affiliates_admin_affiliates' ) { $IXAP21 = new Affiliates_Affiliates_WordPress(); return array( $IXAP21, 'view' ); } else { return $IXAP20; } } function affiliates_pro_admin_print_styles() { wp_enqueue_style( 'smoothness' ); wp_enqueue_style( 'affiliates_pro_admin' ); } function affiliates_pro_admin_print_scripts() { global $IXAP0; wp_enqueue_script( 'datepicker', AFFILIATES_PRO_PLUGIN_URL . 'js/jquery.ui.datepicker.min.js', array( 'jquery', 'jquery-ui-core' ), $IXAP0 ); wp_enqueue_script( 'datepickers', AFFILIATES_PRO_PLUGIN_URL . 'js/datepickers.js', array( 'jquery', 'jquery-ui-core', 'datepicker' ), $IXAP0 ); wp_enqueue_script( 'jquery-corner', AFFILIATES_PRO_PLUGIN_URL . 'js/jquery.corner.js', array( 'jquery', 'jquery-ui-core' ), $IXAP0 ); } add_action( 'wp_enqueue_scripts', 'affiliates_pro_wp_enqueue_scripts' ); function affiliates_pro_wp_enqueue_scripts() { global $IXAP0; wp_register_style( 'affiliates-pro', AFFILIATES_PRO_PLUGIN_URL . 'css/affiliates_pro.css', array(), AFFILIATES_EXT_VERSION ); wp_register_style( 'smoothness', AFFILIATES_CORE_URL . 'css/smoothness/jquery-ui-1.8.16.custom.css', array(), AFFILIATES_EXT_VERSION ); wp_register_script( 'excanvas', AFFILIATES_PLUGIN_URL . 'js/graph/flot/excanvas.min.js', array( 'jquery' ), AFFILIATES_EXT_VERSION ); wp_register_script( 'flot', AFFILIATES_PLUGIN_URL . 'js/graph/flot/jquery.flot.min.js', array( 'jquery' ), AFFILIATES_EXT_VERSION ); wp_register_script( 'flot-resize', AFFILIATES_PLUGIN_URL . 'js/graph/flot/jquery.flot.resize.min.js', array( 'jquery', 'flot' ), AFFILIATES_EXT_VERSION ); wp_register_script( 'datepicker', AFFILIATES_CORE_URL . 'js/jquery.ui.datepicker.min.js', array( 'jquery', 'jquery-ui-core' ), AFFILIATES_EXT_VERSION, true ); wp_register_script( 'datepickers', AFFILIATES_CORE_URL . 'js/datepickers.js', array( 'jquery', 'jquery-ui-core', 'datepicker' ), AFFILIATES_EXT_VERSION, true ); } add_filter( 'affiliates_footer', 'affiliates_pro_affiliates_footer' ); function affiliates_pro_affiliates_footer( $IXAP22 ) { return '<div class="affiliates-pro-footer"><div class="affiliates-pro">Powered by <a href="http://www.itthinx.com/plugins/affiliates-pro" target="_blank"><img src="http://www.itthinx.com/img/affiliates-pro/affiliates-pro.png" alt=""/>Affiliates Pro</a><br/><span style="font-size:0.8em">&#169; Copyright <em>Kento</em> <a href="http://www.itthinx.com">www.itthinx.com</a><br/></span><span style="font-size:0.7em">If you have not been granted a license DO NOT USE this plugin until you have BEEN GRANTED A LICENSE.<br/> * Use of this plugin without a granted license constitutes an act of COPYRIGHT INFRINGEMENT and LICENSE VIOLATION and may result in legal action taken against the offending party.<br/>Being granted a license is GOOD because you will get support and contribute to the development of useful free and premium themes and plugins that you will be able to enjoy.<br/>Thank you! Visit <a href="http://www.itthinx.com">www.itthinx.com</a> for more information.</span></div></div>'; } 