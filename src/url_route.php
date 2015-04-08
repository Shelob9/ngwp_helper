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
		$defintions = array_combine( str_replace( '=', '',$wp_rewrite->queryreplace ), $wp_rewrite->rewritecode );

		$post_types = get_post_types();
		$taxonomies = get_taxonomies();

		$routes = array();
		foreach( $rules as $content_type => $rule ) {

			$rule_parsed = explode( '/', $rule[ 'struct'] );
			end( $rule_parsed );
			$key = key( $rule_parsed );
			$name = array_search( $rule_parsed[ $key ], $defintions );

			$user_archive = false;
			switch ( $name ) {
				case 'tag' == $name :
					$lookup_name = 'post_tag';
					break;
				case 'p' == $name :
					$lookup_name = 'post';
					break;
				case 'pagename' == $name :
					$lookup_name = 'page';
					break;
				case 'category_name' == $name :
					$lookup_name = 'category';
					break;
				case 'author_name' == $name :
					$user_archive = true;
					$lookup_name = 'user';
					break;
				default :
					$lookup_name = $name;
			}

			if ( in_array( $lookup_name, $taxonomies ) ) {
				$type = 'taxonomy';
				$end_point = sprintf( 'posts?filter[%1s]=%%', $name );
				$tax_info = get_taxonomy( $lookup_name );
				if ( is_object( $tax_info ) ) {
					if ( ! empty( $tax_info->object_type ) ) {
						$post_types_tax = $tax_info->object_type;


						$post_types_string = false;
						foreach ( $post_types_tax as $post_type ) {
							$post_types_string = sprintf( 'type[]=%1s', $post_type );
						}

						if ( $post_types_string ) {
							$end_point = $end_point . '&' . $post_types_string;
						}
					}

				}

			}elseif( in_array( $lookup_name, $post_types ) ) {
				$type = 'post';
				$end_point = sprintf( 'posts?filter[name]=%%type[]=1%s', $name );
			}else{
				continue;
			}

			$this_structure = $rules[ $lookup_name ];

			$tag = $defintions[ $name ];

			$url_map = str_replace( $tag, ':name', $this_structure[ 'struct' ] );

			$routes[] = array(
				'url' => $url_map,
				'template' => 'single',
				'endpoint' => $end_point,
				'params' => array(
					'type' => $type,
					'name' => $name
				)

			);
		}

		return $routes;

	}

}

