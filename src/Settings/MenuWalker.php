<?php
/**
 * Расширяющий класс для Walker_Nav_Menu
 * Extending class for Walker_Nav_Menu
 *
 * PHP version 8.1
 *
 * @category MenuWalker_Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Settings;

use Walker_Nav_Menu;

defined( 'ABSPATH' ) || exit;

/**
 * Расширяющий класс для Walker_Nav_Menu. Позволяет перезаписать <ul class="sub-menu">
 * Extending class for Walker_Nav_Menu. Allows you to overwrite <ul class="sub-menu">
 *
 * @category Extend_Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class MenuWalker extends \Walker_Nav_Menu {
	/**
	 * Запускает список до добавления элементов.
	 * Runs through the list before items are added.
	 *
	 * @category Loader_Class
	 * @package  EQUD
	 * @param string   $output Используется для добавления дополнительного содержимого (передается по ссылке).
	 * @param int      $depth  Глубина пункта меню. Используется для набивки.
	 * @param stdClass $args   Объект аргументов wp_nav_menu().
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		/**
		 * Классы, зависящие от глубины
		 */
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // отступ кода.
		$display_depth = ( $depth + 1 ); // Потому что он считает первое подменю равным 0.
		$classes       = array(
			'sub-menu',
			( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
			( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth,
		);
		$class_names   = implode( ' ', $classes );

		// построить html.
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	/**
	 * Запускает вывод элемента.
	 * Starts the output of an element.
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string  $output            Используется для добавления дополнительного содержимого (передается по ссылке).
	 * @param WP_POST $data_object       Объект элемента меню, подробнее ниже.
	 * @param int     $depth             Уровень вложенности элемента меню.
	 * @param object  $args              Параметры функции wp_nav_menu.
	 * @param int     $current_object_id По желанию. ID текущего пункта меню. По умолчанию 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		/**
		 * Запускает вывод элемента.
		 * Starts the output of an element.
		 *
		 * @var mixed     $wp_query
		 * @param object  $item Объект элемента меню, подробнее ниже.
		 * @param int     $depth Уровень вложенности элемента меню.
		 * @param object  $args Параметры функции wp_nav_menu
		 */
		global $wp_query;
		// Restores the more descriptive, specific name for use within this method.
		$item = $data_object;

		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent.

		// depth dependent classes.
		$depth_classes     = array(
			( $depth === 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth,
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes.
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html.
		$datada  = $item->ID;
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" datada="' . $datada . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes.
		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html.
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
