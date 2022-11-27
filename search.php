<?php
/**
 * Шаблон страницы поиска.
 * Search page template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

get_header();
?>
<h2>root > search.php</h2>
	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'equd' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'templates/content/search' );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'templates/content/none' );
		endif;
		?>
	</main><!-- #main -->
<?php
get_footer();
