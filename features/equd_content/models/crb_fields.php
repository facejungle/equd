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
         // Добавляем контейнер для $post_type со списком полей им массива.
         self::create_fields_from_array($post_type, $fields);
      } elseif (is_string($fields)) {
         // Добавляем контейнер для $post_type с одним полем.
         self::create_fields_from_string($post_type, $fields);
      }
   }
   public static function get_array_fields($fields){
      $array_fields = array();
      foreach ($fields as $key => $field) {
         if($field === 'title'){
            $model = fields\title::create_fields_from_array();
            $field_type = $model[0];
            $field_slug = $model[1];
            $field_label = $model[2];
            $field = Field::make($field_type, $field_slug, __($field_label));
            array_push($array_fields, $field);
         }
         if($field === 'text'){
            $model = fields\text::create_fields_from_array();
            $field_type = $model[0];
            $field_slug = $model[1];
            $field_label = $model[2];
            $field = Field::make($field_type, $field_slug, __($field_label));
            array_push($array_fields, $field);
         }
         if($field === 'code'){
            $model = fields\code::create_fields_from_array();
            $field_type = $model[0];
            $field_slug = $model[1];
            $field_label = $model[2];
            $field = Field::make($field_type, $field_slug, __($field_label));
            array_push($array_fields, $field);
         }
      }
      return $array_fields;
   }
   public static function create_fields_from_array(string $post_type, array $fields)
   {
      Container::make('post_meta', __("Content for $post_type", 'equd'))
         ->show_on_post_type($post_type)
         ->add_fields(
            self::get_array_fields($fields)
         );
   }
   public static function create_fields_from_string(string $post_type, string $fields)
   {
      if ($fields == 'title') {
         $title = new fields\title;
         $title::add_model_for_posts($post_type, $fields);
      }
      if ($fields == 'text') {
         $text = new fields\text;
         $text::add_model_for_posts($post_type, $fields);
      }
      if ($fields == 'code') {
         $code = new fields\code;
         $code::add_model_for_posts($post_type, $fields);
      }
   }
}