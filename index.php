<?php
/**
 * Основной файл шаблона, если не использован другой.
 * The main template file, unless another one is used.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

get_header(); ?>
<main id="primary" class="site-main flex-column">
	<?php \EQUD\Content\Tags::entry_header(); ?>
	<main class="entry-main flex-row">
	<?php
			if ( have_posts() ) :
				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'templates/content', get_post_type() );
				endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'templates/content', 'none' );
			endif;
			?>
	</main>
	<?php \EQUD\Content\Tags::entry_footer(); ?>
</main>
<?php
get_footer();

