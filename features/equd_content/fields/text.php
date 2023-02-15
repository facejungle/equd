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

namespace equd_content\fields;

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
class text extends fields_abstract
{
   public static $field = 'text';
   public static $field_type = 'textarea';
   public static $field_slug = 'text__field';
   public static $field_label = 'Text';
   public static function get_field()
   {
      $field = Field::make(self::$field_type, self::$field_slug, __(self::$field_label));
      return $field;
   }
   public function create_container_with_field(string $post_type)
   {
      Container::make('post_meta', __("Content for $post_type", 'equd'))
         ->show_on_post_type($post_type)
         ->add_fields(
            array(
               Field::make(self::$field_type, self::$field_slug, __(self::$field_label)),
            )
         )
      ;
   }
   public static function field_template(){
      global $post;
      $text = carbon_get_post_meta($post->ID, self::$field_slug);
      if ($text) {
         echo '<p>' . carbon_get_post_meta($post->ID, self::$field_slug) . '</p>';
      }
   }
}