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

use equd_content\fields;
use equd_content\fields\fields_abstract;

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
class crb_fields implements models_interface
{
   public static function add_model_for_posts(string $post_type, string|array $fields = 'all')
   {
      if (is_array($fields)) {
         // Add a container for $post_type with a list of fields from the collected array using make_array_fields()
         Container::make('post_meta', __("Content for $post_type", 'equd'))
         ->show_on_post_type($post_type)
         ->add_fields(
            self::make_array_fields($fields)
         );
      } elseif (is_string($fields)) {
         // Добавляем контейнер для $post_type с одним полем.
         if ($fields == 'title') {
            $field_model = new fields\title;
            self::create_container_with_field($field_model, $post_type);
            self::view_model_for_posts($post_type);
         }
         if ($fields == 'text') {
            $field_model = new fields\text;
            self::create_container_with_field($field_model, $post_type);
         }
         if ($fields == 'code') {
            $field_model = new fields\code;
            self::create_container_with_field($field_model, $post_type);
         }
      }
   }
   public static function view_model_for_posts(string $post_type, string|array $fields = 'all')
   {
      if(is_single() || is_singular()){
         global $post;
         if($post->post_type === $post_type){
            add_action('equd_content', require(EQUD_PATH_FEATURES . 'equd_content/templates/fields.php'));
         }
      }
   }
   public static function create_container_with_field(fields_abstract $field_model, string $post_type)
   {
      Container::make('post_meta', 'equd_fields_container', __("Content for $post_type", 'equd'))
      ->show_on_post_type($post_type)
      ->add_fields(
         array($field_model::get_field())
      );
   }
   public static function make_array_fields($fields)
   {
      $array_fields = array();
      foreach ($fields as $key => $field) {
         if ($field === 'title') {
            $field = fields\title::get_field();
            array_push($array_fields, $field);
         }
         if ($field === 'text') {
            $field = fields\text::get_field();
            array_push($array_fields, $field);
         }
         if ($field === 'code') {
            $field = fields\code::get_field();
            array_push($array_fields, $field);
         }
      }
      return $array_fields;
   }
}