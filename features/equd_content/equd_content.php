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

namespace equd_content;

use equd_content\fields\code;
use equd_content\models;
use equd_content\fields;

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
class equd_content
{
   /**
    * @param string       $model     Containers, container, blocks, block or fields.
    * @param string       $post_type Post tape name.
    * @param string|array $fields    Title, text, code.
    */
   public static function add_model_for_posts(string $model, string $post_type, string|array $fields = 'all')
   {
      match ($model) {
         'containers' => models\crb_containers::add_model_for_posts($post_type, $fields),
         'container' => models\crb_container::add_model_for_posts($post_type, $fields),
         'blocks' => models\crb_blocks::add_model_for_posts($post_type, $fields),
         'block' => models\crb_block::add_model_for_posts($post_type, $fields),
         'fields' => models\crb_fields::add_model_for_posts($post_type, $fields),
      };
   }
}