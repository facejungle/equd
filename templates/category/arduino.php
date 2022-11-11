<?php

/**
 * @package equd
 */

get_header();
?>
	<main id="primary" class="site-main">
        <div class="category-header">
            <div class="category-header__inner container flex-row">
                <div class="category-header__block">
                    <header class="page-header">
                        <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                        ?>
                    </header><!-- .page-header -->
                </div>
                <div class="category-header__block">2</div>
            </div>
        </div>
        <div class="category-content flex-row">
            <div class="category-content__sidebar">sidebar</div>
            <div class="category-content__main flex-row">
                <?php if ( have_posts() ) : 
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
            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();
