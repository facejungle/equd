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

namespace EQUD\app;

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
class loader {

	/**
	 * Class autoload.
	 */
	public function __construct() {
		\Carbon_Fields\Carbon_Fields::boot();

		new \EQUD\app\theme_supports();
		new \EQUD\app\style_script();

		new \loadCSS\init();
		new \dynamic_style();
		new \async_style_script();
		
		new \EQUD\entities\post\app\loader();
	}
}
