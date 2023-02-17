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

namespace EQUD\entities\lesson\app;

defined('ABSPATH') || exit;

/**
 * Registering a "lesson" post type.
 *
 * PHP version 8.1
 *
 * @category PostType Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class register
{
	/**
	 * Class autoload.
	 */
	public function __construct()
	{
		$this->register_post_type_lesson();
	}


	/**
	 * Registering the "lesson" post type
	 */
	private function register_post_type_lesson()
	{
		$post_type_slug = 'lesson';
		register_post_type(
			$post_type_slug,
			array(
				'labels' => array(
					'name' => __('Lesson', 'equd'),
					'singular_name' => __('Lesson', 'equd'),
					'add_new' => __('Add new', 'equd'),
					'add_new_item' => __('Add new lesson', 'equd'),
					'edit_item' => __('Edit lesson', 'equd'),
					'new_item' => __('New lesson', 'equd'),
					'view_item' => __('View lesson', 'equd'),
					'view_items' => __('View lesson', 'equd'),
					'search_items' => __('Search lesson', 'equd'),
					'not_found' => __('Lesson not found', 'equd'),
					'all_items' => __('All lesson', 'equd'),
					'archives' => __('Lesson archives', 'equd'),
					'menu_name' => __('Lesson', 'equd'),
					'attributes' => __('Lesson attributes', 'equd'),
					'insert_into_item' => __('Insert into lesson', 'equd'),
					'uploaded_to_this_item' => __('Uploaded to this lesson', 'equd'),
					'featured_image' => __('Lesson Image', 'equd'),
					'set_featured_image' => __('Set lesson Image', 'equd'),
					'remove_featured_image' => __('Remove lesson Image', 'equd'),
					'use_featured_image' => __('Use lesson Image', 'equd'),
					'item_updated' => __('Lesson update', 'equd'),
					'item_published' => __('Lesson published', 'equd'),
					'item_published_privately' => __('Lesson published privately', 'equd'),
					'item_reverted_to_draft' => __('Lesson reverted to draft', 'equd'),
					'item_scheduled' => __('Lesson scheduled', 'equd'),

				),
				'description' => '',
				'public' => true,
				'show_in_menu' => true,
				'menu_position' => 2,
				'menu_icon' => 'dashicons-editor-ol',
				'hierarchical' => false,
				'supports' => array(
					'title',
					'thumbnail',
					'excerpt',
					'comments',
					'revisions',
				),
				'has_archive' => false,
				'rewrite' => array(
					'slug' => "$post_type_slug/%equd_replace_tag%",
					'with_front' => false,
				),
				'query_var' => true,
			)
		);
	}
}