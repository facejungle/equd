<?php
/**
 * Общий шаблон шапки сайта.
 * General site header template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

defined( 'ABSPATH' ) || exit; ?>

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
		<div class="site-header__line flex-column">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'menu_id'        => 'top-menu',
					'fallback_cb'    => '',
					'walker'         => new \EQUD\config\MenuWalker(),
				)
			);
			?>
			<section class="toogle-menu">
				<p>toogle</p>
				<p>toogle</p>
				<p>toogle</p>
				<p>toogle</p>
				<p>toogle</p>
				<p>toogle</p>
			</section>
		</div>
		<div class="site-header__line reserve flex-row"></div>
	</header>
