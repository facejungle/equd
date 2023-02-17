<?php

/**
 * Registering taxonomies for custom post type "Lesson"
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\entities\lesson\app;

defined( 'ABSPATH' ) || exit;

/**
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
class taxonomy {

	/**
	 * Class autoload.
	 */
	public function __construct() {
		$this->register_taxonomy_post_lesson();
		$this->attach_tax();
	}

	 /**
	  * Регистрация плоских таксономий.
	  * Registration of flat taxonomies.
	  */
	private function register_taxonomy_post_lesson() {
		register_taxonomy(
			'lesson_tax_diff',
			'lesson',
			array(
				'hierarchical' => false,
				'labels'       => array(
					'name'                       => 'Сложность',
					'singular_name'              => 'Сложность',
					'search_items'               => 'Искать сложность',
					'popular_items'              => 'Популярная сложность',
					'all_items'                  => 'Все сложности',
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => 'Редактировать сложность',
					'update_item'                => 'Обновить сложность',
					'add_new_item'               => 'Добавить сложность',
					'new_item_name'              => 'Дабавление сложности',
					'separate_items_with_commas' => 'Разделяйте сложность запятой',
					'add_or_remove_items'        => 'Добавить или удалить сложность',
					'choose_from_most_used'      => 'Выбрать часто используемую сложность',
					'menu_name'                  => 'Сложность',
				),
				'public'       => false,
				'show_ui'      => true,
				'query_var'    => true,
			)
		);
	}
	/**
	 * Attach taxonomies to the "lesson" post type.
	 */
	private function attach_tax() {
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type( 'category', 'lesson' );
				register_taxonomy_for_object_type( 'programs', 'lesson' );
				register_taxonomy_for_object_type( 'devices', 'lesson' );
			}
		);
	}
}
