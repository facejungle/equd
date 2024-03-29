<?php
/**
 * Template for equd_content > crb_block model.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
global $post;
$content_blocks = carbon_get_post_meta( $post->ID, 'content_block_list' );
// print_r($content_blocks);
if ( $content_blocks ) {
	foreach ( $content_blocks as $key => $content_block ) {
		switch ( $content_block['_type'] ) {
			case 'block__title':
				?>
			<h3>
				 <?php echo $content_block['title__field']; ?>
			</h3>
				<?php
				break;

			case 'block__text':
				?>
			<p>
				<?php echo $content_block['text__field']; ?>
			</p>
				<?php
				break;

			case 'block__code':
				wp_enqueue_style( 'highlight' );
				wp_enqueue_script( 'highlightjs' );

				add_action(
					'wp_body_close',
					function () {
						echo '<script>hljs.highlightAll();</script>';
					}
				);
				?>
			<pre><code><?php esc_html_e( $content_block['code__field'] ); ?></code></pre>
				<?php
				break;

			case 'content_block_image':
				?>
			<img src="<?php echo wp_get_attachment_image_url( $content_block['content_block_image_elem'], 'size_medium' ); ?>" alt="">
				<?php
				break;

			case 'content_block_association':
				foreach ( $content_block['content_block_association_elem'] as $block_content_association ) {
					?>
			   <p>ID ASSOC:
					<?php print_r( $block_content_association['id'] ); ?></br>
				  TYPE ASSOC:
					<?php print_r( $block_content_association['type'] ); ?>
			   </p>
					<?php
				}
				break;

			case 'content_block_media_gallery':
				foreach ( $content_block['content_block_media_gallery_elem'] as $block_content_media_gallery ) {
					?>
			   <img src="<?php echo wp_get_attachment_image_url( $block_content_media_gallery, 'lesson_preview_mobile' ); ?>" alt="">
					<?php
				}
				break;
		}
	}
}
