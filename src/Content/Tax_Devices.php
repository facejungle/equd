<?php

/**
 * Добавляет функционал таксономии "устройства".
 * Adds "devices" taxonomy functionality.
 *
 * PHP version 8.1
 *
 * @category Tax_Devices Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Регистрация таксономии "устройства". Создание страницы настроек таксономии. Подключение шаблонов.
 * Registration of taxonomy "devices". Creating a taxonomy settings page. Connecting templates.
 *
 * PHP version 8.1
 *
 * @category Tax_Devices Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Tax_Devices {

	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->register_tax_devices();
		$this->settings_page_tax_devices();
	}//end __construct()


	/**
	 * Регистрация таксономии "программы".
	 * Registering the "programms" taxonomy.
	 */
	private static function register_tax_devices() {
		register_taxonomy(
			'devices',
			null,
			array(
				'hierarchical' => true,
				'labels'       => array(
					'name'                  => 'Устройства',
					'singular_name'         => 'Устройство',
					'search_items'          => 'Искать устройство',
					'popular_items'         => 'Популярное устройство',
					'all_items'             => 'Все устройства',
					'parent_item'           => 'Родительское устройство',
					'parent_item_colon'     => 'Родительское устройство',
					'edit_item'             => 'Редактировать устройство',
					'update_item'           => 'Обновить устройство',
					'add_new_item'          => 'Добавить устройство',
					'new_item_name'         => 'Дабавление устройства',
					'add_or_remove_items'   => 'Добавить или удалить устройство',
					'choose_from_most_used' => 'Выбрать часто используемую устройство',
					'menu_name'             => 'Устройства',
				),
				'show_ui'      => true,
				'query_var'    => true,
			)
		);
	}//end register_tax_devices()


	/**
	 * Добавить страницу в админ меню с настройкой таксономии "программы".
	 * Add a page to the admin menu with the "programms" taxonomy setting.
	 */
	private static function settings_page_tax_devices() {
		add_action(
			'admin_menu',
			function (): void {
				add_submenu_page(
					'equd-settings',
					'devices',
					__( 'Devices', 'equd' ),
					'manage_categories',
					'edit-tags.php?taxonomy=devices'
				);
			}
		);

		add_action(
			'parent_file',
			function ( string $parent_file ): string {
				global $current_screen;

				if ( $current_screen->taxonomy === 'devices' ) {
					return 'equd-settings';
				}

				return $parent_file;
			}
		);
	}//end settings_page_tax_devices()
}//end class
