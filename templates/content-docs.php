<?php
/**
 * Шаблон страницы одиночной записи.
 * Singular post page template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

if ( ! is_singular() ) {
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
} elseif ( is_singular() ) {
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
				<?php
				if ( is_singular() ) {
					\EQUD\Content\Tags::sidebar(); }
				?>
				<main class="entry-content">
					<?php
					the_content();
					?>
				</main>				
			</article>
			<?php
}



