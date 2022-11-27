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

get_header(); ?>
<main id="primary" class="site-main flex-column">
	<?php \EQUD\Content\Tags::entry_header(); ?>
	<main class="entry-main flex-row">
		<?php
		\EQUD\Content\Tags::sidebar();
		get_template_part( 'templates/content', get_post_type() );
		?>
	</main>
	<?php \EQUD\Content\Tags::entry_footer(); ?>
</main>
<?php
get_footer();

