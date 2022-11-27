<?php
/**
 * Функционал произвольного типа постов "leassons".
 * Functionality of custom post type "leassons".
 *
 * PHP version 8.1
 *
 * @category Post_Leassons Class
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
 * Регистрация типа поста "уроки". Регистрация плоских таксономий. Подключение шаблонов. Теги вывода постов, контента.
 * Registering a "leassons" post type. Registering a flat taxonomies. Include templates. Tags for displaying posts, content.
 *
 * PHP version 8.1
 *
 * @category Post_Leassons Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Post_Leassons {
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->register_post_type_leassons();
		$this->register_tax_post_leassons();
		$this->attach_tax_post_leassons();
		$this->crb_leassons();
	}
	/**
	 * Регистрация типа записи "leassons".
	 * Registering the "leassons" post type
	 */
	private function register_post_type_leassons() {
		register_post_type(
			'leassons',
			array(
				'labels'        => array(
					'name'                     => 'Уроки',
					'singular_name'            => 'Урок',
					'add_new'                  => 'Добавить урок',
					'add_new_item'             => 'Добавление урока',
					'edit_item'                => 'Редактирование урока',
					'new_item'                 => 'Новый урок',
					'view_item'                => 'Смотреть урок',
					'view_items'               => 'Смотреть уроки',
					'search_items'             => 'Искать урок',
					'not_found'                => 'Урок не найден',
					'not_found_in_trash'       => 'В корзине нет уроков',
					'parent_item_colon'        => 'Родительский урок',
					'all_items'                => 'Все уроки',
					'archives'                 => 'Категории уроков',
					'menu_name'                => 'Уроки',
					'attributes'               => 'Свойства урока',
					'insert_into_item'         => 'Вставить в урок',
					'uploaded_to_this_item'    => 'Загружено для этого урока',
					'featured_image'           => 'Изображение урока',
					'set_featured_image'       => 'Установить изображение урока',
					'remove_featured_image'    => 'Удалить изображение урока',
					'use_featured_image'       => 'Использовать как изображение урока',
					'item_updated'             => 'Урок обновлён.',
					'item_published'           => 'Урок добавлен.',
					'item_published_privately' => 'Урок добавлен приватно.',
					'item_reverted_to_draft'   => 'Урок сохранён как черновик.',
					'item_scheduled'           => 'Публикация урока запланирована.',

				),
				'description'   => '',
				'public'        => true,
				'show_in_menu'  => true,
				'menu_position' => 2,
				'menu_icon'     => 'dashicons-editor-ol',
				'hierarchical'  => false,
				'supports'      => array( 'title', 'thumbnail', 'excerpt', 'comments' ),
				'taxonomies'    => array( 'category' ),
				'has_archive'   => 'leassons',
				'rewrite'       => array(
					'slug'       => 'leassons/%category%',
					'with_front' => false,
				),
				'query_var'     => true,
			)
		);
	}
	/**
	 * Регистрация плоских таксономий.
	 * Registration of flat taxonomies.
	 */
	private function register_tax_post_leassons() {
		register_taxonomy(
			'leassons_tax_diff',
			'leassons',
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
				'show_ui'      => true,
				'query_var'    => true,
			)
		);
	}
	/**
	 * Добавление таксономий к типу записи "уроки".
	 * Attach taxonomies to the "leassons" post type.
	 */
	private function attach_tax_post_leassons() {
		add_action(
			'init',
			function() {
				register_taxonomy_for_object_type( 'category', 'leassons' );
			}
		);
	}
	/**
	 * Настройка Carbon Fields, добавление нового поста "урок".
	 * Setting up Carbon Fields, adding a new "lesson" post.
	 */
	private function crb_leassons() {
		$backend_fields = static function() {
			Container::make( 'post_meta', __( 'Информация для поиска этого урока', 'equd' ) )
			->where( 'post_type', '=', 'leassons' )
			->add_fields(
				array(
					Field::make( 'association', 'leasson_devices', __( 'Устройства:' ) )
					->set_width( 50 )
					->set_types(
						array(
							array(
								'type'     => 'term',
								'taxonomy' => 'devices',
							),
						)
					),
					Field::make( 'association', 'leasson_programms', __( 'Программы:' ) )
					->set_width( 50 )
					->set_types(
						array(
							array(
								'type'     => 'term',
								'taxonomy' => 'programms',
							),
						)
					),
					Field::make( 'association', 'leasson_diff', __( 'Сложность урока:' ) )
					->set_width( 33 )
					->set_types(
						array(
							array(
								'type'     => 'term',
								'taxonomy' => 'leassons_tax_diff',
							),
						)
					),
				)
			);
			$leasson_add_stage_button         = array(
				'plural_name'   => __( 'этапы', 'equd' ),
				'singular_name' => __( 'этап', 'equd' ),
			);
			$leasson_add_content_block_button = array(
				'plural_name'   => __( 'блоки контента', 'equd' ),
				'singular_name' => __( 'блок контента', 'equd' ),
			);
			$leasson_add_block_element_button = array(
				'plural_name'   => __( 'элементы блока', 'equd' ),
				'singular_name' => __( 'элемент блока', 'equd' ),
			);
			Container::make( 'post_meta', __( 'Основное содержание урока', 'equd' ) )
			->show_on_post_type( 'leassons' )
			->add_fields(
				array(
					Field::make( 'complex', 'leasson_stages', __( 'Этапы урока:', 'equd' ) )
					->set_layout( 'tabbed-vertical' )
					->setup_labels( $leasson_add_stage_button )
					->help_text( __( 'Урок состоит из этапов. Этап содержит один заголовок, и неограниченное количество блоков контента. В блоке контента может быть расположенна любая информация.', 'equd' ) )
					->add_fields(
						'leasson_stage',
						__( 'Этап', 'equd' ),
						array(
							Field::make( 'text', 'leasson_stage_name', __( 'Заголовок', 'equd' ) )
							->help_text( __( 'Заголовок для этапа урока', 'equd' ) )
							->set_attribute( 'placeholder', __( 'Заголовок этапа', 'equd' ) ),
							Field::make( 'complex', 'leasson_stage_content', __( 'Контент этапа', 'equd' ) )
							->setup_labels( $leasson_add_content_block_button )
							->add_fields(
								'leasson_stage_content_block',
								__( 'Блок контента', 'equd' ),
								array(
									Field::make( 'complex', 'leasson_stage_content_block_list', __( 'Список контента в блоке', 'equd' ) )
									->setup_labels( $leasson_add_block_element_button )
									->set_layout( 'tabbed-vertical' )
									->help_text( __( '#Блок контента', 'equd' ) )
									->add_fields(
										'leasson_stage_content_block_title',
										__( 'Подзаголовок', 'equd' ),
										array(
											Field::make( 'text', 'leasson_stage_content_block_title_elem', __( 'Подзаголовок' ) )
											->set_attribute( 'placeholder', __( 'Подзаголовок', 'equd' ) ),
										)
									)
									->add_fields(
										'leasson_stage_content_block_text',
										__( 'Текст', 'equd' ),
										array(
											Field::make( 'rich_text', 'leasson_stage_content_block_text_elem', __( 'Текст' ) ),
										)
									)
									->add_fields(
										'leasson_stage_content_block_code',
										__( 'Код', 'equd' ),
										array(
											Field::make( 'textarea', 'leasson_stage_content_block_code_elem', __( 'Код' ) ),
										)
									)
									->add_fields(
										'leasson_stage_content_block_image',
										__( 'Изображение', 'equd' ),
										array(
											Field::make( 'image', 'leasson_stage_content_block_image_elem', __( 'Изображение' ) ),
										)
									)
									->add_fields(
										'leasson_stage_content_block_association',
										__( 'Ассоциация', 'equd' ),
										array(
											Field::make( 'association', 'leasson_stage_content_block_association_elem', __( 'Ассоциация' ) ),
										)
									)
									->add_fields(
										'leasson_stage_content_block_media_gallery',
										__( 'media_gallery', 'equd' ),
										array(
											Field::make( 'media_gallery', 'leasson_stage_content_block_media_gallery_elem', __( 'media_gallery' ) )
											->set_type( array( 'image', 'video' ) )
											->set_duplicates_allowed( false ),
										)
									),
								)
							),
						)
					)
					->set_header_template(
						'=
					<% if (leasson_stage_name) { %>
						<%- leasson_stage_name %>
					<% } %>
				'
					),
				)
			);
		};
		add_action( 'carbon_fields_register_fields', $backend_fields );
	}
}
