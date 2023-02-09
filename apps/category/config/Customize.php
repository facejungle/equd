<?php
/**
 * Регистрация таксономий для произвольного типа постов "Lessons".
 * Registering taxonomies for custom post type "Lessons"
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\apps\taxonomies\categories\config;

defined( 'ABSPATH' ) || exit;

/**
 * #
 * #
 *
 * PHP version 8.1
 *
 * @category Taxonomy Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

class Customize {


	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */

	public function __construct() {
		//$this->attach_tax();
	}
	/**
	 * Attach taxonomy category to the "post" post type.
	 */
	private function attach_tax() {
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type( 'category', 'post' );
			}
		);
	}
}
