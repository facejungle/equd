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

if ( ! is_singular() ) {
	?> <section class="leassons posts-thumbs"> <?php
		\EQUD\Content\Tags::post_thumbnail();
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	?> </section> <?php
} elseif ( is_singular() ) {
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					$data_arr = carbon_get_post_meta( $post->ID, 'leasson_stages' );
					foreach ( $data_arr as $stage_content ) {
						?>
							<div class="leasson-stage">
								<div class="leasson-stage__title"><h2><?php echo $stage_content['leasson_stage_name']; ?></h2></div>
							<div class="leasson-stage__content">
							<?php
							foreach ( $stage_content['leasson_stage_content'] as $block_contents ) {
								?>
									<div class="leasson-stage__block flex-column">
									<?php
									foreach ( $block_contents['leasson_stage_content_block_list'] as $block_content ) {
										switch ( $block_content['_type'] ) {
											case 'leasson_stage_content_block_title':
												?>
													<h3><?php echo $block_content['leasson_stage_content_block_title_elem']; ?></h3>
													<?php
												break;
											case 'leasson_stage_content_block_text':
												?>
													<p><?php echo $block_content['leasson_stage_content_block_text_elem']; ?></p>
													<?php
												break;
											case 'leasson_stage_content_block_code':
												?>
													<pre class="block_code container"><code><?php echo $block_content['leasson_stage_content_block_code_elem']; ?></code></pre>
													<?php
												break;
											case 'leasson_stage_content_block_image':
												?>
													<img src="<?php echo wp_get_attachment_image_url( $block_content['leasson_stage_content_block_image_elem'], 'leasson_preview' ); ?>" alt="">
													<?php
												break;
											case 'leasson_stage_content_block_association':
												foreach ( $block_content['leasson_stage_content_block_association_elem'] as $block_content_association ) {
													?>
														<p>ID ASSOC: <?php print_r( $block_content_association['id'] ); ?></br>
														TYPE ASSOC: <?php print_r( $block_content_association['type'] ); ?></p>
														<?php
												}
												break;
											case 'leasson_stage_content_block_media_gallery':
												foreach ( $block_content['leasson_stage_content_block_media_gallery_elem'] as $block_content_media_gallery ) {
													?>
														<img src="<?php echo wp_get_attachment_image_url( $block_content_media_gallery, 'leasson_preview_mobile' ); ?>" alt="">
														<?php
												}
												break;
										}
									}
									?>
									</div>
									<?php
							}
							?>
							</div>
						</div>
						<?php
					}
					?>
			</article>
	<?php
}
