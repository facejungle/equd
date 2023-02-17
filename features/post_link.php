<?php
/**
 * File to enable or disable styles and scripts.
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class for including and disabling styles and scripts.
 *
 * PHP version 8.1
 *
 * @category PostLink Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class post_link {

	private static $type_name;
	private static $tax_name;
	private static $replace_tag;

	public function __construct( $post_type, $tax, $tag ) {
		$this->type_name   = $post_type;
		$this->tax_name    = $tax;
		$this->replace_tag = $tag;
		self::edit_permalink();
		add_action( 'init', array( $this, 'generated_rewrite_rules' ) );
	}
	private static function edit_permalink() {
		$permalinks = static function ( $permalink, $post ) {
			// выходим если это не наш тип записи: без холдера %products%.
			if ( strpos( $permalink, '%equd_replace_tag%' ) === false ) {
				return $permalink;
			}

			// Получаем элементы таксы.
			$terms = get_the_terms( $post, 'category' );
			// если есть элемент заменим холдер.
			if ( ! is_wp_error( $terms ) && ! empty( $terms ) && is_object( $terms[0] ) ) {
				$cat_id   = $terms[0]->term_id;
				$cat_path = get_category_parents( $cat_id, false, '/', true );
			}
			// элемента нет, а должен быть...
			else {
				$cat_path = 'no-category/';
			}

			return str_replace( '%equd_replace_tag%/', $cat_path, $permalink );
		};
		add_filter( 'post_type_link', $permalinks, 1, 2 );
	}
	public function generated_rewrite_rules() {
		add_rewrite_rule(
			'^' . $this->type_name . '/(.*)/(.*)/?$',
			'index.php?post_type=' . $this->type_name . '&name=$matches[2]',
			'top'
		);
	}
}
