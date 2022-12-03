<?php

/**
 * Шаблон страницы категории. Вывод постов и сайдбар.
 * Category page template.
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
		<main class="entry-main">
			<div class="wrapper container flex-row">
				<?php \EQUD\Content\Tags::sidebar(); ?>
				<div class="wrapper-grid flex-row">
					<?php
					$cat       = get_category( get_query_var( 'cat' ) );
					$args      = array(
						'post_type' => 'any',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $cat->category_nicename,
							),
						),
					);
					$any_posts = new WP_Query( $args );
					if ( $any_posts->have_posts() ) :
						// Start the Loop
						while ( $any_posts->have_posts() ) :
							$any_posts->the_post();
							get_template_part( 'templates/content', get_post_type() );
						endwhile;
					else :
							get_template_part( 'templates/content/none' );
					endif;
					?>
				</div>
			</div>
		</main>
