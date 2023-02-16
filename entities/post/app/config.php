<?php
/**
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\entities\post\app;

use equd_content\equd_content;

defined('ABSPATH') || exit;

/**
 * Customize post type.
 *
 * PHP version 8.1
 *
 * @category Customize post type
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

class config
{
	public static $post_content;
	public function __construct()
	{
		add_action('init', array($this, 'my_remove_post_support'), 10);
		add_filter('wp_insert_post_data', array($this, 'mandatory_excerpt'));
		add_action('admin_notices', array($this, 'excerpt_admin_notice'));
		self::$post_content = new equd_content('post', 'crb_blocks', array('title', 'text', 'code'));
		self::$post_content->add_model_for_posts();
	}
	public function attach_tax()
	{
		add_action(
			'init',
			function () {
				register_taxonomy_for_object_type('devices', 'post');
				register_taxonomy_for_object_type('programs', 'post');
			}
		);
	}
	public function my_remove_post_support()
	{
		remove_post_type_support('post', 'author');
		remove_post_type_support('post', 'editor');
		remove_post_type_support('post', 'trackbacks');
		remove_post_type_support('post', 'custom-fields');
		remove_post_type_support('post', 'post-formats');
		add_post_type_support('post', 'page-attributes');
		add_post_type_support('post', 'excerpt');
		add_post_type_support('page', 'excerpt');
	}
	function mandatory_excerpt($data)
	{
		//change your_post_type to post, page, or your custom post type slug
		if ('post' == $data['post_type']) {

			$excerpt = $data['post_excerpt'];

			if (empty($excerpt)) { // If excerpt field is empty

				// Check if the data is not drafed and trashed
				if (($data['post_status'] != 'draft') && ($data['post_status'] != 'trash')) {

					$data['post_status'] = 'draft';

					add_filter('redirect_post_location', array($this, 'excerpt_error_message_redirect'), '99');

				}
			}
		}

		return $data;
	}

	function excerpt_error_message_redirect($location)
	{

		$location = str_replace('&message=6', '', $location);

		return add_query_arg('excerpt_required', 1, $location);

	}

	function excerpt_admin_notice()
	{

		if (!isset($_GET['excerpt_required']))
			return;

		switch (absint($_GET['excerpt_required'])) {

			case 1:

				$message = 'Excerpt field is empty! Excerpt is required to publish your recipe post.';

				break;

			default:

				$message = 'Unexpected error';
		}

		echo '<div id="notice" class="error"><p>' . $message . '</p></div>';

	}
}