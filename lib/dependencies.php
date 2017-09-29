<?php

namespace Valu\Kantapohja\Dependencies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check dependencies.
 */
function check_dependencies() {

	$dependencies_installed = true;

	if ( ! function_exists( 'get_field' ) ) {
		$dependencies_installed = false;
	}

	if ( ! function_exists( 'PLL' ) ) {
		$dependencies_installed = false;
	}


	if ( ! class_exists( 'Mega_Menu' ) ) {
		$dependencies_installed = false;
	}

	if ( ! $dependencies_installed and ! is_admin() ) {
		wp_die( esc_html__( 'Install required dependencies: ACF, Polylang and Maxmegamenu', 'kantapohja' ) );
	}

}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\check_dependencies', 999 );
