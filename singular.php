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


$entry_header_def = 'widgets/entry_header/single.php';
$sidebar_def = 'widgets/sidebar/single.php';
$content_def = 'widgets/content/single.php';
$entry_footer_def = 'widgets/entry_footer/single.php';
switch (1) {
   case (is_attachment()):
      $equd_entry_header = array('entities/attachment/widgets/entry_header/single.php', $entry_header_def);
      $equd_sidebar = array('entities/attachment/widgets/sidebar/single.php', $sidebar_def);
      $equd_content = array('entities/attachment/widgets/content/single.php', $content_def);
      $equd_entry_footer = array('entities/attachment/widgets/entry_footer/single.php', $entry_footer_def);
      break;
   case (is_page()):
      $equd_entry_header = array('entities/page/widgets/entry_header/single.php');
      $equd_sidebar = array('entities/page/widgets/sidebar/single.php', $sidebar_def);
      $equd_content = array('entities/page/widgets/content/single.php', $content_def);
      $equd_entry_footer = array('entities/page/widgets/entry_footer/single.php');
      break;
   case (is_single() && !is_attachment()):
      $type_name = get_post_type();
      $equd_entry_header = array("entities/$type_name/widgets/entry_header/single.php", $entry_header_def);
      $equd_sidebar = array("entities/$type_name/widgets/sidebar/single.php", $sidebar_def);
      $equd_content = array("entities/$type_name/widgets/content/single.php", $content_def);
      $equd_entry_footer = array("entities/$type_name/widgets/entry_footer/single.php", $entry_footer_def);
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
            while (have_posts()) {
               the_post();
               locate_template($equd_content, true, false);
            }
         } else {
            locate_template('widgets/content/none.php', true);
         }
         ?>
      </div>
   </main>
</main>
<?php
get_footer();