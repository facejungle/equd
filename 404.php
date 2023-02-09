<?php
/**
 * Page "error 404" template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD;
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<main id="primary" class="site-main flex-column">
	<main class="entry-main">
		<div class="wrapper container flex-row">
			<div class="error-404 not-found default-max-width">
				<div class="page-content">
					<p>
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone' ); ?>
					</p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
		</div>
	</main><!-- .entry-main -->
</main><!-- .site-main -->
<?php
get_footer();
