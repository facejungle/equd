<?php

/**
 * Шаблон страницы урока.
 * Lesson page template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<main class="entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'equd' ),
							'after'  => '</div>',
						)
					);
					?>
				</main>
			</article>
