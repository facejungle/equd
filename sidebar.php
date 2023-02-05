<?php
/**
 * Шаблон для страниц одиночной записи.
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
<div class="sidebar">
	<?php

	if ( is_singular() ) {
		dynamic_sidebar( 'singular_sidebar' );
	} else {
		dynamic_sidebar( 'archive_sidebar' );
	}

	?>

</div>
