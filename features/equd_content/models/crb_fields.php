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
   public $post_type;
   public $fields;
   public $meta;
   public static $container;
   public static $model_field;
   public function add_model_for_posts(string $post_type, string|array $fields)
   {
      $this->post_type = $post_type;
      $this->fields = $fields;
      // Create a container and write the model to $container.
      self::$container =
         Container::make('post_meta', 'crb_fields', __("Content for $this->post_type", 'equd'))
            ->show_on_post_type($this->post_type);
      $container = self::$container;

      // Create a field model, add elements, and write the model to $model_field.
      $model_field = $this->make_model_field($this->fields);

      // Add the created field model to the container.
      $container->add_fields($model_field);
      return $container;
   }
   public function make_model_field($fields)
   {
      $button_add_block = array(
         'plural_name' => __('container blocks', 'equd'),
         'singular_name' => __('container block', 'equd'),
      );
      self::$model_field =
         Field::make('complex', 'content_blocks', __('Content blocks', 'equd'))
            ->setup_labels($button_add_block);
      $model_field = self::$model_field;
      $model_field->add_fields($this->make_fields($fields, 'field'));
      return $model_field;
   }
   public function make_fields(string|array $fields, string $type, object $block = null)
   {
      if ($type === 'field') {
         $array_field_models = array();

         if (is_array($fields)) {
            foreach ($fields as $field) {
               $field_model = '\\equd_content\\fields\\' . $field;
               array_push($array_field_models, $field_model::get_field($type));
            }
         } else {
            $field_model = '\\equd_content\\fields\\' . $fields;
            array_push($array_field_models, $field_model::get_field($type));
         }
         return $array_field_models;
      } elseif ($type === 'block') {
         if ($block) {
            $array_field_models = array();
            if (is_array($fields)) {
               foreach ($fields as $field) {
                  $field_model = '\\equd_content\\fields\\' . $field;
                  $field_model::get_field($type, $block);
               }
            } else {
               $field_model = '\\equd_content\\fields\\' . $fields;
               $field_model::get_field($type, $block);
            }
            return $array_field_models;
         }
      }
   }
   public function view_model()
   {
      require_once(EQUD_PATH_FEATURES . 'equd_content/templates/fields.php');
   }
}