<?php
/**
 * Content nested blocks
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace equd_content;

defined('ABSPATH') || exit;

use equd_content\models\models_interface;

/**
 * Class for including and disabling styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Model
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class equd_content
{

	public $post_type;
	public $model;
	public $fields;

	/**
	 * @param string       $model     Model type: Blocks, block or fields.
	 * @param string       $post_type Post type name.
	 * @param string|array $fields    Fields: title, text, code, image, gallery, association.
	 */
	public function __construct(string $post_type, string $model, string|array $fields)
	{
		add_action('wp_enqueue_scripts', array($this, 'highlight_styles'));
		$this->post_type = $post_type;
		$this->model = $model;
		$this->fields = $fields;
	}
	public function add_model_for_posts()
	{
		$model = '\\equd_content\\models\\' . $this->model;
		$content_model = new $model();
		$content_model->add_model_for_posts($this->post_type, $this->fields);

	}
	public function view_model()
	{
		global $post;
		if ($post->post_type === $this->post_type) {
			$model = '\\equd_content\\models\\' . $this->model;
			$content_model = new $model();
			$content_model->view_model();
			wp_enqueue_style('equd_content');
		}
	}

	public function highlight_styles()
	{
		wp_register_style(
			'equd_content',
			get_template_directory_uri() . '/features/equd_content/equd_content.css',
			array(),
			'1.1.1',
			'all'
		);
		wp_register_script(
			'highlightjs',
			get_template_directory_uri() . '/features/equd_content/highlight/highlight.min.js',
			array(),
			'11.6.0',
			false
		);
		wp_register_style(
			'highlight',
			get_template_directory_uri() . '/features/equd_content/highlight/highlight.css',
			array(),
			'11.6.0',
			'all'
		);
	}
}