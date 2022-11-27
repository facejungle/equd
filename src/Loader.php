<?php
/**
 * Основной файл для загрузки всех функций темы.
 * The main file to load all the features of the theme.
 *
 * PHP version 8.1
 *
 * @category Loader_Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD;

defined( 'ABSPATH' ) || exit;

/**
 * Основной класс для загрузки всех функций темы.
 * The main class to load all the features of the theme.
 *
 * @category Loader_Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Loader {

	/**
	 * Автозагрузка функций темы.
	 * Autoload theme functions.
	 */
	public function __construct() {
		$theme_supports = new \EQUD\Settings\ThemeSupports();
		$style_script   = new \EQUD\Settings\StyleScript();

		$site_settings = new \EQUD\Content\EQUD_Settings();

		$tax_categories = new \EQUD\Content\Categories();
		$tax_programms  = new \EQUD\Content\Tax_Programms();
		$tax_devices    = new \EQUD\Content\Tax_Devices();

		$post_leassons = new \EQUD\Content\Post_Leassons();
		$post_news     = new \EQUD\Content\Post_News();
		$post_docs     = new \EQUD\Content\Post_Docs();
	}
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 * Check for installation of dependencies and display an informational message.
	 */
	public static function check_depends() {
		$notice_carbonfields = static function () {
			?>
			<div class="notice notice-error">
				<p>
					<b><?php esc_html_e( 'EQUD THEME :', 'equd' ); ?></b>
					<?php esc_html_e( 'Install the depend', 'equd' ); ?>
					<a href="https://carbonfields.net/zip/latest/">
						<b>Carbon Fields plugin</b>
					</a>
				</p>
				<p>Information:
					<a href="https://carbonfields.net"><b>carbonfields.net</b>
					</a>
				</p>
			</div>
			<?php
		};
		if ( ! class_exists( '\\Carbon_Fields\\Container\\Container' ) ) {
			add_action( 'admin_notices', $notice_carbonfields );
		} else {
			\Carbon_Fields\Carbon_Fields::boot();
		}
	}
}
