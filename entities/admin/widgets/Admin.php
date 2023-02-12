<?php
/**
 * #
 *
 * PHP version 8.1
 *
 * @category EQUD_Settings Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\pages;

defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Class for basic theme settings: theme_supports, menu registration, file extension, image size.
 *
 * @category EQUD_Settings class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Admin {

	/**
	 * Автозагрузка класса.
	 * Сlass autoload.
	 */
	public function __construct() {
		$this->crb_settings_page();
	}


	private function crb_settings_page() {
		$backend_fields = static function () {
			Container::make( 'theme_options', __( 'Customize Background', 'equd' ) )
			->set_page_parent( 'equd-settings' )
			->set_page_menu_position( 1 )
			->add_fields(
				array(
					Field::make( 'color', 'crb_background_color', __( 'Background Color' ) ),
					Field::make( 'image', 'crb_background_image', __( 'Background Image' ) ),
				)
			);
		};
		add_action( 'carbon_fields_register_fields', $backend_fields );
	}

	public static function general_settings() {
		?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title(); ?></h2>
			<p>Приветствую! На этой странице расположен пример как использовать сайт.</p>
		</div>
		<?php
	}
}

