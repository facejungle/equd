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
 * @category StyleScript Class
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
		$this->async_styles();

		add_action( 'wp_enqueue_scripts', array( $this, 'reg_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'reg_scripts' ) );
	}

	/**
	 * Outputs html code on the wp_head hook.
	 */
	private function print_load_css_js() {
		$add_js_wp_head = static function () {
			?><script>
			<?php
			include EQUD_PATH_CORE_JS . 'loadCSS/loadCSS.js';
			include EQUD_PATH_CORE_JS . 'loadCSS/onloadCSS.js';
			include EQUD_PATH_CORE_JS . 'loadCSS/cssrelpreload.js';
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
		wp_register_style( 'highlight', EQUD_URL_CORE_CSS . 'srcery.min.css', '', '11.6.0', 'all' );

		wp_enqueue_style_special( 'loader', EQUD_URL_CORE_CSS . 'loader.css', '', _S_VERSION, 'all', 'asyncPreload' );
		wp_enqueue_style_special( 'general', EQUD_URL_CORE_CSS . 'general.css', '', _S_VERSION, 'all', 'asyncPreload' );
		wp_enqueue_style_special( 'mobile', EQUD_URL_CORE_CSS . 'mobile.css', '', _S_VERSION, 'screen and (max-width: 480px)', 'asyncPreload' );
		wp_enqueue_style_special( 'tablet', EQUD_URL_CORE_CSS . 'tablet.css', '', _S_VERSION, 'screen and (min-width: 480px) and (max-width: 1366px)', 'asyncPreload' );
	}

	/**
	 * Register js files.
	 */
	public function reg_scripts() {
		wp_register_script( 'highlightjs', EQUD_URL_CORE_JS . 'highlight.min.js', '', '11.6.0', false );

		wp_enqueue_script_special( 'checkTouch', EQUD_URL_CORE_JS . 'checkTouch.js', '', _S_VERSION, false, 'async' );
		wp_enqueue_script_special( 'navigation', EQUD_URL_CORE_JS . 'navigation.js', '', _S_VERSION, false, 'async' );
	}
	public function async_styles() {
		/**
		 * Reusable loaders
		 */
		global $specialLoadHnds;
		$specialLoadHnds = (object) array(
			'scripts' => (object) array(
				'async' => array(),
				'defer' => array(),
			),
			'styles'  => (object) array(
				'async'        => array(),
				'asyncPreload' => array(),
			),
		);
		// Same signature as wp_enqueue_style, + $loadMethod as last arg
		function wp_enqueue_style_special( $handle, $srcString, $depArray, $version, $media, $loadMethod ) {
			global $specialLoadHnds;
			array_push( $specialLoadHnds->styles->{$loadMethod}, $handle );
			wp_enqueue_style( $handle, $srcString, $depArray, $version, $media );
		}
		// Same signature as wp_enqueue_script, + $loadMethod as last arg
		// Reminder - $inFooter should probably be false for both async and defer
		function wp_enqueue_script_special( $handle, $srcString, $depArray, $version, $inFooter, $loadMethod ) {
			global $specialLoadHnds;
			array_push( $specialLoadHnds->scripts->{$loadMethod}, $handle );
			wp_enqueue_script( $handle, $srcString, $depArray, $version, $inFooter );
		}
		// Identical signature to wp_enqueue_style
		function wp_enqueue_style_deferred( $handle, $srcString, $depArray, $version, $media ) {
			wp_enqueue_style_special( $handle, $srcString, $depArray, $version, $media, 'async' );
		}
		/**
		 * Custom Script and Style Enqueued stuff
		 */
		/**
		 * Callback for WP to hit before echoing out an enqueued resource
		 *
		 * @param {string}      $tag     - Will be the full string of the tag (`<link>` or `<script>`)
		 * @param {string}      $handle  - The handle that was specified for the resource when enqueuing it
		 * @param {string}      $src     - the URI of the resource
		 * @param {string|null} $media   - if resources is style, should be the target media, else null
		 * @param {boolean}     $isStyle - If the resource is a stylesheet
		 */
		function scriptAndStyleTagCallback( $tag, $handle, $src, $media, $isStyle ) {
			global $specialLoadHnds;
			$finalTag = $tag;
			if ( $isStyle ) {
				// Async loading via invalid mediaquery switching
				if ( in_array( $handle, $specialLoadHnds->styles->async, true ) ) {
					// Do not touch if already modified
					if ( ! preg_match( '/\sonload=|\smedia=["\']none["\']/', $tag ) ) {
						// Lazy load with JS, but also but noscript in case no JS
						$noScriptStr = '<noscript>' . $tag . '</noscript>';
						// Add onload and media="none" attr, and put together with noscript
						$matches = array();
						preg_match( '/(<link[^>]+)>/', $tag, $matches );
						$finalTag = preg_replace( '/\/$/', '', $matches[1], 1 ) . ' media="none" onload="if(media!=\'all\')media=\'all\'"' . ' />' . $noScriptStr;
					}
				}
				// Async loading via preload and loadCSS - https://github.com/filamentgroup/loadCSS/
				elseif ( in_array( $handle, $specialLoadHnds->styles->asyncPreload, true ) ) {
					// Do not touch if already modified
					if ( ! preg_match( '/\srel=["\']preload|\sonload=["\']/', $tag ) ) {
						// Lazy load with JS, but also but noscript in case no JS
						$noScriptStr = '<noscript>' . $tag . '</noscript>';
						// Strip rel="" & as="" portion, if exist
						$tag = preg_replace( '/\srel=["\'][^"\']*["\']|\sas=["\'][^"\']*["\']/', '', $tag, -1 );
						// Add onload, rel="preload", as="style", and put together with noscript
						$matches = array();
						preg_match( '/(<link[^>]+)>/', $tag, $matches );
						$finalTag = preg_replace( '/\/$/', '', $matches[1], 1 ) . ' rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"' . ' />' . $noScriptStr;
					}
				}
			} else {
				// Async
				if ( in_array( $handle, $specialLoadHnds->scripts->async, true ) ) {
					// Do not touch if already modified, or missing src attr
					if ( ! preg_match( '/\sasync/', $tag ) && preg_match( '/src=/', $tag ) ) {
						// Add async attr
						$matches = array();
						preg_match( '/(<script[^>]+)>/', $tag, $matches );
						$finalTag = $matches[1] . ' async="true"' . '></script>';
					}
				}
				// Defer
				elseif ( in_array( $handle, $specialLoadHnds->scripts->defer, true ) ) {
					// Do not touch if already modified, or missing src attr
					if ( ! preg_match( '/\sdefer/', $tag ) && preg_match( '/src=/', $tag ) ) {
						// Add defer attr
						$matches = array();
						preg_match( '/(<script[^>]+)>/', $tag, $matches );
						$finalTag = $matches[1] . ' defer' . '></script>';
					}
				}
			}
			return $finalTag;
		}
		// BE CAREFUL OF PRIORITY
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle, $src ) {
				return scriptAndStyleTagCallback( $tag, $handle, $src, null, false );
			},
			10,
			4
		);
		add_filter(
			'style_loader_tag',
			function ( $tag, $handle, $src, $media ) {
				return scriptAndStyleTagCallback( $tag, $handle, $src, $media, true );
			},
			10,
			4
		);
	}
}
