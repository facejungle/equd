<?php
/**
 * Шаблон категорий и архивов.
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
	entry-header
	<main class="entry-main">
		<div class="wrapper container flex-row">
			<?php get_sidebar(); ?>
			<div class="wrapper-grid flex-row">
				<?php
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						if (is_category()) {
							get_template_part('apps/taxonomies/categories/templates/archive', 'content');
						} elseif (is_tax() && !is_category()) {
							echo '</br>is tax no cat</br>';
							$args = array(
								'public' => true,
								'_builtin' => false,
							);
							$tax_list = get_taxonomies($args);
							foreach ($tax_list as $tax) {
								$locate_template = locate_template("apps/taxonomies/$tax/templates/archive-content.php");
								if ($locate_template) {
									get_template_part("apps/taxonomies/$tax/templates/archive", 'content');
								} else {
									get_template_part('core/templates/archive', 'content');
								}
							}
						}
					}
				} else {
					echo '</br>empty</br>';
				}
				?>
			</div>
		</div>
	</main>
	entry-footer
</main>
<?php
get_footer();