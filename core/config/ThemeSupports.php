<?php
/**
 * File with basic theme settings.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\config;

defined( 'ABSPATH' ) || exit;

/**
 * Class for basic theme settings: theme_supports, menu registration, file extension, image size.
 *
 * @category ThemeSupports class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class ThemeSupports {


	/**
	 * Class autoload.
	 */
	public function __construct() {
		 self::theme_support();
		self::mime_supports();
		self::register_menu();
		self::register_widget_areas();
		self::add_image_size();
	}

	/**
	 * Registering a text domain and adding theme support.
	 */
	private static function theme_support() {
		$theme_supports = static function () {
			load_theme_textdomain( 'equd', get_template_directory() . '/languages' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'widgets' );
			add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
			add_theme_support(
				'custom-logo',
				array(
					'height' => 75,
					'width'  => 150,
				)
			);
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

	}

	/**
	 * Adding support for .webp .svg files.
	 */
	private static function mime_supports() {
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
	 * Registering menu areas.
	 */
	private static function register_menu() {
		$theme_menus = function () {
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
	 * Registering widget areas.
	 */
	private static function register_widget_areas() {
		$sidebars = static function () {
			register_sidebar(
				array(
					'name'          => __( 'Categories sidebar', 'equd' ),
					'id'            => 'archive_sidebar',
					'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
					'before_widget' => '<li id="%1$s" class="widget %2$s">',
					'after_widget'  => '</li>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
			register_sidebar(
				array(
					'name'          => __( 'Singular sidebar', 'equd' ),
					'id'            => 'singular_sidebar',
					'description'   => __( 'Widgets in this area will be shown on all posts.', 'textdomain' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		};
		add_action( 'widgets_init', $sidebars );
	}

	/**
	 * Adding image sizes for cropping during upload in media files,
	 * as well as for inserting into the site.
	 */
	private static function add_image_size() {
		$choose_image_sizes = static function ( $sizes ) {
			return array_merge(
				$sizes,
				array(
					'post_thumbnail'         => __( 'post_thumbnail', 'equd' ),
					'post_thumbnail_preview' => __( 'post_thumbnail_preview', 'equd' ),
					'screenshot'             => __( 'screenshot', 'equd' ),
					'mediagallery'           => __( 'mediagallery', 'equd' ),
					'mediagallery_thumbnail' => __( 'mediagallery_thumbnail', 'equd' ),
				)
			);
		};
		add_filter( 'image_size_names_choose', $choose_image_sizes );
		$image_sizes = static function ( $sizes ) {
			add_image_size( 'rectangle_logo', 128, 64, array( 'center', 'center' ) );
			add_image_size( 'squad_logo', 128, 128, array( 'center', 'center' ) );
			add_image_size( 'post_image', 760, 380, array( 'center', 'bottom' ) );
			add_image_size( 'post_image_thumb', 480, 380, array( 'center', 'bottom' ) );
			add_image_size( 'gallery_image', 800, 450, array( 'center', 'bottom' ) );
			add_image_size( 'gallery_image_thumb', 320, 180, array( 'center', 'bottom' ) );

			add_image_size( 'post_thumbnail', 760, 380, array( 'center', 'bottom' ) );
			add_image_size( 'post_thumbnail_preview', 480, 380, array( 'center', 'bottom' ) );

			add_image_size( 'screenshot', 1600, 900, array( 'center', 'bottom' ) );
			add_image_size( 'mediagallery', 800, 450, array( 'center', 'bottom' ) );
			add_image_size( 'mediagallery_thumbnail', 320, 180, array( 'center', 'bottom' ) );
		};
		add_action( 'after_setup_theme', $image_sizes );
	}
}
