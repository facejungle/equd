<?php

/**
 * File to enable or disable styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\config;

defined( 'ABSPATH' ) || exit;
/**
 * Class for including and disabling styles and scripts.
 *
 * PHP version 8.1
 *
 * @category PostLink Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class PostLink {

	private $type_name;
	private $tax_name;
	private $replace_tag;

	public function __construct( $post_type, $tax, $tag ) {
		 $this->type_name  = $post_type;
		$this->tax_name    = $tax;
		$this->replace_tag = $tag;
		add_filter( 'post_type_link', array( $this, 'change_link' ), 1, 3 );
		add_action( 'init', array( $this, 'generated_rewrite_rules' ) );
	}
	function change_link( $post_link, $id = 0 ) {
		$post = get_post( $id );
		if ( $post->post_type == $this->type_name ) {
			if ( is_object( $post ) ) {
				$terms = wp_get_object_terms( $post->ID, array( $this->tax_name ) );
				if ( $terms ) {
					return str_replace( $this->replace_tag, $terms[0]->slug, $post_link );
				}
			}
		}
		return $post_link;
	}

	function generated_rewrite_rules() {
		add_rewrite_rule(
			'^' . $this->type_name . '/(.*)/(.*)/?$',
			'index.php?post_type=' . $this->type_name . '&name=$matches[2]',
			'top'
		);
	}







	function edit_post_link( $post_type ) {
		 $change_link = static function ( $post_link, $id = 0, $post_type ) {
			$post = get_post( $id );
			if ( $post->post_type == $post_type ) {
				if ( is_object( $post ) ) {
					$terms = wp_get_object_terms( $post->ID, array( 'category' ) );
					if ( $terms ) {
						   return str_replace( '%equd_replace_tag%', $terms[0]->slug, $post_link );
					}
				}
			}
			return $post_link;
		 };
		add_filter( 'post_type_link', $change_link, 1, 3 );
		$generated_rewrite_rules = static function ( $post_type ) {
			add_rewrite_rule(
				"^$post_type/(.*)/(.*)/?$",
				'index.php?post_type=' . $post_type . '&name=$matches[2]',
				'top'
			);
		};
		add_action( 'init', $generated_rewrite_rules );
	}

}
