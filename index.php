<?php
/**
 * General template file.
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

if ( is_singular() ) {
	$entry_header_def = 'widgets/entry-header-single.php';
	$sidebar_def      = 'widgets/sidebar-single.php';
	$content_def      = 'widgets/content-single.php';
	$entry_footer_def = 'widgets/entry-footer-single.php';
	switch ( 1 ) {
		case ( is_attachment() ):
			get_template_part( 'core/pages/single-attachment' );
			$equd_entry_header = array( 'apps/attachment/widgets/entry-header-single.php', $entry_header_def );
			$equd_sidebar      = array( 'apps/attachment/widgets/sidebar-single.php', $sidebar_def );
			$equd_content      = array( 'apps/attachment/widgets/content-single.php', $content_def );
			$equd_entry_footer = array( 'apps/attachment/widgets/entry-footer-single.php', $entry_footer_def );
			break;
		case ( is_page() ):
			$equd_entry_header = array( 'apps/page/widgets/entry-header-single.php' );
			$equd_sidebar      = array( 'apps/page/widgets/sidebar-single.php', $sidebar_def );
			$equd_content      = array( 'apps/page/widgets/content-single.php', $content_def );
			$equd_entry_footer = array( 'apps/page/widgets/entry-footer-single.php' );
			break;
		case ( is_single() && ! is_attachment() ):
			$type_name         = get_post_type();
			$equd_entry_header = array( "apps/$type_name/widgets/entry-header-single.php", $entry_header_def );
			$equd_sidebar      = array( "apps/$type_name/widgets/sidebar-single.php", $sidebar_def );
			$equd_content      = array( "apps/$type_name/widgets/content-single.php", $content_def );
			$equd_entry_footer = array( "apps/$type_name/widgets/entry-footer-single.php", $entry_footer_def );
			break;
		default:
			$equd_entry_header = $entry_header_def;
			$equd_sidebar      = $sidebar_def;
			$equd_content      = $content_def;
			$equd_entry_footer = $entry_footer_def;
			break;
	}
} else {
	if ( have_posts() ) {
		$entry_header_def = 'widgets/entry-header-archive.php';
		$sidebar_def      = 'widgets/sidebar-archive.php';
		$content_def      = 'widgets/content-archive.php';
		$entry_footer_def = 'widgets/entry-footer-archive.php';
		switch ( 1 ) {
			case ( is_tag() ):
				$equd_entry_header = array( 'apps/tag/widgets/entry-header-archive.php', $entry_header_def );
				$equd_sidebar      = array( 'apps/tag/widgets/sidebar-archive.php', $sidebar_def );
				$equd_content      = array( 'apps/tag/widgets/content-archive.php', $content_def );
				$equd_entry_footer = array( 'apps/tag/widgets/entry-footer-archive.php', $entry_footer_def );
				break;
			case ( is_author() ):
				$equd_entry_header = array( 'apps/author/widgets/entry-header-archive.php', $entry_header_def );
				$equd_sidebar      = array( 'apps/author/widgets/sidebar-archive.php', $sidebar_def );
				$equd_content      = array( 'apps/author/widgets/content-archive.php', $content_def );
				$equd_entry_footer = array( 'apps/author/widgets/entry-footer-archive.php', $entry_footer_def );
				break;
			case ( is_date() ):
				$equd_entry_header = array( 'apps/date/widgets/entry-header-archive.php', $entry_header_def );
				$equd_sidebar      = array( 'apps/date/widgets/sidebar-archive.php', $sidebar_def );
				$equd_content      = array( 'apps/date/widgets/content-archive.php', $content_def );
				$equd_entry_footer = array( 'apps/date/widgets/entry-footer-archive.php', $entry_footer_def );
				break;
			case ( is_category() ):
				$equd_entry_header = array( 'apps/category/widgets/entry-header-archive.php', $entry_header_def );
				$equd_sidebar      = array( 'apps/category/widgets/sidebar-archive.php', $sidebar_def );
				$equd_content      = array( 'apps/category/widgets/content-archive.php', $content_def );
				$equd_entry_footer = array( 'apps/category/widgets/entry-footer-archive.php' );
				break;
			case ( is_tax() ):
				$tax_name          = get_queried_object()->slug;
				$equd_entry_header = array( "apps/$tax_name/widgets/entry-header-archive.php", $entry_header_def );
				$equd_sidebar      = array( "apps/$tax_name/widgets/sidebar-archive.php", $sidebar_def );
				$equd_content      = array( "apps/$tax_name/widgets/content-archive.php", $content_def );
				$equd_entry_footer = array( "apps/$tax_name/widgets/entry-footer-archive.php", $entry_footer_def );
				break;
			case ( is_post_type_archive() || is_home() ):
				$type_name         = get_post_type();
				$equd_entry_header = array( "apps/$type_name/widgets/entry-header-archive.php", $entry_header_def );
				$equd_sidebar      = array( "apps/$type_name/widgets/sidebar-archive.php", $sidebar_def );
				$equd_content      = array( "apps/$type_name/widgets/content-archive.php", $content_def );
				$equd_entry_footer = array( "apps/$type_name/widgets/entry-footer-archive.php" );
				break;
			default:
				$equd_entry_header = $entry_header_def;
				$equd_sidebar      = $sidebar_def;
				$equd_content      = $content_def;
				$equd_entry_footer = $entry_footer_def;
				break;
		}
	} else {
		$equd_content = 'core/widgets/content-none';
	}
}

get_header(); ?>
<main id="primary" class="site-main flex-column">
	<?php locate_template( $equd_entry_header, true ); ?>
	<main class="entry-main">
		<div class="wrapper container flex-row">
		<?php locate_template( $equd_sidebar, true ); ?>
		<?php locate_template( $equd_content, true ); ?>
		</div>
	</main><!-- .entry-main -->
	<?php locate_template( $equd_entry_footer, true ); ?>
</main><!-- .site-main -->
<?php
get_footer();
