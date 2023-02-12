<?php
/**
 * File with basic theme settings.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\entities\admin\app;

defined( 'ABSPATH' ) || exit;

/**
 * Class for basic theme settings: theme_supports, menu registration, file extension, image size.
 *
 * @category EQUD_Settings class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class menu {

	public function __construct() {
		$this->equd_admin_menu();

		add_action( 'admin_menu', array( $this, 'add_taxonomies_menu' ) );
		add_action( 'parent_file', array( $this, 'add_taxonomies_menu_parent' ) );
	}

	private function equd_admin_menu() {
		add_action(
			'admin_menu',
			function () {
				add_menu_page(
					__( 'EQUD theme tutorial and settings', 'equd' ),
					_x( 'EQUD theme', 'admin menu, main theme settings link', 'equd' ),
					'manage_options',
					'equd-settings',
					'\EQUD\pages\Admin::general_settings',
					'dashicons-welcome-view-site',
					2
				);
				add_submenu_page(
					'equd-settings',
					__( 'General settings', 'equd' ),
					__( 'General settings page', 'equd' ),
					'manage_options',
					'equd-settings',
					'',
					1
				);
				add_submenu_page(
					'equd-settings',
					__( 'Taxonomies', 'equd' ),
					__( 'Taxonomies page', 'equd' ),
					'manage_options',
					'equd-taxonomies',
					'\EQUD\pages\Admin::general_settings',
					2
				);
			}
		);
	}

	/**
	 * Summary of add_taxonomies_menu
	 *
	 * @return void
	 */
	public function add_taxonomies_menu() {
		$args       = array(
			'public'   => true,
			'_builtin' => false,
		);
		$output     = 'objects'; // names or objects.
		$operator   = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator );
		foreach ( $taxonomies as $taxonomy ) {
			$parent_slug = 'equd-settings';
			$page_title  = $taxonomy->label;
			$menu_title  = $taxonomy->label;
			$capability  = 'manage_categories';
			$menu_slug   = "edit-tags.php?taxonomy=$taxonomy->name";
			$callback    = array( $this, 'taxonomies_menu_callback' );
			add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, '' );
		}
	}

	/**
	 * Summary of add_taxonomies_menu_parent
	 *
	 * @param mixed $parent_file Parent page.
	 * @return mixed
	 */
	public function add_taxonomies_menu_parent( $parent_file ) {
		global $current_screen;
		$args       = array(
			'public'   => true,
			'_builtin' => false,
		);
		$taxonomies = get_taxonomies( $args, 'names', 'and' );
		foreach ( $taxonomies as $taxonomy ) {
			if ( $current_screen->taxonomy === $taxonomy ) {
				return 'equd-settings';
			}
		}
		return $parent_file;
	}
}
