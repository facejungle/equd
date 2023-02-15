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

defined('ABSPATH') || exit;

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
   public function __construct(){
      add_action( 'wp_enqueue_scripts', array( $this, 'highlight' ) );
   }
   /**
    * @param string       $model     Model type: containers, container, blocks, block or fields.
    * @param string       $post_type Post type name.
    * @param string|array $fields    Fields: title, text, code, image, gallery, association.
    */
   public static function add_model_for_posts(string $post_type, string $model, string|array $fields)
   {
      if ($model === 'fields') {
         $content_model = new models\crb_fields();
      } elseif ($model === 'block') {
         $content_model = new models\crb_block();
      } elseif ($model === 'blocks') {
         $content_model = new models\crb_blocks();
      } elseif ($model === 'container') {
         $content_model = new models\crb_container();
      } elseif ($model === 'containers') {
         $content_model = new models\crb_containers();
      }
      $content_model::add_model_for_posts($post_type, $fields);
      $content_model::view_model_for_posts($post_type, $fields);
   }
   public function highlight ()
   {
      wp_register_script( 'highlightjs', get_template_directory_uri() . '/features/equd_content/highlight/highlight.min.js', array(), '11.6.0', false );
      wp_register_style( 'highlight', get_template_directory_uri() . '/features/equd_content/highlight/highlight.css', array(), '11.6.0', 'all' );
   }
}