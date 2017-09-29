<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Name: wp_bootstrap_sidebarwalker
 * Description: Custom sidebar walker
 * Version: 1.0.0
 * Author: Timo Paananen - Valu Digital Oy
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
class WP_Bootstrap_Sidebar_Walker extends Walker_page {

	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 * @param array $args
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='sidebar-menu-walker children'>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object.
	 * @param int $depth Depth of page. Used for padding.
	 * @param int $current_page Page ID.
	 * @param array $args
	 */
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}

		extract( $args, EXTR_SKIP );
		$css_class = array( 'page_item', 'page-item-' . $page->ID );

		$link_toggle = '';

		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			$css_class[] = 'page_item_has_children';
			//if ( 0 === $depth ) {
			$link_toggle = '<i class="fa fa-angle-down togglechildren toggle_' . $depth . '" aria-hidden="true"></i>';
			//}
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors, true ) ) {
				$css_class[] = 'current_page_ancestor';
			}
			if ( $page->ID === $current_page ) {
				$css_class[] = 'current_page_item';
			} elseif ( $_current_page && $page->ID === $_current_page->post_parent ) {
				$css_class[] = 'current_page_parent';
			}
		} elseif ( get_option( 'page_for_posts' ) === $page->ID ) {
			$css_class[] = 'current_page_parent';
		}

		/**
		 * Filter the list of CSS classes to include with each page item in the list.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $css_class An array of CSS classes to be applied
		 *                             to each list item.
		 * @param WP_Post $page Page data object.
		 * @param int $depth Depth of page, used for padding.
		 * @param array $args An array of arguments.
		 * @param int $current_page ID of the current page.
		 */
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		}

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink( $page->ID ) . '">' . $link_before . apply_filters( 'the_title',
		$page->post_title, $page->ID ) . $link_after . '</a>' . $link_toggle;

		if ( ! empty( $show_date ) ) {
			if ( 'modified' === $show_date ) {
				$time = $page->post_modified;
			} else {
				$time = $page->post_date;
			}

			$output .= ' ' . mysql2date( $date_format, $time );
		}
	}
}
