<?php
/**
 * Общий шаблон шапки сайта.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
<!doctype html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<html <?php language_attributes(); ?>>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header class="header">
		<div class="header-line flex-row">
			<div class="header-line__logo">LOGO</div>
			<div class="header-line__search">SEARCH</div>
			<div class="header-line__login">SIGN IN / SIGN UP</div>
		</div>
		<div class="header-line flex-row">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'menu_id'        => 'top-menu',
					'fallback_cb'    => '',
					'walker'         => new \EQUD\MenuWalker(),
				)
			);
			?>
		</div>
	</header>
