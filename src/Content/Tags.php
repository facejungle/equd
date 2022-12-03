<?php

/**
 * Файл для создания контент-тегов
 * File for creating content tags.
 *
 * PHP version 8.1
 *
 * @category Tags Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */

namespace EQUD\Content;

defined( 'ABSPATH' ) || exit;
/**
 * Класс с функциями для вывода различного контента.
 * A class with functions for displaying various content.
 *
 * PHP version 8.1
 *
 * @category Tags Class
 * @package  EQUD
 * @author   Face Jungle <110752838+facejungle@users.noreply.github.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/facejungle/equd
 */
class Tags {

	/**
	 * Выводит форму входа или ссылку на профиль пользователя.
	 * Displays a login form or a link to the user's profile.
	 */
	public static function login_form() {
		if ( is_user_logged_in() ) {
			echo 'LOGIN';
		} else {
			wp_login_form();
		}
	}//end login_form()


	/**
	 * Выводит код html с формой регистрации.
	 * Outputs the html code with the registration form.
	 */
	public static function registration_form() {
		?>
		<form id="registerform" action="<?php echo esc_url( wp_registration_url() ); ?>" method="post">
			<p>
				<label for="user_login">
					Имя пользователя<br>
					<input type="text" name="user_login" id="user_login" class="input" value="" size="20" style="">
				</label>
			</p>
			<p>
				<label for="user_email">
					E-mail<br>
					<input type="email" name="user_email" id="user_email" class="input" value="" size="25">
				</label>
			</p>

			<p id="reg_passmail">Подтверждение регистрации будет отправлено на ваш e-mail.</p>

			<br class="clear">
			<input type="hidden" name="redirect_to" value="">

			<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Регистрация"></p>
		</form> 
		<?php
	}//end registration_form()


	/**
	 * Выводит код html с датой публикации и датой изменения.
	 * Outputs html code with date of publication and date of modification.
	 */
	public static function posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		// translators: %s: post date.
			esc_html_x( 'Posted on %s', 'post date', 'equd' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}//end posted_on()


	/**
	 * Выводит код html с ссылкой на автора публикации.
	 * Displays html code with a link to the author of the post.
	 */
	public static function posted_by() {
		$byline = sprintf(
		// translators: %s: post author.
			esc_html_x( 'by %s', 'post author', 'equd' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}//end posted_by()


	/**
	 * Выводит изображение публикации.
	 * Displays the post image.
	 */
	public static function post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() && ! is_page() ) {
			if ( has_post_thumbnail() ) {
				?>
				<picture class="container">
					<source srcset="<?php the_post_thumbnail_url( 'post_thumbnail' ); ?>">
					<img src="<?php the_post_thumbnail_url( 'post_thumbnail' ); ?>">
				</picture>
				<?php
			} else {
				?>
				<picture>
					<source media="(max-width: 480px)" srcset="<?php echo EQUD_URL . '/assets/img/placeholder/480x360.svg'; ?>">
					<source media="(min-width: 800px)" srcset="<?php echo EQUD_URL . '/assets/img/placeholder/720x360.svg'; ?>">
					<img src="<?php echo EQUD_URL . '/assets/img/placeholder/720x360.png'; ?>">
				</picture>
				<?php
			}
		} elseif ( is_category() || is_home() || is_archive() ) {
			if ( has_post_thumbnail() ) {
				?>
				<a href="<?php the_permalink(); ?>" class="post-image" rel="bookmark">
					<picture>
						<source srcset="<?php the_post_thumbnail_url( 'post_thumbnail_preview' ); ?>">
						<img src="<?php the_post_thumbnail_url( 'post_thumbnail_preview' ); ?>">
					</picture>
				</a>
				<?php
			} else {
				?>
				<a href="<?php the_permalink(); ?>" class="post-image" rel="bookmark">
					<picture>
						<source srcset="<?php echo EQUD_URL . '/assets/img/placeholder/480x360.svg'; ?>">
						<img src="<?php echo EQUD_URL . '/assets/img/placeholder/480x360.png'; ?>">
					</picture>
				</a>
				<?php
			}
		}//end if
	}//end post_thumbnail()


	/**
	 * Выводит код html с тегами, рубриками, комментариями и ссылками для редактирования.
	 * Outputs html code with tags, categories, comments and links for editing.
	 */
	public static function entry_footer2() {
		if ( 'post' === get_post_type() ) {
			// translators: used between list items, there is a space after the comma
			$categories_list = get_the_category_list( esc_html__( ', ', 'equd' ) );
			if ( $categories_list ) {
				// translators: 1: list of categories.
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'equd' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			// translators: used between list items, there is a space after the comma
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'equd' ) );
			if ( $tags_list ) {
				// translators: 1: list of tags.
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'equd' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					// translators: %s: post title
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'equd' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					// translators: %s: Name of current post. Only visible to screen readers
					__( 'Edit <span class="screen-reader-text">%s</span>', 'equd' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}//end entry_footer2()


	/**
	 * Создает хук wp_body_open.
	 * Creates the wp_body_open hook.
	 */
	public static function wp_body_open() {
		do_action( 'wp_body_open' );
	}//end wp_body_open()


	/**
	 * Выводит блок заголовка для категорий.
	 * Displays a title block for categories.
	 */
	public static function category_header() {
		?>
		<div class="category-header">
			<div class="category-header__inner container flex-row">
				<div class="category-header__block">
					<header class="page-header">
		 <?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
					</header><!-- .page-header -->
				</div>
				<div class="category-header__block">2</div>
			</div>
		</div>
		<?php
	}//end category_header()


	/**
	 * Выводит блок заголовка для категорий.
	 * Displays a title block for categories.
	 */
	public static function entry_header() {
		if ( is_singular() && ! is_page() ) {
			?>
			<header class="entry-header post-header <?php echo get_post_type(); ?> container flex-row">
				<div class="entry-header__block post-thumb flex-column">
			<?php self::post_thumbnail(); ?>
				</div>
				<div class="entry-header__block">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			the_excerpt();
			?>
				</div>
			</header>
			<?php
		} elseif ( is_page() ) {
			?>

			<?php
		} elseif ( is_home() ) {
			?>
			<header class="entry-header category-header container flex-row">
				<div class="entry-header__block flex-column">
			<?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-header__block">
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
					222
				</div>
			</header>
			<?php
		} elseif ( is_category() && ! is_archive() ) {
			?>
			<header class="entry-header category-header container flex-row">
				<div class="entry-header__block flex-column">
			<?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-header__block">
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
					222
				</div>
			</header>
			<?php
		} elseif ( is_archive() ) {
			?>
			<header class="entry-header archive-header <?php echo get_post_type(); ?> container flex-row">
				<div class="entry-header__block flex-column">
			<?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-header__block">
					222
				</div>
			</header>
			<?php
		}//end if
	}//end entry_header()


	/**
	 * Выводит код html с тегами, рубриками, комментариями и ссылками для редактирования.
	 * Outputs html code with tags, categories, comments and links for editing.
	 */
	public static function entry_footer() {
		?>
		 <footer class="entry-footer">entry-footer</footer> 
		<?php
	}//end entry_footer()


	/**
	 * Выводит блок заголовка для категорий.
	 * Displays a title block for categories.
	 */
	public static function sidebar() {
		if ( is_singular() ) {
			if ( is_active_sidebar( 'singular_sidebar' ) ) {
				?>
				<aside id="singular-sidebar" class="sidebar flex-column">
				 <?php dynamic_sidebar( 'singular_sidebar' ); ?>
				</aside>
				<?php
			}
		} elseif ( is_category() && ! is_archive() ) {
			if ( is_active_sidebar( 'category_sidebar' ) ) {
				?>
				<aside id="category-sidebar" class="sidebar flex-column">
				<?php dynamic_sidebar( 'category_sidebar' ); ?>
				</aside>
				<?php
			}
		} elseif ( is_archive() ) {
			if ( is_active_sidebar( 'category_sidebar' ) ) {
				?>
				<aside id="archive-sidebar" class="sidebar flex-column">
				<?php dynamic_sidebar( 'category_sidebar' ); ?>
				</aside>
				<?php
			}
		} elseif ( is_home() ) {
			if ( is_active_sidebar( 'category_sidebar' ) ) {
				?>
				<aside id="archive-sidebar" class="sidebar flex-column">
				<?php dynamic_sidebar( 'category_sidebar' ); ?>
				</aside>
				<?php
			}
		}//end if
	}//end sidebar()
}//end class

