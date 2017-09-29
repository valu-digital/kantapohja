<?php

namespace Valu\Kantapohja\Taxonomies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Taxonomy
function register_taxonomies() {

	$service_labels  = array(
		'name'                       => _x( 'Services', 'Taxonomy General Name', 'kantapohja' ),
		'singular_name'              => _x( 'Service', 'Taxonomy Singular Name', 'kantapohja' ),
		'menu_name'                  => __( 'Services', 'kantapohja' ),
		'all_items'                  => __( 'All Services', 'kantapohja' ),
		'parent_item'                => __( 'Parent Service', 'kantapohja' ),
		'parent_item_colon'          => __( 'Parent Service:', 'kantapohja' ),
		'new_item_name'              => __( 'New Service Name', 'kantapohja' ),
		'add_new_item'               => __( 'Add Service Item', 'kantapohja' ),
		'edit_item'                  => __( 'Edit Service', 'kantapohja' ),
		'update_item'                => __( 'Update Service', 'kantapohja' ),
		'view_item'                  => __( 'View Service', 'kantapohja' ),
		'separate_items_with_commas' => __( 'Separate service areas with commas', 'kantapohja' ),
		'add_or_remove_items'        => __( 'Add or remove service areas', 'kantapohja' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'kantapohja' ),
		'popular_items'              => __( 'Popular Services', 'kantapohja' ),
		'search_items'               => __( 'Search Services', 'kantapohja' ),
		'not_found'                  => __( 'Not Found', 'kantapohja' ),
	);
	$service_rewrite = array(
		'slug'         => 'palvelualue',
		'with_front'   => true,
		'hierarchical' => false,
	);
	$service_args    = array(
		'labels'            => $service_labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => true,
		'rewrite'           => $service_rewrite,
	);
	register_taxonomy( 'service', array( 'post', 'page', 'valu_people', 'blog_post' ), $service_args );

}

add_action( 'init', __NAMESPACE__ . '\\register_taxonomies', 0 );

/**
 * Get service of the current page and its' children.
 *
 * @param string $post_id
 *
 * @return array|bool
 */
function get_service_tree( $post_id = '' ) {

	global $post;

	if ( ! $post_id ) {
		$post_id = $post->ID;
	}

	$terms = get_the_terms( $post_id, 'service' ) ? get_the_terms( $post_id, 'service' ) : array();

	$services = wp_list_pluck( $terms, 'slug' );

	$args = array(
		'child_of'    => $post_id,
		'post_type'   => 'page',
		'numberposts' => - 1,
		'post_status' => 'publish',
	);

	$children = get_pages( $args );

	if ( $children ) {
		foreach ( $children as $child ) {

			$child_page_terms = get_the_terms( $child->ID, 'service' );

			if ( $child_page_terms ) {
				$child_page_services = wp_list_pluck( $child_page_terms, 'slug' );

				if ( $child_page_services ) {
					$services = array_merge( $services, $child_page_services );
				}
			}
		}
	}

	if ( $services ) {
		return $services;

	} else {
		return false;
	}

}
