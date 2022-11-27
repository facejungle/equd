<?php
/**
 * Файл для подключения или отключения стилей и скриптов.
 * File to enable or disable styles and scripts.
 *
 * PHP version 8.1
 *
 * @category StyleScript Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Settings;

defined( 'ABSPATH' ) || exit;
/**
 * Класс подключения и отключения стилей и скриптов.
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
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		self::print_load_css_js();
		self::init_styles();
		self::init_scripts();
	}
	/**
	 * Выводит код html на хуке wp_head.
	 * Outputs html code on the wp_head hook.
	 */
	private static function print_load_css_js() {
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
	/**
	 * Подключение шрифтов и файлов css.
	 * Including fonts and css files.
	 */
	private static function init_styles() {
		$styles = static function () {
			wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap', '', _S_VERSION, 'all' );
			wp_enqueue_style( 'equd-loader', EQUD_URL . '/assets/css/loader.css', '', _S_VERSION, 'all' );
			wp_enqueue_style( 'equd-general', EQUD_URL . '/assets/css/general.css', '', _S_VERSION, 'all' );
			wp_enqueue_style( 'highlight', EQUD_URL . '/assets/css/srcery.min.css', '', _S_VERSION, 'all' );
		};
		add_action( 'wp_enqueue_scripts', $styles );
	}
	/**
	 * Подключение фалов js.
	 * Including js files.
	 */
	private static function init_scripts() {
		wp_enqueue_script( 'highlightjs', EQUD_URL . '/assets/js/highlight.min.js', array(), '1.0', true );
	}
}
