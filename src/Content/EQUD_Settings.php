<?php
/**
 * Файл с основными настройками темы.
 * File with basic theme settings.
 *
 * PHP version 8.1
 *
 * @category EQUD_Settings Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Класс для основных настроек темы: theme_supports, регистрация меню, расширение файлов, размер изображений.
 * Class for basic theme settings: theme_supports, menu registration, file extension, image size.
 *
 * @category EQUD_Settings class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class EQUD_Settings {
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->crb_settings_page();
		$this->equd_theme_page();
	}
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	private function equd_theme_page() {
		add_action(
			'admin_menu',
			function() {
				add_menu_page( __( 'EQUD theme tutorial and settings' ), __( 'EQUD theme' ), 'manage_options', 'equd-settings', '\EQUD\Content\EQUD_Settings::add_my_setting', 'dashicons-welcome-view-site', 2 );
				add_submenu_page( 'equd-settings', 'Основное доп. меню', 'Мое основное меню', 'manage_options', 'equd-settings' );
			}
		);
	}
	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	private function crb_settings_page() {
		$backend_fields = static function() {
			Container::make( 'theme_options', __( 'Customize Background' ) )
			->set_page_parent( 'equd-settings' )
			->add_fields(
				array(
					Field::make( 'color', 'crb_background_color', __( 'Background Color' ) ),
					Field::make( 'image', 'crb_background_image', __( 'Background Image' ) ),
				)
			);
		};
		add_action( 'carbon_fields_register_fields', $backend_fields );
	}
	public static function add_my_setting() {
		?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title(); ?></h2>
			<p>Приветствую! На этой странице расположен пример как использовать сайт.</p>
		</div>
		<?php
	}
}
