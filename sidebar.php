<?php

/**
 * @package equd
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<h2>root > sidebar.php</h2>
<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
