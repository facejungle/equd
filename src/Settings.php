<?php
/**
 * Расширяющий класс для Walker_Nav_Menu
 *
 * PHP version 8.1
 *
 * @category Settings_Class
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD;

defined( 'ABSPATH' ) || exit;

/**
 * Расширяющий класс для Walker_Nav_Menu. Позволяет перезаписать <ul class="sub-menu">
 *
 * @category Settings_Class
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Settings {
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 *
	 * @category Settings_Class
	 * @package  Equd
	 */
	public static function theme_supports() {
		$theme_supports = static function () {
			load_theme_textdomain( 'equd', get_template_directory() . '/languages' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'style',
					'script',
				)
			);
			$GLOBALS['content_width'] = apply_filters( 'equd_content_width', 1520 );
		};
		add_action( 'after_setup_theme', $theme_supports );
		add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
	}
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 *
	 * @category Settings_Class
	 * @package  Equd
	 */
	public static function mime_supports() {
		add_filter(
			'upload_mimes',
			function ( $mimes ) {
				$mimes['webp'] = 'image/webp';
				$mimes['svg']  = 'image/svg+xml';
				return $mimes;
			}
		);
	}
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 *
	 * @category Settings_Class
	 * @package  Equd
	 */
	public static function theme_menus() {
		$theme_menus = static function () {
			register_nav_menus(
				array(
					'top-menu'          => esc_html__( 'Top menu', 'equd' ),
					'toggle-menu'       => esc_html__( 'Toggle menu', 'equd' ),
					'footer-horizontal' => esc_html__( 'Footer horizontal', 'equd' ),
					'footer-menu1'      => esc_html__( 'Footer menu 1', 'equd' ),
					'footer-menu2'      => esc_html__( 'Footer menu 2', 'equd' ),
					'footer-menu3'      => esc_html__( 'Footer menu 3', 'equd' ),
					'footer-menu4'      => esc_html__( 'Footer menu 4', 'equd' ),
				)
			);
		};
		add_action( 'after_setup_theme', $theme_menus );
	}
	/**
	 * Добавление размеров изображений для обрезки во время зарузки в медиафайлах, а так же для вставки на сайт.
	 *
	 * @category Settings_Class
	 * @package  Equd
	 */
	public static function add_image_sizes() {
		$choose_image_sizes = static function ( $sizes ) {
			return array_merge(
				$sizes,
				array(
					'2k-size'     => __( '2k size', 'equd' ),
					'1080-size'   => __( '1080 size', 'equd' ),
					'768-size'    => __( '768 size', 'equd' ),
					'360-size'    => __( '360 size', 'equd' ),
					'mobile-size' => __( 'Mobile size', 'equd' ),
				)
			);
		};
		add_filter( 'image_size_names_choose', $choose_image_sizes );
		$image_sizes = static function ( $sizes ) {
			add_image_size( '2k-size', 9999, 1080, array( 'center', 'bottom' ) );
			add_image_size( '1080-size', 9999, 540, array( 'center', 'bottom' ) );
			add_image_size( '768-size', 9999, 384, array( 'center', 'bottom' ) );
			add_image_size( '360-size', 9999, 180, array( 'center', 'bottom' ) );
			add_image_size( 'mobile-size', 480, 450, array( 'center', 'bottom' ) );
		};
		add_action( 'after_setup_theme', $image_sizes );
	}
	/**
	 * Проверка на установку зависимостей и вывод информационного сообщения.
	 *
	 * @category Settings_Class
	 * @package  Equd
	 */
	public static function templates_include() {
		add_filter(
			'template_include',
			function ( $template ) {
				if ( is_category( 'Arduino' ) ) {
					$new_template = locate_template( array( 'templates/category/arduino.php' ) );
					if ( $new_template ) {
						$template = $new_template;
					}
				}
				return $template;
			},
			99
		);
	}
}
