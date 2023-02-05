<?php
/**
 * Шаблон для страниц одиночной записи.
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

get_header(); ?>
<main id="primary" class="site-main flex-column">
	\EQUD\Content\Tags::entry_header();
	<main class="entry-main">
		<div class="wrapper container flex-row">
			<?php
			get_sidebar();
			echo get_post_type();
			echo '</br>root>index</br>';
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					$locate_template = locate_template('apps/' . get_post_type() . '/templates/single-content.php');
					if($locate_template){
						get_template_part('apps/' . get_post_type() . '/templates/single', 'content');
					} else{
						get_template_part('core/templates/single', 'content');
					}
				}
			}else{
				echo '</br>empty</br>';
			}

			?>
		</div>
	</main>
	\EQUD\Content\Tags::entry_footer()
</main>
<?php
get_footer();
