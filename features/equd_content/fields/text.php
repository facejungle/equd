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
   public static function get_field(string $type, object $block = null)
   {
      if ($type === 'block') {
         $field = $block->add_fields(
            'block__text',
            __('Text', 'equd'),
            array(
               Field::make('textarea', 'text__field', __('Text'))
            )
         );
      } elseif ($type === 'field') {
         $field = Field::make('textarea', 'text__field', __('Text'));
      }
      return $field;
   }
}