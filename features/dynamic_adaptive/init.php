<?php
/**
 * Init dynamic adaptive feature.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\features\loadCSS;

defined( 'ABSPATH' ) || exit;

/**
 * Init dynamic adaptive feature.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class init {
   public function __construct(){
      add_action( 'wp_enqueue_scripts', array( $this, 'reg_js' ) );
   }
	public function reg_js() {
		wp_enqueue_script( 'dynamic_adaptive', __DIR__ . 'dynamicAdapt.js', array(), '', false );
	}
}