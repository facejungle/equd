<?php

/**
 * #
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

namespace EQUD\apps\lessons\config;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
/**
 * #
 * #
 *
 * PHP version 8.1
 *
 * @category CarbonFields Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class CarbonFields {


	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		  $this->carbon_fields_lessons();
	}
	 /**
	  * Настройка Carbon Fields, добавление нового поста "урок".
	  * Setting up Carbon Fields, adding a new "lesson" post.
	  */
	private function carbon_fields_lessons() {
		$backend_fields = static function () {
			$lesson_add_stage_button         = array(
				'plural_name'   => __( 'Stages', 'equd' ),
				'singular_name' => __( 'Stage', 'equd' ),
			);
			$lesson_add_content_block_button = array(
				'plural_name'   => __( 'Content blocks', 'equd' ),
				'singular_name' => __( 'Content block', 'equd' ),
			);
			$lesson_add_block_element_button = array(
				'plural_name'   => __( 'Block elements', 'equd' ),
				'singular_name' => __( 'Block element', 'equd' ),
			);
			Container::make( 'post_meta', __( 'Main content of the lesson', 'equd' ) )
			->show_on_post_type( 'lessons' )
			->add_fields(
				array(
					Field::make( 'complex', 'lesson_stages', __( 'Lesson stages:', 'equd' ) )
					->set_layout( 'tabbed-vertical' )
					->setup_labels( $lesson_add_stage_button )
					->help_text( __( 'Lessons are divided into stages. One stage contains title and an unlimited number of content blocks.', 'equd' ) )
					->add_fields(
						'lesson_stage',
						__( 'Stage', 'equd' ),
						array(
							Field::make( 'text', 'lesson_stage_name', __( 'Заголовок', 'equd' ) )
							->help_text( __( 'Title for the lesson stage', 'equd' ) )
							->set_attribute( 'placeholder', __( 'Stage title', 'equd' ) ),
							Field::make( 'complex', 'lesson_stage_content', __( 'Stage content', 'equd' ) )
							->setup_labels( $lesson_add_content_block_button )
							->add_fields(
								'lesson_stage_content_block',
								__( 'Content block', 'equd' ),
								array(
									Field::make( 'complex', 'lesson_stage_content_block_list', __( 'Block content list', 'equd' ) )
									->setup_labels( $lesson_add_block_element_button )
									->set_layout( 'tabbed-vertical' )
									->help_text( __( '#Content block', 'equd' ) )
									->add_fields(
										'lesson_stage_content_block_title',
										__( 'Subtitle', 'equd' ),
										array(
											Field::make( 'text', 'lesson_stage_content_block_title_elem', __( 'Subtitle' ) )
											->set_attribute( 'placeholder', __( 'Subtitle', 'equd' ) ),
										)
									)->add_fields(
										'lesson_stage_content_block_text',
										__( 'Text', 'equd' ),
										array(
											Field::make( 'textarea', 'lesson_stage_content_block_text_elem', __( 'Text' ) ),
										)
									)->add_fields(
										'lesson_stage_content_block_code',
										__( 'Code', 'equd' ),
										array(
											Field::make( 'textarea', 'lesson_stage_content_block_code_elem', __( 'Code' ) ),
										)
									)->add_fields(
										'lesson_stage_content_block_image',
										__( 'Image', 'equd' ),
										array(
											Field::make( 'image', 'lesson_stage_content_block_image_elem', __( 'Image' ) ),
										)
									)->add_fields(
										'lesson_stage_content_block_association',
										__( 'Association', 'equd' ),
										array(
											Field::make( 'association', 'lesson_stage_content_block_association_elem', __( 'Association' ) ),
										)
									)->add_fields(
										'lesson_stage_content_block_media_gallery',
										__( 'Media gallery', 'equd' ),
										array(
											Field::make( 'media_gallery', 'lesson_stage_content_block_media_gallery_elem', __( 'Media gallery' ) )->set_type( array( 'image', 'video' ) )->set_duplicates_allowed( false ),
										)
									),
								)
							),
						)
					)->set_header_template(
						'=
					<% if (lesson_stage_name) { %>
						<%- lesson_stage_name %>
					<% } %>
				'
					),
				)
			);
		};
		add_action( 'carbon_fields_register_fields', $backend_fields );
	}
}
