<?php
/**
 * Containers template
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

$content_containers = carbon_get_post_meta($post->ID, 'content_containers');

if ($content_containers) {
   foreach ($content_containers as $content_container) {
      ?>
      <div class="content-container">
         <div class="content-container__title">
            <h2>
               <?php echo $content_container['content_container_name']; ?>
            </h2>
         </div>
         <div class="content-container__blocks">
            <?php
            foreach ($content_container['content_blocks'] as $content_blocks) {
               ?>
               <div class="content__block flex-column">
                  <?php
                  foreach ($content_blocks['content_block_list'] as $content_block) {
                     switch ($content_block['_type']) {
                        case 'content_block_title':
                           ?>
                           <h3>
                              <?php echo $content_block['content_block_title_elem']; ?>
                           </h3>
                           <?php
                           break;

                        case 'content_block_text':
                           ?>
                           <p>
                              <?php echo $content_block['content_block_text_elem']; ?>
                           </p>
                           <?php
                           break;

                        case 'content_block_code':
                           wp_enqueue_style('highlight');
                           wp_enqueue_script('highlightjs');

                           add_action('wp_body_close', function () {
                              echo '<script>hljs.highlightAll();</script>';
                           })
                              ?>
                           <pre><code><?php esc_html_e($content_block['content_block_code_elem']); ?></code></pre>
                           <?php
                           break;

                        case 'content_block_image':
                           ?>
                           <img
                              src="<?php echo wp_get_attachment_image_url($content_block['content_block_image_elem'], 'size_medium'); ?>"
                              alt="">
                           <?php
                           break;

                        case 'content_block_association':
                           foreach ($content_block['content_block_association_elem'] as $block_content_association) {
                              ?>
                              <p>ID ASSOC:
                                 <?php print_r($block_content_association['id']); ?></br>
                                 TYPE ASSOC:
                                 <?php print_r($block_content_association['type']); ?>
                              </p>
                              <?php
                           }
                           break;

                        case 'content_block_media_gallery':
                           foreach ($content_block['content_block_media_gallery_elem'] as $block_content_media_gallery) {
                              ?>
                              <img src="<?php echo wp_get_attachment_image_url($block_content_media_gallery, 'lesson_preview_mobile'); ?>"
                                 alt="">
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
}
?>