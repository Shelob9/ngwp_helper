<?php
/**
 * Functions for this plugins
 *
 * @package   @ngwp_helper
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2015 Josh Pollock
 */

/**
 * Add our routes.
 *
 * @since 0.0.1
 *
 * @uses "wp_json_server_before_serve" filter
 */
add_action( 'wp_json_server_before_serve', function (  ) {
	$class = new \ngwp\url_route(  );
	add_filter( 'json_endpoints', array( $class, 'register_routes' ), 0 );

}, 10, 1 );

