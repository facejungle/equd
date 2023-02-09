<?php
/**
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

?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                
	 <?php
		the_content();
		?>
					 
 </article>
<?php


