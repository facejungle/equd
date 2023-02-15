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

	$equd_entry_header = 'widgets/entry_header/single.php';
	$equd_sidebar      = 'widgets/sidebar/single.php';
	$equd_content      = 'widgets/content/single.php';
	$entry_footer_def = 'widgets/entry_footer/single.php';
echo 'root->index.php';

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
