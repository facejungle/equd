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
class crb_blocks implements models_interface {

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
		 Container::make( 'post_meta', 'equd_blocks_container', __( "Content for $this->post_type", 'equd' ) )
			->show_on_post_type( $this->post_type );
		$container       = self::$container;

		// Create a field model, add elements, and write the model to $model_field.
		$model_field = $this->make_model_field( $this->fields );

		// Add the created field model to the container.
		$container->add_fields( array( $model_field ) );
		return $container;
	}
	public function make_model_field( array|string $fields ) {
		$button_add_container = array(
			'plural_name'   => __( 'containers', 'equd' ),
			'singular_name' => __( 'container', 'equd' ),
		);
		$button_add_block     = array(
			'plural_name'   => __( 'container blocks', 'equd' ),
			'singular_name' => __( 'container block', 'equd' ),
		);
		$crb_block_model      = new crb_block();
		self::$model_field    =
		 Field::make( 'complex', 'content_containers', __( 'Content containers:', 'equd' ) )
			->set_layout( 'tabbed-vertical' )
			->setup_labels( $button_add_container )
			->help_text( __( 'Content are divided into containers. One container contains title and an unlimited number of content blocks.', 'equd' ) )
			->add_fields(
				'content_container',
				__( 'Container', 'equd' ),
				array(
					Field::make( 'text', 'content_container_name', __( 'Container name', 'equd' ) )
					   ->help_text( __( 'Title for the content container', 'equd' ) )
					   ->set_attribute( 'placeholder', __( 'Title for container', 'equd' ) ),
					Field::make( 'complex', 'content_blocks', __( 'Content blocks', 'equd' ) )
					   ->setup_labels( $button_add_block )
					->add_fields(
						'content_block',
						__( 'Content block', 'equd' ),
						array( $crb_block_model->make_model_field( $fields ) )
					),
				)
			)
			->set_header_template( '= <% if (content_container_name) { %> <%- content_container_name %> <% } %>' );
		$model_field          = self::$model_field;

		return $model_field;
	}
	public function view_model() {
		require_once EQUD_PATH_FEATURES . 'equd_content/templates/blocks.php';
	}
}
