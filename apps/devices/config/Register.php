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

namespace EQUD\apps\devices\config;

defined( 'ABSPATH' ) || exit;

/**
 * Регистрация таксономии: устройства.
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

class Register {


	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */

	public function __construct() {
		 $this->register_taxonomy();
	}
	private static function register_taxonomy() {
		$args_devices = array(
			'labels'       => array(
				'name'              => _x( 'Devices', 'taxonomy general name', 'equd' ),
				'singular_name'     => _x( 'Device', 'taxonomy singular name', 'equd' ),
				'search_items'      => __( 'Search devices', 'equd' ),
				'all_items'         => __( 'All devices', 'equd' ),
				'parent_item'       => __( 'Parent device', 'equd' ),
				'parent_item_colon' => __( 'Parent device:', 'equd' ),
				'edit_item'         => __( 'Edit device', 'equd' ),
				'update_item'       => __( 'Update device', 'equd' ),
				'add_new_item'      => __( 'Add new device', 'equd' ),
				'new_item_name'     => __( 'New device Name', 'equd' ),
				'menu_name'         => __( 'Device', 'equd' ),
			),
			'show_ui'      => true,
			'show_in_menu' => false,
			'query_var'    => true,
			'hierarchical' => true,
		);
		register_taxonomy( 'devices', null, $args_devices );
	}
}
