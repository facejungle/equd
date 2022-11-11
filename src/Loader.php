<?php
/**
 * Основной файл для загрузки всех функций темы.
 *
 * PHP version 8.1
 *
 * @category Loader_Class
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD;

defined( 'ABSPATH' ) || exit;

/**
 * Основной класс для загрузки всех функций темы.
 *
 * @category Loader_Class
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Loader {

	/**
	 * Автозагрузка функций темы.
	 *
	 * @category Loader_Class
	 * @package  Equd
	 */
	public function __construct() {
		\EQUD\Settings::theme_supports();
		\EQUD\Settings::mime_supports();
		\EQUD\Settings::theme_menus();
		\EQUD\Settings::add_image_sizes();
		\EQUD\Settings::templates_include();

		\EQUD\Taxonomy::rename_post_tag();

		\EQUD\StyleScript::print_loadCSS_js();
		\EQUD\StyleScript::init_styles();
		\EQUD\StyleScript::init_scripts();
	}
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 *
	 * @category Loader_Class
	 * @package  Equd
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
		}
	}
}
