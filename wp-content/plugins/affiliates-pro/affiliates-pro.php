<?php
/**
 * affiliates-pro.php
 * 
 * Copyright (c) 2011,2012 "kento" Karim Rahimpur www.itthinx.com
 * 
 * This code is provided subject to the license granted.
 * Unauthorized use and distribution is prohibited.
 * Parts of this code are released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 * 
 * =============================================================================
 * 
 * You MUST be granted a license by the copyright holder for those parts that
 * are not provided under the GPLv3 license.
 * 
 * If you have not been granted a license DO NOT USE this plugin until you have
 * BEEN GRANTED A LICENSE.
 * 
 * Use of this plugin without a granted license constitutes an act of COPYRIGHT
 * INFRINGEMENT and LICENSE VIOLATION and may result in legal action taken
 * against the offending party.
 * 
 * Being granted a license is GOOD because you will get support and contribute
 * to the development of useful free and premium themes and plugins that you
 * will be able to enjoy.
 * 
 * Thank you!
 * 
 * Visit www.itthinx.com for more information.
 * 
 * =============================================================================
 * 
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This header and all notices must be kept intact.
 * 
 * @author Karim Rahimpur
 * @package affiliates-pro
 * @since affiliates-pro 1.0.0
 *
 * Plugin Name: Affiliates Pro
 * Plugin URI: http://www.itthinx.com/plugins/affiliates-pro
 * Description: The Affiliates Pro plugin provides advanced tools to manage an affiliate program.
 * Version: 2.7.1
 * Author: itthinx
 * Author URI: http://www.itthinx.com
 * Donate-Link: http://www.itthinx.com/plugins/affiliates-pro
 * License: Only files that state so explicitly in their header are licensed under GPLv3, the rest is subject to the license granted.
 */
if ( !defined( 'AFFILIATES_CORE_VERSION' ) ) {
	define( 'AFFILIATES_CORE_VERSION', '2.7.1' );
	define( 'AFFILIATES_EXT_VERSION', '2.7.1' );
	define( 'AFFILIATES_PLUGIN_NAME', 'affiliates-pro' );

	if ( !function_exists( 'itthinx_plugins' ) ) {
		require_once 'itthinx/itthinx.php';
	}
	itthinx_plugins( __FILE__ );
	
	// core
	define( 'AFFILIATES_FILE', __FILE__ );
	define( 'AFFILIATES_CORE_DIR', plugin_dir_path( AFFILIATES_FILE ) );
	define( 'AFFILIATES_PLUGIN_BASENAME', plugin_basename( AFFILIATES_FILE ) );
	define( 'AFFILIATES_CORE_LIB', AFFILIATES_CORE_DIR . '/lib/core' );
	define( 'AFFILIATES_CORE_URL', plugin_dir_url( AFFILIATES_FILE ) );
	require_once( AFFILIATES_CORE_LIB . '/constants.php' );
	require_once( AFFILIATES_CORE_LIB . '/wp-init.php');
	// ext
	define( 'AFFILIATES_PRO_FILE', __FILE__ );
	require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/constants.php' );
	require_once( dirname( AFFILIATES_PRO_FILE ) . '/lib/ext/wp-init.php');
}
