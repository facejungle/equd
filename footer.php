<?php
/**
 * Общий шаблон подвала сайта.
 * General site footer template.
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
		<footer id="colophon" class="site-footer">
			<div class="site-footer__line">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-horizontal',
						'menu_id'        => 'footer-horizontal',
					)
				);
				?>
			</div>
			<div class="site-footer__line nav flex-row">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu1',
						'menu_id'        => 'footer-menu1',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu2',
						'menu_id'        => 'footer-menu2',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu3',
						'menu_id'        => 'footer-menu3',
					)
				);
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu4',
						'menu_id'        => 'footer-menu4',
					)
				);
				?>
			</div>
			<div class="site-footer__line">
				<div class="site-info">
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'equd' ), 'equd', '<a href="https://vk.com/face_jungle">face jungle ;c</a>' );
					?>
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
		<?php wp_footer(); ?>
		<script>hljs.highlightAll();</script>
	</body>
</html>
