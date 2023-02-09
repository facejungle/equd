<?php
/**
 * ###
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
 * Class loader.
 *
 * @category Loader class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Loader {

	/**
	 * Class autoload.
	 */
	public function __construct() {
		\Carbon_Fields\Carbon_Fields::boot();
		// Core: config
		new \EQUD\config\AdminMenu();
		new \EQUD\config\ThemeSupports();
		new \EQUD\config\StyleScript();

      new \EQUD\src\AsyncStyleScript();

		new \EQUD\apps\devices\config\Register();
		new \EQUD\apps\programs\config\Register();
		new \EQUD\apps\post\config\Customize();
	}
}
