<?php
/**
 * Sidebar template for archive and single pages.
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
defined( 'ABSPATH' ) || exit;

if (is_singular()) {
	$type_name = get_post_type();
	if (locate_template("apps/$type_name/widgets/sidebar-single.php")) {
		get_template_part("apps/$type_name/widgets/sidebar-single");
	} else {
		get_template_part('core/widgets/sidebar-single');
	}
} elseif( is_post_type_archive() ) {
	$type_name = get_post_type();
	if ( locate_template( "apps/$type_name/widgets/sidebar-archive.php" ) ) {
		get_template_part( "apps/$type_name/widgets/sidebar-archive" );
	} else {
		get_template_part( 'core/widgets/sidebar-archive' );
	}
} elseif ( is_tax() ) {
	$tax_name = get_queried_object()->slug;
	if ( locate_template( "apps/$tax_name/widgets/sidebar-archive.php" ) ) {
		get_template_part( "apps/$tax_name/widgets/sidebar-archive" );
	} else {
		get_template_part( 'core/widgets/sidebar-archive' );
	}
} else {
	get_template_part( 'core/widgets/sidebar-archive' );
}