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
		 // Core: config
		new \EQUD\config\AdminMenu();
		new \EQUD\config\ThemeSupports();
		new \EQUD\config\StyleScript();

		// Core: templates
		new \EQUD\templates\Admin();

		// Post type: post
		new \EQUD\apps\post\config\Customize();

		// Post type: lessons
		new \EQUD\apps\lessons\config\Taxonomy();
		new \EQUD\apps\lessons\config\PostType();
		new \EQUD\apps\lessons\config\CarbonFields();

		// Taxonomy: categories
		new \EQUD\apps\taxonomies\categories\config\Customize();

		// Taxonomy: devices
		new \EQUD\apps\taxonomies\devices\config\Register();

		// Taxonomy: programs
		new \EQUD\apps\taxonomies\programs\config\Register();
	}
}
