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
	?> 
			<section class="blog posts-thumbs flex-column"> 
				<?php
				\EQUD\Content\Tags::post_thumbnail();
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><div class="posts-thumbs__title"><h2 class="entry-title">', '</h2></div></a>' );
				?>
			</section>
	<?php
} elseif ( is_singular() ) {
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                
				<?php
				the_content();
				?>
								
			</article>
	<?php
}



