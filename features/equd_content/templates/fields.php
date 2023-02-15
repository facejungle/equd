<?php
/**
 * Templates for fields.
 *
 * PHP version 8.1
 *
 * @category Template
 * @package  Equd
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

$title__field = carbon_get_post_meta(get_the_ID(), 'title__field');
if ($title__field) {
   echo '<h3>' . $title__field . '</h3>';
}
$text__field = carbon_get_post_meta(get_the_ID(), 'text__field');
if ($text__field) {
   echo '<p>' . $text__field . '</p>';
}
$code__field = carbon_get_post_meta(get_the_ID(), 'code__field');
if ($code__field) {
   wp_enqueue_style('highlight');
   wp_enqueue_script('highlightjs');
   add_action('wp_body_close',
   function () {
      echo '<script>hljs.highlightAll();</script>';
   });
   echo '<pre><code>' . $code__field . '</pre></code>';
}
?>