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

use equd_content\fields\fields_interface;

defined('ABSPATH') || exit;

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
class crb_containers implements models_interface{
   public static function add_model_for_posts(string $post_type, array $fields) {
      $button_add_container = array(
         'plural_name'   => __('containers', 'equd'),
         'singular_name' => __('container', 'equd'),
      );
      $button_add_block = array(
         'plural_name'   => __('container blocks', 'equd'),
         'singular_name' => __('container block', 'equd'),
      );
      $button_add_block_element = array(
         'plural_name'   => __('Block elements', 'equd'),
         'singular_name' => __('Block element', 'equd'),
      );
      Container::make('post_meta', __("Content for $post_type", 'equd'))
         ->show_on_post_type($post_type)
         ->add_fields(
            array(

               Field::make('complex', 'content_containers', __('Content containers:', 'equd'))
                  ->set_layout('tabbed-vertical')
                  ->setup_labels($button_add_container)
                  ->help_text(__('Content are divided into containers. One container contains title and an unlimited number of content blocks.', 'equd'))
                  ->add_fields(
                     'content_container',
                     __('Container', 'equd'),
                     array(

                        Field::make('text', 'content_container_name', __('Container name', 'equd'))
                           ->help_text(__('Title for the content container', 'equd'))
                           ->set_attribute('placeholder', __('Title for container', 'equd')),
                        Field::make('complex', 'content_blocks', __('Content blocks', 'equd'))
                           ->setup_labels($button_add_block)
                           ->add_fields(
                              'content_block',
                              __('Content block', 'equd'),
                              array(

                                 Field::make('complex', 'content_block_list', __('Block content list', 'equd'))
                                    ->setup_labels($button_add_block_element)
                                    ->set_layout('tabbed-vertical')
                                    ->help_text(__('#Content block', 'equd'))
                                    ->add_fields(
                                       'content_block_title',
                                       __('Subtitle', 'equd'),
                                       array(
                                          Field::make('text', 'content_block_title_elem', __('Subtitle'))
                                             ->set_attribute('placeholder', __('Subtitle', 'equd')),
                                       )
                                    )
                                    ->add_fields(
                                       'content_block_text',
                                       __('Text', 'equd'),
                                       array(
                                          Field::make('textarea', 'content_block_text_elem', __('Text')),
                                       )
                                    )
                                    ->add_fields(
                                       'content_block_code',
                                       __('Code', 'equd'),
                                       array(
                                          Field::make('textarea', 'content_block_code_elem', __('Code')),
                                       )
                                    )
                                    ->add_fields(
                                       'content_block_image',
                                       __('Image', 'equd'),
                                       array(
                                          Field::make('image', 'content_block_image_elem', __('Image')),
                                       )
                                    )
                                    ->add_fields(
                                       'content_block_association',
                                       __('Association', 'equd'),
                                       array(
                                          Field::make('association', 'content_block_association_elem', __('Association')),
                                       )
                                    )
                                    ->add_fields(
                                       'content_block_media_gallery',
                                       __('Media gallery', 'equd'),
                                       array(
                                          Field::make('media_gallery', 'content_block_media_gallery_elem', __('Media gallery'))
                                             ->set_type(array('image', 'video'))
                                             ->set_duplicates_allowed(false),
                                       )
                                    ),
                              )
                           ),
                     )
                  )->set_header_template('= <% if (content_container_name) { %> <%- content_container_name %> <% } %>'),
            )
         );
   }
   public function get_model(){

   }
}