<?php
/**
 * #
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\apps\post\config;

defined( 'ABSPATH' ) || exit;

/**
 * Register taxonomy: devices.
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
	 * Class autoload.
	 */

	public function __construct() {
		 $this->attach_tax();
	}
	private function attach_tax() {
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type( 'devices', 'post' );
			}
		);
	}
}
