<?php
/**
 * Content template for archives.
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
<article class="archive flex-column">
	<?php
	locate_template('widgets/entry_header/archive.php', true);
	?>
	<div class="archive-grid flex-row">
		<?php
		while (have_posts()) {
			the_post();
			?>
			<section class="post-preview flex-column <?php echo tag_escape(get_post_type()); ?>">
				<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
				<?php
				echo get_the_post_thumbnail($post, 'size_small');
				the_title('<div class="post-preview__title"><h2 class="entry-title">', '</h2></div>');
				the_excerpt();
				
				?>
				</a>
			</section>
		<?php
		}
		?>
	</div>
	<?php
	locate_template('widgets/entry_footer/archive.php', true);
	?>
</article>