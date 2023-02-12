<?php
/**
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\entities\post\app;

use equd_content\equd_content;

defined( 'ABSPATH' ) || exit;

/**
 * Customize post type.
 *
 * PHP version 8.1
 *
 * @category Customize post type
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

class config {
	public function __construct() {
		$this->attach_tax();
		add_action( 'init', array($this, 'my_remove_post_support'), 10 );
		equd_content::add_model_for_posts('fields', 'post', array('title', 'text', 'code'));
	}
	private function attach_tax() {
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type( 'devices', 'post' );
				register_taxonomy_for_object_type( 'programs', 'post' );
			}
		);
	}
	function my_remove_post_support() {
		remove_post_type_support( 'post', 'editor' );
		remove_post_type_support( 'post', 'post-formats' );
	}
}
