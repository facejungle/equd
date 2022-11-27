<?php
/**
 * Шаблон страниц категорий и архивов.
 * Template for category and archive pages.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

		get_header(); ?>
		<main id="primary" class="site-main flex-column">
			<?php
			\EQUD\Content\Tags::entry_header();
			if ( is_category() && ! is_archive() ) {
				$cat      = get_category( get_query_var( 'cat' ) );
				$cat_slug = $cat->slug;

				$locate_template = locate_template( "templates/category-$cat_slug.php" );
				if ( $locate_template ) {
					get_template_part( 'templates/category', $cat_slug );
				} else {
					get_template_part( 'templates/category' );
				}
			} if ( is_archive() ) {
				$post_types      = get_post_type();
				$locate_template = locate_template( "templates/archive-$post_types.php" );
				if ( $locate_template ) :
					get_template_part( 'templates/archive', $post_types );
				else :
					get_template_part( 'templates/archive' );
				endif;
			}
			\EQUD\Content\Tags::entry_footer(); ?>
		</main>
		<?php
		get_footer();
