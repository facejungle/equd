<?php
/**
 * ###
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\entities\lesson\app;

defined( 'ABSPATH' ) || exit;

use equd_content\equd_content;

/**
 * Loader for post type - lesson.
 *
 * @category Loader class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class loader {
   public static $post_content;
   public function __construct(){
      $register = new register();
      $taxonomy = new taxonomy();
      new \post_link( 'lesson', 'category', '%equd_replace_tag%' );
      self::$post_content = new equd_content('lesson', 'crb_blocks', array('title', 'text', 'code'));
		self::$post_content->add_model_for_posts();
   }
}