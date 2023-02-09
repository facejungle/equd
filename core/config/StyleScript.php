<?php
/**
 * File to enable or disable styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\config;

defined( 'ABSPATH' ) || exit;

/**
 * Class for including and disabling styles and scripts.
 *
 * PHP version 8.1
 *
 * @category StyleScript
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class StyleScript {

	/**
	 * Class autoload.
	 */
	public function __construct() {
		$this->print_load_css_js();

		add_action( 'wp_enqueue_scripts', array( $this, 'reg_styles' ) );
		add_action( 'init', array($this, 'deregister_style'), 99 );
		remove_action('wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles');
		add_action( 'wp_enqueue_scripts', array( $this, 'reg_scripts' ) );
	}

	/**
	 * Outputs html code on the wp_head hook.
	 */
	private function print_load_css_js() {
		$add_js_wp_head = static function () {
			new \EQUD\config\StyleLoader();
			?>
			<link rel="preconnect" href="https://fonts.googleapis.com">
			<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
			<script>
			<?php
			require_once EQUD_PATH_CORE_JS . 'loadCSS/loadCSS.js';
			require_once EQUD_PATH_CORE_JS . 'loadCSS/onloadCSS.js';
			echo 'loadCSS( "https://fonts.googleapis.com/css2?family=Montserrat&display=swap" )';
			?>
			</script>
			<?php
		};
		add_action( 'wp_head', $add_js_wp_head, 7 );
		$add_js_wp_body_open = static function () {
			?>
			<script>
			<?php include EQUD_PATH_CORE_JS . 'checkTouch.js'; ?>
			checkTouch();
			</script>
			<?php
		};
		add_action( 'wp_body_open', $add_js_wp_body_open );
	}

	/**
	 * Register fonts and css files.
	 */
	public function reg_styles() {
		\EQUD\src\AsyncStyleScript::wp_enqueue_style_special( 'loader', EQUD_URL_CORE_CSS . 'loader.css', '', _S_VERSION, 'all', 'asyncPreload' );
		// \EQUD\src\AsyncStyleScript::wp_enqueue_style_special( 'general', EQUD_URL_CORE_CSS . 'general.css', '', _S_VERSION, 'all', 'async' );
		//\EQUD\src\AsyncStyleScript::wp_enqueue_style_special( 'mobile', EQUD_URL_CORE_CSS . 'mobile.css', '', _S_VERSION, 'screen and (max-width: 480px)', 'asyncPreload' );
		//\EQUD\src\AsyncStyleScript::wp_enqueue_style_special( 'tablet', EQUD_URL_CORE_CSS . 'tablet.css', '', _S_VERSION, 'screen and (min-width: 480px) and (max-width: 1366px)', 'asyncPreload' );

		//\EQUD\src\AsyncStyleScript::wp_enqueue_style_special( 'highlight', EQUD_URL_CORE_CSS . 'srcery.min.css', '', _S_VERSION, '', 'asyncPreload' );
	}

	/**
	 * Register fonts and css files.
	 */
	public function deregister_style() {
		//wp_deregister_style( 'wp-block-library' );
	}

	/**
	 * Register js files.
	 */
	public function reg_scripts() {
		//\EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'checkTouch', EQUD_URL_CORE_JS . 'checkTouch.js', '', _S_VERSION, false, 'async' );
		//\EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'navigation', EQUD_URL_CORE_JS . 'navigation.js', '', _S_VERSION, false, 'async' );
		//\EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'highlightjs', EQUD_URL_CORE_JS . 'highlight.min.js', '', _S_VERSION, false, 'async' );
	}
}
