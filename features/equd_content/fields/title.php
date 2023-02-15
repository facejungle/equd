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
class title extends fields_abstract
{
   public static $field = 'title';
   public static $field_type = 'text';
   public static $field_slug = 'title__field';
   public static $field_label = 'Title';

   public static function get_field()
   {
      $field = Field::make(self::$field_type, self::$field_slug, __(self::$field_label));
      return $field;
   }
   public static function field_template()
   {
      global $post;
      $title = carbon_get_post_meta($post->ID, self::$field_slug);
      if ($title) {
         echo '<h3>' . carbon_get_post_meta($post->ID, self::$field_slug) . '</h3>';
      }
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
}