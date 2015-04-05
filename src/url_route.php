<?php
/**
 * Add a /ngwp/url_routes endpoint with formatted route rules.
 *
 * @package   @ngwp_helper
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2015 Josh Pollock
 */

namespace ngwp;

class url_route {

	/**
	 * Register endpoints for JSON REST API.
	 *
	 * @since 0.0.1
	 *
	 * @param array $routes
	 *
	 * @return array
	 */
	public function register_routes( $routes ) {
			$routes[ '/ngwp/url_route' ] = array(
				array( array( $this, 'get_routes'), \WP_JSON_Server::READABLE ),
			);


			return $routes;

	}

	/**
	 * Get the routes
	 *
	 * @since 0.0.1
	 *
	 * @return array
	 */
	public function get_routes() {
		global $wp_rewrite;
		$rules = $wp_rewrite->extra_permastructs;
		$post_types = get_post_types();
		$taxonomies = get_taxonomies();
		$routes = array();
		foreach( $rules as $content_type => $rule ) {
			$routes[] = array(
				'url' =>  '/:type/:ignore/:name/',
				'template' > "single",
				'endpoint' => '',
				'params' => array(
					'type' => '',
					'name' => 'name'
				)

			);
		}

		return $routes;

	}

}
