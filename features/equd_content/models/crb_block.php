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

defined('ABSPATH') || exit;

use equd_content\fields;
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
class crb_block implements models_interface
{
   public static function add_model_for_posts(string $post_type, string|array $fields = 'all')
   {
      Container::make('post_meta', 'equd_fields_container', __("Content for $post_type", 'equd'))
         ->show_on_post_type($post_type)
         ->add_fields(
            array(
               self::make_block($fields)
            )
         );
   }
   public static function make_block($fields)
   {
      $button_add_block_element = array(
         'plural_name' => __('Block elements', 'equd'),
         'singular_name' => __('Block element', 'equd'),
      );
      $block =
         Field::make('complex', 'content_block_list', __('Block content list', 'equd'))
            ->setup_labels($button_add_block_element)
            ->set_layout('tabbed-vertical')
            ->help_text(__('#Content block', 'equd'));
      foreach ($fields as $key => $field) {
         if ($field === 'title') {
            $block->add_fields(
               'block__title',
               __('Title', 'equd'),
               array(
                  fields\title::get_field()
               )
            );
         } elseif ($field === 'text') {
            $block->add_fields(
               'block__text',
               __('Text', 'equd'),
               array(
                  fields\text::get_field()
               )
            );
         } elseif ($field === 'code') {
            $block->add_fields(
               'block__code',
               __('Code', 'equd'),
               array(
                  fields\code::get_field()
               )
            );
         }
      }
      return $block;
   }

   public static function view_model_for_posts(string $post_type, string|array $fields = 'all')
   {
      if(is_single() || is_singular()){
         global $post;
         if($post->post_type === $post_type){
            add_action('equd_content', require(EQUD_PATH_FEATURES . 'equd_content/templates/block.php'));
         }
      }
   }
}