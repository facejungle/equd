<?php
/**
 * File to enable or disable styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

defined('ABSPATH') || exit;

/**
 * Class for including and disabling styles and scripts.
 *
 * PHP version 8.1
 *
 * @category PostLink Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

class require_post_meta
{
	public $post_type;
	public $post_meta;
	public function __construct(string $post_type, string|array $post_meta)
	{
		$this->post_type = $post_type;
		$this->post_meta = $post_meta;
		add_filter('wp_insert_post_data', array($this, 'equd_excerpt'));
		add_action('admin_notices', array($this, 'excerpt_admin_notice'));
	}
	public function equd_excerpt($data)
	{
		// change your_post_type to post, page, or your custom post type slug
		if ($this->post_type == $data['post_type']) {
			$post_meta = $data[$this->post_meta];
			if (empty($post_meta)) { // If excerpt field is empty
				// Check if the data is not drafed and trashed
				if (($data['post_status'] != 'draft') && ($data['post_status'] != 'trash')) {
					$data['post_status'] = 'draft';
					add_filter('redirect_post_location', array($this, 'excerpt_error_message_redirect'), '99');
				}
			}
		}
		return $data;
	}
	public function excerpt_error_message_redirect($location)
	{
		$location = str_replace('&message=6', '', $location);
		return add_query_arg($this->post_meta . 'required', 1, $location);
	}
	public function excerpt_admin_notice()
	{
		if (!isset($_GET[$this->post_meta . 'required'])) {
			return;
		}
		switch (absint($_GET[$this->post_meta . 'required'])) {
			case 1:
				$message = "$this->post_meta field is empty! $this->post_meta is required to publish your recipe post.";
				break;
			default:
				$message = 'Unexpected error';
		}
		echo '<div id="notice" class="error"><p>' . $message . '</p></div>';
	}
}