<?php
/**
 Plugin Name: NGWP Helper
 */
/**
 * Copyright (c) 2015 Josh Pollock (email: Josh@JoshPress.net). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NGWP_HELPER_PATH',  plugin_dir_path( __FILE__ ) );
define( 'NGWP_HELPER_URL',  plugin_dir_url( __FILE__ ) );
define( 'NGWP_HELPER_VER',  '0.0.1' );

/**
 * Load plugin if PHP is good enough, and JSON API Active
 *
 * @since 0.0.1
 *
 * @uses 'init' action
 */
add_action( 'init', 'ngwp_helper_maybe_load', 1 );
function ngwp_helper_maybe_load() {
	if ( function_exists( 'json_url' ) && version_compare( PHP_VERSION, '5.5.0' ) >= 0 ) {
		include_once( NGWP_HELPER_PATH . 'src/url_route.php' );
		include_once( NGWP_HELPER_PATH . 'src/functions.php' );
	}


}

