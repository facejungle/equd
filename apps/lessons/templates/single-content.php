<?php

/**
 * Шаблон страницы урока.
 * Lesson page template.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$data_arr = carbon_get_post_meta( $post->ID, 'lesson_stages' );
	foreach ( $data_arr as $stage_content ) {
		?>
		<div class="lesson-stage">
			<div class="lesson-stage__title">
				<h2>
					<?php echo $stage_content['lesson_stage_name']; ?>
				</h2>
			</div>
			<div class="lesson-stage__content">
				<?php
				foreach ( $stage_content['lesson_stage_content'] as $block_contents ) {
					?>
					<div class="lesson-stage__block flex-column">
						<?php
						foreach ( $block_contents['lesson_stage_content_block_list'] as $block_content ) {
							switch ( $block_content['_type'] ) {
								case 'lesson_stage_content_block_title':
									?>
									<h3>
										<?php echo $block_content['lesson_stage_content_block_title_elem']; ?>
									</h3>
									<?php
									break;

								case 'lesson_stage_content_block_text':
									?>
									<p>
										<?php echo $block_content['lesson_stage_content_block_text_elem']; ?>
									</p>
									<?php
									break;

								case 'lesson_stage_content_block_code':
									?>
									<pre
										class="block_code container"><code><?php echo $block_content['lesson_stage_content_block_code_elem']; ?></code></pre>
									<?php
									wp_enqueue_style( 'highlight' );
									break;

								case 'lesson_stage_content_block_image':
									?>
									<img
										src="<?php echo wp_get_attachment_image_url( $block_content['lesson_stage_content_block_image_elem'], 'lesson_preview' ); ?>"
										alt="">
									<?php
									break;

								case 'lesson_stage_content_block_association':
									foreach ( $block_content['lesson_stage_content_block_association_elem'] as $block_content_association ) {
										?>
										<p>ID ASSOC:
											<?php print_r( $block_content_association['id'] ); ?></br>
											TYPE ASSOC:
											<?php print_r( $block_content_association['type'] ); ?>
										</p>
										<?php
									}
									break;

								case 'lesson_stage_content_block_media_gallery':
									foreach ( $block_content['lesson_stage_content_block_media_gallery_elem'] as $block_content_media_gallery ) {
										?>
										<img
											src="<?php echo wp_get_attachment_image_url( $block_content_media_gallery, 'lesson_preview_mobile' ); ?>"
											alt="">
										<?php
									}
									break;
							} //end switch
						} //end foreach
						?>
					</div>
					<?php
				} //end foreach
				?>
			</div>
		</div>
		<?php
	} //end foreach
	?>
</article>
