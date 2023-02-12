<?php
/**
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\app;

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
class style_script {

	/**
	 * Class autoload.
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'reg_styles' ) );
		add_action( 'init', array( $this, 'deregister_style' ), 99 );
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles' );
		add_action( 'wp_enqueue_scripts', array( $this, 'reg_scripts' ) );
	}

	/**
	 * Register fonts and css files.
	 */
	public function reg_styles() {
		\async_style_script::wp_enqueue_style_special( 'loader', EQUD_URL_CORE_CSS . 'loader.css', '', _S_VERSION, 'all', 'asyncPreload' );
		// \EQUD\features\async_style_script::wp_enqueue_style_special( 'general', EQUD_URL_CORE_CSS . 'general.css', '', _S_VERSION, 'all', 'async' );
		// \EQUD\features\async_style_script::wp_enqueue_style_special( 'mobile', EQUD_URL_CORE_CSS . 'mobile.css', '', _S_VERSION, 'screen and (max-width: 480px)', 'asyncPreload' );
		// \EQUD\features\async_style_script::wp_enqueue_style_special( 'tablet', EQUD_URL_CORE_CSS . 'tablet.css', '', _S_VERSION, 'screen and (min-width: 480px) and (max-width: 1366px)', 'asyncPreload' );
		// \EQUD\features\async_style_script::wp_enqueue_style_special( 'highlight', EQUD_URL_CORE_CSS . 'highlight.css', '', _S_VERSION, '', 'async' );
	}

	/**
	 * Register fonts and css files.
	 */
	public function deregister_style() {
		// wp_deregister_style( 'wp-block-library' );
	}

	/**
	 * Register js files.
	 */
	public function reg_scripts() {
		// \EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'checkTouch', EQUD_URL_CORE_JS . 'checkTouch.js', '', _S_VERSION, false, 'async' );
		// \EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'navigation', EQUD_URL_CORE_JS . 'navigation.js', '', _S_VERSION, false, 'async' );
		// \EQUD\src\AsyncStyleScript::wp_enqueue_script_special( 'highlightjs', EQUD_URL_CORE_JS . 'highlight.min.js', '', _S_VERSION, false, 'async' );
	}
}
