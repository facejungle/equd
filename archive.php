<?php

/**
 * @package equd
 */

get_header();
?>
<h2>root > archive.php</h2>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'templates/content', get_post_type() );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'templates/content', 'none' );
		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
