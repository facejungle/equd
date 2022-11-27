<?php
/**
 * Функционал произвольного типа постов "news".
 * Functionality of custom post type "news".
 *
 * PHP version 8.1
 *
 * @category Post_News Class
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
 * @category Post_News Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Post_News {
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->register_post_type_news();
		$this->attach_tax_post_news();
	}
	/**
	 * Регистрация типа записи "news".
	 * Registering the "news" post type
	 */
	private static function register_post_type_news() {
		register_post_type(
			'news',
			array(
				'labels'        => array(
					'name'                     => 'Новости',
					'singular_name'            => 'Новость',
					'add_new'                  => 'Добавить новость',
					'add_new_item'             => 'Добавление новости',
					'edit_item'                => 'Редактирование новости',
					'new_item'                 => 'Новая новость',
					'view_item'                => 'Смотреть новость',
					'view_items'               => 'Смотреть новости',
					'search_items'             => 'Искать новость',
					'not_found'                => 'Новость не найдена',
					'parent_item_colon'        => 'Родительская новость',
					'all_items'                => 'Все новости',
					'archives'                 => 'Категории новостей',
					'menu_name'                => 'Новости',
					'attributes'               => 'Свойства новости',
					'insert_into_item'         => 'Вставить в новость',
					'uploaded_to_this_item'    => 'Загружено для этой новости',
					'featured_image'           => 'Изображение новости',
					'set_featured_image'       => 'Установить изображение новости',
					'remove_featured_image'    => 'Удалить изображение новости',
					'use_featured_image'       => 'Использовать как изображение новости',
					'item_updated'             => 'Новость обновлёна.',
					'item_published'           => 'Новость добавлена.',
					'item_published_privately' => 'Новость добавлена приватно.',
					'item_reverted_to_draft'   => 'Новость сохранёна как черновик.',
					'item_scheduled'           => 'Публикация новости запланирована.',

				),
				'description'   => '',
				'public'        => true,
				'show_in_menu'  => true,
				'menu_position' => 2,
				'menu_icon'     => 'dashicons-admin-site',
				'hierarchical'  => false,
				'supports'      => array( 'title', 'thumbnail', 'excerpt', 'comments', 'post-formats' ),
				'taxonomies'    => array( 'category' ),
				'has_archive'   => 'news',
				'rewrite'       => array(
					'slug'       => 'news/%category%',
					'with_front' => false,
				),
				'query_var'     => true,
			)
		);
	}
	/**
	 * Добавление таксономий к типу записи "новости".
	 * Attach taxonomies to the "news" post type.
	 */
	private function attach_tax_post_news() {
		add_action(
			'init',
			function() {
				register_taxonomy_for_object_type( 'category', 'news' );
			}
		);
	}
}
