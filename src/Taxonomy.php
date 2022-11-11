<?php

namespace EQUD;

/**
 * @package equd
 */
defined( 'ABSPATH' ) || exit;

class Taxonomy {

	/**
	 * Переименование таксономии
	 *
	 * @param {string}      $tag - Will be the full string of the tag (`<link>` or `<script>`)
	 * @param {string}      $handle - The handle that was specified for the resource when enqueuing it
	 * @param {string}      $src - the URI of the resource
	 * @param {string|null} $media - if resources is style, should be the target media, else null
	 * @param {boolean}     $isStyle - If the resource is a stylesheet
	 */
	public static function rename_post_tag() {
		add_action(
			'init',
			function() {
				global $wp_taxonomies;

				$labels                     = & $wp_taxonomies['post_tag']->labels;
				$labels->name               = 'Тип записи';
				$labels->singular_name      = 'Тип записи';
				$labels->search_items       = 'Искать тип';
				$labels->not_found          = 'Тип запиписи не найден';
				$labels->not_found_in_trash = 'Тип запиписи не найден в корзине';
				$labels->nall_items         = 'Все типы';
				$labels->view_item          = 'Показать тип записи';
				$labels->nparent_item       = 'Родительский тип записи';
				$labels->nparent_item_colon = 'Родительский тип записи:';
				$labels->edit_item          = 'Редактировать тип записи';
				$labels->new_item           = 'Тип записи';
				$labels->nupdate_item       = 'Обновить тип записи';
				$labels->add_new            = 'Добавить тип записи';
				$labels->add_new_item       = 'Добавить тип записи';
				$labels->nnew_item_name     = 'Новый тип записи';
				$labels->menu_name          = 'Типы записей';
				$labels->name_admin_bar     = 'Типы записей';
				$labels->nback_to_items     = '← Назад к типу записей';
			}
		);
	}
}
