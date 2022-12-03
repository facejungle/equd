<?php

/**
 * Редактирование стандартной таксономии "рубрики".
 * Editing the standard taxonomy "categories".
 *
 * PHP version 8.1
 *
 * @category Categories Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;
/**
 * Подключение шаблонов для категорий, а также отображение постов и контента.
 * Connecting templates for categories, as well as displaying posts and content.
 * Регистрация типа поста "уроки". Регистрация плоских таксономий. Подключение шаблонов. Теги вывода постов, контента.
 * Registering a "leassons" post type. Registering a flat taxonomies. Include templates. Tags for displaying posts, content.
 *
 * PHP version 8.1
 *
 * @category Categories Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Categories {

	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		self::edit_taxonomy();
		self::edit_permalink();
		$this->settings_page_categories();
	}//end __construct()


	/**
	 * Редактирование таксономии category.
	 * Editing the category taxonomy.
	 */
	private static function edit_taxonomy() {
		add_action(
			'init',
			function () {
				global $wp_taxonomies;

				$labels                 = & $wp_taxonomies['category']->labels;
				$labels->name           = 'Категории';
				$labels->singular_name  = 'Категория';
				$labels->add_new        = 'Добавить категорию';
				$labels->add_new_item   = 'Добавление категории';
				$labels->edit_item      = 'Редактировать категорию';
				$labels->new_item       = 'Новая категория';
				$labels->view_item      = 'Показать категорию';
				$labels->search_items   = 'Искать категории';
				$labels->not_found      = 'Категорий не найдено';
				$labels->all_items      = 'Все категории';
				$labels->menu_name      = __( 'Categories', 'equd' );
				$labels->name_admin_bar = 'Категории';
			}
		);
		global $wp_taxonomies;
	}//end edit_taxonomy()


	/**
	 * Замена части ссылки %category% у произвольных типов постов.
	 * Replacing the %category% part of the link for custom post types.
	 */
	private static function edit_permalink() {
		$permalinks = static function ( $permalink, $post ) {
			// выходим если это не наш тип записи: без холдера %products%.
			if ( strpos( $permalink, '%category%' ) === false ) {
				return $permalink;
			}

			// Получаем элементы таксы.
			$terms = get_the_terms( $post, 'category' );
			// если есть элемент заменим холдер.
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) && is_object( $terms[0] ) ) {
				$cat_id   = $terms[0]->term_id;
				$cat_path = get_category_parents( $cat_id, false, '/', true );
			}
				// элемента нет, а должен быть...
			else {
				 $cat_path = 'no-category/';
			}

			return str_replace( '%category%/', $cat_path, $permalink );
		};
		add_filter( 'post_type_link', $permalinks, 1, 2 );
	}//end edit_permalink()


	/**
	 * Добавить страницу в админ меню с настройкой таксономии "категории".
	 * Add a page to the admin menu with the "category" taxonomy setting.
	 */
	private static function settings_page_categories() {
		add_action(
			'admin_menu',
			function (): void {
				add_submenu_page( 'equd-settings', 'Основное доп. меню', __( 'Categories', 'equd' ), 'manage_categories', 'edit-tags.php?taxonomy=category' );
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
	}//end settings_page_categories()
}//end class
