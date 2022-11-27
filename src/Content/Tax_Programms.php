<?php
/**
 * Добавляет функционал таксономии "программы".
 * Adds "programms" taxonomy functionality.
 *
 * PHP version 8.1
 *
 * @category Tax_Programms Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;

use \Carbon_Fields\Container;
use \Carbon_Fields\Field;
/**
 * Регистрация таксономии "программы". Создание страницы настроек таксономии. Подключение шаблонов.
 * Registration of taxonomy "programs". Creating a taxonomy settings page. Connecting templates.
 *
 * PHP version 8.1
 *
 * @category Tax_Programms Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Tax_Programms {
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->register_tax_programms();
		$this->settings_page_tax_programms();
	}
	/**
	 * Регистрация таксономии "программы".
	 * Registering the "programms" taxonomy.
	 */
	private static function register_tax_programms() {
		register_taxonomy(
			'programms',
			null,
			array(
				'hierarchical' => true,
				'labels'       => array(
					'name'                  => 'Программы',
					'singular_name'         => 'Программа',
					'search_items'          => 'Искать программы',
					'popular_items'         => 'Популярная программа',
					'all_items'             => 'Все программы',
					'parent_item'           => 'Родительская программа',
					'parent_item_colon'     => 'Родительская программа',
					'edit_item'             => 'Редактировать программу',
					'update_item'           => 'Обновить программу',
					'add_new_item'          => 'Добавить программу',
					'new_item_name'         => 'Дабавление программы',
					'add_or_remove_items'   => 'Добавить или удалить программу',
					'choose_from_most_used' => 'Выбрать часто используемую программу',
					'menu_name'             => 'Программы',
				),
				'show_ui'      => true,
				'query_var'    => true,
			)
		);
	}
	/**
	 * Добавить страницу в админ меню с настройкой таксономии "программы".
	 * Add a page to the admin menu with the "programms" taxonomy setting.
	 */
	private static function settings_page_tax_programms() {
		add_action(
			'admin_menu',
			function (): void {
				add_submenu_page(
					'equd-settings',
					'programms',
					__( 'Programms', 'equd' ),
					'manage_categories',
					'edit-tags.php?taxonomy=programms'
				);
			}
		);

		add_action(
			'parent_file',
			function ( string $parent_file ): string {
				global $current_screen;

				if ( $current_screen->taxonomy === 'programms' ) {
					return 'equd-settings';
				}

				return $parent_file;
			}
		);
	}
}
