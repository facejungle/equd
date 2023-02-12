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
   public static $field_slug = 'content_block_title_elem';
   public static $field_label = 'Title';

   public static function create_fields_from_array()
   {
      $array = array(self::$field_type, self::$field_slug, self::$field_label);
      return $array;
   }
   public static function add_model_for_posts($post_type, string|array $fields = 'all')
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