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
	<?php \EQUD\Content\Tags::entry_header(); ?>
	<main class="entry-main">
			<div class="wrapper container flex-row">
				<?php \EQUD\Content\Tags::sidebar(); ?>
				<div class="wrapper-grid flex-row">
					<?php
					if ( have_posts() ) :
						// Start the Loop
						while ( have_posts() ) :
							the_post();
							get_template_part( 'templates/content', get_post_type() );
						endwhile;
					else :
								get_template_part( 'templates/content', 'none' );
					endif;
					?>
				</div>
			</div>
		</main>
	<?php \EQUD\Content\Tags::entry_footer(); ?>
</main>
<?php
get_footer();
