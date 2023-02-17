<?php
/**
 * Async  styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace loadCSS;

defined( 'ABSPATH' ) || exit;

/**
 * Class for including and disabling styles and scripts.
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
	public function __construct() {
		add_action( 'wp_head', array( $this, 'print_js' ), 7 );
	}
	public function print_js() {
		?>
	  <script>
		<?php
		 require_once __DIR__ . '/loadCSS.js';
		 require_once __DIR__ . '/onloadCSS.js';
		?>
	  </script>
		<?php
	}
}
