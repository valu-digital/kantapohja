<?php

namespace Valu\Kantapohja\Gallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 * The number of columns must be a factor of 12.
 *
 * @link http://getbootstrap.com/components/#thumbnails
 */
function gallery( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance ++;

	if ( ! empty( $attr['ids'] ) ) {
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$output = apply_filters( 'post_gallery', '', $attr );

	if ( '' !== $output ) {
		return $output;
	}

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract( shortcode_atts( [
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => '',
		'icontag'    => '',
		'captiontag' => '',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => '',
	], $attr ) );

	$id      = intval( $id );
	$columns = ( 0 === 12 % $columns ) ? $columns : 3;
	$grid    = sprintf( 'col-sm-%1$s col-lg-%1$s', 12 / $columns );

	if ( 'RAND' === $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$_attachments = get_posts( [
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby,
		] );

		$attachments = [];
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $exclude ) ) {
		$attachments = get_children( [
			'post_parent'    => $id,
			'exclude'        => $exclude,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby,
		] );
	} else {
		$attachments = get_children( [
			'post_parent'    => $id,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby,
		] );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		}

		return $output;
	}

	$unique = ( get_query_var( 'page' ) ) ? $instance . '-p' . get_query_var( 'page' ) : $instance;
	$output = '<div class="gallery clearfix gallery-' . $id . '-' . $unique . '">';

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		switch ( $link ) {
			case 'file':
				$newsize = ( 0 === $i ) ? 'post-thumbnail-large' : $size;
				$image   = wp_get_attachment_link( $id, $newsize, false, false );
				break;
			case 'none':
				$image = wp_get_attachment_image( $id, $size, false, [ 'class' => 'thumbnail img-thumbnail' ] );
				break;
			default:
				$image = wp_get_attachment_link( $id, $size, true, false );
				break;
		}
		$output .= '<div class="' . $newsize . ' clearfix">' . $image;

		if ( trim( $attachment->post_excerpt ) ) {
			$output .= '<div class="caption hidden">' . wptexturize( $attachment->post_excerpt ) . '</div>';
		}

		$output .= '</div>';
		$i ++;
	}

	$output .= '</div>';

	return $output;
}

remove_shortcode( 'gallery' );
add_shortcode( 'gallery', __NAMESPACE__ . '\\gallery' );
add_filter( 'use_default_gallery_style', '__return_null' );

/**
 * Add class="thumbnail img-thumbnail" to attachment items
 */
function attachment_link_class( $html ) {
	$html = str_replace( '<a', '<a class="thumbnail img-thumbnail"', $html );

	return $html;
}

add_filter( 'wp_get_attachment_link', __NAMESPACE__ . '\\attachment_link_class', 10, 1 );

function gallery_default_type_set_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file';

	return $settings;
}

add_filter( 'media_view_settings', __NAMESPACE__ . '\\gallery_default_type_set_link' );
