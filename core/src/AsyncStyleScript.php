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

namespace EQUD\src;

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
class AsyncStyleScript {

	public $specialLoadHnds;
	public function __construct() {
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
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle, $src ) {
				return $this->scriptAndStyleTagCallback( $tag, $handle, $src, null, false );
			},
			10,
			4
		);
		add_filter(
			'style_loader_tag',
			function ( $tag, $handle, $src, $media ) {
				return $this->scriptAndStyleTagCallback( $tag, $handle, $src, $media, true );
			},
			10,
			4
		);
	}

	public static function wp_enqueue_style_special( $handle, $srcString, $depArray, $version, $media, $loadMethod ) {
		global $specialLoadHnds;

		array_push( $specialLoadHnds->styles->{$loadMethod}, $handle );
		wp_enqueue_style( $handle, $srcString, $depArray, $version, $media );
	}

	public static function wp_enqueue_script_special( $handle, $srcString, $depArray, $version, $inFooter, $loadMethod ) {
		global $specialLoadHnds;
		array_push( $specialLoadHnds->scripts->{$loadMethod}, $handle );
		wp_enqueue_script( $handle, $srcString, $depArray, $version, $inFooter );
	}

	public static function wp_enqueue_style_deferred( $handle, $srcString, $depArray, $version, $media ) {
		self::wp_enqueue_style_special( $handle, $srcString, $depArray, $version, $media, 'async' );
	}

	public static function scriptAndStyleTagCallback( $tag, $handle, $src, $media, $isStyle ) {
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
}

