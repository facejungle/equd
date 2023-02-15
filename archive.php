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

defined('ABSPATH') || exit;

$entry_header_def = 'widgets/entry_header/archive.php';
$sidebar_def = 'widgets/sidebar/archive.php';
$content_def = 'widgets/content/archive.php';
$entry_footer_def = 'widgets/entry_footer/archive.php';

switch (1) {
	case (is_tag()):
		$equd_entry_header = array('entities/tag/widgets/entry-header-archive.php', $entry_header_def);
		$equd_sidebar = array('entities/tag/widgets/sidebar-archive.php', $sidebar_def);
		$equd_content = array('entities/tag/widgets/content-archive.php', $content_def);
		$equd_entry_footer = array('entities/tag/widgets/entry-footer-archive.php', $entry_footer_def);
		break;
	case (is_author()):
		$equd_entry_header = array('entities/author/widgets/entry-header-archive.php', $entry_header_def);
		$equd_sidebar = array('entities/author/widgets/sidebar-archive.php', $sidebar_def);
		$equd_content = array('entities/author/widgets/content-archive.php', $content_def);
		$equd_entry_footer = array('entities/author/widgets/entry-footer-archive.php', $entry_footer_def);
		break;
	case (is_date()):
		$equd_entry_header = array('entities/date/widgets/entry-header-archive.php', $entry_header_def);
		$equd_sidebar = array('entities/date/widgets/sidebar-archive.php', $sidebar_def);
		$equd_content = array('entities/date/widgets/content-archive.php', $content_def);
		$equd_entry_footer = array('entities/date/widgets/entry-footer-archive.php', $entry_footer_def);
		break;
	case (is_category()):
		$equd_entry_header = array('entities/category/widgets/entry-header-archive.php', $entry_header_def);
		$equd_sidebar = array('entities/category/widgets/sidebar-archive.php', $sidebar_def);
		$equd_content = array('entities/category/widgets/content-archive.php', $content_def);
		$equd_entry_footer = array('entities/category/widgets/entry-footer-archive.php');
		break;
	case (is_tax()):
		$tax_name = get_queried_object()->slug;
		$equd_entry_header = array("entities/$tax_name/widgets/entry-header-archive.php", $entry_header_def);
		$equd_sidebar = array("entities/$tax_name/widgets/sidebar-archive.php", $sidebar_def);
		$equd_content = array("entities/$tax_name/widgets/content-archive.php", $content_def);
		$equd_entry_footer = array("entities/$tax_name/widgets/entry-footer-archive.php", $entry_footer_def);
		break;
	case (is_post_type_archive() || is_home()):
		$type_name = get_post_type();
		$equd_entry_header = array("entities/$type_name/widgets/entry-header-archive.php", $entry_header_def);
		$equd_sidebar = array("entities/$type_name/widgets/sidebar-archive.php", $sidebar_def);
		$equd_content = array("entities/$type_name/widgets/content-archive.php", $content_def);
		$equd_entry_footer = array("entities/$type_name/widgets/entry-footer-archive.php");
		break;
	default:
		$equd_entry_header = $entry_header_def;
		$equd_sidebar = $sidebar_def;
		$equd_content = $content_def;
		$equd_entry_footer = $entry_footer_def;
		break;
}

get_header(); ?>
<main id="primary" class="site-main flex-column">
	<main class="entry-main">
		<div class="container flex-row">
			<?php
			locate_template($equd_sidebar, true);
			if (have_posts()) {
				locate_template($equd_content, true, false);
			} else {
				locate_template('widgets/content/none.php', true);
			}
			?>
		</div>
	</main>
</main>
<?php
get_footer();