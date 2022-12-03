<?php

/**
 * Функционал произвольного типа постов "docs".
 * Functionality of custom post type "docs".
 *
 * PHP version 8.1
 *
 * @category Post_Docs Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;
/**
 * Регистрация произвольного типа поста. Подключение шаблонов. Теги вывода постов, контента.
 * Registration of an arbitrary post type. Connecting templates. Tags for displaying posts, content.
 *
 * PHP version 8.1
 *
 * @category Post_Docs Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Post_Docs {

	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->register_post_type_docs();
		$this->attach_tax_post_docs();
	}//end __construct()


	/**
	 * Регистрация типа записи "docs".
	 * Registering the "docs" post type
	 */
	private static function register_post_type_docs() {
		register_post_type(
			'docs',
			array(
				'labels'        => array(
					'name'                     => 'Документации',
					'singular_name'            => 'Документация',
					'add_new'                  => 'Добавить документацию',
					'add_new_item'             => 'Добавление документации',
					'edit_item'                => 'Редактирование документации',
					'new_item'                 => 'Новая документация',
					'view_item'                => 'Смотреть документацию',
					'view_items'               => 'Смотреть документации',
					'search_items'             => 'Искать документацию',
					'not_found'                => 'Документация не найдена',
					'parent_item_colon'        => 'Родительская документация',
					'all_items'                => 'Все документации',
					'archives'                 => 'Категории документаций',
					'menu_name'                => 'Документации',
					'attributes'               => 'Свойства документации',
					'insert_into_item'         => 'Вставить в документацию',
					'uploaded_to_this_item'    => 'Загружено для этой документации',
					'featured_image'           => 'Изображение документации',
					'set_featured_image'       => 'Установить изображение документации',
					'remove_featured_image'    => 'Удалить изображение документации',
					'use_featured_image'       => 'Использовать как изображение документации',
					'item_updated'             => 'Документация обновлёна.',
					'item_published'           => 'Документация добавлена.',
					'item_published_privately' => 'Документация добавлена приватно.',
					'item_reverted_to_draft'   => 'Документация сохранёна как черновик.',
					'item_scheduled'           => 'Публикация документации запланирована.',

				),
				'description'   => '',
				'public'        => true,
				'show_in_menu'  => true,
				'menu_position' => 2,
				'menu_icon'     => 'dashicons-welcome-write-blog',
				'hierarchical'  => false,
				'supports'      => array(
					'title',
					'thumbnail',
					'excerpt',
					'comments',
					'post-formats',
				),
				'taxonomies'    => array( 'category' ),
				'has_archive'   => 'documentation',
				'rewrite'       => array(
					'slug'       => 'documentation/%category%',
					'with_front' => false,
				),
				'query_var'     => true,
			)
		);
	}//end register_post_type_docs()


	/**
	 * Добавление таксономий к типу записи "документации".
	 * Attach taxonomies to the "documentation" post type.
	 */
	private function attach_tax_post_docs() {
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type( 'category', 'docs' );
			}
		);
	}//end attach_tax_post_docs()
}//end class
