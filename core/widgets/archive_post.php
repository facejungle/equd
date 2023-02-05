<section class="lessons posts-thumbs flex-column">
	\EQUD\Content\Tags::post_thumbnail();
	<?php
	the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><div class="posts-thumbs__title"><h2 class="entry-title">', '</h2></div></a>' );
	?>
</section>
