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
			<div class="header-line__logo">
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
			<div class="header-line__search">
			<?php get_search_form(); ?>
			</div>
			<div class="header-line__login">
			<?php \EQUD\Content\Tags::login_form(); ?>
			</div>
		</div>
		<div class="header-line flex-row">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'top-menu',
					'menu_id'        => 'top-menu',
					'fallback_cb'    => '',
					'walker'         => new \EQUD\Settings\MenuWalker(),
				)
			);
			?>
		</div>
	</header>
<!-- ================================================================================================================================================= -->
<main id="primary" class="site-main">
	<header class=""entry-header></header>
</main>
<!-- ================================================================================================================================================= -->
?>
<?php
/**
 * Общий шаблон подвала сайта.
 * General site footer template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

?>
<footer id="colophon" class="site-footer">
	<div class="site-footer__row">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer-horizontal',
				'menu_id'        => 'footer-horizontal',
			)
		);
		?>
	</div>
	<div class="site-footer__row nav flex-row">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer-menu1',
				'menu_id'        => 'footer-menu1',
			)
		);
		wp_nav_menu(
			array(
				'theme_location' => 'footer-menu2',
				'menu_id'        => 'footer-menu2',
			)
		);
		wp_nav_menu(
			array(
				'theme_location' => 'footer-menu3',
				'menu_id'        => 'footer-menu3',
			)
		);
		wp_nav_menu(
			array(
				'theme_location' => 'footer-menu4',
				'menu_id'        => 'footer-menu4',
			)
		);
		?>
	</div>
	<div class="site-footer__row">
		<div class="site-info">
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'equd' ), 'equd', '<a href="https://vk.com/face_jungle">face jungle ;c</a>' );
			?>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- page__wrapper -->
<?php wp_footer(); ?>
</body>
</html>







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
				<div class="header-login">
				<?php \EQUD\Content\Tags::login_form(); ?>
				</div>
			</div>
			<div class="site-header__line flex-row">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-menu',
						'menu_id'        => 'top-menu',
						'fallback_cb'    => '',
						'walker'         => new \EQUD\Settings\MenuWalker(),
					)
				);
				?>
			</div>
		</header>
		<main id="primary" class="site-main">
			<header class="entry-header flex-row"></header>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<aside></aside>
				<main class="entry-content"></main>
				
			</article>
			<footer class="entry-footer"></footer>
		</main>
		<footer id="colophon" class="site-footer">
			<div class="site-footer__line">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-horizontal',
						'menu_id'        => 'footer-horizontal',
					)
				);
				?>
			</div>
			<div class="site-footer__line nav flex-row">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu1',
						'menu_id'        => 'footer-menu1',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu2',
						'menu_id'        => 'footer-menu2',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu3',
						'menu_id'        => 'footer-menu3',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu4',
						'menu_id'        => 'footer-menu4',
					)
				);
				?>
			</div>
			<div class="site-footer__line">
				<div class="site-info">
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'equd' ), 'equd', '<a href="https://vk.com/face_jungle">face jungle ;c</a>' );
					?>
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
		<?php wp_footer(); ?>
		<script>hljs.highlightAll();</script>
	</body>
</html>
