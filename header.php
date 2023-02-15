<?php

/**
 * Site header template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD;

defined( 'ABSPATH' ) || exit; ?>

<!doctype html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<html <?php language_attributes(); ?>>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'wp_body_open' ); ?>
	<header id="head-top" class="site-header">
		<div class="site-header__line flex-row">
			<div class="site-logo">
				<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						echo 'LOGO';
					}
				} else {
					echo 'LOGO';
				}
				?>
			</div>
			<div class="header-search">
				<?php get_search_form(); ?>
			</div>
			<div class="menu-button">
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
			</div>
		</div>
		<div class="site-header__line">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'site-header-menu',
					'menu_id'        => 'site-header-menu',
					'fallback_cb'    => '',

				)
			);
			?>
		</div>
		<div class="site-header__line flex-row reserve">3</div>
		<div class="site-header__line flex-row reserve">3</div>
	</header>
