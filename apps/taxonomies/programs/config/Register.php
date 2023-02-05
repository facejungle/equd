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

namespace EQUD\apps\taxonomies\programs\config;

defined( 'ABSPATH' ) || exit;

/**
 * Регистрация таксономии: программы.
 * Register taxonomy: programs.
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
		$args_programs = array(
			'labels'       => array(
				'name'              => _x( 'Programs', 'taxonomy general name', 'equd' ),
				'singular_name'     => _x( 'Program', 'taxonomy singular name', 'equd' ),
				'search_items'      => __( 'Search programs', 'equd' ),
				'all_items'         => __( 'All programs', 'equd' ),
				'parent_item'       => __( 'Parent program', 'equd' ),
				'parent_item_colon' => __( 'Parent program:', 'equd' ),
				'edit_item'         => __( 'Edit program', 'equd' ),
				'update_item'       => __( 'Update program', 'equd' ),
				'add_new_item'      => __( 'Add new program', 'equd' ),
				'new_item_name'     => __( 'New program Name', 'equd' ),
				'menu_name'         => __( 'Program', 'equd' ),
			),
			'show_ui'      => true,
			'show_in_menu' => false,
			'query_var'    => true,
			'hierarchical' => true,
		);
		register_taxonomy( 'programs', null, $args_programs );
	}
}
