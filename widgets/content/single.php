<?php
/**
 * Content template for single post and pages.
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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php locate_template('widgets/entry_header/single.php', true); ?>
	<div class="post-content flex-column">
		<?php
		the_content();
		\EQUD\entities\post\app\config::$post_content->view_model();
		?>
	</div>
	<?php
	locate_template('widgets/entry_footer/single.php', true);
	?>
</article>
<?php
