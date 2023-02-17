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

namespace equd_content\models;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

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
class crb_block implements models_interface {

	public $post_type;
	public $fields;
	public $meta;
	public static $container;
	public static $model_field;
	public function add_model_for_posts( string $post_type, string|array $fields ) {
		$this->post_type = $post_type;
		$this->fields    = $fields;
		// Create a container and write the model to $container.
		self::$container =
		 Container::make( 'post_meta', 'crb_block', __( "Content for $this->post_type", 'equd' ) )
			->show_on_post_type( $this->post_type );
		$container       = self::$container;

		// Create a field model, add elements, and write the model to $model_field.
		$model_field = $this->make_model_field( $this->fields );

		// Add the created field model to the container.
		$container->add_fields( array( $model_field ) );
		return $container;
	}
	public function make_model_field( array|string $fields ) {
		$button_add_block_element = array(
			'plural_name'   => __( 'block elements', 'equd' ),
			'singular_name' => __( 'block element', 'equd' ),
		);
		self::$model_field        =
		 Field::make( 'complex', 'content_block_list', __( 'Block content list', 'equd' ) )
			->setup_labels( $button_add_block_element )
			->set_layout( 'tabbed-vertical' )
			->help_text( __( '#Content block', 'equd' ) );
		$model_field              = self::$model_field;
		$crb_fields               = new crb_fields();
		$model_field->add_fields( $crb_fields->make_fields( $fields, 'block', $model_field ) );
		return $model_field;
	}
	public function view_model() {
		require_once EQUD_PATH_FEATURES . 'equd_content/templates/block.php';
	}
}
