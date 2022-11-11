<?php

namespace EQUD;

/**
 * @package equd
 */
defined( 'ABSPATH' ) || exit;

class StyleScript {

	public static function print_loadCSS_js() {
		$add_load_css = static function () {
			?><script>
			<?php
			readfile( EQUD_PATH . '/assets/js/loadCSS.js' );
			readfile( EQUD_PATH . '/assets/js/onloadCSS.js' );
			readfile( EQUD_PATH . '/assets/js/cssrelpreload.js' );
			?>
			</script>
			<?php
		};
		add_action( 'wp_head', $add_load_css, 7 );
	}

	public static function init_styles() {
		$styles = static function () {
			wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap', '', _S_VERSION, 'all' );
			wp_enqueue_style( 'equd-loader', EQUD_URL . '/assets/css/loader.css', '', _S_VERSION, 'all' );
			wp_enqueue_style( 'equd-general', EQUD_URL . '/assets/css/general.css', '', _S_VERSION, 'all' );
		};
		add_action( 'wp_enqueue_scripts', $styles );
	}
	public static function init_scripts() {

	}
}
