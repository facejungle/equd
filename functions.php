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

defined('ABSPATH') || exit;

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.1.1');
}

if (!defined('EQUD_URL')) {
	define('EQUD_URL', get_template_directory_uri());
}
if (!defined('EQUD_URL_APP')) {
	define('EQUD_URL_APP', EQUD_URL . '/app/');
}
if (!defined('EQUD_URL_ENTITIES')) {
	define('EQUD_URL_ENTITIES', EQUD_URL . '/entities/');
}
if (!defined('EQUD_URL_FEATURES')) {
	define('EQUD_URL_FEATURES', EQUD_URL . '/features/');
}
if (!defined('EQUD_URL_WIDGETS')) {
	define('EQUD_URL_WIDGETS', EQUD_URL . '/widgets/');
}
if (!defined('EQUD_URL_SHARED')) {
	define('EQUD_URL_SHARED', EQUD_URL . '/shared/');
}


if (!defined('EQUD_URL_CORE_CSS')) {
	define('EQUD_URL_CORE_CSS', EQUD_URL . '/app/assets/css/');
}
if (!defined('EQUD_URL_CORE_JS')) {
	define('EQUD_URL_CORE_JS', EQUD_URL . '/app/assets/js/');
}
if (!defined('EQUD_URL_CORE_IMG')) {
	define('EQUD_URL_CORE_IMG', EQUD_URL . '/app/assets/images/');
}




if (!defined('EQUD_PATH')) {
	define('EQUD_PATH', get_template_directory());
}
if (!defined('EQUD_PATH_APP')) {
	define('EQUD_PATH_APP', EQUD_PATH . '/app/');
}
if (!defined('EQUD_PATH_ENTITIES')) {
	define('EQUD_PATH_ENTITIES', EQUD_PATH . '/entities/');
}
if (!defined('EQUD_PATH_FEATURES')) {
	define('EQUD_PATH_FEATURES', EQUD_PATH . '/features/');
}
if (!defined('EQUD_PATH_WIDGETS')) {
	define('EQUD_PATH_WIDGETS', EQUD_PATH . '/widgets/');
}
if (!defined('EQUD_PATH_SHARED')) {
	define('EQUD_PATH_SHARED', EQUD_PATH . '/shared/');
}


if (!defined('EQUD_PATH_CORE_CSS')) {
	define('EQUD_PATH_CORE_CSS', EQUD_PATH . '/app/assets/css/');
}

if (!defined('EQUD_PATH_CORE_JS')) {
	define('EQUD_PATH_CORE_JS', EQUD_PATH . '/app/assets/js/');
}

if (!defined('EQUD_PATH_CORE_IMG')) {
	define('EQUD_PATH_CORE_IMG', EQUD_PATH . '/app/assets/image/');
}

require_once EQUD_PATH . '/vendor/autoload.php';
new \EQUD\app\loader();
