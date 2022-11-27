<?php
/**
 * Основной файл всех функций темы.
 * The main file of all theme functions.
 *
 * PHP version 8.1
 *
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

if ( ! defined( 'EQUD_URL' ) ) {
	define( 'EQUD_URL', get_template_directory_uri() );
}

if ( ! defined( 'EQUD_PATH' ) ) {
	define( 'EQUD_PATH', get_template_directory() );
}

require_once EQUD_PATH . '/autoload.php';
/**
 * Запуск проверки на зависимости.
 * Run a dependency check.
 */
function run_check_depends() {
	\EQUD\Loader::check_depends();
}
add_action( 'admin_init', 'run_check_depends' );

new \EQUD\Loader();
