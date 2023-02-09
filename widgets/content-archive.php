<?php
/**
 * Archive page template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

?>
<div class="wrapper-grid flex-row">
	<section class="posts-thumbs flex-column">
			\EQUD\Content\Tags::post_thumbnail();
			<?php
			the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><div class="posts-thumbs__title"><h2 class="entry-title">', '</h2></div></a>' );
			?>
	</section>
</div>