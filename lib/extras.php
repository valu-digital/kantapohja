<?php

namespace Valu\Kantapohja\Extras;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Valu\Kantapohja\Setup;

/**
 * Add <body> classes
 */
function body_class( $classes ) {
	// Add page slug if it doesn't exist
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	if ( is_page() and ! is_page_template() and ! is_front_page() ) {
		$classes[] = 'sidebar-both';
	}

	// Add class if sidebar is active
	if ( Setup\display_sidebar() ) {
		$classes[] = 'sidebar-right';
	}

	if ( is_home() or is_archive() or is_post_type_archive( 'valu_people' ) or is_post_type_archive( 'event' ) or is_page_template( 'template-dynasty-meetings.php' ) ) {
		$classes[] = 'sidebar-left';
	}

	if ( wp_is_mobile() ) {
		$classes[] = 'mobile-device';
	}

	// Polylang
	$classes[] = get_bloginfo( 'language' );

	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
	return '&hellip;';
}

add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );

/**
 * Define custom excerpt length.
 *
 * @param $length
 *
 * @return int
 */
function custom_excerpt_length( $length ) {
	return 40;
}

add_filter( 'excerpt_length', __NAMESPACE__ . '\\custom_excerpt_length', 999 );

/**
 * Define custom excerpt field.
 *
 * @param $output
 *
 * @return string
 */
function custom_excerpt( $output ) {
	if ( function_exists( 'get_field' ) ) {
		if ( get_field( 'post_ingress' ) ) {
			$post_ingress_field = get_field( 'post_ingress', false, false );
			$output             = wp_trim_words( $post_ingress_field, 25, '...' );
		}
	}

	return $output;
}

add_filter( 'get_the_excerpt', __NAMESPACE__ . '\\custom_excerpt' );

/**
 * Add favicon.
 */
function add_favicon() {
	echo '<link rel="shortcut icon" href="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/favicon.ico" />';
}

add_action( 'wp_head', __NAMESPACE__ . '\\add_favicon' );

/**
 * Add theme settings page
 */
function add_theme_settings_page() {

	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page( array(
			'page_title' => __( 'Theme Settings', 'kantapohja' ),
			'menu_title' => __( 'Theme Settings', 'kantapohja' ),
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
		) );

	}

}

add_action( 'admin_menu', __NAMESPACE__ . '\\add_theme_settings_page' );

/**
 * Clean category title.
 *
 * @param $title
 *
 * @return string
 */
function clean_category_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', __NAMESPACE__ . '\\clean_category_title' );

/**
 * @return string
 */
function move_yoast_seo_to_the_bottom() {
	return 'low';
}

add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\\move_yoast_seo_to_the_bottom' );

/**
 * Bootstrap pagination function
 *
 * @param string $pages
 * @param int $range
 */

function pagination( $pages = '', $range = 4 ) {

	$showitems = ( $range * 2 ) + 1;

	global $paged;

	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( '' === $pages ) {

		global $wp_query;

		$pages = $wp_query->max_num_pages;

		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( $pages > 1 ) {

		echo '<nav><ul class="pagination">';

		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo
				'<li>
					<a href="' . esc_url( get_pagenum_link( 1 ) ) . '" aria-label="First">&laquo;
					<span class="hidden-xs"> ' . esc_html__( 'First', 'kantapohja' ) . '</span>
					</a>
				</li>';
		}

		if ( $paged > 1 && $showitems < $pages ) {
			echo
				'<li>
				<a href="' . esc_url( get_pagenum_link( $paged - 1 ) ) . '" aria-label="Previous">&lsaquo;
				<span class="hidden-xs"> ' . esc_html__( 'Previous', 'kantapohja' ) . '</span>
				</a>
			</li>';
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 !== $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged === $i ) ? '<li class="active"><span>' . esc_attr( $i ) . ' <span class="sr-only">(current)</span></span></li>' : '<li><a href="' . esc_url( get_pagenum_link( $i ) ) . '">' . esc_attr( $i ) . '</a></li>';
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo
				'<li>
					<a href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '\"  aria-label="Next">
					<span class="hidden-xs">' . esc_html__( 'Next', 'kantapohja' ) . '</span>&rsaquo;
					</a>
				</li>';
		}

		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo
				'<li>
					<a href="' . esc_url( get_pagenum_link( $pages ) ) . '" aria-label="Last">
					<span class="hidden-xs">' . esc_html__( 'Last', 'kantapohja' ) . '</span>&raquo;
					</a>
				</li>';
		}

		echo '</ul></nav>';
	}

}

/**
 * Get thumbnail id.
 *
 * @param string $id
 *
 * @return bool|int|mixed|null|string
 */
function get_thumbnail_id( $id = '' ) {

	if ( ! $id ) {
		$id = get_the_ID();
	}

	if ( ! $id ) {
		return false;
	}

	$thumb_id = get_post_thumbnail_id();

	// Get parent thumb if no thumb
	if ( ! $thumb_id ) {
		$parents      = get_post_ancestors( $id );
		$parents_keys = array_keys( $parents );
		$parents_last = end( $parents_keys );
		if ( $parents_last ) {
			$parent_id = ( $parents ) ? $parents[ $parents_last ] : $id;
		} else {
			// is parent
			$parent_id = $id;
		}
		$thumb_id = get_post_thumbnail_id( $parent_id );
	}

	// Still no thumb id, even from parents
	if ( ! $thumb_id ) {
		$thumb_id = get_field( 'default_bg', 'option' );
	}

	return $thumb_id;
}

/**
 * Get department names.
 *
 * @param string $current_language
 *
 * @return array
 */
function get_department_names( $current_language = '' ) {

	if ( ! $current_language ) {
		$current_language = pll_current_language();
	}

	if ( ! $current_language ) {
		return;
	}

	$department_names = array();
	$departments      = get_the_terms( get_the_ID(), sprintf( 'department_%s', $current_language ) );

	if ( ! is_wp_error( $departments ) and is_array( $departments ) ) {
		foreach ( $departments as $term ) {
			$department_names[] = esc_html( $term->name );
		}
	}

	natsort( $department_names );

	return $department_names;

}

/**
 * Add custom FacetWP translations.
 *
 * @param $string
 *
 * @return mixed
 */
function custom_facetwp_i18n( $string ) {
	$lang = pll_current_language();

	// manual translations
	$translations                  = array();
	$translations['fi']['Keyword'] = 'Hakusana';
	$translations['en']['Keyword'] = 'Keyword';
	$translations['fi']['Keyword'] = 'Hakusana';
	$translations['en']['Keyword'] = 'Keyword';

	if ( isset( $translations[ $lang ][ $string ] ) ) {
		return $translations[ $lang ][ $string ];
	}

	return $string;
}

add_filter( 'facetwp_i18n', __NAMESPACE__ . '\\custom_facetwp_i18n' );

/**
 * Add custom buttom to the FacetWP search.
 *
 * @param $output
 * @param $params
 *
 * @return string
 */
function search_facetwp_facet_html( $output, $params ) {

	if ( 'search' === $params['facet']['type'] ) {
		$output .= '<button class="btn btn-info btn-block btn-sidebar btn-facet-search">' . __( 'Search ', 'kantapohja' ) . '</button>';
	}

	return $output;
}

add_filter( 'facetwp_facet_html', __NAMESPACE__ . '\\search_facetwp_facet_html', 10, 2 );

/**
 * Custom FacetWP Pager
 *
 * @param $output
 * @param $params
 *
 * @return string
 */
function custom_facetwp_pager_html( $output, $params ) {
	$output      = '';
	$page        = (int) $params['page'];
	$total_pages = (int) $params['total_pages'];

	// Only show pagination when > 1 page
	if ( 1 < $total_pages ) {

		if ( 1 < $page ) {
			$output .= '<a class="facetwp-page" data-page="' . ( $page - 1 ) . '">&laquo; ' . esc_html__( 'Previous', 'kantapohja' ) . '</a>';
		}
		if ( 3 < $page ) {
			$output .= '<a class="facetwp-page first-page" data-page="1">1</a>';
			$output .= ' <span class="dots">…</span> ';
		}
		for ( $i = 2; $i > 0; $i -- ) {
			if ( 0 < ( $page - $i ) ) {
				$output .= '<a class="facetwp-page" data-page="' . ( $page - $i ) . '">' . ( $page - $i ) . '</a>';
			}
		}

		// Current page
		$output .= '<a class="facetwp-page active" data-page="' . $page . '">' . $page . '</a>';

		for ( $i = 1; $i <= 2; $i ++ ) {
			if ( $total_pages >= ( $page + $i ) ) {
				$output .= '<a class="facetwp-page" data-page="' . ( $page + $i ) . '">' . ( $page + $i ) . '</a>';
			}
		}
		if ( $total_pages > ( $page + 2 ) ) {
			$output .= ' <span class="dots">&hellip;</span> ';
			$output .= '<a class="facetwp-page last-page" data-page="' . $total_pages . '">' . $total_pages . '</a>';
		}
		if ( $page < $total_pages ) {
			$output .= '<a class="facetwp-page" data-page="' . ( $page + 1 ) . '">' . esc_html__( 'Next', 'kantapohja' ) . ' &raquo;</a>';
		}
	}

	return $output;
}

add_filter( 'facetwp_pager_html', __NAMESPACE__ . '\\custom_facetwp_pager_html', 10, 2 );

/**
 * Add home url to the shorturl field.
 *
 * @param $field
 *
 * @return mixed
 */
function add_url_to_valu_shorturl( $field ) {

	$field['prepend'] = esc_url( home_url( '/' ) );

	return $field;
}

add_filter( 'acf/load_field/name=valu_shorturl', __NAMESPACE__ . '\\add_url_to_valu_shorturl' );

/**
 * Redirect short url.
 */
function redirect_short_url() {

	$shorturl = explode( '/', $_SERVER['REQUEST_URI'] );
	$shorturl = $shorturl[1];

	if ( '' !== $shorturl ) {
		$args = array(
			'post_status'         => 'publish',
			'post_type'           => 'any',
			'meta_query'          => array(
				array(
					'key'     => 'valu_shorturl',
					'value'   => sanitize_text_field( $shorturl ),
					'compare' => '=',
				),
			),
			'showposts'           => 1,
			'ignore_sticky_posts' => true,
		);

		$query = new \WP_Query( $args );

		$redirect_to = '';
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$redirect_to = esc_url( get_permalink() );
				break;
			endwhile;
		endif;
		wp_reset_postdata();

		if ( '' !== $redirect_to ) {
			wp_safe_redirect( $redirect_to, 302 );
			exit;
		}
	}

}

add_action( 'template_redirect', __NAMESPACE__ . '\\redirect_short_url', 0 );

/**
 *
 * @param $valid
 * @param $value
 * @param $field
 * @param $input
 *
 * @return string
 */
function validate_short_url( $valid, $value, $field, $input ) {

	$current_post_id = esc_html( $_POST['post_ID'] );

	if ( ! $valid ) {
		return $valid;
	}

	if ( '' === $value ) {
		return $valid;
	}

	if ( remove_special_characters( $value ) !== $value ) {
		$valid = 'Special characters not allowed in short url';

		return $valid;
	}

	$args = array(
		'post_status'         => 'publish',
		'post_type'           => 'any',
		'meta_query'          => array(
			array(
				'key'     => 'valu_shorturl',
				'value'   => $value,
				'compare' => '=',
			),
		),
		'showposts'           => 1,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array( $current_post_id ),
	);

	$query = new \WP_Query( $args );

	$post_title = '';
	$foundpost  = false;
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			$foundpost  = true;
			$post_title = get_the_title();
			break;
		endwhile;
	endif;
	wp_reset_postdata();

	if ( $foundpost ) {
		$valid = 'Current shorturl is already in use in post "' . $post_title . '"';
	}

	// return
	return $valid;

}

add_filter( 'acf/validate_value/name=valu_shorturl', __NAMESPACE__ . '\\validate_short_url', 10, 4 );

/**
 * Redirect old URLs
 */
function redirect_old_urls() {

	$old_path = esc_url( $_SERVER['REQUEST_URI'] );
	$old_path = site_url( $old_path, 'http' );

	if ( '' !== $old_path ) {
		$args = array(
			'post_status'         => 'publish',
			'post_type'           => 'any',
			'meta_query'          => array(
				array(
					'key'     => '_redirect_url',
					'value'   => $old_path,
					'compare' => '=',
				),
			),
			'showposts'           => 1,
			'ignore_sticky_posts' => true,
		);

		$query = new \WP_Query( $args );

		$redirect_to = '';
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$redirect_to = esc_url( get_permalink() );
				break;
			endwhile;
		endif;
		wp_reset_postdata();

		if ( '' !== $redirect_to ) {
			wp_safe_redirect( $redirect_to, 302 );
			exit;
		}
	}

}

add_action( 'template_redirect', __NAMESPACE__ . '\\redirect_old_urls', 0 );

/**
 * Validate redirect url acf field.
 *
 * @param $valid
 * @param $value
 * @param $field
 * @param $input
 *
 * @return string
 */
function validate_redirect_url_field( $valid, $value, $field, $input ) {

	$current_post_id = esc_html( $_POST['post_ID'] );

	if ( ! $valid ) {
		return $valid;
	}

	if ( '' === $value ) {
		return $valid;
	}

	$args = array(
		'post_status'         => 'publish',
		'post_type'           => 'any',
		'meta_query'          => array(
			array(
				'key'     => '_redirect_url',
				'value'   => $value,
				'compare' => '=',
			),
		),
		'showposts'           => 1,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array( $current_post_id ),
	);

	$query = new \WP_Query( $args );

	$post_title = '';
	$foundpost  = false;
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			$foundpost  = true;
			$post_title = get_the_title();
			break;
		endwhile;

	endif;
	wp_reset_postdata();

	if ( $foundpost ) {
		$valid = 'Current shorturl is already in use in post "' . $post_title . '"';
	}

	// return
	return $valid;

}

add_filter( 'acf/validate_value/name=_redirect_url', __NAMESPACE__ . '\\validate_redirect_url_field', 10, 4 );


/**
 * Redirect page to another content page (uses ACF).
 */
function redirect_page_to() {

	if ( function_exists( 'get_field' ) ) {
		$redirect_page_to_id = get_field( 'redirect_page_to' );

		if ( $redirect_page_to_id ) {
			$redirect_to = get_permalink( $redirect_page_to_id );

			if ( '' !== $redirect_to ) {
				wp_safe_redirect( esc_url( $redirect_to ), 302 );
				exit;
			}
		}
	}
}

add_action( 'template_redirect', __NAMESPACE__ . '\\redirect_page_to', 0 );

/**
 * Remove special characters.
 *
 * @param $string
 *
 * @return mixed
 */
function remove_special_characters( $string ) {
	$string = str_replace( ' ', '-', $string );

	return preg_replace( '/[^A-Za-z0-9\-]/', '', $string );
}

/**
 * Get icon for attachment.
 *
 * @param $post_id
 *
 * @return string
 */
function get_icon_for_attachment( $post_id ) {
	$type = get_post_mime_type( $post_id );
	switch ( $type ) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
			return '<i class="fa fa-file-image-o"></i>';
			break;
		case 'text/csv':
		case 'text/plain':
		case 'text/xml':
			return '<i class="fa fa-file-text"></i>';
			break;
		case 'application/pdf':
			return '<i class="fa fa-file-pdf-o"></i>';
			break;
		default:
			return '<i class="fa fa-file-o"></i>';
	}
}

/**
 * @param $format
 * @param $timestamp
 * @param $zone
 *
 * @return string
 */
function date_timezone( $format, $timestamp, $zone ) {
	$dtime = new \DateTime();
	$dtime->setTimestamp( $timestamp );
	$timezone = new \DateTimeZone( $zone );
	$dtime->setTimeZone( $timezone );
	$date = $dtime->format( $format );

	return $date;
}
