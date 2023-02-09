<?php
/**
 * The main file of all theme functions.
 *
 * PHP version 8.1
 *
 * @package EQUD
 * @author  Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/facejungle/equd
 */

namespace EQUD;
defined( 'ABSPATH' ) || exit;

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.1.0' );
}

if ( ! defined( 'EQUD_URL' ) ) {
	define( 'EQUD_URL', get_template_directory_uri() );
}

if ( ! defined( 'EQUD_URL_CORE_CSS' ) ) {
	define( 'EQUD_URL_CORE_CSS', EQUD_URL . '/assets/css/' );
}
if ( ! defined( 'EQUD_URL_CORE_JS' ) ) {
	define( 'EQUD_URL_CORE_JS', EQUD_URL . '/assets/js/' );
}
if ( ! defined( 'EQUD_URL_CORE_IMG' ) ) {
	define( 'EQUD_URL_CORE_IMG', EQUD_URL . '/assets/images/' );
}

if ( ! defined( 'EQUD_PATH' ) ) {
	define( 'EQUD_PATH', get_template_directory() );
}

if ( ! defined( 'EQUD_PATH_CORE_CSS' ) ) {
	define( 'EQUD_PATH_CORE_CSS', EQUD_PATH . '/assets/css/' );
}

if ( ! defined( 'EQUD_PATH_CORE_JS' ) ) {
	define( 'EQUD_PATH_CORE_JS', EQUD_PATH . '/assets/js/' );
}

if ( ! defined( 'EQUD_PATH_CORE_IMG' ) ) {
	define( 'EQUD_PATH_CORE_IMG', EQUD_PATH . '/assets/image/' );
}

require_once EQUD_PATH . '/vendor/autoload.php';
new \EQUD\config\Loader();